<?php
session_start();
include('connection.php');

// If user is not logged in
if (!isset($_SESSION['logged_in'])) {
    header('location: ../checkout.php?message=Please login/register to place an order');
    exit;
} else {
    if (isset($_POST['place_order'])) {
        // Get form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['total'];
        $order_status = "Not Paid";
        $user_id = $_SESSION['user_id'];
        $order_date = date('Y-m-d H:i:s');
        // Insert order into orders table
        $stmt = $connection->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
        $stmt->execute();

        // Check for errors
        if ($stmt->errno) {
            echo "Error: " . $stmt->error;
            exit;
        }

        // Get the order_id
        $order_id = $stmt->insert_id;

        // Insert order items into order_items table
        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $_SESSION['cart'][$key];
            $order_id = $product['product_id'];
            $product_name = $product['product_name'];
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];

            // Insert order item
            $stmt1 = $connection->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt1->bind_param('iissiiis', $order_id, $order_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
            $stmt1->execute();

            // Check for errors
            if ($stmt1->errno) {
                echo "Error: " . $stmt1->error;
                exit;
            }
        }

        // Set order_id in session
        $_SESSION['order_id'] = $order_id;

        // Redirect to payment page
        header('location: ../payment.php?order_status=order placed successfully');
        exit;
    } else {
        // If place_order is not set
        header('location: ../checkout.php?message=Error: Place order parameter not set');
        exit;
    }
}
