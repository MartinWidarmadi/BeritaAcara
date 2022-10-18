<?php
session_start();
include_once 'controller/UserController.php';
include_once 'controller/ForgotController.php';
include_once 'controller/ChangePWController.php';
include_once 'dao/UserDaoImpl.php';
include_once 'dao/DosenDaoImpl.php';
include_once 'db-util/PDOUtil.php';
include_once 'entity/Dosen.php';
include_once 'entity/Kelas.php';
include_once 'entity/MataKuliah.php';
include_once 'entity/Prodi.php';
include_once 'entity/User.php';

if (!isset($_SESSION['is_logged'])) {
    $_SESSION['is_logged'] = false;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Author" content="Michael Mathew Setiadi (2072007)">
    <title>Berita Acara PBM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
</head>
<body>
<?php
$menu = filter_input(INPUT_GET, 'menu');
if ($_SESSION['is_logged']):
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid m-0">
            <a class="navbar-brand" href="#">PPL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <i class="fa-solid fa-house nav-img"></i>
                        <a class="nav-link" href="?menu=home">Home</a>
                    </li>
<!--                    <li class="nav-item">-->
<!--                        <i class="fa-solid fa-user nav-img"></i>-->
<!--                        <a class="nav-link" href="?menu=dashboard">Supplier Management</a>-->
<!--                    </li>-->
                    <!-- <li class="nav-item">
                        <i class="fa-solid fa-bag-shopping nav-img"></i>
                        <a class="nav-link" href="?menu=product">Product Management</a>
                    </li> -->
                    <li class="nav-item">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <a class="nav-link" href="?menu=logout">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php


    switch ($menu) {
        case 'home':
            include_once 'view/home-view.php';
            break;
        case 'dashboard':
            include_once 'view/dashboard-view.php';
            break;
        case 'logout':
            $userController = new UserController();
            $userController->logout();
            break;
        default:
            include_once 'view/home-view.php';
            break;
    }
else:
    if ($menu == "forgot") {
        $forgotController = new ForgotController();
        $forgotController->index();
        $forgotController->checkingEmail();
    } else if ($menu == "changepw") {
        $changepwController = new ChangePWController();
        $changepwController->index();
        $changepwController->updateindex();
    } else if ($menu == "login") {
        $userController = new UserController();
        $userController->index();
    } else {
        $userController = new UserController();
        $userController->index();
    }

endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>
</html>