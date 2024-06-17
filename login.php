<?php
session_start();

include('server/connection.php');

session_start();
// Redirect to account page if already logged in
if(isset($_SESSION['logged_in'])){
    header('Location: account.php');
    exit;
}

if(isset($_POST['login_btn'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $connection->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");
    $stmt->bind_param('ss', $email, $password);

    if($stmt->execute()){
        $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
        $stmt->store_result();

        if($stmt->num_rows() == 1){
            $stmt->fetch();

            // Set session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;

            // Redirect to account page
            header('Location: account.php?login_success=logged in successfully');
            exit;
        } else {
            // Redirect with error message
            header('Location: login.php?error=Could not verify account');
            exit;
        }
    } else {
        // Redirect with error message
        header('Location: login.php?error=Something went wrong');
        exit;
    }
}
?>

<?php include('layouts/header.php'); ?> 

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="register-form" method="POST" action="login.php">
            <p style="color: red" class="text-center">
                <?php if(isset($_GET['error'])){ echo $_GET['error']; }?>
            </p>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="password" required/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
            </div>
            <div class="form-group">
                <a id="register-url" href="register.php" class="btn">Don't have an account? Register here.</a>
            </div>
        </form>
    </div>
</section>

<?php include('layouts/footer.php'); ?>
