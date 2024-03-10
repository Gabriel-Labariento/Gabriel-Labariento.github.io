<?php
    // Start the session
    session_start();
    if (!isset($_SESSION['user'])) header('location: ../login.php');
    $_SESSION['table'] = 'users';
    $user = $_SESSION['user'];

    $_SESSION['table'] = 'users';
    $users = include('database/show.php');

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
    <title>View Users | Inventory Management</title>
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
              <h1 class="sectionHeader">List of Users</h1>
              <div class="sectionContent">
                <div class="users">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>   
                            <tbody>
                                <?php foreach($users as $index => $user){ ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td class="firstName"><?= $user['first_name'] ?></td>
                                        <td class="lastName"><?= $user['last_name'] ?></td>
                                        <td class="email"><?= $user['email'] ?></td>
                                        <td><?= date('M d, Y @ h:i:s A', strtotime($user['updated_at'])) ?></td>
                                        <td><?= date('M d, Y @ h:i:s A', strtotime($user['created_at'])) ?></td>
                                        <td>
                                            <a href="" class="updateUser" data-userid="<?= $user['id'] ?>"><i class="fa fa-pencil"></i> Edit<br></a>                                                
                                            <a href="" class="deleteUser" data-userid="<?= $user['id'] ?>" data-fname="<?= $user['first_name'] ?>" data-lname="<?= $user['last_name'] ?>"> <i class="fa fa-trash"></i> Delete</a>                                    
                                        </td>
                                    </tr>
                                <?php } ?>
                            </body>
                        </tr>
                        </thead>
                    </table>
                </div>
                <p class="userCount"><?= count($users) ?> Users</p>
              </div>
            </div>
                </div>
            </div>
            
        </div>
    </div>
   </div>
   
   <div class="modal fade" id="confirmationDeleteUserModal" tabindex="-1" aria-labelledby="confirmationDeleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationDeleteUserModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteUser">Delete</button>
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

                if (classList.contains('deleteUser')) {
                    e.preventDefault();
                    userId = targetElement.dataset.userid;
                    fname = targetElement.dataset.fname;
                    lname = targetElement.dataset.lname;
                    fullName = fname + ' ' + lname;

                    if (window.confirm('Are you sure to delete ' + fullName + '?')) {
                        $.ajax({
                            method: 'POST',
                            data: {
                                user_id: userId,
                                f_name: fname,
                                l_name: lname
                            },
                            url: 'database/delete-user.php',
                            dataType: 'json',
                            success: function (data) {
                                if (data.success) {
                                    if (window.alert(data.message)) {
                                        location.reload();
                                    } else window.alert(data.message);
                                }
                            }
                        })
                    } else {
                        console.log('will not delete.');
                    }
                }

                if (classList.contains('updateUser')) {
                    e.preventDefault();

                    firstName = targetElement.closest('tr').querySelector('td.firstName').innerHTML;
                    lastName = targetElement.closest('tr').querySelector('td.lastName').innerHTML;
                    email = targetElement.closest('tr').querySelector('td.email').innerHTML;
                    userId = targetElement.dataset.userid;

                    var modalBody = document.querySelector('#confirmationModal .modal-body');
                        modalBody.innerHTML = '<form>\
                            <div class="form-group">\
                                <label for="firstName">First Name:</label>\
                                <input type="text" class="form-control" id="firstName" placeholder="Enter first name" value="'+ firstName + '">\
                            </div>\
                            <div class="form-group">\
                                <label for="lastName">Last Name:</label>\
                                <input type="text" class="form-control" id="lastName" placeholder="Enter last name" value="'+ lastName + '">\
                            </div>\
                            <div class="form-group">\
                                <label for="email">Email:</label>\
                                <input type="email" class="form-control" id="emailUpdate" placeholder="Enter new email" value="'+ email + '">\
                            </div>\
                        </form>';

                        // Show the modal
                        var modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                        modal.show();

                    // Add event listener for the confirmation button inside the modal
                    document.getElementById('confirmAction').addEventListener('click', function () {
                        modal.hide();
                   // Perform AJAX request
                            $.ajax({
                                method: 'POST',
                                data: {
                                    user_id: userId,
                                    f_name: document.getElementById('firstName').value,
                                    l_name: document.getElementById('lastName').value,
                                    email: document.getElementById('emailUpdate').value
                                },
                                url: 'database/update-user.php', // Adjust URL as needed
                                dataType: 'json',
                                success: function (data) {
                                    if (data.success) {
                                        // Success message
                                        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                                        successModal.show();
                                        successModal.addEventListener('hidden.bs.modal', function () {
                                        location.reload();
                                        });
                                        
                                    } else {
                                        // Error message
                                        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                                        errorModal.show();  
                                    }
                                },
                                error: function (xhr, status, error) {
                                    // Handle error if AJAX request fails
                                    console.error(xhr.responseText);
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

