<?php
session_start();
if(isset($_POST['order_pay_btn'])){
  $order_status = $_POST['order_status'];
  $order_total_price = $_POST['order_total_price'];
}

include('layouts/header.php');
?>

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="font-weight-bold">Checkout</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center">
        <?php if(isset($_SESSION['total']) && $_SESSION['total'] != 0): ?>
            <?php $amount = strval($_SESSION['total']); ?>
            <?php $order_id = $_POST['order_id']; ?>

            <p>Total amount: $ <?php echo $_SESSION['total']; ?></p>
        <?php elseif(isset($_POST['order_status']) && $_POST['order_status'] == "Not Paid"): ?>
            <?php $amount = strval($_POST['order_total_price']); ?>
            <?php $order_id = $_SESSION['order_id']; ?>
            <p>Total Payment: $ <?php echo $_POST['order_total_price']; ?></p>
        <?php else: ?>
            <p>You don't have any order</p>
        <?php endif; ?>
        <div id="paypal-button-container" class="mx-auto container text-center"></div>
    </div>
</section>

<?php include('layouts/footer.php'); ?>

<script src="https://www.paypal.com/sdk/js?client-id=AULKtEcCRdbZOYT_6IbW1IzfNEO8SfpFhCXEA1KPwbj8S0Ff_tFjjOAr-kCxq31Q9V3-afzkWHwu2N4w&currency=USD"></script>
<script>
    var amount = <?php echo json_encode($amount); ?>;
    
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: amount
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                console.log('Transaction completed by ' + details.payer.name.given_name);
                window. location.href = "server/complete_payment. php?+transactionId=" + data.orderID;
                // Call your server to save the transaction
                return fetch('/paypal-transaction-complete', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
                });
            });
        }
    }).render('#paypal-button-container');
</script>
