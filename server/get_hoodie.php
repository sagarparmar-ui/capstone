<?php


include('connection.php');

$stmt = $connection->prepare("SELECT * FROM products WHERE product_category='Hoodies' LIMIT 4");

$stmt->execute();

$hoodie_products = $stmt->get_result();




