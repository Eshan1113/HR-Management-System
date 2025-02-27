<?php
// search_employee.php

// Include the database connection

// Connection/db.php

$host = 'localhost'; // Database host
$dbname = 'dt_database'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exceptions for errors
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Get the search term from the AJAX request
$searchTerm = isset($_POST['search']) ? trim($_POST['search']) : '';

try {
    // Prepare the SQL query to search for employees
    $query = "SELECT * FROM human_resource_list_dt 
              WHERE name LIKE :search 
              OR dt_employee_number LIKE :search 
              OR `Job title` LIKE :search 
              OR contact_tel LIKE :search 
              OR `office _location` LIKE :search 
              ORDER BY sr_no DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':search' => "%$searchTerm%"]);

    // Fetch the results
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate the HTML for the table rows
    $html = '';
    if (count($employees) > 0) {
        foreach ($employees as $row) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($row['dt_employee_number']) . '</td>
                        <td>' . htmlspecialchars($row['name']) . '</td>
                        <td>' . htmlspecialchars($row['Job title']) . '</td>
                        <td>' . htmlspecialchars($row['contact_tel']) . '</td>
                        <td>' . htmlspecialchars($row['office _location']) . '</td>
                        <td>
                            <button class="btn btn-sm btn-info view-btn" data-id="' . htmlspecialchars($row['sr_no']) . '">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning edit-btn" data-id="' . htmlspecialchars($row['sr_no']) . '">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="' . htmlspecialchars($row['sr_no']) . '">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                      </tr>';
        }
    } else {
        $html = '<tr><td colspan="6" class="text-center">No employees found.</td></tr>';
    }

    echo $html;
} catch (PDOException $e) {
    // Log the error (optional)
    error_log("Database Error: " . $e->getMessage());

    // Return an error message
    echo '<tr><td colspan="6" class="text-center text-danger">An error occurred while searching. Please check the logs for details.</td></tr>';
}
?>