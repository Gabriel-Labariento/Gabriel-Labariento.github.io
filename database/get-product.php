<?php 
include('connection.php');

$id = $_GET['id'];


$stmt = $conn->prepare("SELECT * FROM products WHERE id=$id");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$created_by_name = $row['first_name'] . ' ' . $row['last_name'];

echo json_encode($row);