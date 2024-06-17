<?php

include('server/connection.php');
if(isset($_POST['search'])){

    if(isset($_GET['page_on']) && $_GET['page_on'] != ""){
        $page_on = $_GET['page_on'];

    }else{
        $page_on = 1;
    }

    $category=$_POST['category'];
    $price=$_POST['price'];

    $stmt1 =  $connection->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=? AND product_price<=?");
    $stmt1->bind_param('si', $category, $price);
    $stmt1->execute();

    $stmt1->bind_result($total_records);

    $stmt1->store_result();

    $stmt1->fetch();

    $total_records_per_page = 8;

    $offset = ($page_on-1) * $total_records_per_page;

    $previous_page = $page_on - 1;

    $next_page = $page_on + 1;

    $adjacents = "2";

    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    $stmt2 = $connection->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset,$total_records_per_page");
    $stmt2->bind_param('si',$category,$price);
    $stmt2->execute();

    $products = $stmt2->get_result();//[]


}else{

    if(isset($_GET['page_on']) && $_GET['page_on'] != ""){
        $page_on = $_GET['page_on'];

    }else{
        $page_on = 1;
    }
    
    $stmt1 =  $connection->prepare("SELECT COUNT(*) As total_records FROM products");

    $stmt1->execute();

    $stmt1->bind_result($total_records);

    $stmt1->store_result();

    $stmt1->fetch();


    $total_records_per_page = 8;

    $offset = ($page_on-1) * $total_records_per_page;

    $previous_page = $page_on - 1;

    $next_page = $page_on + 1;

    $adjacents = "2";

    $total_no_of_pages = ceil($total_records/$total_records_per_page);



  //return all products


    $stmt2 = $connection->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");

    $stmt2->execute();

    $products = $stmt2->get_result();


}
?>










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    .product img {
        width: 100%;
        height: auto;
        box-sizing: border-box;
        object-fit: cover;
    }

    .pagination a {
        color: coral;
    }

    .pagination li:hover a {
        color: white;
        background-color: coral;
    }
    </style>
</head>

<body>
<?php include('layouts/header.php'); ?>

    <section id="shop" class="my-5 py-5">
        <div class="container mt-5 py-5">
            <div class="row">
                <!-- Side panel for categories -->
                <div class="col-lg-3 col-md-4">
                    <section id="search" class="my-5 py-5">
                        <div class="container mt-5 py-5">
                            <p>Search Products</p>
                            <hr>
                        </div>
                        <form action="shop.php" method="POST">
                            <div class="row mx-auto container">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p>Category</p>
                                    <div class="form-check">
                                        <input class="form-check-input" value="Jacket" type="radio" name="category"
                                            id="category_one" <?php if(isset($category) && $category=='Jacket') {echo 'checked';} ?>>
                                        <label class="form-check-label" for="category_one">
                                            Jacket
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Hoodies" name="category"
                                            id="category_two" <?php if(isset($category) && $category=='Hoodies') {echo 'checked';} ?>>
                                        <label class="form-check-label" for="category_two">
                                            Hoodies
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="T-shirt" name="category"
                                            id="category_three" <?php if(isset($category) && $category=='T-shirt') {echo 'checked';} ?>>
                                        <label class="form-check-label" for="category_three">
                                            T-shirt
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Shirts" name="category"
                                            id="category_four" <?php if(isset($category) && $category=='Shirt') {echo 'checked';} ?>>
                                        <label class="form-check-label" for="category_four">
                                            Shirt
                                        </label>
                                    </div>
                                </div>
                                <div class="row mx-auto container mt-5">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <p>Prices</p>
                                        <input type="range" name="price" value="<?php if(isset($price)) {echo $price;} else {echo "100";}  ?>" class="form-range w-50" min="1"
                                            max="1000" id="customRange2">
                                        <div class="w-50">
                                            <span style="float: left;">1</span>
                                            <span style="float: right;">1000</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-3 mx-3">
                                    <input type="submit" name="search" value="Search" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <!-- Products display -->
                <div class="col-lg-9 col-md-8">
                    <div class="container">
                        <h3>Our Products</h3>
                        <hr>
                        <p>Here You Can Check Out Our Featured Products</p>
                        <div class="row">
                            <?php while($row = $products->fetch_assoc()) { ?>
                            <div onclick="window.location.href='single_product.html';"
                                class="product text-center col-lg-3 col-md-4 col-sm-6">
                                <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt=""
                                    class="img-fluid mb-3" style="width:200px;height:200px;">
                                <div class="star">
                                    <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                </div>
                                <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                                <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
                                <a class="btn shop-buy-btn"
                                    href="single_product.php?product_id=<?php echo $row['product_id'];?>">Buy Now</a>
                            </div>
                            <?php } ?>
                        </div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination mt-5">

                                <li class="page-item <?php if($page_on<=1){echo 'disabled';}?>">
                                    <a href="<?php if($page_on<=1){echo '#';} else { echo "?page_on=".($page_on-1);}?>" class="page-link">Previous</a>
                                </li>
                                <li class="page-item"><a href="?page_on=1" class="page-link">1</a></li>
                                <li class="page-item"><a href="?page_on=2" class="page-link">2</a></li>

                                <?php if($page_on >=3) {?>
                                <li class="page-item"><a href="" class="page-link">...</a></li>
                                <li class="page-item"><a href="<?php echo "?page_on=".$page_on; ?>" class="page-link"><?php echo $page_on;?></a></li>
                                <?php } ?>

                                <li class="page-item <?php if($page_on>= $total_no_of_pages){echo 'disabled';}?>" >
                                    <a href="<?php if($page_on>= $total_no_of_pages){echo '#';} else { echo "?page_on=".($page_on+1);}?>" class="page-link">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include('layouts/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>