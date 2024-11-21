<?php
// Include database connection
include '../functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subjectCode = $_POST['subject_code'];
    $subjectName = $_POST['subject_name'];

    if (!empty($subjectCode) && !empty($subjectName)) {
        try {
            $db = dbConnect();
            $stmt = $db->prepare("INSERT INTO subjects (subject_code, subject_name) VALUES (:subject_code, :subject_name)");
            $stmt->bindParam(':subject_code', $subjectCode);
            $stmt->bindParam(':subject_name', $subjectName);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'Subject added successfully.']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error adding subject: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Please provide all required fields.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
