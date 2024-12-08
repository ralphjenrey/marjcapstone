<?php
include_once('includes/config.php');
include_once('includes/modal.php');

session_start();
if (!isset($_SESSION['aid']) && $_SESSION['aid'] == 0) {
    header('location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Details</title>
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
                            <h1 class="m-0">Registrar Details</h1>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary m-0" onclick="showAddRegistrarModal()">Add Registrar</button>
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
                                    <?php
                                    // Remove static $registrars array and replace with database query
                                    $query = "SELECT `id`, `registrarNumber`, `firstName`, `lastName`, `email`, `status`, `created_at`, `updated_at` FROM `tblregistrar`";
                                    $result = $con->query($query);

                                    $registrars = [];
                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $registrars[] = $row;
                                        }
                                    }

                                    // Table display code remains the same since it already handles the data structure correctly
                                    ?>

                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Registrar Number</th>
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
                                            <?php foreach ($registrars as $registrar): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($registrar['registrarNumber']) ?></td>
                                                    <td><?= htmlspecialchars($registrar['firstName']) ?></td>
                                                    <td><?= htmlspecialchars($registrar['lastName']) ?></td>
                                                    <td><?= htmlspecialchars($registrar['email']) ?></td>
                                                    <td><span class="badge bg-<?= $registrar['status'] === 'active' ? 'success' : 'danger' ?>"><?= htmlspecialchars($registrar['status']) ?></span></td>
                                                    <td><?= date('M d, Y h:i A', strtotime($registrar['created_at'])) ?></td>
                                                    <td><?= date('M d, Y h:i A', strtotime($registrar['updated_at'])) ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning" onclick="showEditRegistrarModal(<?= $registrar['id'] ?>, '<?= htmlspecialchars($registrar['firstName'], ENT_QUOTES) ?>', '<?= htmlspecialchars($registrar['lastName'], ENT_QUOTES) ?>', '<?= htmlspecialchars($registrar['email'], ENT_QUOTES) ?>', '<?= htmlspecialchars($registrar['status'], ENT_QUOTES) ?>')">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" onclick="deleteRegistrar(<?= $registrar['id'] ?>)">
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
        $registrarData = isset($_SESSION['add-registrar']) ? $_SESSION['add-registrar'] : [
            'registrarNumber' => '',
            'firstName' => '',
            'lastName' => '',
            'email' => '',
            'status' => 'active'
        ];

        // Clear session after getting data
        unset($_SESSION['add-registrar']);
        ?>

        function showAddRegistrarModal() {
            showModal('Add Registrar', `
                <form action="./php/add-registrar.php" method="post">
                    <div class="form-group">
                        <label for="registrarNumber">Registrar Number</label>
                        <input type="text" class="form-control" name="registrarNumber" value="<?= $registrarData['registrarNumber'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" name="firstName" value="<?= $registrarData['firstName'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" name="lastName" value="<?= $registrarData['lastName'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $registrarData['email'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password" required>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="active" <?= $registrarData['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= $registrarData['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
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

        function showEditRegistrarModal(id, firstName, lastName, email, program, status) {
            showModal('Edit Registrar', `
                <form action="./php/update-registrar.php" method="post">
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
                    <div class="form-group>
                        <label for="status">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="active" ${status === 'active' ? 'selected' : ''}>Active</option>
                            <option value="inactive" ${status === 'inactive' ? 'selected' : ''}>Inactive</option>
                        </select>
                    <div class="form-group>
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password">

                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            `, [{
                text: 'Close',
                class: 'btn-secondary',
                dismiss: true
            }]);
        }

        // function deleteRegistrar(id) {
        //     if (confirm('Are you sure you want to delete this registrar?')) {
        //         fetch(`./php/delete-registrar.php?id=${id}`, {
        //                 method: 'DELETE'
        //             })
        //             .then(response => response.json())
        //             .then(data => {
        //                 if (data.success) {
        //                     window.location.reload();
        //                 } else {
        //                     alert('Error deleting registrar: ' + data.message);
        //                 }
        //             })
        //             .catch(error => {
        //                 alert('Error: ' + error);
        //             });
        //     }
        // }

        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var passwordIcon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>