<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

include 'Connection/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .navbar { background: #333; color: #fff; padding: 10px; display: flex; justify-content: space-between; }
        .navbar a { color: #fff; text-decoration: none; margin: 0 10px; }
        .container { max-width: 1200px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .btn { padding: 10px 20px; background: #28a745; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <?php
   include 'include/header.php'
   ?>
</body>
</html>