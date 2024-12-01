<?php session_start();
error_reporting(0);
// Database Connection
include('includes/config.php');
//Validating Session
if (strlen($_SESSION['aid']) == 0) {
  header('location:index.php');
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
                  <h3 class="card-title">Student Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">

                    <tbody>
                      <?php
                      // Input validation
                      $sid = isset($_GET['sid']) ? filter_var($_GET['sid'], FILTER_VALIDATE_INT) : 0;
                      if (!$sid) {
                        die("Invalid student ID");
                      }

                      // Prepare statement to prevent SQL injection
                      $query = "SELECT s.*, p.name as program_name 
                                  FROM tblstudents s
                                  JOIN programs p ON s.program = p.id 
                                  WHERE s.id = ?";

                      if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt, "i", $sid);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);


                        if ($student = mysqli_fetch_assoc($result)) {
                          $email = $student['email'];
                      ?>
                          <tr>
                            <th>Student Number</th>
                            <td colspan="3"><?php echo htmlspecialchars($student['studentNumber']); ?></td>
                          </tr>

                          <tr>
                            <th>First Name</th>
                            <td><?php echo htmlspecialchars($student['firstName']); ?></td>
                            <th>Last Name</th>
                            <td><?php echo htmlspecialchars($student['lastName']); ?></td>
                          </tr>

                          <tr>
                            <th>Program</th>
                            <td><?php echo htmlspecialchars($student['program_name']); ?></td>
                            <th>Status</th>
                            <td><?php echo htmlspecialchars($student['status']); ?></td>
                          </tr>

                          <tr>
                            <th>Email</th>
                            <td colspan="2"><?php echo htmlspecialchars($student['email']); ?></td>
                          </tr>
                          <?php
                          $files_query = "SELECT * FROM tblfile WHERE studentId = ? ORDER BY updated_at DESC";
                          if ($stmt = mysqli_prepare($con, $files_query)) {
                            mysqli_stmt_bind_param($stmt, "i", $sid);
                            mysqli_stmt_execute($stmt);
                            $files = mysqli_stmt_get_result($stmt);
                            if (mysqli_num_rows($files) > 0) {
                          ?>
                              <tr>
                                <th>Files</th>
                                <td colspan="3">
                                  <ul>
                                    <?php while ($file = mysqli_fetch_assoc($files)):
                                      $statusBadge = match ($file['status']) {
                                        'pending' => 'warning',
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        default => 'secondary'
                                      };
                                    ?>
                                      <div class="d-flex align-items-center mb-4">
                                        <i class="fas fa-file mr-2"></i>
                                        <span class="me-3"><?= htmlspecialchars($file['fileType']) ?></span>
                                        <span class="badge bg-<?= $statusBadge ?> mr-3"><?= htmlspecialchars($file['status']) ?></span>
                                        <a href="php/download.php?file=<?= urlencode($file['id']) ?>"
                                          class="btn btn-sm btn-success mr-2">
                                          <i class="fas fa-download"></i>
                                        </a>
                                        <?php if ($file['status'] === 'pending'): ?>
                                          <button onclick="updateFileStatus(<?= $file['id'] ?>, 'approved')"
                                            class="btn btn-sm btn-success mr-2">
                                            <i class="fas fa-check"></i>
                                          </button>
                                          <button onclick="updateFileStatus(<?= $file['id'] ?>, 'rejected')"
                                            class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                          </button>
                                        <?php endif; ?>
                                      </div>
                                    <?php endwhile; ?>
                                  </ul>
                                </td>
                              </tr>
                          <?php
                            }
                          }

                          ?>

                      <?php
                        } else {
                          echo "<tr><td colspan='4'>No student found</td></tr>";
                        }
                        mysqli_stmt_close($stmt);
                      } else {
                        echo "Error preparing statement: " . mysqli_error($con);
                      }
                      ?>

                    </tbody>
                    <td colspan="4" style="text-align:center;">
                      <a href="../gmail/gmail.php?email=<?= urlencode($email) ?>" class="btn btn-info">Take Action</a>
                    </td>

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

      function updateFileStatus(fileId, status) {
        if (confirm('Are you sure you want to ' + status + ' this file?')) {
          fetch('php/update-file-status.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: `file_id=${fileId}&status=${status}`
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                location.reload();
              } else {
                alert('Error updating status');
              }
            });
        }
      }
    </script>
</body>

</html>