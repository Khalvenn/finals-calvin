<!-- Template Files here -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">
                            <i class="bi bi-house-door-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="subjects.php">
                            <i class="bi bi-book-fill"></i> Subjects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="students.php">
                            <i class="bi bi-people-fill"></i> Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="bi bi-box-arrow-left"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
            <h1 class="h2">Dashboard</h1>
            <div class="row mt-5">
                <div class="col-12 col-xl-3 mb-4">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">Number of Subjects:</div>
                        <div class="card-body">
                            <h5 class="card-title text-primary">3</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-3 mb-4">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">Number of Students:</div>
                        <div class="card-body">
                            <h5 class="card-title text-success">2</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-3 mb-4">
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">Number of Failed Students:</div>
                        <div class="card-body">
                            <h5 class="card-title text-danger">0</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-3 mb-4">
                    <div class="card border-success">
                        <div class="card-header bg-success text-white">Number of Passed Students:</div>
                        <div class="card-body">
                            <h5 class="card-title text-success">1</h5>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<!-- Template Files here -->
