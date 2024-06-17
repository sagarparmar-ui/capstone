<?php 

session_start();
// Check if the user is logged in
$admin_logged_in = isset($_SESSION['admin_id']);

// // If not logged in, redirect to the login page
// if (!$admin_logged_in) {
//     header('Location: login.php');
//     exit;
// }
// ?>

<?php 

include('../server/connection.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light bg-dark py-3 fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="assets/imgs/ovo_logo_PNG1.png" alt="Logo" height="30">
            CBuddy
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <?php if(!isset($_SESSION['admin_logged_in'])) { ?>
                    <a class="nav-link" href="login.php?logout.php=1">Logout</a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

</body>
</html>
