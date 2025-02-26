<?php
// search_employee.php

// Start the session
session_start();

// Include the database connection
include_once 'Connection/db.php';

// Function to safely escape HTML
function safe_html($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

// Check if the search term is set
if (isset($_POST['search'])) {
    $searchTerm = trim($_POST['search']);

    try {
        // Prepare the search query
        $query = "SELECT * FROM human_resource_list_dt 
                  WHERE name LIKE :search 
                  OR dt_employee_number LIKE :search 
                  OR dt_system_hr_number LIKE :search 
                  OR calling_name LIKE :search 
                  OR category LIKE :search 
                  OR manpower_agent LIKE :search 
                  OR employee_id LIKE :search 
                  OR Job title LIKE :search 
                  OR dt_job_role LIKE :search 
                  OR skillness LIKE :search 
                  OR address LIKE :search 
                  OR contact_tel LIKE :search 
                  OR office_location LIKE :search 
                  ORDER BY sr_no DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':search' => "%$searchTerm%"]);

        // Fetch the results
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Generate the HTML for the table rows
        $html = '';
        if (count($employees) > 0) {
            foreach ($employees as $row) {
                $html .= '<tr>';
                $html .= '<td>' . safe_html($row['dt_employee_number']) . '</td>';
                $html .= '<td>' . safe_html($row['name']) . '</td>';
                $html .= '<td>' . safe_html($row['Job title']) . '</td>';
                $html .= '<td>' . safe_html($row['contact_tel']) . '</td>';
                $html .= '<td>' . safe_html($row['office_location']) . '</td>';
                $html .= '<td>';
                $html .= '<button class="btn btn-sm btn-info view-btn" data-id="' . safe_html($row['sr_no']) . '"><i class="fas fa-eye"></i></button>';
                $html .= '<button class="btn btn-sm btn-warning edit-btn" data-id="' . safe_html($row['sr_no']) . '"><i class="fas fa-edit"></i></button>';
                $html .= '<button class="btn btn-sm btn-danger delete-btn" data-id="' . safe_html($row['sr_no']) . '"><i class="fas fa-trash"></i></button>';
                $html .= '</td>';
                $html .= '</tr>';
            }
        } else {
            $html .= '<tr><td colspan="6" class="text-center">No employees found.</td></tr>';
        }

        echo $html;
    } catch (PDOException $e) {
        echo '<tr><td colspan="6" class="text-center text-danger">An error occurred while searching.</td></tr>';
    }
} else {
    echo '<tr><td colspan="6" class="text-center text-danger">Invalid request.</td></tr>';
}
?>