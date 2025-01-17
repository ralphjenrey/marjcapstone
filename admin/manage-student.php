<?php
include_once('includes/config.php');
include_once('includes/modal.php');

session_start();
if (!isset($_SESSION['aid'])) {
    header('location: index.php');
    exit();
}

$status = [
    'new',
    'old',
    'returnee',
    'shiftee',
    'transferee'
];

$query = "SELECT id, name, `key` FROM programs";
$result = $con->query($query);

$programs = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $programs[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include_once('includes/navbar.php'); ?>

        <!-- Main Sidebar Container -->
        <?php include_once('includes/sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <h1 class="m-0">Student Details</h1>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary m-0" onclick="showAddStudentModal()">Add Student</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Student Number</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT `id`, `studentNumber`, `firstName`, `lastName`, `email`, `program`, `status`, `created_at`, `updated_at` FROM `tblstudents`";
                                            $result = $con->query($query);

                                            $students = [];
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $students[] = $row;
                                                }
                                            }

                                            $con->close();
                                            ?>
                                            <?php foreach ($students as $student): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($student['studentNumber']) ?></td>
                                                    <td><?= htmlspecialchars($student['firstName']) ?></td>
                                                    <td><?= htmlspecialchars($student['lastName']) ?></td>
                                                    <td><?= htmlspecialchars($student['email']) ?></td>
                                                    <td><span class="badge bg-<?= $student['status'] === 'active' ? 'success' : 'danger' ?>"><?= htmlspecialchars($student['status']) ?></span></td>
                                                    <td><?= date('M d, Y h:i A', strtotime($student['created_at'])) ?></td>
                                                    <td><?= date('M d, Y h:i A', strtotime($student['updated_at'])) ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning" onclick="showEditStudentModal(<?= $student['id'] ?>, '<?= htmlspecialchars($student['firstName'], ENT_QUOTES) ?>', '<?= htmlspecialchars($student['lastName'], ENT_QUOTES) ?>', '<?= htmlspecialchars($student['email'], ENT_QUOTES) ?>', '<?= htmlspecialchars($student['program'], ENT_QUOTES) ?>', '<?= htmlspecialchars($student['status'], ENT_QUOTES) ?>')">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" onclick="deleteStudent(<?= $student['id'] ?>)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        <?php
        $studentData = isset($_SESSION['add-student']) ? $_SESSION['add-student'] : [
            'studentNumber' => '',
            'firstName' => '',
            'lastName' => '',
            'email' => '',
            'program' => '',
            'status' => ''
        ];

        //Clear the session data
        unset($_SESSION['add-student']);
    
        ?>
        function showAddStudentModal() {
            showModal('Add Student', `
                <form action="./php/add-student.php" method="post">
                    <div class="form-group">
                        <label for="studentNumber">Student Number</label>
                        <input type="text" class="form-control" name="studentNumber" value="<?php echo htmlspecialchars($studentData['studentNumber']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" name="firstName" value="<?php echo htmlspecialchars($studentData['firstName']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" name="lastName" value="<?php echo htmlspecialchars($studentData['lastName']) ?>" required>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($studentData['email']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="program">Program</label>
                        <select class="form-control" name="program" required>
                             <?php foreach ($programs as $program): ?>
                                <option value="<?= $program['id'] ?>" <?= $studentData['program'] == $program['key'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($program['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" required>
                            <?php foreach ($status as $s): ?>
                                <option value="<?= $s ?>" <?= $s === $studentData['status'] ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            `, [{
                text: 'Close',
                class: 'btn-secondary',
                dismiss: true
            }]);
        }

        function showEditStudentModal(id, firstName, lastName, email, program, status) {
            showModal('Edit Student', `
                <form action="./php/update-student.php" method="post">
                    <input type="hidden" name="id" value="${id}">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" name="firstName" value="${firstName}" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" name="lastName" value="${lastName}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="${email}" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" required>
                            <?php foreach ($status as $s): ?>
                                <option value="<?= $s ?>" <?= $s === $status ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password">
                        
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            `, [{
                text: 'Close',
                class: 'btn-secondary',
                dismiss: true
            }]);
        }

        function deleteStudent(id) {
            if (confirm('Are you sure you want to delete this student?')) {
                fetch(`./php/delete-student.php?id=${id}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert('Error deleting student: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Error: ' + error);
                });
            }
        }
        
        $('#togglePassword').on('click', function() {
            var $passwordInput = $('#password');
            var $passwordIcon = $(this).find('i');
            
            if ($passwordInput.attr('type') === 'password') {
                $passwordInput.attr('type', 'text');
                $passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                $passwordInput.attr('type', 'password');
                $passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

    </script>
</body>

</html>