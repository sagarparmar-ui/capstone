<?php

session_start();

include('server/connection.php');


// if(isset($_SESSION['logged_in'])){
//   header('location: account.php');
//   exit;
// }



if(isset($_POST['register'])){

  $name= $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  if($password !== $confirmPassword){
    header('location: register.php?error=passwords dont match');
  }

  else if(strlen($password) < 6){
    header('location: register.php?error=password must be at least 6 character');
  }

  else{
      $stmt1 = $connection->prepare("SELECT count(*) FROM users where user_email=?");
      $stmt1->bind_param('s',$email);
      $stmt1->execute();
      $stmt1->bind_result($num_rows);
      $stmt1->store_result(); 
      $stmt1->fetch();


      if($num_rows != 0){
        header('location: register.php?error=user with this email already exists');
      }
      
      else{

          $stmt = $connection->prepare("INSERT INTO users (user_name,user_email,user_password) 
                          VALUES(?,?,?)");



          $stmt->bind_param('sss',$name,$email,md5($password));

          if($stmt->execute()){
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $name;
            $_SESSION['logged_in'] = true;
            header('location: account.php?register= you registered successfully');
          }else{

              header('location: register.php?error= could not create an account at the moment');

          }
      }
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
      




    
    
    
    
    
      <!--Register-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Register</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST" action="register.php">
              <p style="color: red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></P>
                <div class="form-group">
                    <label>name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="password" required/>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="confirmPassword" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Register"/>
                </div>
                <div class="form-group">
                    <a id="login-url" class="btn">Do you have  an account? Login here.</a>
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