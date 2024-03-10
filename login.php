<?php

    // Start the session
    session_start();

    // Redirect to dashboard if user is already logged in
    if(isset($_SESSION['user'])) header('location: dashboard.php');

    // Initialize error message variable
    $error_message = '';

    // Check if form is submitted
    if($_POST){
        // Include database connection file
        include('database/connection.php'); 

        // Retrieve username and password from form
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Prepare and execute SQL query to retrieve all users
        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
        // Fetch all users from database
        $users = $stmt->fetchAll();
    
        // Initialize variable to check if user exists
        $user_exist = false;

        // Iterate through each user to check for a match
        foreach($users as $user){
            // Retrieve hashed password from database
            $upass = $user['password'];
    
            // Verify if the provided password matches the hashed password
            if (password_verify($password, $upass)){
                // Set user session and mark user existence
                $user_exist = true;
                $_SESSION['user'] = $user;
                break;
            }
        }
    
        // Redirect to dashboard if user exists, otherwise set error message
        if($user_exist) header('Location:dashboard.php');
        else $error_message = 'Please make sure that the username and password are correct.';
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-sclepius Login | Inventory Management</title>
    <link rel="stylesheet" href="login.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
</head>
<body id="loginBody">
    <?php
        // Display error message if it's not empty
        if(!empty($error_message)){ ?>
    <div id="errorMessage"> 
        <strong>Error:</strong> <p><?= $error_message ?></p>
    </div>
    <?php } ?>
    <div class="loginMain"> <!-- Login container -->
        <div class="container">
            <div class="loginHeader">
                <div class="logo"> 
                    <a href="index.php"><img src="images/E-SCLEPIUS LOGO (2).svg" alt="E-sclepius Logo" id="login-logo"/></a>
                </div>
                <h3>Inventory Management System</h3>
            </div>
        </div>
        <div class="loginBody"> <!-- Login form -->
            <form action="login.php" method="POST">
                <div class="loginInputContainer">
                    <label for="">Username</label>
                    <input type="text" placeholder="Username" name="username" />
                </div>
                <div class="loginInputContainer">
                    <label for="">Password</label>
                    <input type="password" placeholder="Password" name="password" />
                </div>
                <div>
                    <button class="loginButton">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
