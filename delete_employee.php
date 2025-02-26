<?php
include 'Connection/db.php';

$id = $_POST['id'];

$sql = "DELETE FROM human_resource_list_dt WHERE sr_no = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id]);

echo 'Employee deleted successfully!';