<?php

    //Start the session...
    session_start();
    if(isset($_SESSION['user'])) header('location: dashboard.php');

    $error_message = '';
    if($_POST){
        include('database/connection.php'); 
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
        $users = $stmt->fetchAll();
    
        $user_exist = false;
        foreach($users as $user){
            $upass = $user['password'];
    
            if (password_verify($password, $upass)){
                $user_exist = true;
                $_SESSION['user'] = $user;
                break;
            }
        }
    
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
        if(!empty($error_message)){ ?>
    <div id="errorMessage"> 
        <strong>Error:</strong> <p><?= $error_message ?></p>
    </div>
    <?php } ?>
    <div class="loginMain"> <!--wrapper-->
        <div class="container">
        <div class="loginHeader">
            <div class="logo"> 
                <a href="index.php"><img src="images/E-SCLEPIUS LOGO (2).svg" alt="E-sclepius Logo" id="login-logo"/></a>
            </div>
            <h3>Inventory Management System</h3>
        </div>
    </div>
    <div class="loginBody">
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

