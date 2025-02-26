<?php
include 'Connection/db.php';

$query = $_POST['query'];
$sql = "SELECT * FROM human_resource_list_dt WHERE name LIKE :query OR dt_employee_number LIKE :query";
$stmt = $conn->prepare($sql);
$stmt->execute(['query' => "%$query%"]);
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'employee_table.php';