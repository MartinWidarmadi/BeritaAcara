<?php
session_start();
include_once 'controller/UserController.php';
include_once 'controller/ForgotController.php';
include_once 'controller/ChangePWController.php';
include_once 'controller/HomeController.php';
include_once 'controller/SecondController.php';
include_once 'controller/OTPController.php';
include_once 'controller/DosenController.php';
include_once 'controller/JadwalController.php';
include_once 'controller/AcaraController.php';
include_once 'controller/MataKuliahController.php';
include_once 'controller/MahasiswaController.php';
include_once 'controller/ProfileController.php';
include_once 'controller/AsistenController.php';
include_once 'dao/UserDaoImpl.php';
include_once 'dao/MataKuliahDaoImpl.php';
include_once 'dao/DosenDaoImpl.php';
include_once 'dao/ProdiDaoImpl.php';
include_once 'dao/JadwalDaoImpl.php';
include_once 'dao/DetailJadwalDaoImpl.php';
include_once 'dao/MahasiswaDaoImpl.php';
include_once 'dao/SemesterDaoImpl.php';
include_once 'dao/AsistenDaoImpl.php';
include_once 'db-util/PDOUtil.php';
include_once 'entity/Dosen.php';
include_once 'entity/Kelas.php';
include_once 'entity/MataKuliah.php';
include_once 'entity/Prodi.php';
include_once 'entity/User.php';
include_once 'entity/Jadwal.php';
include_once 'entity/Semester.php';
include_once 'entity/DetailJadwal.php';
include_once 'entity/Mahasiswa.php';
include_once 'entity/AssistenDosen.php';

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
    <link rel="stylesheet" type="text/css" href="style.css">


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="src/jquery.toast.css">
    <script src="dist/jquery.toast.min.js"></script>
</head>
<body>
<?php
$menu = filter_input(INPUT_GET, 'menu');
if ($_SESSION['is_logged']):
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container m-0">
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
                <li class="nav-item">
                    <i class="fa-solid fa-bag-shopping nav-img"></i>
                    <a class="nav-link" href="?menu=mahasiswa">Mahasiswa</a>
                </li>
                <?php
                if ($_SESSION['roles'] == "admin") :
                    ?>
                    <li class="nav-item">
                        <i class="fa-solid fa-user nav-img"></i>
                        <a class="nav-link" href="?menu=dosen">Dosen</a>
                    </li>
                    <li class="nav-item">
                        <i class="fa-solid fa-bag-shopping nav-img"></i>
                        <a class="nav-link" href="?menu=matkul">Mata Kuliah</a>
                    </li>
                <?php
                endif; ?>
                <li class="nav-item">
                    <i class="fa-solid fa-bag-shopping nav-img"></i>
                    <a class="nav-link" href="?menu=jadwal">Jadwal</a>
                </li>
                <li class="nav-item">
                    <i class="fa-solid fa-bag-shopping nav-img"></i>
                    <a class="nav-link" href="?menu=acara">Berita Acara</a>
                </li>
                <?php
                if ($_SESSION['roles'] == "admin") :
                    ?>
                    <li class="nav-item">
                        <i class="fa-solid fa-bag-shopping nav-img"></i>
                        <a class="nav-link" href="?menu=asdos">Asisten Dosen</a>
                    </li>
                <?php
                endif; ?>
                <li class="nav-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <a class="nav-link" href="?menu=profile">Profile</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div style="padding-left: 25px; padding-right: 25px">
    <?php


    switch ($menu) {
        case 'home':
            $homeController = new HomeController();
            $homeController->index();
            break;
        case 'second':
            $secondController = new SecondController();
            $secondController->index();
            break;
        case 'dashboard':
            include_once 'view/dashboard-view.php';
            break;
        case 'dosen':
            $dosenController = new DosenController();
            $dosenController->index();
            break;
        case 'matkul' :
            $mataKuliahController = new MataKuliahController();
            $mataKuliahController->index();
            break;
        case 'mahasiswa' :
            $mahasiswaController = new MahasiswaController();
            $mahasiswaController->index();
            break;
        case 'jadwal' :
            $jadwalController = new JadwalController();
            $jadwalController->index();
            break;
        case 'acara' :
            $acaraController = new AcaraController();
            $acaraController->index();
            break;
        case 'asdos' :
            $assistenController = new AsistenController();
            $assistenController->index();
            break;
        case 'logout':
            $userController = new UserController();
            $userController->logout();
            break;
        case 'profile':
            $profileController = new ProfileController();
            $profileController->index();
            break;
        case 'updatePass':
            $profileController = new ProfileController();
            $profileController->updateIndex();
            break;
        // case 'editmatkul':
        //     $editMatkul = new MataKuliahController();
        //     $editMatkul->updateIndex();
        //     break;
        // case 'addDosen':
        //     $addDosenController = new addDosenController();
        //     $addDosenController->index();
        //     break;
        // case 'addNamaDosen':
        //     $addNamaDosenController = new  addNamaDosenController();
        //     $addNamaDosenController->index();
        //     break;
        default:
            $homeController = new HomeController();
            $homeController->index();
    }
    else:
        if ($menu == "forgot") {
            $forgotController = new ForgotController();
            $forgotController->index();
        } else if ($menu == "changepw") {
            $changepwController = new ChangePWController();
            $changepwController->index();
            $changepwController->updateindex();
        } else if ($menu == "login") {
            $userController = new UserController();
            $userController->index();
        } else if ($menu == "otp") {
            $OTPController = new  OTPController();
            $OTPController->index();
            $OTPController->updateindex();
        } 
        // else if ($menu == "changepw1") {
        //     $changepwController = new ChangePWController();
        //     $changepwController->updateindex();
        // }
        // else if ($menu == "addDosen") {
        //     $addDosenController = new  addDosenController();
        //     $addDosenController->index();
        // } else if ($menu == "addNamaDosen") {
        //     $addDosenController = new  addDosenController();
        //     $addDosenController->index();
        // }
        else {
            $userController = new UserController();
            $userController->index();
        }

    endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
            $('#example2').DataTable();
        });
    </script>

</div>
</body>
</html>