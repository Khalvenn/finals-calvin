<?php
// Include header
include 'partials/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <!-- Include sidebar -->
        <?php include 'partials/side-bar.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h1 class="mt-4">Dashboard</h1>
            <div class="row mt-4">
                <!-- Card: Number of Subjects -->
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Number of Subjects:</h5>
                            <p class="card-text h3">3</p>
                        </div>
                    </div>
                </div>
                
                <!-- Card: Number of Students -->
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Number of Students:</h5>
                            <p class="card-text h3">2</p>
                        </div>
                    </div>
                </div>

                <!-- Card: Number of Failed Students -->
                <div class="col-md-3">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Number of Failed Students:</h5>
                            <p class="card-text h3">0</p>
                        </div>
                    </div>
                </div>

                <!-- Card: Number of Passed Students -->
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Number of Passed Students:</h5>
                            <p class="card-text h3">1</p>
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
