<?php

include('server/connection.php');

if(isset($_GET['product_id'])){

  $order_id = $_GET['product_id'];

  $stmt = $connection->prepare("SELECT * FROM products WHERE product_id = ?");
  $stmt->bind_param("i",$order_id);

  $stmt->execute();
  
  $products = $stmt->get_result();

}else{

  header('location: index.php');
}






?>








<?php  include('layouts/header.php'); ?> 

<!-- single_product -->
<section class="container single-product my-5 pt-5">
  <div class="row mt-5">
    
    <?php while($row = $products->fetch_assoc()){ ?>

      <div class="col-lg-5 col-md-6 col-sm-12">
        <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid w-100 pb-1" id="mainImg" alt="">
        <div class="small-img-group">
          <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row['product_image']; ?>"  class="small-img" alt=""/>
          </div>
          <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row['product_image2']; ?>"  class="small-img" alt=""/>
          </div>
          <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row['product_image3']; ?>"  class="small-img" alt=""/>
          </div>
          <div class="small-img-col">
            <img src="assets/imgs/<?php echo $row['product_image4']; ?>"  class="small-img" alt=""/>
          </div>
        </div>
      
        
      </div>
      <div class="col-lg-6 col-md-12 col-12">
        <h6>Men/Shoes</h6>
        <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
        <h2><?php echo $row['product_price']; ?></h2>
        <form action="cart.php" method="POST">
          <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
          <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>" />
          <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
          <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />
          
          <input type="number" name="product_quantity" value="1" />
          <button class="buy-btn" type="submit" name="add_to_cart">Add to Cart</button>
        </form>
        <h4 class="mt-5 mb-5">Product Details</h4>
        <span><?php echo $row['product_description']; ?></span>
      </div>
      
      <?php } ?>    
      
    </div>
  </section>
  
  
  <?php include 'reviews.php';   ?>
  <!-- Related products -->
  <section id="related-products" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Related products</h3>
      <hr>
      
    </div>
    <div class="row mx-auto container-fluid">
      <div class="product text-center col-lg-3 col-md-4  col-sm-12">
        <img src="assets/imgs/sportshoes1.jpeg" alt="" class="img-fluid mb-3" style="width:200px;height:200px;">
        <div class="star">
          <i class="fas fa-star"></i>   <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Sports Shoes</h5>
        <h4 class="p-price">129.90</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
      
      
      
    
      
      
      <div class="product text-center col-lg-3 col-md-4  col-sm-12">
        <img src="assets/imgs/phone.jpeg" alt="" class="img-fluid mb-3" style="width:200px;height:200px;">
        <div class="star">
          <i class="fas fa-star"></i>   <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Phone</h5>
        <h4 class="p-price">399.90</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
      
      
      
      
      
      
      <div class="product text-center col-lg-3 col-md-4  col-sm-12">
        <img src="assets/imgs/watch.jpeg" alt="" class="img-fluid mb-3" style="width:200px;height:200px;">
        <div class="star">
          <i class="fas fa-star"></i>   <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Watch</h5>
        <h4 class="p-price">169.90</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
      
      
      
      
      
      
      <div class="product text-center col-lg-3 col-md-4  col-sm-12">
        <img src="assets/imgs/bag.jpeg" alt="" class="img-fluid mb-3" style="width:200px;height:200px;">
        <div class="star">
          <i class="fas fa-star"></i>   <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>  <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">Bag</h5>
        <h4 class="p-price">499.90</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
    </div>
  </section>
  <?php  include('layouts/footer.php'); ?>
  <script>
      var mainImg=document.getElementById("mainImg");
     var smallImg= document.getElementsByClassName("small-img");
  
  
     for(let i=0;i<4;i++){
      smallImg[i].onclick=function(){
      mainImg.src=smallImg[i].src;
     }
     }
     
    
  </script>
</body>
</html>