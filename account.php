<?php
session_start();
include('server/connection.php');

// Check if the user is logged in
if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}

// Check if the logout parameter is set
if(isset($_GET['logout'])){
    // If logged in, unset session variables and redirect to login page
    if(isset($_SESSION['logged_in'])){
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('location: login.php');
        exit;
    }
}

// Handle change password request
if(isset($_POST['change_password'])){
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    if($password !== $confirmPassword){
        header('location: account.php?error=passwords dont match');
    } else if(strlen($password) < 6){
        header('location: account.php?error=password must be at least 6 characters');
    } else {
        $stmt = $connection->prepare("UPDATE users SET user_password=? WHERE user_email=?");
        $stmt->bind_param('ss', md5($password), $user_email);
        if($stmt->execute()){
            header('location: account.php?message=password has been updated successfully');
        } else {
            header('location: account.php?error=could not update password');
        }
    }
}

// Get orders
if(isset($_SESSION['logged_in'])){
    $user_id = $_SESSION['user_id'];
    $stmt = $connection->prepare("SELECT * FROM orders WHERE user_id=?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $orders = $stmt->get_result();
}
?>

<?php include('layouts/header.php'); ?> 



<!-- Account Information and Change Password -->
<section class="my-5 py-5">
    <div class="row container mx-auto">

        <?php if(isset($_GET['payment_message'])) { ?>
            <p class="mt-5 text-center" style="color:green"><?php echo $_GET['payment_message']; ?></p>
        <?php } ?>

        <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 pt-5 mt-3 col-md-12">
            <div class="text-center">
                <!-- Account Information -->
                <div>
                    <p style="color:green"><?php if(isset($_GET['register_success'])){echo $_GET['register_success'];} ?></p>
                    <p style="color:green"><?php if(isset($_GET['login_success'])){echo $_GET['login_success'];} ?></p>
                    <h3 class="font-weight-bold">Account Information</h3>
                    <hr>
                    <div class="account-info">
                        <p>Name: <span><?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?></span></p>
                        <p>Email: <span><?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?></span></p>
                        <p><a href="cart.php" id="orders-btn"  class="btn btn-danger text-white">Your Cart</a></p>
                        <p><a href="account.php?logout=1" class="btn btn-primary text-white"id="logout-btn">Logout</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 mt-3 mt-lg-0">
            <!-- Change Password -->
            <div class="text-center">
                <form class="change-password-form" method="POST" action="account.php" id="account-form">
                    <p style="color:red"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                    <p style="color:green"><?php if(isset($_GET['message'])){echo $_GET['message'];} ?></p>
                    <h3>Change Password</h3>
                    <hr>
                    <div class="form-group my-2 py-2">
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="New Password" required>
                    </div>
                    <div class="form-group my-2 py-2">
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Confirm New Password" required>
                    </div>
                    <div class="form-group my-2 py-2">
                        <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    </div>
</section>

<!-- Orders -->
<section class="orders container my-5 py-3" id="orders">
    <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
        <hr class="mx-auto">
    </div>
    <table>
        <tr>
            <th>Order id</th>
            <th>Order Cost</th>
            <th>Order Status</th>
            <th>Order Date</th>
            <th>Order Details</th>
            </tr>
        <?php  while($row=$orders->fetch_assoc()){    ?>
                        <tr>
                            <td>
                                <!-- <div>
                                    <img src="assets/imgs/watch.jpeg" alt="Product Image"> -->
                                    <!-- <div>
                                        <p class="mt-3"></p>
                                    </div>
                                    
                                </div> -->
                                <span><?php echo $row['order_id'];?></span>
                            </td>
                            <td>
                                <span><?php echo $row['order_cost'];?></span>
                            </td>
                            <td>
                                <span><?php echo $row['order_status'];?></span>
                            </td>
                            <td>
                                <span><?php echo date('Y-m-d h:i A', strtotime($row['order_date'])); ?></span>
                            </td>
                            <td>
                                <form action="order_detail.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status" />
                                    <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id" />
                                    <input type="submit" class="btn order-details-btn" value="details" name="order_details_btn"/>
                                    </form>
                        </td>
        
                        </tr>
                        <?php } ?>
    </table>
</section>


    <!-- footer -->
    <?php  include('layouts/footer.php'); ?>
