<?php
    // Start the session
    session_start();
    if (!isset($_SESSION['user'])) header('location: ../login.php');
    $_SESSION['table'] = 'users';
    $user = $_SESSION['user'];
    $users = include('database/show-users.php');

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
    <title>Dashboard | Inventory Management</title>
    <link rel="stylesheet" href="login.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                <div class="column column-5">
                    <h1 class="sectionHeader">Insert User</h1>
                    <div class="" id="userAddFormContainer">
                        <form action="database/add.php" method="POST" id="appForm">
                            <div class="appFormInputContainer">
                                <label for="first_name">First Name</label>
                                <input type="text" class="appFormInput" name="first_name" id="first_name">
                            </div>
                            <div class="appFormInputContainer">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="appFormInput" name="last_name" id="last_name">
                            </div>
                            <div class="appFormInputContainer">
                                <label for="email">Email</label>
                                <input type="text" class="appFormInput" name="email" id="email">
                            </div>
                            <div class="appFormInputContainer">
                                <label for="password">Password</label>
                                <input type="password" class="appFormInput" name="password" id="password">
                            </div>

                            <button id="registerBtn"     type="submit"><i class="fa fa-plus"></i>Add User</button>
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
            <div class="column column-7">
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
                                            <a href="" class="updateUser"><i class="fa fa-pencil"></i> Edit<br></a>                                                
                                            <a href="" class="deleteUser" data-userid="<?= $user['id'] ?>" data-fname="<?= $user['first_name'] ?>" data-lname="<?= $user['last_name'] ?>"> <i class="fa fa-trash"></i> Delete</a>                                    
                                        </td>
                                    </tr>
                                <?php } ?>
                            </body>
                        </tr>
                        </thead>
                    </table>
                    <p class="userCount"><?= count($users) ?> Users</p>
                </div>
              </div>
            </div>
                </div>
            </div>
            
        </div>
    </div>
   </div>

   <script src="js/script.js"></script>
   <script src="js/jquery/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/css/bootstrap-dialog.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.min.js"></script>

   <script>
        function script(){

            this.initialize = function(){
                this.registerEvents();
            },

            this.registerEvents = function(){
                document.addEventListener('click', function(e){
                    targetElement = e.target;
                    classList = targetElement.classList;

                    if(classList.contains('deleteUser')){
                        e.preventDefault();
                        userId = targetElement.dataset.userid;
                        fname = targetElement.dataset.fname;
                        lname = targetElement.dataset.lname;
                        fullName = fname + ' ' + lname;

                        if (window.confirm('Are you sure to delete '+ fullName + '?')){
                            $.ajax({
                                method: 'POST',
                                data:  {
                                    user_id: userId,
                                    f_name: fname,
                                    l_name: lname
                                },
                                url: 'database/delete-user.php',
                                dataType:'json',
                                success: function(data){
                                    if(data.success){
                                        if(window.alert(data.message)){
                                            location.reload();
                                        }
                                        else window.alert(data.message);
                                    }
                                }
                            })
                        } else{
                            console.log('will not delete.');
                        } 
                    }

                    if(classList.contains('updateUser')){
                        e.preventDefault();

                        firstName = targetElement.closest('tr').querySelector('td.firstName').innerHTML;
                        lastName = targetElement.closest('tr').querySelector('td.lastName').innerHTML;
                        email  = targetElement.closest('tr').querySelector('td.email').innerHTML;

                        BootstrapDialog.confirm({
                            title: 'Update' + firstName + ' ' + lastName,
                            message: '<form>\
                            <div class="form-group">\
                                <label for="firstName">First Name:</label>\
                                <input type="text" class="form-control" id="firstName" placeholder="Enter first name" value="'+ firstName + '">\
                            </div>\
                            <div class="form-group">\
                                <label for="lastName">Last Name:</label>\
                                <input type="text" class="form-control" id="lastName" placeholder="Enter last name" value="'+ lastName + '">\
                            </div>\
                            <div class="form-group">\
                                <label for="firstName">First Name:</label>\
                                <input type="email" class="form-control" id="email" placeholder="Enter new email" value="'+ email + '">\
                            </div>\
                            </form>'
                        });
                    }
                })

            }
        }

        var script = new script;
        script.initialize();
   </script>
</body>
</html>