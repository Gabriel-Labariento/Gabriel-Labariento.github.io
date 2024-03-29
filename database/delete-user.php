<?php
    // Retrieve data from POST request
    $data = $_POST;
    // Convert user_id to integer
    $user_id = (int) $data['user_id'];
    // Extract first name and last name from data
    $first_name = $data['f_name'];
    $last_name = $data['l_name'];

    // Delete record from the database
    try {
        // Prepare SQL command to delete user record
        $command = "DELETE FROM users WHERE id=($user_id)";
        // Include database connection file
        include('connection.php');
        // Execute SQL command
        $conn->exec($command);
        
        // Return success message in JSON format
        return json_encode([
            'success' => true,
            'message' => $first_name .  ' ' . $last_name . ' successfully deleted.',
        ]);
    } catch (PDOException $e) {
        // Return error message in JSON format if an exception occurs
        return json_encode([
            'success' => false,
            'message'=> 'Error processing your request.'
        ]);
    }
?>