<?php 
    session_start();
    include('connection.php');

   if(isset ($_GET [' transaction_id']) && isset($_GET ['order_id'] )) {

        $order_id = $_GET['$order_id'];
        $order_status = "paid";
        $transaction_id = $_GET['transaction_id'];
        $user_id = $_SESSION['$user_id'];
        $payment_date=date('Y-m-d h:i: A');


        //change order_status to paid
        $stmt = $conn->prepare ("UPDATE orders SET order_status=? WHERE order_id=?");
        $stmt->bind_param('sis ' ,$order_status, $order_id, $payment_date);
        $stmt->execute();

        //store payment info
        $stmt1 = $conn->prepare("INSERT INTO payments (order_id,user_id,transaction_id,payment_date)
            VALUES (?,?,?,?); ");
        $stmt->bind_param('iiss', $order_id, $user_id, $transaction_id, $payment_date);
        $stmt1->execute();

        header( "Location: ../account.php?payment_message=paid successfully, thanks for your shopping with us." );
        //go to user account
    }
    else {
        header("Location: index.php");
        exit;
    }
?>