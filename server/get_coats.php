<?php

include('connection.php');


$stmt=$connection->prepare("SELECT * FROM products WHERE product_category='coats' LIMIT 4");
$stmt->execute();
$coats_products=$stmt->get_result();



?>