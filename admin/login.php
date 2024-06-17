

<?php
include('../server/connection.php');

// Redirect to dashboard page if already logged in
if(isset($_SESSION['admin_logged_in'])){
    header('Location: index.php');
    exit;
}

if(isset($_POST['login_btn'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']); // This is not a secure way to store passwords. Consider using more secure methods like password_hash() and password_verify().

    $stmt = $connection->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");
    $stmt->bind_param('ss', $email, $password);

    if($stmt->execute()){
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        $stmt->store_result();

        if($stmt->num_rows() == 1){
            $stmt->fetch();

            // Set session variables
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;

            // Redirect to dashboard page
            header('Location: index.php?login_success=Logged in successfully');
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Admin Login</div>
                    <div class="card-body">
                        <form id="login-form" method="POST" action="login.php">
                        <p style="color: red" class="text-center">
                            <?php if(isset($_GET['error'])){ echo $_GET['error']; }?>
                        </p>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required/>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" id="login-btn" name="login_btn" value="Login"/>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
