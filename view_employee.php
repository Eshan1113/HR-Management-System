<?php
session_start();
include 'Connection/db.php';

// Check if the employee ID is provided in the URL
if (!isset($_GET['id'])) {
    header('Location: view_employee.php');
    exit();
}

$id = $_GET['id'];

// Fetch employee details from the database
$stmt = $conn->prepare("SELECT * FROM human_resource_list_dt WHERE sr_no = :id");
$stmt->execute(['id' => $id]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

// Redirect if employee not found
if (!$employee) {
    header('Location: view_employee.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employee - <?php echo $employee['name']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="p-8">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Employee Details</h1>
            
            <!-- Employee Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600">Employee Number</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['dt_employee_number']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">System HR Number</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['dt_system_hr_number']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Name</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['name']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Calling Name</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['calling_name']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Category</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['category']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Manpower Agent</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['manpower_agent']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Employee ID</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['employee_id']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Job Title</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['Job title']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Job Role</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['dt_job_role']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Skillness</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['skilness']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Date Joined</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo date('d M Y', strtotime($employee['date_joint'])); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Address</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['address']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Contact Tel</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['contact_tel']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Office Location</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['office _location']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Date of Birth</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo date('d M Y', strtotime($employee['date_of_birth'])); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Per Hour Rate</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['per_hr_rate']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Saturday Rate</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['sat_rate']; ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Sunday Rate</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['sun_rate']; ?></p>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8">
                <a href="view_employees.php" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Back to Employee List</a>
            </div>
        </div>
    </main>
</body>
</html>