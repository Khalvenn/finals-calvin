<?php
// Include database connection
include '../functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $originalCode = $_POST['original_code']; // Original subject code
    $subjectCode = $_POST['subject_code'];
    $subjectName = $_POST['subject_name'];

    if (!empty($subjectCode) && !empty($subjectName)) {
        try {
            $db = dbConnect();
            $stmt = $db->prepare("UPDATE subjects SET subject_code = :subject_code, subject_name = :subject_name WHERE subject_code = :original_code");
            $stmt->bindParam(':subject_code', $subjectCode);
            $stmt->bindParam(':subject_name', $subjectName);
            $stmt->bindParam(':original_code', $originalCode);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'Subject updated successfully.']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error updating subject: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Please provide all required fields.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
