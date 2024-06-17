<?php
/*not paid
delivered
shipped

*/
include('server/connection.php');


if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){
    $order_id=$_POST['order_id'];
    $order_status=$_POST['order_status'];
    $stmt=$connection->prepare("SELECT * FROM order_items WHERE order_id=?");
    $stmt->bind_param('i',$order_id);
    $stmt->execute();
    $order_details=$stmt->get_result();
    $order_total_price=calculateTotalOrderPrice($order_details);

}else{
    header('location:account.php');
    exit;
}

function calculateTotalOrderPrice($order_details){
    $total=0;
    foreach($order_details as $row){
$product_price=$row['product_price'];
$product_quantity=$row['product_quantity'];
$total=$total+($product_price*$product_quantity);
    }
        return $total;
        // $_SESSION['total']=$total;
    }
    


?>

<?php  include('layouts/header.php'); ?> 

<!-- order details -->
    <section class="orders container my-5 py-3" id="orders">
        <div class="container mt-5">
            <h2 class="font-weight-bold text-center">Order Details</h2>
            <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5 mx-auto">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            
            <?php foreach($order_details as $row){ ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="Product Image"> 
                            <div>
                                <p class="mt-4 ml-3"><?php echo $row['product_name']; ?></p>
                            </div>
                            
                        </div> 
                    </td>
                    
                    <td>
                        <span>$<?php echo $row['product_price']; ?></span>
                    </td>
                    <td>
                        <span><?php echo $row['product_quantity']; ?></span>
                    </td>
                    
                    
                    <!-- <td>
                        <span>2024-02-01</span>
                    </td> -->
                </tr>
                
                <?php } ?>
                
            </table>
            <?php if($order_status=="Not Paid"){  ?>
                <form action="payment.php" method="POST" style="float:right;">
                <input type="hidden" name="order_id" value="<?php echo $order_id;?>" />
                
                <input type="hidden" name="order_total_price" value="<?php echo $order_total_price;?>" />
                <input type="hidden" name="order_status" value="<?php echo $order_status;    ?>">
    <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now" />
</form>
<?php   }   ?>
</section>




<?php  include('layouts/footer.php'); ?>
