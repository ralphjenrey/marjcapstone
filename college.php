<?php include_once('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        .custom-container {
            margin-top: 40px; /* Adjust space above container */
        }
        .custom-table {
            width: 100%;
            border-collapse: collapse; /* Collapses borders to remove spacing */
        }
        .custom-table th {
            padding: 8px; /* Adjusted padding for table cells */
            text-align: center; /* Default align text to the center */
            word-wrap: break-word; /* Allow long words to break */
            border: 1px solid #dee2e6; /* Add border for better visibility */
        }
        .custom-table td {
            padding: 8px; /* Adjusted padding for table cells */
            word-wrap: break-word; /* Allow long words to break */
            border: 1px solid #dee2e6; /* Add border for better visibility */
        }
        /* Specific styles for the Initial Name and Degree Title columns */
        .initial-name {
            width: 80px; /* Fixed width for Initial Name column */
            text-align: left; /* Align text to the left */
        }
        .degree-title {
            width: 250px; /* Fixed width for Degree Title column */
            text-align: left; /* Align text to the left */
        }
        /* Styles for the Action column */
        .action {
            padding: 0; /* Remove padding for action cells */
            text-align: center; /* Center align text for action buttons */
            width: 50px; /* Fixed width for action column */
        }
        .action a {
            padding: 7px 9px; /* Adjusted padding for buttons */
            display: inline-block; /* Make the button inline block */
            margin: 0; /* Ensure no extra margin around buttons */
            font-size: 12px; /* Optional: Reduce font size for buttons */
        }
        .btn-primary {
        background-color: #007bff !important;
        border-color: #007bff !important;
        }      
        /* Hover effect for buttons */
        .btn-primary:hover {
        background-color: gray !important;
        border-color: gray !important;
        color: white !important;
        }
        
    </style>
</head>

<body>
    <?php include_once('includes/header.php'); ?>

    <div class="container custom-container mb-5">
        <!-- Education Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">EDUCATION SCIENCE AND TEACHER</h3>
            </div>
            <div class="card-body">
                <table class="custom-table table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="initial-name">Initial Name</th>
                            <th class="degree-title">Degree Title</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="initial-name">BEEd</td>
                            <td class="degree-title">Bachelor of Elementary Education</td>
                            <td class="action">
                                <a href="elemC.php" title="View Details" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="initial-name">BSEd</td>
                            <td class="degree-title">Bachelor of Secondary Education</td>
                            <td class="action">
                                <a href="enrollment-details.php?enrollid=2" title="View Details" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Hospitality and Tourism Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">HOSPITALITY AND TOURISM MANAGEMENT</h3>
            </div>
            <div class="card-body">
                <table class="custom-table table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="initial-name">Initial Name</th>
                            <th class="degree-title">Degree Title</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="initial-name">BSHRM</td>
                            <td class="degree-title">Bachelor of Science in Hotel and Restaurant Management</td>
                            <td class="action">
                                <a href="enrollment-details.php?enrollid=1" title="View Details" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="initial-name">BSTM</td>
                            <td class="degree-title">Bachelor of Science in Tourism Management</td>
                            <td class="action">
                                <a href="enrollment-details.php?enrollid=2" title="View Details" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- IT-Related Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">IT-RELATED</h3>
            </div>
            <div class="card-body">
                <table class="custom-table table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="initial-name">Initial Name</th>
                            <th class="degree-title">Degree Title</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="initial-name">BSIT</td>
                            <td class="degree-title">Bachelor of Science in Information Technology</td>
                            <td class="action">
                                <a href="enrollment-details.php?enrollid=3" title="View Details" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mass Communication Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">MASS COMMUNICATION AND DOCUMENTATION</h3>
            </div>
            <div class="card-body">
                <table class="custom-table table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="initial-name">Initial Name</th>
                            <th class="degree-title">Degree Title</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="initial-name">BSDC</td>
                            <td class="degree-title">Bachelor of Science in Development Communication</td>
                            <td class="action">
                                <a href="enrollment-details.php?enrollid=3" title="View Details" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
