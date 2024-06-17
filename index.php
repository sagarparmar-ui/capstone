
    <?php  include('layouts/header.php'); ?>
    

    <!--Home-->
      <section id="home">
        <div class="container">
            <h5>NEW ARRIVALS</h5>
            <h1><span>Best Prices</span> of This Season</h1>
            <p   id="para-id">ClothBuddies offers the best products for the most affordable prices</p>
            <button>Shop now</button>
        </div>
      </section>
           

<!-- 

      <section id="banner" style="background: #F9F3EC;">
    <div class="container">
      <div class="swiper main-swiper">
        <div class="swiper-wrapper">

          <div class="swiper-slide py-5">
            <div class="row banner-content align-items-center">
              <div class="img-wrapper col-md-5">
                <img src="assets/imgs/banner.jpeg" class="img-fluid">
              </div>
              <div class="content-wrapper col-md-7 p-5 mb-5">
                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                <h2 class="banner-title display-1 fw-normal">Best destination for <span class="text-primary">your
                    pets</span>
                </h2>
                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                  shop now
                  <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                    <use xlink:href="#arrow-right"></use>
                  </svg></a>
              </div>

            </div>
          </div>
          <div class="swiper-slide py-5">
            <div class="row banner-content align-items-center">
              <div class="img-wrapper col-md-5">
                <img src="images//banner-img3.png" class="img-fluid">
              </div>
              <div class="content-wrapper col-md-7 p-5 mb-5">
                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                <h2 class="banner-title display-1 fw-normal">Best destination for <span class="text-primary">your
                    pets</span>
                </h2>
                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                  shop now
                  <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                    <use xlink:href="#arrow-right"></use>
                  </svg></a>
              </div>

            </div>
          </div>
          <div class="swiper-slide py-5">
            <div class="row banner-content align-items-center">
              <div class="img-wrapper col-md-5">
                <img src="images/banner-img4.png" class="img-fluid">
              </div>
              <div class="content-wrapper col-md-7 p-5 mb-5">
                <div class="secondary-font text-primary text-uppercase mb-4">Save 10 - 20 % off</div>
                <h2 class="banner-title display-1 fw-normal">Best destination for <span class="text-primary">your
                    pets</span>
                </h2>
                <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                  shop now
                  <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                    <use xlink:href="#arrow-right"></use>
                  </svg></a>
              </div>

            </div>
          </div>
        </div>

        <div class="swiper-pagination mb-5"></div>

      </div>
    </div>
  </section> -->

  <section id="categories">
    <div class="container my-3 py-5">
      <div class="row my-5">
        <div class="col text-center">
          <a href="#" class="categories-item">
          <img class="mt-4" src="assets/imgs/Hugo_Boss_logo_PNG5.png" style="width:300px;height:150px;">
          </a>
        </div>
        <div class="col text-center">
          <a href="#" class="categories-item">
          <img src="assets/imgs/North_face_logo_PNG3.png" style="width:250px;height:200px;">
          </a>
        </div>
        <div class="col text-center">
          <a href="#" class="categories-item">
          <img src="assets/imgs/Ralph_lauren_logo_PNG15.png" style="width:250px;height:200px;">
          </a>
        </div>
        <div class="col text-center">
          <a href="#" class="categories-item">
          <img class="mt-2" src="assets/imgs/Tom_Ford_logo_PNG1.png" style="width:300px;height:180px;">
          </a>
        </div>
      </div>
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
<div class="container text-dark">
    <h4 class="dark">MID SEASON'S SALES</h4>
    <h1 class=" text-dark">Autumn Collection <br>UP TO 30% OFF</h1>
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
<?php  include('layouts/footer.php'); ?>


<script src="js/jquery-1.11.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="js/plugins.js"></script>
  <script src="js/script.js"></script>
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
 
