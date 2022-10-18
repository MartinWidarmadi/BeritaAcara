<?php
include_once 'controller/UserController.php';
?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
$userController = new UserController();
$userController->checkingEmail();
?>
<div class="container">
    <form method="post">
    <div class="row">
        <div class="col-md-4 offset-md-4 form">
                <h2 class="text-center">Forgot Password</h2>
                <p class="text-center">Enter your email address</p>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Enter email address">
                </div>
                <div class="form-group">
                    <input class="form-control button" type="submit" name="check-email" value="Continue">
                </div>
        </div>
    </div>
    </form>
</div>
</body>
