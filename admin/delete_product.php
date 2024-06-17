<?php session_start();

    include('../server/connection.php');
?>




<?php 

if(isset($_SESSION['$admin_logged_in'])) {
    header('location: login.php');
    exit();
}

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $stmt =  $connection->prepare("DELETE FROM products WHERE Product_id=?");
    $stmt->bind_param('i',$product_id);

    if($stmt->execute()){
        header('location: products.php?deleted_successfully=Product deleted successfully');
    }else{
        header('location: products.php?deleted_failure=Product not deleted successfully');
    }
}
?>
