<?php
// Check if $page and $total_pages are defined
$page = isset($page) ? $page : 1;
$total_pages = isset($total_pages) ? $total_pages : 1;
?>

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

<!-- Pagination -->
<div class="flex justify-between mt-6">
    <button onclick="prevPage()" class="px-4 py-2 bg-blue-500 text-white rounded-lg <?php echo $page <= 1 ? 'opacity-50 cursor-not-allowed' : ''; ?>">Previous</button>
    <span class="text-gray-700">Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>
    <button onclick="nextPage()" class="px-4 py-2 bg-blue-500 text-white rounded-lg <?php echo $page >= $total_pages ? 'opacity-50 cursor-not-allowed' : ''; ?>">Next</button>
</div>