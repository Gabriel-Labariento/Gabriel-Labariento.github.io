<?php
    // Start the session
    session_start();
    if (!isset($_SESSION['user'])) header('location: ../login.php');

    $_SESSION['table'] = 'products';
    $_SESSION['redirect_to'] = 'product-add.php';

    $user = $_SESSION['user'];

    // Initialize variables
    $response_message = "";
    $is_success = false;

    if (isset($_SESSION['response'])) {
        $response_message = $_SESSION['response']['message'];
        $is_success = $_SESSION['response']['success'];
        // Unset the session variable after retrieving its values
        unset($_SESSION['response']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | Inventory Management</title>
    <?php include('partials/app-header-scripts.php'); ?>
</head>

<body id="">
   <div id="dashboardMainContainer">
       <?php include('partials/app-sidebar.php') ?>
    </div>
    <div class="dashboardContentContainer">
    <?php include('partials/app-topnav.php') ?>
        <div class="dashboardContent">
        <div class="dashboardContentMain">
            <div class="row">
                <div class="column column-12">
                    <h1 class="sectionHeader">Add Product</h1>
                    <div class="" id="userAddFormContainer">
                        <form action="database/add.php" method="POST" id="appForm">
                            <div class="appFormInputContainer">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="appFormInput" name="product_name" placeholder="Enter product name..." id="product_name">
                            </div>
                            <div class="appFormInputContainer">
                                <label for="description">Description</label>
                                <textarea class="appFormInput procutTextAreaInput" name="description" id="description" placeholder="Enter product description...">

                                </textarea>
                            </div>
                            <button id="registerBtn"     type="submit"><i class="fa fa-plus"></i>Add Product</button>
                        </form>


                        <?php if(isset($_SESSION['response'])){
                            $response_message = $_SESSION['response']['message'];
                            $is_success = $_SESSION['response']['success'];}
                        ?>
                            <div class="responseMessage">
                                <p class="responseMessage <?= $is_success ? 'responseMessage_success' : 'responseMessage_error' ?>">
                                    <?= $response_message ?>
                                </p>
                            </div>
                        <?php unset($_SESSION['response']); ?>
                    </div>
            </div>
                </div>
            </div>
            
        </div>
    </div>
   </div>

   <?php include('partials/app-scripts.php'); ?>

</body>
</html>

