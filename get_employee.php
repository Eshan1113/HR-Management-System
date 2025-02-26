<?php
// get_employee.php

// Start the session
session_start();

// Include the database connection
include_once 'Connection/db.php';

// Check if the employee ID is set
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        // Prepare the query to fetch employee details
        $query = "SELECT * FROM human_resource_list_dt WHERE sr_no = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $id]);

        // Fetch the employee details
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($employee) {
            // Return the employee details as JSON
            echo json_encode($employee);
        } else {
            echo json_encode(['error' => 'Employee not found.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'An error occurred while fetching employee data.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
?>