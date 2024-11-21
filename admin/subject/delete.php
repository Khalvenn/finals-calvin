<?php
// Include database connection
include '../functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['code'])) {
    $subjectCode = $_GET['code'];

    try {
        $db = dbConnect();
        $stmt = $db->prepare("DELETE FROM subjects WHERE subject_code = :subject_code");
        $stmt->bindParam(':subject_code', $subjectCode);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Subject deleted successfully.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error deleting subject: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request or missing subject code.']);
}
