<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
    header('location:admin_book.php');
}
$title = "Admin Panel";
require_once "./template/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Center the card */
        .card {
            margin: 0 auto;
            margin-top: 50px;
        }

        /* Style the card header */
        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
        }

        /* Add a subtle box-shadow to the card */
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Style form elements */
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 0;
        }

        /* Style the submit button */
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 0;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Add some padding to the form */
        .card-body {
            padding: 20px;
        }

        /* Style error message */
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        /* Animations */
        .animate__animated {
            animation-duration: 1s;
        }

        .animate__fadeIn {
            animation-name: fadeIn;
        }

        .animate__fadeInUp {
            animation-name: fadeInUp;
        }
    </style>
</head>
<body>
<div class="row justify-content-center my-5">
    <div class="col-lg-4 col-md-6 col-sm-10 col-xs-12">
        <div class="card rounded-0 shadow animate__animated animate__fadeIn">
            <div class="card-header">
                <div class="card-title text-center h4 fw-bolder animate__animated animate__fadeIn">Login</div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <?php if(isset($_SESSION['err_login'])): ?>
                        <div class="alert alert-danger rounded-0 animate__animated animate__fadeIn">
                            <?= $_SESSION['err_login'] ?>
                        </div>
                    <?php 
                        unset($_SESSION['err_login']);
                        endif;
                    ?>
                    <form class="form-horizontal animate__animated animate__fadeIn" method="post" action="admin_verify.php">
                        <div class="mb-3">
                            <label for="name" class="control-label">Username</label>
                            <input type="text" name="name" class="form-control rounded-0">
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="control-label">Password</label>
                            <input type="password" name="pass" class="form-control rounded-0">
                        </div>
                        <div class="mb-3 d-grid">
                            <input type="submit" name="submit" class="btn btn-primary rounded-0">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once "./template/footer.php";
?>
</body>
</html>
