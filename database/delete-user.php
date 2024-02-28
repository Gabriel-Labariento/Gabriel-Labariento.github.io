<?php
    $data = $_POST;
    $user_id = (int) $data['user_id'];
    $first_name = $data['f_name'];
    $last_name = $data['l_name'];

    //delete record

    try{
        $command = "DELETE from users WHERE id=($user_id)";

    include('connection.php');

    $conn->exec($command);

    return json_encode([
        'success' => true,
        'message' => $first_name .  ' ' . $last_name . ' successfully deleted.',
        ]);
    } catch (PDOException $e){
        return json_encode([
            'success' => false,
            'message'=> 'Error processing your request.'
        ]);
    }

?>