<?php
session_start();
include 'Connection/db.php';

// Pagination logic
$records_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Fetch total number of records
$total_records_sql = "SELECT COUNT(*) AS total FROM human_resource_list_dt";
$total_records_stmt = $conn->query($total_records_sql);
$total_records = $total_records_stmt->fetch(PDO::FETCH_ASSOC)['total'];
$total_pages = ceil($total_records / $records_per_page);

// Fetch records for the current page
$sql = "SELECT * FROM human_resource_list_dt LIMIT :offset, :records_per_page";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':records_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employees</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php
   include 'include/header.php'
   ?>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Employee List</h2>

        <!-- Search Bar -->
        <div class="mb-6">
            <input type="text" id="search" placeholder="Search employees..." class="w-full p-2 border border-gray-300 rounded-lg">
        </div>

        <!-- Employee Table -->
        <div id="employee-table" class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">SR No</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Employee Number</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Name</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Calling Name</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Category</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Manpower Agent</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Employee ID</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Job Title</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Dt Job Role</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Skilness</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Date Join</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Address</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Contact Number</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Office Location</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Date Of Birth</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Per Hour rate</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Sat Rate</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Sun Rate</th>
                        <th class="py-3 px-4 border-b border-gray-300 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['sr_no']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['dt_employee_number']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['name']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['calling_name']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['category']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['manpower_agent']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['employee_id']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['Job title']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['dt_job_role']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['skilness']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['date_joint']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['address']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['contact_tel']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['office _location']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['date_of_birth']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['per_hr_rate']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['sat_rate']); ?></td>
                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700"><?php echo htmlspecialchars($employee['sun_rate']); ?></td>

                            <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">
                                <button onclick="openEditModal('<?php echo $employee['sr_no']; ?>', '<?php echo $employee['name']; ?>', '<?php echo $employee['dt_employee_number']; ?>')" class="px-2 py-1 bg-blue-500 text-white rounded-lg">Edit</button>
                                <button onclick="deleteEmployee('<?php echo $employee['sr_no']; ?>')" class="px-2 py-1 bg-red-500 text-white rounded-lg">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between mt-6">
            <button onclick="prevPage()" class="px-4 py-2 bg-blue-500 text-white rounded-lg <?php echo $page <= 1 ? 'opacity-50 cursor-not-allowed' : ''; ?>">Previous</button>
            <span class="text-gray-700">Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>
            <button onclick="nextPage()" class="px-4 py-2 bg-blue-500 text-white rounded-lg <?php echo $page >= $total_pages ? 'opacity-50 cursor-not-allowed' : ''; ?>">Next</button>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-6">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-xl font-bold mb-4">Edit Employee</h3>
            <form id="edit-form">
                <input type="hidden" id="edit-id" name="id">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="edit-name" name="name" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Employee Number</label>
                        <input type="text" id="edit-employee-number" name="dt_employee_number" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <!-- Add more fields as needed -->
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Pagination
        function nextPage() {
            const currentPage = <?php echo $page; ?>;
            const totalPages = <?php echo $total_pages; ?>;
            if (currentPage < totalPages) {
                window.location.href = `?page=${currentPage + 1}`;
            }
        }

        function prevPage() {
            const currentPage = <?php echo $page; ?>;
            if (currentPage > 1) {
                window.location.href = `?page=${currentPage - 1}`;
            }
        }

        // Real-time Search
        $('#search').on('input', function() {
            const query = $(this).val();
            $.ajax({
                url: 'search_employees.php',
                method: 'POST',
                data: { query: query },
                success: function(response) {
                    $('#employee-table').html(response);
                }
            });
        });

        // Edit Modal
        function openEditModal(id, name, employeeNumber) {
            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#edit-employee-number').val(employeeNumber);
            $('#edit-modal').removeClass('hidden');
        }

        function closeEditModal() {
            $('#edit-modal').addClass('hidden');
        }

        // Save Edit Form
        $('#edit-form').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: 'update_employee.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    alert('Employee updated successfully!');
                    closeEditModal();
                    location.reload(); // Refresh the page
                }
            });
        });

        // Delete Employee
        function deleteEmployee(id) {
            if (confirm('Are you sure you want to delete this employee?')) {
                $.ajax({
                    url: 'delete_employee.php',
                    method: 'POST',
                    data: { id: id },
                    success: function(response) {
                        alert('Employee deleted successfully!');
                        location.reload(); // Refresh the page
                    }
                });
            }
        }
    </script>
</body>
</html>