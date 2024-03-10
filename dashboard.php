<?php

    // Start the session
    session_start();

    // Redirect to login page if user is not logged in
    if(!isset($_SESSION['user'])) header('location: ../login.php');

    // Get user information from session
    $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Inventory Management</title>
    <!-- Link to external stylesheets and fonts -->
    <link rel="stylesheet" href="login.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
</head>

<body id="">
    <!-- Dashboard main container -->
    <div id="dashboardMainContainer">
        <?php include('partials/app-sidebar.php') ?> <!-- Include sidebar -->
    </div>
    <div class="dashboardContentContainer">
        <?php include('partials/app-topnav.php') ?> <!-- Include top navigation -->
        <div class="dashboardContent">
            <div class="dashboardContentMain"></div> <!-- Main content -->
        </div>
    </div>
    <!-- Include JavaScript file -->
    <script src="js/script.js" defer></script>
</body>
</html>
