<?php

session_start();
if(isset($_POST['add_to_cart'])){
    if(isset($_SESSION['cart'])){

        $products_array_ids=array_column($_SESSION['cart'],"product_id");

        if(!in_array($_POST['product_id'],$products_array_ids)){
        $order_id=$_POST['product_id'];
        $product_array=array(
                    'product_id'=>$_POST['product_id'],
                    'product_name'=>$_POST['product_name'],
                    'product_price'=>$_POST['product_price'],
                    'product_image'=>$_POST['product_image'],
                    'product_quantity'=>$_POST['product_quantity']
        );
        $_SESSION['cart'][$order_id]=$product_array;

        echo "The product price is: " . $product_array['product_price'];



}else{

  echo '<script>alert("Product already added");</script>';

// echo 'script>window.location="index.php";</script>';

  //if this is the first product
}

}


else{


$order_id=$_POST['product_id'];
// echo $product_id;
$product_name=$_POST['product_name'];
$product_price=$_POST['product_price'];
$product_image=$_POST['product_image'];
$product_quantity=$_POST['product_quantity'];
  $product_array=array(
    'product_id'=>$_POST['product_id'],
    'product_name'=>$_POST['product_name'],
    'product_price'=>$_POST['product_price'],
    'product_image'=>$_POST['product_image'],
    'product_quantity'=>$_POST['product_quantity']
  );
  $_SESSION['cart'][$order_id]=$product_array;
  
 //remove product from cart
}


//update or calculate total
calculateTotalCart();


}
elseif(isset($_POST['remove_product'])){
  $order_id=$_POST['product_id'];
unset($_SESSION['cart'][$order_id]);
//calculate total
calculateTotalCart();



}
elseif(isset($_POST['edit_quantity'])){
  
  // var_dump($_SESSION['cart']);
  //we get id and quantity
  $order_id=$_POST['product_id'];
$product_quantity=$_POST['product_quantity'];

//get the product array from the session
$product_array=$_SESSION['cart'][$order_id];
//update the product quantity
$product_array['product_quantity']=$product_quantity;
//send it to the session
$_SESSION['cart'][$order_id]=$product_array;
//clculate total
calculateTotalCart();
// var_dump($_SESSION['cart']);
}
else{
//  header('location:index.php');
}
function calculateTotalCart(){
$total_price=0;
$total_quantity=0;

    foreach($_SESSION['cart'] as $key => $value){
       $product= $_SESSION['cart'][$key];
     $price=  $product['product_price'];
     $quantity=$product['product_quantity'];
     $total_price=$total+($price * $quantity);
     $total_quantity=$total_quantity+$quantity;
    }
    $_SESSION['total']=$total_price;
    $_SESSION['quantity']=$total_quantity;
}


?>

<?php  include('layouts/header.php'); ?> 


<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bolder">Your Cart</h2>
        <hr>
    </div>
    
    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        
        <?php foreach($_SESSION['cart'] as $key =>$value){
            // var_dump($value['product_price']);
            // echo var_dump($value);
            echo $key." has the value". $value['product_price'];
            ?>


<tr>
    <td>
        <div class="product-info">
            <img src="assets/imgs/<?php echo $value["product_image"]; ?>" alt="">
        </div>
        <p><?php echo $value["product_name"]; ?></p>
        <?php if (isset($value["product_price"])) { ?>
            <small><span>$</span><?php echo $value["product_price"]; ?></small>
            <?php } else { ?>
                <small>Price not available</small>
                <?php } ?>
                <br>
                <form action="cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $value["product_id"];    ?>">
                    <input type="submit" name="remove_product" class="remove-btn" value="remove"/>
                </form>
            </div>
        </div>
    </td>
    <td>
        
        <form action="cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>" />
            <input type="submit" value="Edit" class="edit-btn" name="edit_quantity">
        </form>
        <!-- <a href="#" class="edit-btn">Edit</a> -->
    </td>
    <td>
        <span>$</span>
        <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
    </td>
    
</tr>
<?php   }  ?>
</table>
<div class="cart-total">
    <table>
        <tr>
            <td>
                total
            </td>
            <td>$ <?php echo $_SESSION['total']; ?></td>
        </tr>
    </table>
</div>
<div class="checkout-container">
    <form action="checkout.php" method="POST">
        <input type="submit" value="checkout" class="btn checkout-btn" name="checkout">
    </form>
</div>
</section>
<?php  include('layouts/footer.php'); ?>
