<?php
// Include the database connection
include('Connection/db.php');

// Check if a search term is passed
if (isset($_GET['search'])) {
    $searchTerm = '%' . $_GET['search'] . '%'; // Adding wildcards for LIKE query

    try {
        // Prepare SQL statement to search for employees by name or calling name
        $stmt = $pdo->prepare("SELECT * FROM human_resource_list_dt WHERE name LIKE :searchTerm OR calling_name LIKE :searchTerm");
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch all results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            // Loop through the results and output table rows
            foreach ($results as $row) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['sr_no']) . '</td>';
                echo '<td>' . htmlspecialchars($row['dt_employee_number']) . '</td>';
                echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Job title']) . '</td>';
                echo '<td>' . htmlspecialchars($row['contact_tel']) . '</td>';
                echo '<td>' . htmlspecialchars($row['office _location']) . '</td>';
                echo '</tr>';
            }
        } else {
            // If no results found, display message
            echo '<tr><td colspan="6" class="text-center">No results found.</td></tr>';
        }
    } catch (PDOException $e) {
        // In case of any error, display it
        echo 'Error: ' . $e->getMessage();
    }
}
?>
