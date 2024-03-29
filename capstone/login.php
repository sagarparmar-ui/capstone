<?php

session_start();

include('server/connection.php');

// if(isset($_SESSION['logged_in'])){
//   header('location: account.php');
//   exit;
// }

if(isset($_POST['login_btn'])){

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $connection->prepare("SELECT user_id,user_name, user_email, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);
  

  if($stmt->execute()){
    $stmt->bind_result($user_id,$user_name,$user_email,$user_password);
    $stmt->store_result();

    if($stmt->num_rows() == 1){
      $stmt->fetch();

      $_SESSION['user_id'] = $user_id;
      $_SESSION['user_name'] = $user_name;
      $_SESSION['user_email'] = $user_email;
      $_SESSION['logged_in'] = true;


      header('location: account.php?message=logged in successfully');
    }
    else{
      header('location: login.php?error=could not verify account');
    }
  
  }else{

    header('location: login.php?error=something went wrong');
  }
}









?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>


   <!--Navbar-->
   <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light bg-white py-3 fixed-top">
    <div class="container">
      <img class="logo" src="assets/imgs/ovo_logo_PNG1.png">
      <a class="navbar-brand" href="#">CBuddy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Signup</a>
            </li>
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
              <a class="nav-link" href="contact.html">Contact Us</a>
            </li>
            <li class="nav-item">
              <a href="cart.html"><i class="fa-solid fa-cart-shopping"></i></a>
              <a href="account.php"><i class="fa-solid fa-user"></i></a>
            </li>

              
          </div>
    </div>
  </nav>
  

    <!--Login-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Login</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST" action="login.php">
              <p style="color: red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="password" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
                </div>
                <div class="form-group">
                    <a id="register-url" href="register.php" class="btn">Don't have an account? Register here.</a>
                </div>
            </form>
        </div>

    </section>


    <!-- footer -->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <img clas="logo" src="assets/imgs/ovo_logo_PNG1.png" alt="">
            <h2 class="brand">Orange</h2>
            <p class="pt-3">We provide the best products at affordable rate</p>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Featured</h5>
        <ul class="text-uppercase">
            <li><a href="#">men</a></li>
            <li><a href="#">women</a></li>
            <li><a href="#">boys</a></li>
            <li><a href="#">girls</a></li>
            <li><a href="#">new arrivals</a></li>
            <li><a href="#">Clothes</a></li>
        </ul>
        
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Contact Us</h5>
            <div>
            <h6 class="text-uppercase">Address</h6>
            <p>1234 Street name,City</p>
            </div>

            <div>
            <h6 class="text-uppercase">Phone</h6>
            <p>1234567890</p>
            </div>
            <div>
            <h6 class="text-uppercase">email</h6>
            <p>info@email.com</p>
            </div>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Instagram</h5>
            <div class="row">
            <img src="assets/imgs/men1.jpeg" class="img-fluid w-25 h-100 m-2" alt="">
            <img src="assets/imgs/men2.jpeg" class="img-fluid w-25 h-100 m-2" alt="">
            <img src="assets/imgs/men3.jpeg" class="img-fluid w-25 h-100 m-2" alt="">
            <img src="assets/imgs/men4.jpeg" class="img-fluid w-25 h-100 m-2" alt="">
            <img src="assets/imgs/men1.jpeg" class="img-fluid w-25 h-100 m-2" alt="">
            </div>
        </div>
        
        <div class="copyright mt-5">
        <div class="row container mx-auto">
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
            <img src="assets/imgs/visa.png" alt="">
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
            <p>eCommerce @ 2024 All rights reserved</p>
            
        </div>
        <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>