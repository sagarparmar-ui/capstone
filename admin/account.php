
<?php
session_start();
include('../server/connection.php');

    if(isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit;
    }
// Check if the logout parameter is set
if(isset($_GET['logout'])){
    // If logged in, unset session variables and redirect to login page
    if(isset($_SESSION['admin_logged_in'])){
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_id']);
        unset( $_SESSION["admin_name"]);
        unset($_SESSION['admin_email']);
        header('location: login.php');
        exit;
    }
}
?>
<?php include('header.php'); ?>



    <div class="container-fluid">
        <div class="row" style="min-height: 1000px">
        
        <?php include( 'sidemenu.php'); ?>
    
        <main class="col-md-9 ms-sm-auto col-1g-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Admin Account</h1>
                <div class="btn-toolbar mb-2 mb-md—0">
                    <div class="btn-group me-2">


                    </div>
                </div>
            </div>
            <div class="container">
                <p>Id: 1<?php echo $_SESSION['admin_id']; ?></p>
                <p>Name: admin<?php echo $_SESSION['admin_Name']; ?></p>
                <p>Email: admin@email.com<?php echo $_SESSION['admin_Email']; ?></p>
            </div>
        </main>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-b3thh6lTUhR/Ax5aWE95E72YnPJ2CKd6tvD2e7n6m/HMqBZKtO7GAYnXm5U+frnn" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-Btt5IPVqmzj3OvWgtD/7JASZbVQaDAfVbKzSbkAl6ap9R8/OnwB1XjBz6jqgMIa0" crossorigin="anonymous"></script>
