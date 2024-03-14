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
                                        <td>
                                            <?php
                                                $pid = $product['created_by'];
                                                $stmt = $conn->prepare("SELECT * FROM users WHERE id=$pid");
                                                $stmt->execute();
                                                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                                $created_by_name = $row['first_name'] . ' ' . $row['last_name'];
                                                echo $created_by_name;

                                            ?>
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
   <div class="modal fade" id="confirmationDeleteProductModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationDeleteProductModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this product?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteProduct">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmationUpdateProductModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationUpdateProductModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmUpdateProduct">Update</button>
            </div>
        </div>
    </div>
</div>


    <?php include('partials/app-scripts.php'); ?>

 <script>
    function script() {
        var vm = this;

        this.initialize = function () {
            this.registerEvents();
        };

        this.registerEvents = function () {
            // Register click events
            document.addEventListener('click', function (e) {
                var targetElement = e.target;
                var classList = targetElement.classList;

                if (classList.contains('deleteProduct')) {
                    e.preventDefault();
                    var pId = targetElement.dataset.pid;
                    // Trigger the confirmation modal
                    $('#confirmationDeleteProductModal').modal('show');

                    // Handle the confirmation action
                    document.getElementById('confirmDeleteProduct').addEventListener('click', function () {
                        // AJAX request to delete the product
                        $.ajax({
                            method: 'POST',
                            data: {
                                id: pId,
                                table: 'products'
                            },
                            url: 'database/delete.php',
                            dataType: 'json',
                            success: function (data) {
                                if (data.success) {
                                    window.alert(data.message);
                                    location.reload();
                                } else {
                                    window.alert(data.message);
                                }
                            }
                        });
                        $('#confirmationDeleteProductModal').modal('hide'); // Hide the modal
                        location.reload();
                    });
                }

                if (classList.contains('updateProduct')) {
                    e.preventDefault();
                    var pId = targetElement.dataset.pid;
                    // Pass the form as a parameter to 'showEditDialog'
                    vm.showEditDialog(pId, targetElement.closest('tr').querySelector('.editProductForm'));
                }
            });

            // Register submit events
            document.addEventListener('submit', function (e) {
                e.preventDefault();
                var targetElement = e.target;

                // Check the form's ID for event target
                if (targetElement.id === 'editProductForm') {
                    vm.saveUpdatedData(targetElement);
                }
            });
        };

        this.saveUpdatedData = function (form) {
            var formData = new FormData(form);

            $.ajax({
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                dataType: 'json',
                url: 'database/update-product.php',
                success: function (data) {
                    if (data.success) {
                        window.alert(data.message);
                        location.reload();
                    } else {
                        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        };

        this.showEditDialog = function (id, form) {
            $.get('database/get-product.php', { id: id }, function (productDetails) {
                var modalBody = document.querySelector('#confirmationUpdateProductModal .modal-body');
                modalBody.innerHTML = '<form action="database/update-product.php" method="POST" enctype="multipart/form-data" class="editProductForm">\
                                            <div class="appFormInputContainer">\
                                                <label for="product_name"><strong>Product Name</strong></label>\
                                                <input type="text" class="appFormInput" name="product_name" value="'+ productDetails.product_name + '" placeholder="Enter product name..." id="product_name">\
                                            </div>\
                                            <div class="appFormInputContainer">\
                                                <label for="description"><strong>Description</strong></label>\
                                                <textarea class="appFormInput productTextAreaInput" name="description" id="description" placeholder="Enter product description...">'+ productDetails.description +'</textarea>\
                                            </div>\
                                            <!--Image Capture-->\
                                            <div class="appFormInputContainer">\
                                                <label for="img"><strong>Product Image</strong></label><br>\
                                                <input type="file" name="img" >\
                                            </div>\
                                            <input type="hidden" name="pid" value="' + productDetails.id +'" />\
                                            <input type="submit" value="Submit" class="hidden"/>\
                                        </form>';
                // Show the modal
                var modal = new bootstrap.Modal(document.getElementById('confirmationUpdateProductModal'));
                modal.show();

                // Add event listener for the confirmation button inside the modal
                document.getElementById('confirmUpdateProduct').addEventListener('click', function () {
                    modal.hide();
                    form.submit();
                });
            }, 'json');
        };
    }

    var script = new script();
    script.initialize();
</script>

</body>
</html>
