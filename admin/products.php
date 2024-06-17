

<?php include('header.php');?>

<?php 

if(isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}

?>

<?php

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


$total_records_per_page = 5;

$offset = ($page_on-1) * $total_records_per_page;

$previous_page = $page_on - 1;

$next_page = $page_on + 1;

$adjacents = "2";

$total_no_of_pages = ceil($total_records/$total_records_per_page);



//return all products


$stmt2 = $connection->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");

$stmt2->execute();

$products = $stmt2->get_result();




?>





    <div class="container-fluid">
        <div class="row" style="min-height: 1000px">
        
        <?php include( 'sidemenu.php'); ?>
    
        <main class="col-md-9 ms-sm-auto col-1g-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <div class="btn-toolbar mb-2 mb-md—0">
                    <div class="btn-group me-2">
                        <div class="container mt-5 py-5">
                            <div class="row">
                            <h2>Products</h2>
                                <?php if(isset($_GET['product_created'])){?>
                                    <p class="text-center" style="color: green;"><?php echo $_GET['product_created'];?></p>
                                <?php } ?>

                                <?php if(isset($_GET['product_failed'])){?>
                                    <p class="text-center" style="color: red;"><?php echo $_GET['product_failed'];?></p>
                                <?php } ?>
                                
                                <?php if(isset($_GET['edit_success_message'])){?>
                                    <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message'];?></p>
                                <?php } ?>

                                <?php if(isset($_GET['edit_failure_message'])){?>
                                    <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message'];?></p>
                                <?php } ?>
                                
                                <?php if(isset($_GET['deleted_successfully'])){?>
                                    <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully'];?></p>
                                <?php } ?>

                                <?php if(isset($_GET['deleted_failure'])){?>
                                    <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure'];?></p>
                                <?php } ?>

                                <?php if(isset($_GET['images_updated'])){?>
                                    <p class="text-center" style="color: green;"><?php echo $_GET['images_updated'];?></p>
                                <?php } ?>

                                <?php if(isset($_GET['images_failed'])){?>
                                    <p class="text-center" style="color: red;"><?php echo $_GET['images_failed'];?></p>
                                <?php } ?>


                                <div class="table-responsive">
                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Product Id</th>
                                                <th scope="col">Product Image</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Product Price</th>
                                                <th scope="col">Product Offer</th>
                                                <th scope="col">Product Category</th>
                                                <th scope="col">Product Color</th>
                                                <th scope="col">Edit Images</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($products as $product) { ?>
                                            <tr>
                                                <td><?php echo $product['product_id']; ?></td>
                                                <td><img src="<?php echo "../assets/imgs/". $product['product_image']; ?>" style="width: 70px; height: 70px;" /></td>
                                                <td><?php echo $product['product_name']; ?></td>
                                                <td><?php echo "$".$product['product_price']; ?></td>
                                                <td><?php echo $product['product_special_offer']."%"; ?></td>
                                                <td><?php echo $product['product_category']; ?></td>
                                                <td><?php echo $product['product_color']; ?></td>
                                                <td><a class="btn btn-warning" href="<?php echo "edit_images.php?product_id=".$product['product_id']."&product_name=".$product['$product_name'];?>">Edit Images</a></td>
                                                <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id'];?>">Edit</a></td>
                                                <td><a class="btn btn-danger"  href="delete_product.php?product_id=<?php echo $product['product_id'];?>">Delete</a></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        </div>
    </div>

<nav aria-label="Page navigation example" class="fixed-bottom">
    <ul class="pagination justify-content-center">
        <li class="page-item <?php if($page_on<=1){echo 'disabled';}?>">
            <a href="<?php if($page_on<=1){echo '#';} else { echo "?page_on=".($page_on-1);}?>" class="page-link">Previous</a>
        </li>
        <?php for($i = 1; $i <= $total_no_of_pages; $i++) { ?>
            <li class="page-item <?php if($page_on == $i) echo 'active'; ?>">
                <a href="?page_on=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
            </li>
        <?php } ?>
        <li class="page-item <?php if($page_on >= $total_no_of_pages){echo 'disabled';}?>" >
            <a href="<?php if($page_on >= $total_no_of_pages){echo '#';} else { echo "?page_on=".($page_on+1);}?>" class="page-link">Next</a>
        </li>
    </ul>
</nav>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-b3thh6lTUhR/Ax5aWE95E72YnPJ2CKd6tvD2e7n6m/HMqBZKtO7GAYnXm5U+frnn" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-Btt5IPVqmzj3OvWgtD/7JASZbVQaDAfVbKzSbkAl6ap9R8/OnwB1XjBz6jqgMIa0" crossorigin="anonymous"></script>
</body>
</html>
