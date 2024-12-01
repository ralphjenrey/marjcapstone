<?php session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['aid']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        try {
            $eid = intval($_GET['enrollid']);
            $estatus = $_POST['status'];
            $oremark = $_POST['officialremak'];

            // Start transaction
            mysqli_begin_transaction($con);

            // Update enrollment status
            $query = mysqli_query($con, "UPDATE tblenrollment SET officialRemark='$oremark', enrollStatus='$estatus' WHERE id='$eid'");
            if (!$query) {
                throw new Exception("Error updating enrollment: " . mysqli_error($con));
            }

            // Get enrollment details
            $getEnroll = mysqli_query($con, "SELECT * FROM tblenrollment WHERE id='$eid'");
            if (!$getEnroll) {
                throw new Exception("Error fetching enrollment details: " . mysqli_error($con));
            }
            $enrollData = mysqli_fetch_assoc($getEnroll);

            // Insert into student table if accepted
            if ($estatus == 'Accepted') {
                $insertStudent = mysqli_query($con, "INSERT INTO tblstudent (
                    studentNumber, firstName, lastName, age, phoneNumber,
                    status, email, gender, program, documentImage, remarks
                ) VALUES (
                    '{$enrollData['enrollmentNumber']}',
                    '{$enrollData['fatherName']}',
                    '{$enrollData['motherName']}',
                    '{$enrollData['childName']}',
                    '{$enrollData['parentmobNo']}',
                    'Active',
                    '{$enrollData['parentEmail']}',
                    '{$enrollData['childAge']}',
                    '{$enrollData['enrollProgram']}',
                    '{$enrollData['image']}',
                    '{$enrollData['message']}'
                )");

                if (!$insertStudent) {
                    throw new Exception("Error inserting student record: " . mysqli_error($con));
                }
            }

            // Commit transaction
            mysqli_commit($con);
            echo "<script>alert('Enrollment Status updated successfully.');</script>";

        } catch (Exception $e) {
            // Rollback transaction on error
            mysqli_rollback($con);
            echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
            error_log("Enrollment Error: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include_once("includes/navbar.php"); ?>
    <!-- /.navbar -->

    <?php include_once("includes/sidebar.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Student Details</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Student Details</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">


              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Enrollment Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">

                    <tbody>
                      <?php $eid = intval($_GET['enrollid']);
                      var_dump($eid);
                      $query = mysqli_query($con, "select * from tblenrollment where id='$eid'");
                      $cnt = 1;
                      while ($result = mysqli_fetch_array($query)) {
                      ?>


                        <tr>
                          <th>Enrollment Number</th>
                          <td colspan="3"><?php echo $result['enrollmentNumber'] ?></td>
                        </tr>

                        <tr>
                          <th>First Name</th>
                          <td><?php echo $result['fatherName'] ?></td>
                          <th>Last Name</th>
                          <td> <?php echo $result['motherName'] ?></td>
                        </tr>
                        <tr>
                          <th>Age</th>
                          <td><?php echo $result['childName'] ?></td>
                          <th>Sex</th>
                          <td><?php echo $result['childAge'] ?></td>
                        </tr>
                        <tr>
                          <th>Program Enroll</th>
                          <td><?php echo $result['enrollProgram'] ?></td>
                          <th>Status</th>
                          <td><?php echo $result['status'] ?></td>
                        </tr>
                        <tr>
                          <th>Email</th>
                          <td><?php echo $result['parentEmail'] ?></td>
                          <th>Phone Mobile</th>
                          <td><?php echo $result['parentmobNo'] ?></td>
                        </tr>

                        <tr>
                          <th>Posting Date</th>
                          <td colspan="3"><?php echo $result['postingDate'] ?></td>
                        </tr>

                        <tr>
                          <th>Message</th>
                          <td colspan="3"><?php echo $result['message'] ?></td>
                        </tr>

                        <tr>
                          <th>Image</th>
                          <td colspan="3"><img src="../img/<?php echo $result['image'] ?>" width="200" height="200" /></td>
                        </tr>
                        <?php if ($result['enrollStatus'] != ''): ?>
                          <tr>
                            <th>Program Enroll Status</th>
                            <td><?php echo $result['enrollStatus'] ?></td>
                            <th>Updation date Date</th>
                            <td><?php echo $result['updationDate'] ?></td>
                          </tr>

                          <tr>
                            <th>Official Remark</th>
                            <td colspan="3"><?php echo $result['officialRemark'] ?></td>
                          </tr>
                        <?php endif; ?>
                        <?php if ($result['enrollStatus'] == ''): ?>
                          <tr>
                            <td colspan="4" style="text-align:center;">
                              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Take Action</button>
                            </td>
                          <?php endif; ?>

                        <?php $cnt++;
                      } ?>

                    </tbody>

                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once('includes/footer.php'); ?>


  </div>
  <!-- ./wrapper -->


  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Enrollment Satus</h4>
        </div>
        <div class="modal-body">
          <form name="takeaction" method="post">

            <p><select class="form-control" name="status" required>
                <option value="">Select Enrollment Status</option>
                <option value="Accepted">Accepted</option>
                <option value="Rejected">Rejected</option>
                <option value="Pending">Pending</option>


              </select></p>
            <p><textarea class="form-control" name="officialremak" placeholder="Official Remark" rows="5" required></textarea></p>
            <input type="submit" class="btn btn-primary" name="submit" value="Update">

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>






  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>
<?php  ?>