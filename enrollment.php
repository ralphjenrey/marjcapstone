<?php
include_once('includes/config.php');
session_start();
require('validator/formvalidator.php');

$validator = new FormValidator();
if (isset($_POST['submit'])) {
    if ($validator->validate($_POST)) {
        try {
            // Get form data
            $studentNumber = mysqli_real_escape_string($con, $_POST['studentNumber']);
            $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
            $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $program = (int)mysqli_real_escape_string($con, $_POST['program']);

            // Check for existing student number globally
            $checkStudentNumber = mysqli_query($con, "SELECT studentNumber FROM tblstudents WHERE studentNumber = '$studentNumber'");
            if (mysqli_num_rows($checkStudentNumber) > 0) {
                $_SESSION['errors']['studentNumber'] = "Student number already exists";
                $_SESSION['old_input'] = $_POST;
                header('Location: enrollment.php');
                exit();
            }

            // Check for existing student number and program combination
            $checkStudent = mysqli_query($con, "SELECT studentNumber FROM tblstudents 
                                              WHERE studentNumber = '$studentNumber' 
                                              AND program = $program");
            if (mysqli_num_rows($checkStudent) > 0) {
                $_SESSION['errors']['studentNumber'] = "Student is already enrolled in this program";
                $_SESSION['old_input'] = $_POST;
                header('Location: enrollment.php');
                exit();
            }

            // Check for existing email
            $checkEmail = mysqli_query($con, "SELECT email FROM tblstudents WHERE email = '$email'");
            if (mysqli_num_rows($checkEmail) > 0) {
                $_SESSION['errors']['email'] = "This email address is already registered";
                $_SESSION['old_input'] = $_POST;
                header('Location: enrollment.php');
                exit();
            }

            // If no duplicates, proceed with insert
            $query = mysqli_query($con, "INSERT INTO tblstudents(studentNumber, firstName, lastName, email, password, program) 
            VALUES('$studentNumber', '$firstName', '$lastName', '$email', '$password', '$program')");

            if ($query) {
                echo "<script>alert('Student registered successfully.');</script>";
                echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
            }

        } catch (mysqli_sql_exception $e) {
            $_SESSION['errors']['db'] = "Registration failed: " . 
                (strpos($e->getMessage(), 'Duplicate entry') !== false ? 
                "Student number or email already exists" : "Database error occurred");
            $_SESSION['old_input'] = $_POST;
            header('Location: enrollment.php');
            exit();
        }
    } else {
        $_SESSION['errors'] = $validator->getErrors();
        $_SESSION['old_input'] = $_POST;
        header('Location: enrollment.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 80%;
            margin-top: 0.25rem;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        body {
            background-image: url('img/6.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .glass-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 700px;
            text-align: center;
        }

        h1 {
            color: black;
            margin-bottom: 30px;
        }

        label {
            color: black;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            color: gray;
            border: none;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: none;
            border: none;
        }

        .btn-custom {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: gray;
            color: white;
        }

        /* Positioning the back button */
        .back-button {
            position: absolute;
            top: 20px;
            left: 50px;
        }

        .btn-secondary {
            padding: 1px 5px;
            font-family: 'Heebo', sans-serif;
            border: none;
            font-size: .75rem;
            background-color: #007bff;
            color: white;
        }

        /* Changing text color to black after filling the input fields */
        .filled {
            color: black !important;
        }
    </style>
</head>

<body>

    <div class="back-button">
        <a href="about.php" class="btn btn-secondary btn-lg">Back</a>
    </div>

    <div class="glass-container">
        <h1>Student Registration</h1>
        <form method="POST" enctype="multipart/form-data" id="enrollmentForm">
            <?php
            // At the top after session_start()
            $errors = [];
            $old_input = [];
            if (isset($_SESSION['errors'])) {
                $errors = $_SESSION['errors'];
                $old_input = $_SESSION['old_input'] ?? [];
                unset($_SESSION['errors']);
                unset($_SESSION['old_input']);
            }
            ?>

            <!-- Update form fields with error checking and old input values -->
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <input type="text"
                        class="form-control <?php echo isset($errors['studentNumber']) ? 'is-invalid' : ''; ?>"
                        name="studentNumber"
                        value="<?php echo htmlspecialchars($old_input['studentNumber'] ?? ''); ?>"
                        placeholder="8 digits Student Number"
                        required>
                    <?php if (isset($errors['studentNumber'])): ?>
                        <div class="invalid-feedback d-block">
                            <?php echo htmlspecialchars($errors['studentNumber']); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6 mb-3">
                    <input type="text"
                        class="form-control <?php echo isset($errors['firstName']) ? 'is-invalid' : ''; ?>"
                        name="firstName"
                        value="<?php echo htmlspecialchars($old_input['firstName'] ?? ''); ?>"
                        placeholder="First Name"
                        required>
                    <?php if (isset($errors['firstName'])): ?>
                        <div class="invalid-feedback d-block">
                            <?php echo htmlspecialchars($errors['firstName']); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6 mb-3">
                    <input type="text"
                        class="form-control <?php echo isset($errors['lastName']) ? 'is-invalid' : ''; ?>"
                        name="lastName"
                        value="<?php echo htmlspecialchars($old_input['lastName'] ?? ''); ?>"
                        placeholder="Last Name"
                        required>
                    <?php if (isset($errors['lastName'])): ?>
                        <div class="invalid-feedback d-block">
                            <?php echo htmlspecialchars($errors['lastName']); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6 mb-3">
                    <input type="email"
                        class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                        name="email"
                        value="<?php echo htmlspecialchars($old_input['email'] ?? ''); ?>"
                        placeholder="Email"
                        required>
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback d-block">
                            <?php echo htmlspecialchars($errors['email']); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6 mb-3">
                    <input type="password"
                        class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>"
                        name="password"
                        placeholder="Password"
                        required>
                    <?php if (isset($errors['password'])): ?>
                        <div class="invalid-feedback d-block">
                            <?php echo htmlspecialchars($errors['password']); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6 mb-3">
                    <input type="password"
                        class="form-control <?php echo isset($errors['confirmPassword']) ? 'is-invalid' : ''; ?>"
                        name="confirmPassword"
                        placeholder="Confirm Password"
                        required>
                    <?php if (isset($errors['confirmPassword'])): ?>
                        <div class="invalid-feedback d-block">
                            <?php echo htmlspecialchars($errors['confirmPassword']); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6 mb-3">
                    <select class="form-control <?php echo isset($errors['program']) ? 'is-invalid' : ''; ?>"
                        name="program"
                        required>
                        <option value="">Select a Program</option>
                        <?php
                        $query = mysqli_query($con, "SELECT name, id  FROM programs ORDER BY name ASC");
                        if ($query) {
                            while ($row = mysqli_fetch_assoc($query)) {
                                $selected = (isset($old_input['program']) && $old_input['program'] == $row['name']) ? 'selected' : '';
                                echo "<option value='" . htmlspecialchars($row['id']) . "' {$selected}>";
                                echo htmlspecialchars($row['name']);
                                echo "</option>";
                            }
                        }
                        ?>
                    </select>
                    <?php if (isset($errors['program'])): ?>
                        <div class="invalid-feedback d-block">
                            <?php echo htmlspecialchars($errors['program']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" name="submit" class="btn btn-custom w-100">Submit</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript to change text color to black after filling -->
    <script>
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.classList.add('filled');
                } else {
                    this.classList.remove('filled');
                }
            });
        });
    </script>
</body>

</html>