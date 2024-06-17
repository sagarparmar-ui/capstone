<?php

include('connection.php');

$stmt = $connection->prepare("SELECT * FROM products WHERE product_category='Shirts' LIMIT 4");

$stmt->execute();

$shirt_products = $stmt->get_result();




?>