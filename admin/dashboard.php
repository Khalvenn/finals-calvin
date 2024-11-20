<?php
// Example PHP logic for database queries (if needed in the future)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .top-bar {
            height: 50px;
            background-color: #212529;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 1rem;
        }
        .top-bar h5 {
            margin: 0;
        }
        .sidebar {
            background-color: #f8f9fa;
            height: 100vh;
        }
        .sidebar .nav-link {
            color: #0d6efd;
            font-weight: 500;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            font-weight: bold;
        }
        main {
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <h5>Student Management System</h5>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar">
                <ul class="nav flex-column pt-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-section="dashboard">
                            <i class="bi bi-house-door-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="subjects">
                            <i class="bi bi-book-fill"></i> Subjects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-section="students">
                            <i class="bi bi-people-fill"></i> Students
                        </a>
                    </li>
                    <hr class="logout-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="/finals-calvin/index.php">
                            <i class="bi bi-box-arrow-left"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Dashboard Section -->
                <div id="dashboard" class="content-section">
                    <h1 class="h4">Dashboard</h1>
                    <div class="row mt-4">
                        <div class="col-12 col-md-3 mb-4">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">Number of Subjects:</div>
                                <div class="card-body">
                                    <h5 class="card-title text-primary">3</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-4">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">Number of Students:</div>
                                <div class="card-body">
                                    <h5 class="card-title text-success">2</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-4">
                            <div class="card border-danger">
                                <div class="card-header bg-danger text-white">Number of Failed Students:</div>
                                <div class="card-body">
                                    <h5 class="card-title text-danger">0</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-4">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">Number of Passed Students:</div>
                                <div class="card-body">
                                    <h5 class="card-title text-success">1</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subjects Section -->
<div id="subjects" class="content-section d-none">
    <h1 class="h4">Add a New Subject</h1>
    <nav class="mb-3">
        <a href="#" class="text-primary text-decoration-none" onclick="navigateTo('dashboard')">Dashboard</a>
        <span>/</span>
        <span>Subjects</span>
    </nav>
    <div class="p-4 border rounded bg-light">
        <form method="POST" action="add_subject.php" class="mb-4">
            <div class="mb-3">
                <label for="subjectCode" class="form-label">Subject Code</label>
                <input type="text" class="form-control" id="subjectCode" name="subjectCode"  required>
            </div>
            <div class="mb-3">
                <label for="subjectName" class="form-label">Subject Name</label>
                <input type="text" class="form-control" id="subjectName" name="subjectName"  required>
            </div>
            <button type="submit" class="btn btn-primary">Add Subject</button>
        </form>
    </div>

    <h2 class="h5 mt-4">Subject List</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Subject Code</th>
                <th>Subject Name</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1001</td>
                <td>English</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="editSubject(1001, 'English')">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteSubject(1001, 'English')">Delete</button>
                </td>
            </tr>
            <tr>
                <td>1002</td>
                <td>Mathematics</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="editSubject(1002, 'Mathematics')">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteSubject(1002, 'Mathematics')">Delete</button>
                </td>
            </tr>
            <tr>
                <td>1003</td>
                <td>Science</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="editSubject(1003, 'Science')">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteSubject(1003, 'Science')">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Edit Subject Section -->
<div id="edit-subject" class="content-section d-none">
    <h1 class="h4">Edit Subject</h1>
    <nav class="mb-3">
        <a href="#" class="text-primary text-decoration-none" onclick="navigateTo('dashboard')">Dashboard</a>
        <span>/</span>
        <a href="#" class="text-primary text-decoration-none" onclick="navigateTo('subjects')">Subjects</a>
        <span>/</span>
        <span>Edit Subject</span>
    </nav>
    <div class="p-4 border rounded bg-light">
        <form method="POST" action="edit_subject.php" class="mb-4">
            <div class="mb-3">
                <label for="editSubjectCode" class="form-label">Subject Code</label>
                <input type="text" class="form-control" id="editSubjectCode" name="subjectCode" readonly>
            </div>
            <div class="mb-3">
                <label for="editSubjectName" class="form-label">Subject Name</label>
                <input type="text" class="form-control" id="editSubjectName" name="subjectName" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Subject</button>
        </form>
    </div>
</div>

<!-- Delete Subject Section -->
<div id="delete-subject" class="content-section d-none">
    <h1 class="h4">Delete Subject</h1>
    <nav class="mb-3">
        <a href="#" class="text-primary text-decoration-none" onclick="navigateTo('dashboard')">Dashboard</a>
        <span>/</span>
        <a href="#" class="text-primary text-decoration-none" onclick="navigateTo('subjects')">Subjects</a>
        <span>/</span>
        <span>Delete Subject</span>
    </nav>
    <div class="p-4 border rounded bg-light">
        <p>Are you sure you want to delete the following subject record?</p>
        <ul>
            <li><strong>Subject Code:</strong> <span id="deleteSubjectCode"></span></li>
            <li><strong>Subject Name:</strong> <span id="deleteSubjectName"></span></li>
        </ul>
        <form method="POST" action="delete_subject.php" class="mb-4">
            <input type="hidden" id="deleteSubjectCodeInput" name="subjectCode">
            <button type="button" class="btn btn-secondary" onclick="navigateTo('subjects')">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete Subject Record</button>
        </form>
    </div>
</div>
<!-- Students Section -->
<div id="students" class="content-section d-none">
    <h1 class="h4">Register a New Student</h1>
    <nav class="mb-3">
        <a href="#" class="text-primary text-decoration-none" onclick="navigateTo('dashboard')">Dashboard</a>
        <span>/</span>
        <span>Register Student</span>
    </nav>
    <div class="p-4 border rounded bg-light">
        <form method="POST" action="add_student.php" class="mb-4">
            <div class="mb-3">
                <label for="studentId" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="studentId" name="studentId" required>
            </div>
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
    </div>

    <h2 class="h5 mt-4">Student List</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example student records -->
            <tr>
                <td>1001</td>
                <td>Renmark</td>
                <td>Salalila</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="editStudent(1001, 'Renmark', 'Salalila')">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteStudent(1001)">Delete</button>
                    <button class="btn btn-warning btn-sm">Attach Subject</button>
                </td>
            </tr>
            <tr>
                <td>1002</td>
                <td>Charlie</td>
                <td>Tullao</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="editStudent(1002, 'Charlie', 'Tullao')">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteStudent(1002)">Delete</button>
                    <button class="btn btn-warning btn-sm">Attach Subject</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div id="edit-student" class="content-section d-none">
    <h1 class="h4">Edit Student</h1>
    <nav class="mb-3">
        <a href="#" class="text-primary text-decoration-none" onclick="navigateTo('dashboard')">Dashboard</a>
        <span>/</span>
        <a href="#" class="text-primary text-decoration-none" onclick="navigateTo('students')">Register Student</a>
        <span>/</span>
        <span>Edit Student</span>
    </nav>
    <div class="p-4 border rounded bg-light">
        <form method="POST" action="update_student.php" class="mb-4">
            <div class="mb-3">
                <label for="editStudentId" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="editStudentId" name="studentId" readonly>
            </div>
            <div class="mb-3">
                <label for="editFirstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="editFirstName" name="firstName" required>
            </div>
            <div class="mb-3">
                <label for="editLastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="editLastName" name="lastName" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Student</button>
        </form>
    </div>
</div>
<div id="delete-student" class="content-section d-none">
    <h1 class="h4">Delete a Student</h1>
    <nav class="mb-3">
        <a href="#" class="text-primary text-decoration-none" onclick="navigateTo('dashboard')">Dashboard</a>
        <span>/</span>
        <a href="#" class="text-primary text-decoration-none" onclick="navigateTo('students')">Register Student</a>
        <span>/</span>
        <span>Delete Student</span>
    </nav>
    <div class="p-4 border rounded bg-light">
        <p>Are you sure you want to delete the following student record?</p>
        <ul>
            <li><strong>Student ID:</strong> <span id="deleteStudentId">1002</span></li>
            <li><strong>First Name:</strong> <span id="deleteFirstName">Charlie</span></li>
            <li><strong>Last Name:</strong> <span id="deleteLastName">Tullao</span></li>
        </ul>
        <div>
            <button class="btn btn-secondary" onclick="navigateTo('students')">Cancel</button>
            <button class="btn btn-danger" onclick="confirmDeleteStudent()">Delete Student Record</button>
        </div>
    </div>
</div>
<div id="attach-subject" class="content-section d-none">
    <h1 class="h4">Attach Subject to Student</h1>
    <nav class="mb-3">
        <a href="#" class="text-primary text-decoration-none" onclick="navigateTo('dashboard')">Dashboard</a>
        <span>/</span>
        <a href="#" class="text-primary text-decoration-none" onclick="navigateTo('students')">Register Student</a>
        <span>/</span>
        <span>Attach Subject to Student</span>
    </nav>
    <div class="p-4 border rounded bg-light">
        <h2 class="h5">Selected Student Information</h2>
        <ul>
            <li><strong>Student ID:</strong> <span id="attachStudentId">1002</span></li>
            <li><strong>Name:</strong> <span id="attachStudentName">Charlie Tullao</span></li>
        </ul>
        <div>
            <form id="subjectForm">
                <div>
                    <input type="checkbox" id="subject1001" name="subjects" value="1001 - English">
                    <label for="subject1001">1001 - English</label>
                </div>
                <div>
                    <input type="checkbox" id="subject1002" name="subjects" value="1002 - Mathematics">
                    <label for="subject1002">1002 - Mathematics</label>
                </div>
                <div>
                    <input type="checkbox" id="subject1003" name="subjects" value="1003 - Science">
                    <label for="subject1003">1003 - Science</label>
                </div>
                <button class="btn btn-primary mt-3" type="button" onclick="attachSubjects()">Attach Subjects</button>
            </form>
        </div>
    </div>
    <div class="mt-4">
        <h2 class="h5">Subject List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Grade</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody id="subjectList">
                <tr>
                    <td colspan="4" class="text-center">No subject found.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    function attachSubjects() {
        const selectedSubjects = Array.from(document.querySelectorAll('input[name="subjects"]:checked'))
            .map(subject => subject.value.split(" - "));
        const subjectList = document.getElementById("subjectList");

        if (selectedSubjects.length === 0) {
            alert("Please select at least one subject to attach.");
            return;
        }

        // Clear the "No subject found." row
        if (subjectList.querySelector("tr td.text-center")) {
            subjectList.innerHTML = "";
        }

        selectedSubjects.forEach(subject => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${subject[0]}</td>
                <td>${subject[1]}</td>
                <td>-</td>
                <td><button class="btn btn-sm btn-danger" onclick="removeSubject(this)">Remove</button></td>
            `;
            subjectList.appendChild(row);
        });

        // Clear form after adding
        document.getElementById("subjectForm").reset();
    }

    function removeSubject(button) {
        const row = button.closest("tr");
        row.remove();

        const subjectList = document.getElementById("subjectList");
        if (subjectList.querySelectorAll("tr").length === 0) {
            subjectList.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center">No subject found.</td>
                </tr>
            `;
        }
    }

    function loadAttachSubject(studentId, studentName) {
        document.getElementById("attachStudentId").innerText = studentId;
        document.getElementById("attachStudentName").innerText = studentName;
        navigateTo('attach-subject');
    }
</script>

<script>
    function deleteStudent(id, firstName, lastName) {
        document.getElementById('deleteStudentId').innerText = id;
        document.getElementById('deleteFirstName').innerText = firstName;
        document.getElementById('deleteLastName').innerText = lastName;
        navigateTo('delete-student');
    }

    function confirmDeleteStudent() {
        const studentId = document.getElementById('deleteStudentId').innerText;
        // Add your deletion logic here
        alert(`Student ID ${studentId} deleted.`);
        navigateTo('students'); // Go back to student list after deletion
    }

    function editStudent(id, firstName, lastName) {
        document.getElementById('editStudentId').value = id;
        document.getElementById('editFirstName').value = firstName;
        document.getElementById('editLastName').value = lastName;
        navigateTo('edit-student');
    }

    function editSubject(code, name) {
        document.getElementById('editSubjectCode').value = code;
        document.getElementById('editSubjectName').value = name;
        navigateTo('edit-subject');
    }

    function deleteSubject(code, name) {
        document.getElementById('deleteSubjectCode').innerText = code;
        document.getElementById('deleteSubjectName').innerText = name;
        document.getElementById('deleteSubjectCodeInput').value = code;
        navigateTo('delete-subject');
    }

        // JavaScript for switching between sections
        function navigateTo(sectionId) {
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.add('d-none');
            });

            // Show the selected section
            document.getElementById(sectionId).classList.remove('d-none');

            // Update active link
            document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
            document.querySelector(`[data-section="${sectionId}"]`).classList.add('active');
        }

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const section = this.dataset.section;
                navigateTo(section);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
