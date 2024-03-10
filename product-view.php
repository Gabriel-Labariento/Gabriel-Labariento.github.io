<?php
    // Start the session
    session_start();
    if (!isset($_SESSION['user'])) header('location: ../login.php');
    $_SESSION['table'] = 'products';
    $products = include('database/show.php');

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
    <title>View Products | Inventory Management</title>
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
              <h1 class="sectionHeader">List of Products</h1>
              <div class="sectionContent">
                <div class="users">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>   
                            <tbody>
                                <?php foreach($products as $index => $product){ ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td class="firstName">
                                            <img class="productImages" src="uploads/products/<?= $product['img']?>" alt="">
                                        </td>
                                        <td class="lastName"><?= $product['product_name'] ?></td>
                                        <td class="email"><?= $product['description'] ?></td>
                                        <td><?= $product['created_by'] ?></td>
                                        <td><?= date('M d, Y @ h:i:s A', strtotime($product['updated_at'])) ?></td>
                                        <td><?= date('M d, Y @ h:i:s A', strtotime($product['created_at'])) ?></td>
                                        <td>
                                            <a href="" class="updateProduct" data-pid="<?= $product['id'] ?>"><i class="fa fa-pencil"></i> Edit<br></a>                                                
                                            <a href="" class="deleteProduct" data-name="<?= $product['product_name'] ?>" data-pid="<?= $product['id'] ?>"><i class="fa fa-trash"></i> Delete</a>                                    
                                        </td>
                                    </tr>
                                <?php } ?>
                            </body>
                        </tr>
                        </thead>
                    </table>
                </div>
                <p class="userCount"><?= count($products) ?> Products</p>
              </div>
            </div>
                </div>
            </div>
            
        </div>
    </div>
   </div>

   <!-- Bootstrap modals-->
   <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to perform this action?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmAction">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Successfully Updated</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                User was successfully updated. Please refresh the page to see changes.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                There was an error in processing user update.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>



    <?php include('partials/app-scripts.php'); ?>

    <script>
    function script() {
        this.initialize = function () {
            this.registerEvents();
        },

        this.registerEvents = function () {
            document.addEventListener('click', function (e) {
                targetElement = e.target;
                classList = targetElement.classList;

                if (classList.contains('deleteProduct')) {
                    e.preventDefault();

                    pId = targetElement.dataset.pid;
                    pName = targetElement.dataset.name;

                    // Trigger the confirmation modal
                    $('#confirmationModal').modal('show');

                    // Handle the confirmation action
                    $('#confirmAction').unbind().click(function () { // Unbind previous click events
                        $.ajax({
                            method: 'POST',
                            data: {
                                id: pId,
                                table: 'products'
                            },
                            url: 'database/delete.php',
                            dataType: 'json',
                            success: function (data) {
                                message = data.success ?
                                    pName + ' successfully deleted.' : 'Error processing your request';
                                if (data.success) {
                                    $('#confirmationModal').modal('hide'); // Hide the modal
                                    alert(message); // You can customize this alert with a modal if needed
                                    location.reload(); // Refresh the page
                                }
                            }
                        });
                    });
                }
            });
        }
    }

    var script = new script;
    script.initialize();
</script>
</body>
</html>

