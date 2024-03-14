<?php 
include('connection.php');

$id = $_GET['id'];


$stmt = $conn->prepare("SELECT p.*, u.first_name, u.last_name FROM products p JOIN users u ON p.created_by = u.id WHERE p.id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the row is fetched successfully
if ($row) {
    // Now you can access 'first_name' and 'last_name' in the $row array
    $created_by_name = $row['first_name'] . ' ' . $row['last_name'];
    echo json_encode($row);
} else {
    echo "Product not found";
}
