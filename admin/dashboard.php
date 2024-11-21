<?php
// Include header and functions
include 'partials/header.php';

// Adjust path to functions.php
if (!file_exists('../functions.php')) {
    die("Error: Required file 'functions.php' not found.");
}
include '../functions.php';

// Fetch data
$totalSubjects = getTotalSubjects();
$totalStudents = getTotalStudents();
$totalPassed = getPassedStudents();
$totalFailed = getFailedStudents();

// Fetch student and subject lists
$db = dbConnect();
$stmtStudents = $db->query("SELECT student_id, first_name, last_name FROM students");
$students = $stmtStudents->fetchAll(PDO::FETCH_ASSOC);

$stmtSubjects = $db->query("SELECT subject_code, subject_name FROM subjects");
$subjects = $stmtSubjects->fetchAll(PDO::FETCH_ASSOC);

// Determine the active page
$activePage = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'partials/side-bar.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
            <!-- Dashboard Section -->
            <div id="dashboard-section" class="content-section <?php echo $activePage === 'dashboard' ? '' : 'd-none'; ?>">
                <h1 class="h2">Dashboard</h1>
                <div class="row mt-5">
                    <div class="col-12 col-xl-3 mb-4">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">Number of Subjects:</div>
                            <div class="card-body">
                                <h5 class="card-title text-primary"><?php echo htmlspecialchars($totalSubjects); ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-3 mb-4">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">Number of Students:</div>
                            <div class="card-body">
                                <h5 class="card-title text-success"><?php echo htmlspecialchars($totalStudents); ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-3 mb-4">
                        <div class="card border-danger">
                            <div class="card-header bg-danger text-white">Number of Failed Students:</div>
                            <div class="card-body">
                                <h5 class="card-title text-danger"><?php echo htmlspecialchars($totalFailed); ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-3 mb-4">
                        <div class="card border-success">
                            <div class="card-header bg-success text-white">Number of Passed Students:</div>
                            <div class="card-body">
                                <h5 class="card-title text-success"><?php echo htmlspecialchars($totalPassed); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subjects Section -->
<div id="subjects-section" class="content-section <?php echo $activePage === 'subjects' ? '' : 'd-none'; ?>">
    <h1 class="h2">Subjects</h1>
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Subjects</li>
        </ol>
    </nav>
    <div class="row">
        <!-- Add Subject Form -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">Add a New Subject</div>
                <div class="card-body">
                    <form action="subject/add.php" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Subject Code" name="subject_code" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Subject Name" name="subject_name" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Subject</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Subject List -->
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">Subject List</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($subjects as $subject): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($subject['subject_code']); ?></td>
                                    <td><?php echo htmlspecialchars($subject['subject_name']); ?></td>
                                    <td>
                                        <a href="subject/edit.php?code=<?php echo $subject['subject_code']; ?>" class="btn btn-sm btn-info">Edit</a>
                                        <a href="subject/delete.php?code=<?php echo $subject['subject_code']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this subject?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- Subjects Section -->
<div id="subjects-section" class="content-section <?php echo $activePage === 'subjects' ? '' : 'd-none'; ?>">
    <h1 class="h2">Subjects</h1>
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Subjects</li>
        </ol>
    </nav>
    <div class="row">
        <?php
        // Handle Add Subject
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_subject'])) {
            $subjectCode = $_POST['subject_code'];
            $subjectName = $_POST['subject_name'];

            $db = dbConnect();
            $stmt = $db->prepare("INSERT INTO subjects (subject_code, subject_name) VALUES (:subject_code, :subject_name)");
            $stmt->execute([':subject_code' => $subjectCode, ':subject_name' => $subjectName]);
            header("Location: ?page=subjects");
            exit;
        }

        // Handle Edit Subject
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_subject'])) {
            $id = $_POST['id'];
            $subjectCode = $_POST['subject_code'];
            $subjectName = $_POST['subject_name'];

            $db = dbConnect();
            $stmt = $db->prepare("UPDATE subjects SET subject_code = :subject_code, subject_name = :subject_name WHERE id = :id");
            $stmt->execute([':subject_code' => $subjectCode, ':subject_name' => $subjectName, ':id' => $id]);
            header("Location: ?page=subjects");
            exit;
        }

        // Handle Delete Subject
        if (isset($_GET['delete_subject'])) {
            $id = $_GET['delete_subject'];

            $db = dbConnect();
            $stmt = $db->prepare("DELETE FROM subjects WHERE id = :id");
            $stmt->execute([':id' => $id]);
            header("Location: ?page=subjects");
            exit;
        }
        ?>

        <!-- Add Subject Form -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">Add a New Subject</div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Subject Code" name="subject_code" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Subject Name" name="subject_name" required>
                            </div>
                        </div>
                        <button type="submit" name="add_subject" class="btn btn-primary w-100">Add Subject</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Subject List -->
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">Subject List</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($subjects as $subject): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($subject['subject_code']); ?></td>
                                    <td><?php echo htmlspecialchars($subject['subject_name']); ?></td>
                                    <td>
                                        <!-- Edit Form -->
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $subject['id']; ?>">Edit</button>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal<?php echo $subject['id']; ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Subject</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?php echo $subject['id']; ?>">
                                                            <div class="mb-3">
                                                                <label>Subject Code</label>
                                                                <input type="text" class="form-control" name="subject_code" value="<?php echo htmlspecialchars($subject['subject_code']); ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Subject Name</label>
                                                                <input type="text" class="form-control" name="subject_name" value="<?php echo htmlspecialchars($subject['subject_name']); ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="edit_subject" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete Button -->
                                        <a href="?page=subjects&delete_subject=<?php echo $subject['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this subject?');">Delete</a>
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

<!-- Students Section -->
            <div id="students-section" class="content-section <?php echo $activePage === 'students' ? '' : 'd-none'; ?>">
                <h1 class="h2">Students</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?page=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Students</li>
                    </ol>
                </nav>
                <div class="row mt-4">
                    <!-- Student List -->
                    <div class="col-12">
                        <h4>Student List</h4>
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Student ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                                        <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                                        <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                                        <td>
                                            <a href="edit_student.php?id=<?php echo $student['student_id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                            <a href="delete_student.php?id=<?php echo $student['student_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>


<script>
   document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('.nav-link[data-section]');

    navLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            // Update active link
            navLinks.forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');

            // Hide all sections
            const allSections = document.querySelectorAll('.content-section');
            allSections.forEach(section => section.classList.add('d-none'));

            // Show the target section
            const targetSection = document.getElementById(`${this.dataset.section}-section`);
            if (targetSection) {
                targetSection.classList.remove('d-none');
            } else {
                console.error(`Section with ID '${this.dataset.section}-section' not found.`);
            }
        });
    });
});
</script>


<?php
// Include footer
include 'partials/footer.php';
?>
