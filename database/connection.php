<?php
    // Database connection parameters
    $servername = 'localhost';
    $username = 'root';
    $password = '';

    // Connecting to the database
    try{
        // Create a new PDO instance for MySQL connection
        $conn = new PDO("mysql:host=$servername;dbname=inventory", $username, $password);
        
        // Set PDO error mode to exception for better error handling
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (\Exception $e) {
        // Catch any exceptions and store the error message
        $error_message = $e->getMessage();
    }
?>
