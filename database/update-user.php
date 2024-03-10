<?php
    // Retrieve data from POST request
    $data = $_POST;
    // Convert user_id to integer
    $user_id = (int) $data['user_id'];
    // Extract first name, last name, and email from data
    $first_name = $data['f_name'];
    $last_name = $data['l_name'];
    $email = $data['email'];

    // Update user record
    try {
        // Prepare SQL statement to update user record
        $sql = "UPDATE users SET email=?, first_name=?, last_name=?, updated_at=? WHERE id=?";
        // Include database connection file
        include('connection.php');
        // Execute prepared statement with provided values
        $conn->prepare($sql)->execute([$email, $first_name, $last_name, date('Y-m-d h:i:s'), $user_id]);
        
        // Return success message in JSON format
        echo json_encode([
            'success' => true,
            'message' => $first_name . ' ' . $last_name . ' successfully updated.'
        ]);
    } catch (PDOException $e) {
        // Return error message in JSON format if an exception occurs
        echo json_encode([
            'success' => false,
            'message' => 'Error processing your request.'
        ]);
    }
?>
