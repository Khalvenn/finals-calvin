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
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'partials/side-bar.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
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
        </main>
    </div>
</div>

<?php
// Include footer
include 'partials/footer.php';
?>
