<?php 
session_start();

if (!isset($_SESSION['is_logged'])) {
  $_SESSION['is_logged'] = false;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php 
    if ($_SESSION['is_logged']):
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid m-0">
          <a class="navbar-brand" href="#">PWL</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <i class="fa-solid fa-house nav-img"></i>
                      <a class="nav-link" href="?menu=home">Home</a>
                  </li>
                  <li class="nav-item">
                      <i class="fa-solid fa-user nav-img"></i>
                      <a class="nav-link" href="?menu=dashboard">Supplier Management</a>
                  </li>
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
    $menu = filter_input(INPUT_GET, 'menu');

    switch ($menu) {
      case 'home':
        include_once 'view/home-view.php';
        break;
      case 'dashboard':
        include_once 'view/dashboard-view.php';
        break;
      default:
        include_once 'view/home-view.php';
        break;
    } else:
      include_once 'view/login-view.php';
    endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>