<?php

// Fetch the admin's last login time from the session or database
$last_login = $_SESSION['last_login'] ?? 'Never logged in';

// Format the last login time and date if it exists
if ($last_login !== 'Never logged in') {
    $last_login = date('h:i A, d M Y', strtotime($last_login)); // Format: 02:30 PM, 15 Oct 2023
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="bg-gradient-to-r from-blue-600 to-purple-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="dashboard.php" class="text-white text-2xl font-bold">Admin Panel</a>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    <a href="view_employees.php" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Add Employees</a>
                    <a href="view_employee.php" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Viwe Employees Details
                    </a>
                  
                </div>

                <!-- Admin Info and Last Login -->
                <div class="flex items-center">
                    <div class="text-white text-sm mr-4">
                        <span class="font-semibold">Welcome, <?php echo $_SESSION['username'] ?? 'Admin'; ?></span>
                        <span class="block text-xs text-gray-200">Last Login: <?php echo $last_login; ?></span>
                    </div>
                    <div class="relative">
                        <!-- Profile Dropdown -->
                        <button id="profileDropdown" class="flex items-center text-white focus:outline-none">
                            <img src="img/1.jpg" alt="Admin" class="w-8 h-8 rounded-full">
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                            <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- JavaScript CDNs -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for Dropdown -->
    <script>
        const profileDropdown = document.getElementById('profileDropdown');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Toggle dropdown on button click
        profileDropdown.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!profileDropdown.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>