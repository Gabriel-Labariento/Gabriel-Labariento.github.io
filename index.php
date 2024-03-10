<!DOCTYPE html> <!-- Declaration of HTML version -->
<html lang="en"> <!-- Define language for better accessibility -->
<head>
    <!-- Meta tags for character set and viewport -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title of the webpage -->
    <title>E-sclepius Homepage | Inventory Management</title>
    <!-- Link to external stylesheet for login page -->
    <link rel="stylesheet" href="login.css"/>
    <!-- Link to Font Awesome library for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Preconnect to Google Fonts for faster loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Link to custom font family from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
</head>
<body id=""> <!-- Body of the webpage -->
    <!-- Header section with login link -->
    <div class="header">
        <a href="login.php">Login</a>
    </div>
    <!-- Banner section with company logo, title, tagline, and registration button -->
    <div class="banner">
        <div class="homePageContainer">
                <img src="images/E-SCLEPIUS LOGO (2).svg" alt="E-sclepius Logo" id="homepageLogo"/>
                <h3 class="homePage">INVENTORY MANAGEMENT SYSTEM</h3>
                <p class="homeTagLine">An Inventory Management System Designed for Local Drugstores. Experience Seamless Precision with the E-sclepius Inventory Management System. Unleash Efficiency, Master Control, and Elevate Your Business to New Heights!</p>
                <a href="login.php"><button type="button" id="getStarted">Register Now</button></a>
        </div>
    </div>
    <!-- Section for features of the inventory management system -->
    <div class="homePageFeatures">
        <!-- Each feature represented by an icon, title, and description -->
        <div class="homePageFeature">
            <span class="featureIcon"><i class="fa fa-gear"></i></span>
            <h4 class="featureTitle">deserunt magna</h4>
            <p class="featureDescription">commodo sunt dolor ut irure aliquip aliquip voluptate cupidatat irure</p>
        </div>
        <div class="homePageFeature">
            <span class="featureIcon"><i class="fa fa-star"></i></span>
            <h4 class="featureTitle">deserunt magna</h4>
            <p class="featureDescription">commodo sunt dolor ut irure aliquip aliquip voluptate cupidatat irure</p>
        </div>
        <div class="homePageFeature">
            <span class="featureIcon"><i class="fa fa-globe"></i></span>
            <h4 class="featureTitle">deserunt magna</h4>
            <p class="featureDescription">commodo sunt dolor ut irure aliquip aliquip voluptate cupidatat irure</p>
        </div>
    </div>
    <!-- Section for staying in touch with the company -->
    <div class="homePageContainer1">
        <div class="homePageNotified">
            <h3 class="notifiedTitle">STAY IN TOUCH</h3>
            <!-- Form for submitting email to receive notifications -->
            <div class="emailForm">
                <p class="notifiedText">anim cupidatat commodo aliqua voluptate amet do ad et dolore culpa ea eiusmod ea id incididunt et qui proident aute sde aliquip sunt velit enim Lorem voluptate occaecat </p>
               <div class="formContainer">
                <form action="">
                    <input type="email" placeholder="Email Address" />
                    <button id="notifButton" type="">NOTIFY</button>
                </form>
               </div>
            </div>
        </div>
    </div>
    <!-- Footer section -->
    <div class="footer">
    </div>
</body>
</html>
