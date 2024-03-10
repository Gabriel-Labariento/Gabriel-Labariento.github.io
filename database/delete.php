<?php
    // Retrieve data from POST request
    $data = $_POST;
    // Convert user_id to integer
    $id = (int) $data['id'];

    $table = $data['table'];
  


    // Delete record from the database
    try {
        // Prepare SQL command to delete user record
        $command = "DELETE FROM $table WHERE id=($id)";
        // Include database connection file
        include('connection.php');
        // Execute SQL command
        $conn->exec($command);
        
        // Return success message in JSON format
        return json_encode([
            'success' => true,
            
        ]);
    } catch (PDOException $e) {
        // Return error message in JSON format if an exception occurs
        return json_encode([
            'success' => false,
            
        ]);
    }
?>