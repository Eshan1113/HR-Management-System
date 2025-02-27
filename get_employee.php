<?php
// get_employee.php

// Start the session (if not already started)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection
include_once 'Connection/db.php';

// Helper function to safely escape HTML
function safe_html($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

// Set the content type to JSON
header('Content-Type: application/json');

// Check if 'id' is set in the GET request
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize input to prevent SQL injection

    try {
        // Prepare the SQL statement to fetch employee details
        $stmt = $pdo->prepare("SELECT * FROM human_resource_list_dt WHERE sr_no = :sr_no");
        $stmt->execute([':sr_no' => $id]);
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($employee) {
            // Return employee data as JSON
            echo json_encode($employee);
        } else {
            // Return error if employee not found
            echo json_encode(['error' => 'Employee not found.']);
        }
    } catch (PDOException $e) {
        // Return error message if query fails
        echo json_encode(['error' => 'An error occurred while fetching employee data.']);
    }
} else {
    // Return error if 'id' is not provided
    echo json_encode(['error' => 'No ID provided.']);
}
?>
