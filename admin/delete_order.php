<?php session_start();

    include('../server/connection.php');
?>




<?php 

if(isset($_SESSION['$admin_logged_in'])) {
    header('location: login.php');
    exit();
}

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $stmt =  $connection->prepare("DELETE FROM orders WHERE order_id=?");
    $stmt->bind_param('i',$order_id);

    if($stmt->execute()){
        header('location: index.php?deleted_successfully=Product deleted successfully');
    }else{
        header('location: index.php?deleted_failure=Product not deleted successfully');
    }
}
?>
