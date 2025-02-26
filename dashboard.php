<?php
// index.php

// Start the session at the very beginning
session_start();

// Disable error reporting in production
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Include the header and database connection
include_once 'include/header.php';       
include_once 'Connection/db.php';

// Helper function to safely escape HTML
function safe_html($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

// Initialize variables
$recordsPerPage = 10;

// Handle form submissions using Post/Redirect/Get (PRG) pattern
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Adding a new employee
    if (isset($_POST['save'])) {
        // Retrieve and sanitize input data
        $name = trim($_POST['name']);
        $employee_number = trim($_POST['dt_employee_number']);
        $system_hr_number = trim($_POST['dt_system_hr_number']);
        $calling_name = trim($_POST['calling_name']);
        $category = trim($_POST['category']);
        $manpower_agent = trim($_POST['manpower_agent']);
        $employee_id = trim($_POST['employee_id']);
        $job_title = trim($_POST['Job title']);
        $job_role = trim($_POST['dt_job_role']);
        $skillness = trim($_POST['skillness']);
        $date_joined = $_POST['date_joined'];
        $address = trim($_POST['address']);
        $contact_tel = trim($_POST['contact_tel']);
        $office_location = trim($_POST['office _location']);
        $date_of_birth = $_POST['date_of_birth'];
        $per_hr_rate = $_POST['per_hr_rate'];
        $sat_rate = $_POST['sat_rate'];
        $sun_rate = $_POST['sun_rate'];

        try {
            // Get next sr_no
            $stmt = $pdo->query("SELECT MAX(sr_no) as max_sr FROM human_resource_list_dt");
            $row = $stmt->fetch();
            $sr_no = ($row['max_sr'] ?? 0) + 1;

            // Prepare the INSERT statement
            $query = "INSERT INTO human_resource_list_dt (
                        sr_no, dt_employee_number, dt_system_hr_number, name, calling_name, category, 
                        manpower_agent, employee_id, Job title, dt_job_role, skillness, date_joined, 
                        address, contact_tel, office _location, date_of_birth, per_hr_rate, sat_rate, sun_rate
                      ) VALUES (
                        :sr_no, :dt_employee_number, :dt_system_hr_number, :name, :calling_name, :category, 
                        :manpower_agent, :employee_id, :Job title, :dt_job_role, :skillness, :date_joined, 
                        :address, :contact_tel, :office _location, :date_of_birth, :per_hr_rate, :sat_rate, :sun_rate
                      )";

            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':sr_no' => $sr_no,
                ':dt_employee_number' => $employee_number,
                ':dt_system_hr_number' => $system_hr_number,
                ':name' => $name,
                ':calling_name' => $calling_name,
                ':category' => $category,
                ':manpower_agent' => $manpower_agent,
                ':employee_id' => $employee_id,
                ':Job title' => $job_title,
                ':dt_job_role' => $job_role,
                ':skillness' => $skillness,
                ':date_joined' => $date_joined,
                ':address' => $address,
                ':contact_tel' => $contact_tel,
                ':office _location' => $office_location,
                ':date_of_birth' => $date_of_birth,
                ':per_hr_rate' => $per_hr_rate,
                ':sat_rate' => $sat_rate,
                ':sun_rate' => $sun_rate
            ]);

            // Set success message in session
            $_SESSION['success'] = "Employee added successfully.";

            // Redirect to the same page to prevent form resubmission
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } catch (PDOException $e) {
            // Log the technical error (optional)
            // error_log("Database Error: " . $e->getMessage());

            // Set error message in session
            $_SESSION['error'] = "An error occurred while adding the employee. Please try again.";

            // Redirect to the same page
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    // Updating an existing employee
    if (isset($_POST['update'])) {
        // Retrieve and sanitize input data
        $id = intval($_POST['id']);
        $name = trim($_POST['name']);
        $employee_number = trim($_POST['dt_employee_number']);
        $system_hr_number = trim($_POST['dt_system_hr_number']);
        $calling_name = trim($_POST['calling_name']);
        $category = trim($_POST['category']);
        $manpower_agent = trim($_POST['manpower_agent']);
        $employee_id = trim($_POST['employee_id']);
        $job_title = trim($_POST['Job title']);
        $job_role = trim($_POST['dt_job_role']);
        $skillness = trim($_POST['skillness']);
        $date_joined = $_POST['date_joined'];
        $address = trim($_POST['address']);
        $contact_tel = trim($_POST['contact_tel']);
        $office_location = trim($_POST['office _location']);
        $date_of_birth = $_POST['date_of_birth'];
        $per_hr_rate = $_POST['per_hr_rate'];
        $sat_rate = $_POST['sat_rate'];
        $sun_rate = $_POST['sun_rate'];

        try {
            // Prepare the UPDATE statement
            $query = "UPDATE human_resource_list_dt SET
                        dt_employee_number = :dt_employee_number,
                        dt_system_hr_number = :dt_system_hr_number,
                        name = :name,
                        calling_name = :calling_name,
                        category = :category,
                        manpower_agent = :manpower_agent,
                        employee_id = :employee_id,
                        Job title = :Job title,
                        dt_job_role = :dt_job_role,
                        skillness = :skillness,
                        date_joined = :date_joined,
                        address = :address,
                        contact_tel = :contact_tel,
                        office _location = :office _location,
                        date_of_birth = :date_of_birth,
                        per_hr_rate = :per_hr_rate,
                        sat_rate = :sat_rate,
                        sun_rate = :sun_rate
                      WHERE sr_no = :sr_no";

            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':dt_employee_number' => $employee_number,
                ':dt_system_hr_number' => $system_hr_number,
                ':name' => $name,
                ':calling_name' => $calling_name,
                ':category' => $category,
                ':manpower_agent' => $manpower_agent,
                ':employee_id' => $employee_id,
                ':Job title' => $job_title,
                ':dt_job_role' => $job_role,
                ':skillness' => $skillness,
                ':date_joined' => $date_joined,
                ':address' => $address,
                ':contact_tel' => $contact_tel,
                ':office _location' => $office_location,
                ':date_of_birth' => $date_of_birth,
                ':per_hr_rate' => $per_hr_rate,
                ':sat_rate' => $sat_rate,
                ':sun_rate' => $sun_rate,
                ':sr_no' => $id
            ]);

            // Set success message in session
            $_SESSION['success'] = "Employee updated successfully.";

            // Redirect to the same page to prevent form resubmission
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } catch (PDOException $e) {
            // Log the technical error (optional)
            // error_log("Database Error: " . $e->getMessage());

            // Set error message in session
            $_SESSION['error'] = "An error occurred while updating the employee. Please try again.";

            // Redirect to the same page
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    // Deleting an employee
    if (isset($_POST['delete'])) {
        // Retrieve and sanitize input data
        $id = intval($_POST['id']);

        try {
            // Prepare the DELETE statement
            $stmt = $pdo->prepare("DELETE FROM human_resource_list_dt WHERE sr_no = :sr_no");
            $stmt->execute([':sr_no' => $id]);

            // Set success message in session
            $_SESSION['success'] = "Employee deleted successfully.";

            // Redirect to the same page to prevent form resubmission
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } catch (PDOException $e) {
            // Log the technical error (optional)
            // error_log("Database Error: " . $e->getMessage());

            // Set error message in session
            $_SESSION['error'] = "An error occurred while deleting the employee. Please try again.";

            // Redirect to the same page
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

// Determine the current page
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the offset for the SQL query
$offset = ($currentPage - 1) * $recordsPerPage;

// Fetch total number of records
try {
    $countQuery = "SELECT COUNT(*) FROM human_resource_list_dt";
    $countStmt = $pdo->prepare($countQuery);
    $countStmt->execute();
    $totalRecords = $countStmt->fetchColumn();
} catch (PDOException $e) {
    $_SESSION['error'] = "An error occurred while fetching records. Please try again.";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Calculate total pages
$totalPages = ceil($totalRecords / $recordsPerPage);

// Fetch records for the current page
try {
    $query = "SELECT * FROM human_resource_list_dt ORDER BY sr_no DESC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':limit', $recordsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error'] = "An error occurred while fetching records. Please try again.";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Management System</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/all.min.css" rel="stylesheet">
    <link href="css/popper.min.js" rel="stylesheet">

    <style>
        .search-box {
            position: relative;
            margin: 20px 0;
        }
        .search-box .form-control {
            padding-right: 40px;
        }
        .search-box .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
        .table-responsive {
            max-height: 600px;
            overflow-y: auto;
        }
        .fixed-header {
            position: sticky;
            top: 0;
            background: white;
            z-index: 1;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .pagination {
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-4">
        <!-- Navigation Bar -->
        <?php /* 
            Since you've already included 'include/header.php' at the top, 
            there's no need to include it again here.
        */ ?>

        <!-- Alerts -->
        <?php
        // Display success message if set
        if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php 
                echo safe_html($_SESSION['success']); 
                unset($_SESSION['success']); // Remove the message after displaying
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php
        // Display error message if set
        if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php 
                echo safe_html($_SESSION['error']); 
                unset($_SESSION['error']); // Remove the message after displaying
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Search Box -->
        <div class="search-box">
            <form id="searchForm" class="d-flex">
                <input type="text" id="searchInput" class="form-control" placeholder="Search employees...">
                <i class="fas fa-search search-icon"></i>
            </form>
        </div>

        <!-- Add New Employee Button -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#employeeModal">
            <i class="fas fa-plus"></i> Add New Employee
        </button>

        <!-- Employee Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="fixed-header">
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Job Title</th>
                        <th>Contact</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="employeeTableBody">
                    <?php if (isset($employees) && count($employees) > 0): ?>
                        <?php foreach ($employees as $row): ?>
                            <tr>
                                <td><?php echo safe_html($row['dt_employee_number']); ?></td>
                                <td><?php echo safe_html($row['name']); ?></td>
                                <td><?php echo safe_html($row['Job title']); ?></td>
                                <td><?php echo safe_html($row['contact_tel']); ?></td>
                                <td><?php echo safe_html($row['office _location']); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-info view-btn" data-id="<?php echo safe_html($row['sr_no']); ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning edit-btn" data-id="<?php echo safe_html($row['sr_no']); ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="<?php echo safe_html($row['sr_no']); ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No employees found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Controls -->
        <?php if ($totalPages > 1): ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination" id="paginationControls">
                    <!-- Previous Button -->
                    <li class="page-item <?php if ($currentPage <= 1) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($currentPage > 1) echo '?page=' . ($currentPage - 1); else echo '#'; ?>">Previous</a>
                    </li>

                    <!-- Page Numbers -->
                    <?php
                    // Display a range of pages around the current page
                    $range = 2; // Adjust as needed
                    for ($i = max(1, $currentPage - $range); $i <= min($currentPage + $range, $totalPages); $i++):
                    ?>
                        <li class="page-item <?php if ($currentPage == $i) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Next Button -->
                    <li class="page-item <?php if ($currentPage >= $totalPages) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($currentPage < $totalPages) echo '?page=' . ($currentPage + 1); else echo '#'; ?>">Next</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>

        <!-- Employee Modal (Add/Edit) -->
        <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="employeeModalLabel">Employee Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="employee_id">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Employee Number</label>
                                    <input type="text" name="dt_employee_number" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>System HR Number</label>
                                    <input type="text" name="dt_system_hr_number" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Calling Name</label>
                                    <input type="text" name="calling_name" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Category</label>
                                    <input type="text" name="category" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Manpower Agent</label>
                                    <input type="text" name="manpower_agent" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Employee ID</label>
                                    <input type="text" name="employee_id" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Job Title</label>
                                    <input type="text" name="Job title" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Job Role</label>
                                    <input type="text" name="dt_job_role" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Skillness</label>
                                    <input type="text" name="skillness" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Date Joined</label>
                                    <input type="date" name="date_joined" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Contact Tel</label>
                                    <input type="text" name="contact_tel" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Office Location</label>
                                    <input type="text" name="office _location" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Per Hour Rate</label>
                                    <input type="number" step="0.01" name="per_hr_rate" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Saturday Rate</label>
                                    <input type="number" step="0.01" name="sat_rate" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Sunday Rate</label>
                                    <input type="number" step="0.01" name="sun_rate" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="save" class="btn btn-primary">Save</button>
                            <button type="submit" name="update" class="btn btn-warning" style="display:none;">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- View Modal -->
        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">Employee Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Details will be loaded dynamically -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this employee?
                    </div>
                    <div class="modal-footer">
                        <form method="POST">
                            <input type="hidden" name="id" id="delete_id">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="css/bootstrap.bundle.min.js"></script>
    <!-- jQuery (for AJAX and DOM manipulation) -->
    <script src="css/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to handle real-time search
            $('#searchInput').on('input', function() {
                var searchTerm = $(this).val().trim();

                if (searchTerm.length >= 1) { // Start searching from 1 character
                    $.ajax({
                        url: 'search_employee.php',
                        type: 'POST',
                        data: {search: searchTerm},
                        success: function(response) {
                            $('#employeeTableBody').html(response);
                            $('#paginationControls').hide(); // Hide pagination during search
                        },
                        error: function() {
                            $('#employeeTableBody').html('<tr><td colspan="6" class="text-center text-danger">An error occurred while searching.</td></tr>');
                        }
                    });
                } else {
                    // If search input is empty, reload the table with default data
                    $.ajax({
                        url: 'search_employee.php',
                        type: 'POST',
                        data: {search: ''},
                        success: function(response) {
                            $('#employeeTableBody').html(response);
                            $('#paginationControls').show(); // Show pagination when not searching
                        },
                        error: function() {
                            $('#employeeTableBody').html('<tr><td colspan="6" class="text-center text-danger">An error occurred while loading data.</td></tr>');
                        }
                    });
                }
            });

            // Handle Edit Button Click
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                // Load employee data via AJAX
                $.ajax({
                    url: 'get_employee.php',
                    type: 'GET',
                    data: {id: id},
                    dataType: 'json', // Ensure response is treated as JSON
                    success: function(employee) {
                        if (employee.error) {
                            alert(employee.error);
                            return;
                        }
                        // Fill the form with employee data
                        $('#employee_id').val(employee.sr_no);
                        $('[name="dt_employee_number"]').val(employee.dt_employee_number);
                        $('[name="dt_system_hr_number"]').val(employee.dt_system_hr_number);
                        $('[name="name"]').val(employee.name);
                        $('[name="calling_name"]').val(employee.calling_name);
                        $('[name="category"]').val(employee.category);
                        $('[name="manpower_agent"]').val(employee.manpower_agent);
                        $('[name="employee_id"]').val(employee.employee_id);
                        $('[name="Job title"]').val(employee.job_title);
                        $('[name="dt_job_role"]').val(employee.dt_job_role);
                        $('[name="skillness"]').val(employee.skillness);
                        $('[name="date_joined"]').val(employee.date_joined);
                        $('[name="address"]').val(employee.address);
                        $('[name="contact_tel"]').val(employee.contact_tel);
                        $('[name="office _location"]').val(employee.office_location);
                        $('[name="date_of_birth"]').val(employee.date_of_birth);
                        $('[name="per_hr_rate"]').val(employee.per_hr_rate);
                        $('[name="sat_rate"]').val(employee.sat_rate);
                        $('[name="sun_rate"]').val(employee.sun_rate);
                        $('[name="update"]').show();
                        $('[name="save"]').hide();
                        // Show the modal
                        $('#employeeModal').modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("An error occurred while fetching employee data.");
                    }
                });
            });

            // Handle View Button Click
            $(document).on('click', '.view-btn', function() {
                var id = $(this).data('id');
                // Load employee data via AJAX
                $.ajax({
                    url: 'get_employee.php',
                    type: 'GET',
                    data: {id: id},
                    dataType: 'json', // Ensure response is treated as JSON
                    success: function(employee) {
                        if (employee.error) {
                            alert(employee.error);
                            return;
                        }
                        // Display employee data in the view modal
                        var details = `
                            <p><strong>Employee Number:</strong> ${employee.dt_employee_number}</p>
                            <p><strong>System HR Number:</strong> ${employee.dt_system_hr_number}</p>
                            <p><strong>Name:</strong> ${employee.name}</p>
                            <p><strong>Calling Name:</strong> ${employee.calling_name}</p>
                            <p><strong>Category:</strong> ${employee.category}</p>
                            <p><strong>Manpower Agent:</strong> ${employee.manpower_agent}</p>
                            <p><strong>Employee ID:</strong> ${employee.employee_id}</p>
                            <p><strong>Job Title:</strong> ${employee.job_title}</p>
                            <p><strong>Job Role:</strong> ${employee.dt_job_role}</p>
                            <p><strong>Skillness:</strong> ${employee.skillness}</p>
                            <p><strong>Date Joined:</strong> ${employee.date_joined}</p>
                            <p><strong>Address:</strong> ${employee.address}</p>
                            <p><strong>Contact Tel:</strong> ${employee.contact_tel}</p>
                            <p><strong>Office Location:</strong> ${employee.office_location}</p>
                            <p><strong>Date of Birth:</strong> ${employee.date_of_birth}</p>
                            <p><strong>Per Hour Rate:</strong> ${employee.per_hr_rate}</p>
                            <p><strong>Saturday Rate:</strong> ${employee.sat_rate}</p>
                            <p><strong>Sunday Rate:</strong> ${employee.sun_rate}</p>
                        `;
                        $('#viewModal .modal-body').html(details);
                        $('#viewModal').modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("An error occurred while fetching employee data.");
                    }
                });
            });

            // Handle Delete Button Click
            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
                $('#deleteModal').modal('show');
            });

            // Reset modal forms when closed
            $('#employeeModal').on('hidden.bs.modal', function () {
                $('form')[0].reset();
                $('[name="update"]').hide();
                $('[name="save"]').show();
            });
        });
    </script>
</body>
</html>

