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
      
      <!--Home-->
      <section id="home">
        <div class="container">
            <h5>NEW ARRIVALS</h5>
            <h1><span>Best Prices</span> of This Season</h1>
            <p   id="para-id">ClothBuddies offers the best products for the most affordable prices</p>
            <button>Shop now</button>
        </div>
      </section>
           



<!-- features -->
<section id="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Our Featured </h3>
    <hr>
    <p>Here You Can Check Out Our Featured Products</p>
  </div>
  <div class="row mx-auto container-fluid">

    <?php include('server/get_product.php'); ?>

    <?php while($row= $featured_products->fetch_assoc()){ ?>
    
  
    <div class="product text-center col-lg-3 col-md-4  col-sm-12">
      <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="" class="img-fluid mb-3" style="width:200px;height:200px;">
      <div class="star">
        <i class="fas fa-star"></i>   <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name"><?php echo $row['product_name']; ?> </h5>
      <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
      <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
    </div>
  

    <?php } ?>

  
  
    
  </div>
</section>



<!-- banner -->
<section id="banner" class="my-5 py-5">
  <div class="container">
    <h4>MID SEASON'S SALES</h4>
    <h1>Autunm Collection <br>UP TO 30% OFF</h1>
    <button class="text-uppercase">Shop now</button>
  </div>
</section>

<!-- Hoodies -->
<section id="featured" class="my-5 ">
  <div class="container text-center mt-5 py-5">
    <h3>Hoodies</h3>
    <hr>
    <p>Here You Can Check Out Our Hoodies</p>
  </div>
  <div class="row mx-auto container-fluid">
  
  <?php include('server/get_hoodie.php'); ?>

    <?php while($row= $hoodie_products->fetch_assoc()){ ?>
    


    <div class="product text-center col-lg-3 col-md-4  col-sm-12">
      <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="" class="img-fluid mb-3" style="width:200px;height:200px;">
      <div class="star">
        <i class="fas fa-star"></i>   <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
      <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
      <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
    </div>
  


    <?php } ?>
  
  
    
  </div>
</section>

<!-- Shirt -->
<section id="shoes" class="my-5 ">
  <div class="container text-center mt-5 py-5">
    <h3>Shirt</h3>
    <hr>
    <p>Here You Can Check Out Our Shirt</p>
  </div>
  <div class="row mx-auto container-fluid">

  <?php include('server/get_shirt.php'); ?>

  <?php while($row= $shirt_products->fetch_assoc()){ ?>


    <div class="product text-center col-lg-3 col-md-4  col-sm-12">
      <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="" class="img-fluid mb-3" style="width:200px;height:200px;">
      <div class="star">
        <i class="fas fa-star"></i>   <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
      <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
      <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a> 
    </div>
  
  <?php } ?>


  
  
  
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