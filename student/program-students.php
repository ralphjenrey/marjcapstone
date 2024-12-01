<?php
include_once('includes/config.php');
include_once('includes/modal.php');

session_start();
if (!isset($_SESSION['sauth'])) {
    header('location: index.php');
    exit();
}
// Get parameters
$program = isset($_GET['program']) ? trim($_GET['program']) : '';
if (empty($program)) {
    die("Program name is required");
}

// Prepare statement
$query = "SELECT `key` FROM programs WHERE name = ?";
if ($stmt = mysqli_prepare($con, $query)) {
    mysqli_stmt_bind_param($stmt, "s", $program);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $programKey = htmlspecialchars($row['key']);
    } else {
        die("Program not found");
    }

    mysqli_stmt_close($stmt);
} else {
    die("Database query failed: " . mysqli_error($con));
}

$undergraduate = [
    'Form_138' => 'Form 138 / Report Card',
    'Good_Moral' => 'Certificate of Good Moral',
    'Birth_Certificate' => 'Birth Certificate',
    'NSAT_NCAE' => 'NSAT or NCAE Result',
];

$tranferees = [
    'TOR' => 'Transcript of Records (TOR) for evaluation',
    'Good_Moral' => 'Certificate of Good Moral',
    'Birth_Cert' => 'Birth Certificate'
];

$seniorHigh = [
    'Form_138' => 'Form 138 / Report Card (Original and Photocopy)',
    'Good_Moral' => 'Certificate of Good Moral Character',
    'Birth_Cert' => 'Birth Certificate (Original NSO and Photocopy)',
    'Exam_Result' => 'Entrance Examination Result from the Guidance Office',
    'Picture' => 'Recent 2x2 colored picture'
];

$cebuCityScholars = [
    'Form_138' => 'Form 138 / Report Card',
    'Good_Moral' => 'Certificate of Good Moral',
    'Birth_Cert' => 'Birth Certificate',
    'Intelliprime' => 'Intelliprime Result',
    'Voucher' => 'Voucher from the government'
];

$programRequirements = [
    'undergraduate' => [
        'title' => 'Undergraduate Requirements',
        'items' => [
            ['name' => 'Form 138 / Report Card', 'note' => 'Original copy and photocopy'],
            ['name' => 'Certificate of Good Moral Character', 'note' => 'From previous school'],
            ['name' => 'Birth Certificate', 'note' => 'PSA authenticated copy'],
            ['name' => 'NSAT or NCAE Result', 'note' => 'Original copy'],
            ['name' => '4 pieces 2x2 ID Picture', 'note' => '']
        ]
    ],
    'transferees' => [
        'title' => 'Transferee Requirements',
        'items' => [
            ['name' => 'Transcript of Records (TOR)', 'note' => 'For evaluation purposes'],
            ['name' => 'Certificate of Good Moral Character', 'note' => 'From previous school'],
            ['name' => 'Birth Certificate', 'note' => 'PSA authenticated copy'],
            ['name' => '4 pieces 2x2 ID Picture', 'note' => '']
        ]
    ],
    'seniorHigh' => [
        'title' => 'Senior High School Requirements',
        'items' => [
            ['name' => 'Form 138 / Report Card', 'note' => 'Original and photocopy'],
            ['name' => 'Certificate of Good Moral Character', 'note' => 'From previous school'],
            ['name' => 'Birth Certificate', 'note' => 'Original NSO and photocopy'],
            ['name' => 'Entrance Examination Result', 'note' => 'From the Guidance Office'],
            ['name' => '2x2 colored picture', 'note' => 'Recent']
        ]
    ],
    'cebuCityScholars' => [
        'title' => 'Cebu City Scholars Requirements',
        'items' => [
            ['name' => 'Form 138 / Report Card', 'note' => 'Original and photocopy'],
            ['name' => 'Certificate of Good Moral Character', 'note' => 'From previous school'],
            ['name' => 'Birth Certificate', 'note' => 'PSA authenticated copy'],
            ['name' => 'Intelliprime Result', 'note' => 'Original copy'],
            ['name' => 'Voucher', 'note' => 'From the government'],
            ['name' => '4 pieces 2x2 ID Picture', 'note' => '']
        ]
    ]
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Details</title>
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
                            <h1 class="m-0"><?= $program ?> File Details</h1>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary m-0" onclick="showFilesModal()">Add File</button>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary m-0" onclick="showInstructionModal()">Instructions</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add this after content-header section -->
            <div class="container-fluid">
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <?= htmlspecialchars($_SESSION['success']) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <?= htmlspecialchars($_SESSION['error']) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
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
                                                <th>File Name</th>
                                                <th>File Type</th>
                                                <th>Status</th>
                                                <th>Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $student_id = $_SESSION['student_id'];
                                            $query = mysqli_query(
                                                $con,
                                                "SELECT f.*, s.studentNumber 
                                                 FROM tblfile f
                                                 JOIN tblstudents s ON f.studentId = s.id
                                                 JOIN programs p ON s.program = p.id 
                                                 WHERE  s.id = '$student_id'
                                                 ORDER BY f.updated_at DESC"
                                            );

                                            while ($row = mysqli_fetch_assoc($query)):
                                                $statusBadge = match ($row['status']) {
                                                    'pending' => 'warning',
                                                    'approved' => 'success',
                                                    'rejected' => 'danger',
                                                    default => 'secondary'
                                                };
                                            ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($row['fileName']) ?></td>
                                                    <td><span class="badge bg-info"><?= htmlspecialchars($row['fileType']) ?></span></td>
                                                    <td><span class="badge bg-<?= $statusBadge ?>"><?= htmlspecialchars($row['status']) ?></span></td>
                                                    <td><?= date('M d, Y h:i A', strtotime($row['updated_at'])) ?></td>
                                                    <td>

                                                        <a href="./php/download.php?file=<?= htmlspecialchars($row['id']) ?>" class="btn btn-sm btn-success">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-warning"
                                                            onclick="showEditModal(<?= $row['id'] ?>, '<?= htmlspecialchars($row['fileName']) ?>', '<?= $row['fileType'] ?>')">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" onclick="deleteFile(<?= $row['id'] ?>)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
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
        showFilesModal = () => {
            <?php
            // Define which array to use based on programKey
            if ($programKey === 'seniorHighSchool') {
                $fileTypes = $seniorHigh;
            } elseif ($programKey === 'transferees') {
                $fileTypes = $tranferees;
            } elseif ($programKey === 'cebuCityScholar') {
                $fileTypes = $cebuCityScholars;
            } elseif ($programKey === 'undergraduate') {
                $fileTypes = $undergraduate;
            } else {
                $fileTypes = $undergraduate; // Default to undergraduate if no match
            }
            ?>

            showModal('Add File', `
            <form action="./php/upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file">File</label>
                    <input type="file" class="form-control" name="file" required>
                </div>
                <input type="hidden" name="program" value="<?= $program ?>">
                <div class="form-group">
                    <label for="fileType">File Type</label>
                    <select class="form-control" name="fileType" required>
                       <?php foreach ($fileTypes as $key => $value): ?>
                        <option value="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($value) ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        `, [{
                text: 'Close',
                class: 'btn-secondary',
                dismiss: true
            }]);
        }

        showInstructionModal = () => {
            <?php
            // Define which array to use based on programKey
            if ($programKey === 'seniorHighSchool') {
                $instructions = $programRequirements['seniorHigh'];
            } elseif ($programKey === 'transferees') {
                $instructions = $programRequirements['transferees'];
            } elseif ($programKey === 'cebuCityScholar') {
                $instructions = $programRequirements['cebuCityScholars'];
            } elseif ($programKey === 'undergraduate') {
                $instructions = $programRequirements['undergraduate'];
            } else {
               die("Program not found");
            }
            ?>
            const instructions = <?php echo json_encode($instructions); ?>;


            const requirementsHtml = `
                <div class="requirements-list">
                    <h5 class="mb-4">${instructions.title}</h5>
                    <ol class="list-group list-group-numbered">
                        ${instructions.items.map(item => `
                            <li class="list-group-item">
                                ${item.name}
                                <small class="d-block text-muted">
                                    ${item.note}
                                    ${item.name.toLowerCase().includes('picture') ? `
                                        <br>• Male: Blue background
                                        <br>• Female: Red background
                                        <br>• Recent photo within last 3 months
                                        <br>• White background
                                    ` : ''}
                                </small>
                            </li>
                        `).join('')}
                    </ol>
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle"></i> Please submit all requirements within 2 weeks of enrollment.
                    </div>
                </div>
            `;

            showModal('Program Requirements', requirementsHtml, [{
                text: 'Close',
                class: 'btn-secondary',
                dismiss: true
            }]);
        };

        showEditModal = (fileId, fileName, fileType) => {
            showModal('Edit File', `
        <form action="./php/update-file.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="fileId" value="${fileId}">
            <div class="form-group">
                <label for="file">File</label>
                <input type="file" class="form-control" name="file" required>
            </div>
            <div class="form-group">
                <label for="fileType">File Type</label>
                <select class="form-control" name="fileType" required>
                    <option value="">Select File Type</option>
                    <option value="Form_138">Form 138 / Report Card</option>
                    <option value="Good_Moral">Certificate of Good Moral</option>
                    <option value="Birth_Certificate">Birth Certificate</option>
                    <option value="NSAT_NCAE">NSAT or NCAE Result</option>
                    <option value="Requirement">Requirement</option>
                    <option value="Assignment">Assignment</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    `, [{
                text: 'Close',
                class: 'btn-secondary',
                dismiss: true
            }]);
        }

        function deleteFile(fileId) {
            if (confirm('Are you sure you want to delete this file?')) {
                fetch(`./php/delete-file.php?id=${fileId}`, {
                        method: 'DELETE'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert('Error deleting file: ' + data.message);
                        }
                    })
                    .catch(error => {
                        alert('Error: ' + error);
                    });
            }
        }
    </script>
</body>

</html>