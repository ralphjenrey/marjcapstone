<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['rid']) == 0) {
    header('location:index.php');
} else {
    // Get and validate status parameter
    $status = isset($_GET['status']) ? $_GET['status'] : 'all';
    $validStatuses = ['pending', 'enrolled', 'rejected', 'all'];
    if (!in_array($status, $validStatuses)) {
        $status = 'all';
    }

    // Build query based on status
    $query = "SELECT s.*, p.name as program
    FROM tblstudents s 
    INNER JOIN programs p ON s.program = p.id";
    if ($status !== 'all') {
        $status = mysqli_real_escape_string($con, string: $status);
        $query .= " WHERE status2 = '$status'";
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
            <?php include_once("includes/navbar.php"); ?>
            <?php include_once("includes/sidebar.php"); ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Students List <?php echo $status != 'all' ? '- ' . ucfirst($status) : ''; ?></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active">All Enrollments</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="mt-3">
                                            <a href="student-list.php" class="btn <?php echo $status == 'all' ? 'btn-primary' : 'btn-secondary'; ?>">All</a>
                                            <a href="student-list.php?status=pending" class="btn <?php echo $status == 'pending' ? 'btn-primary' : 'btn-warning'; ?>">Pending</a>
                                            <a href="student-list.php?status=enrolled" class="btn <?php echo $status == 'enrolled' ? 'btn-primary' : 'btn-success'; ?>">Accepted</a>
                                            <!-- <a href="student-list.php?status=rejected" class="btn <?php echo $status == 'rejected' ? 'btn-primary' : 'btn-danger'; ?>">Rejected</a> -->
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Student No</th>
                                                    <th>Name</th>
                                                    <th>Program Enroll</th>
                                                    <th>Status</th>
                                                    <th>Status2</th>
                                                    <th>Posting Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result_query = mysqli_query($con, $query);
                                                $cnt = 1;
                                                while ($result = mysqli_fetch_array($result_query)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><?php echo $result['studentNumber'] ?></td>
                                                        <td><?php echo $result['firstName'] ?> <?php echo $result['lastName'] ?></td>
                                                        <td><?php echo $result['program'] ?></td>
                                                        <td><?= $result['status'] ?></td>
                                                        <td>
                                                            <span class="badge <?php
                                                                                echo $result['status2'] == 'enrolled' ? 'badge-success' : ($result['status'] == 'rejected' ? 'badge-danger' : 'badge-warning');
                                                                                ?>">
                                                                <?php echo ucfirst($result['status2']) ?>
                                                            </span>
                                                        </td>
                                                        <td><?php echo $result['updated_at'] ?></td>
                                                        <td class="text-center">
                                                            <a href="status-details.php?sid=<?php echo $result['id']; ?>"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $cnt++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
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
<?php } ?>