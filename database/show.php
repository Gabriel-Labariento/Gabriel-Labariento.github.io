<?php
    // Include database connection file
    include('connection.php');


    $table_name = $_SESSION['table'];

    // Prepare SQL statement to select all users ordered by creation date in descending order
    $stmt = $conn->prepare("SELECT * FROM $table_name ORDER BY created_at DESC");
    // Execute the prepared statement
    $stmt->execute();
    // Set fetch mode to return an associative array
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Return all fetched rows as an associative array
    return $stmt->fetchAll();
?>
