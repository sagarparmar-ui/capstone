<!-- header.php -->
<?php
session_start();

// Check if the user is logged in
$logged_in = isset($_SESSION['user_id']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Home</title>
        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chilanka&family=Montserrat:wght@300;400;500&display=swap"
    rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light bg-white py-2 fixed-top">
        <div class="container">
            
        <a class="navbar-brand" href="#">CBuddy</a>
            <img class="logo" src="assets/imgs/ovo_logo_PNG1.png" >
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    

                <?php if ($logged_in): ?>
                        <!-- Display Account and Cart links if logged in -->
                        <li class="nav-item">
                            <a class="nav-link" href="account.php"><i class="fas fa-user"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">
                                <i class="fas fa-shopping-bag">
                                    <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) {?>
                                        <span class="cart-quantity"> <?php echo $_SESSION['quantity'];  ?> </span>
                                    <?php } ?>
                                </i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <!-- Display Login and Sign Up links if not logged in -->
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Sign Up</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($logged_in): ?>
                        <!-- Display Cart link if logged in -->
                        
                    <?php endif; ?>

                <?php
                
                    // // Check if user is logged in
                    // if(isset($_SESSION['user_id'])) {
                    //     // If logged in, show user profile and logout option
                    //     echo '<li class="nav-item"><a class="nav-link" href="account.php"><i class="fas fa-user"></i></a></a></li>';
                    //     echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
                    // } else {
                    //     // If not logged in, show login and sign-up option
                    //     echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
                    //     echo '<li class="nav-item"><a class="nav-link" href="signup.php">Sign Up</a></li>';
                    // }
                    // ?>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                     /Applications/XAMPP/xamppfiles/htdocs/newcpastone/newcpastone/index.php
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Signup</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    
            </div>
        </div>
    </nav>
      