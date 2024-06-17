
<?php 

session_start();
include('../server/connection.php');

if(isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}
?>
<?php include('header.php');?>

<?php

if(isset($_GET['page_on']) && $_GET['page_on'] != ""){
    $page_on = $_GET['page_on'];

}else{
    $page_on = 1;
}

$stmt1 =  $connection->prepare("SELECT COUNT(*) As total_records FROM orders");

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


$stmt2 = $connection->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");

$stmt2->execute();

$orders = $stmt2->get_result();

?>

<div class="container-fluid">
        <div class="row" style="min-height: 1000px">
        
        <?php include( 'sidemenu.php'); ?>
        <main class="col-md-9 ms-sm-auto col-1g-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <div class="btn-toolbar mb-2 mb-md—0">
                    <div class="btn-group me-2">
                        <div class="container mt-5 py-5">
                            <h2>Orders</h2>
                            <?php if(isset($_GET['order_updated'])){?>
                                <p class="text-center" style="color: green;"><?php echo $_GET['order_updated'];?></p>
                            <?php } ?>

                            <?php if(isset($_GET['order_failed'])){?>
                                <p class="text-center" style="color: red;"><?php echo $_GET['order_failed'];?></p>
                            <?php } ?>
                            
                            <?php if(isset($_GET['deleted_successfully'])){?>
                                <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully'];?></p>
                            <?php } ?>

                            <?php if(isset($_GET['deleted_failure'])){?>
                                <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure'];?></p>
                            <?php } ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order Id</th>
                                            <th scope="col">Order Status</th>
                                            <th scope="col">User Id</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">User Phone</th>
                                            <th scope="col">User Address</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($orders as $order) { ?>
                                            <tr>
                                                <td><?php echo $order['order_id']; ?></td>
                                                <td><?php echo $order['order_status']; ?></td>
                                                <td><?php echo $order['user_id']; ?></td>
                                                <td><?php echo $order['order_date']; ?></td>
                                                <td><?php echo $order['user_phone']; ?></td>
                                                <td><?php echo $order['user_address']; ?></td>
                                                <td><a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $order['order_id'];?>">Edit</a></td>
                                                <td><a class="btn btn-danger"  href="delete_order.php?order_id=<?php echo $order['order_id'];?>">Delete</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <nav aria-label="Page navigation example">
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
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include('footer.php'); ?>
