<?php

class DosenController
{
    private $dosenDao;
    private $userDao;

    public function __construct()
    {
        $this->dosenDao = new DosenDaoImpl();
        $this->userDao = new UserDaoImpl();
    }

    public function index()
    {
        $btnDel = filter_input(INPUT_GET, 'delcom');
        if (isset($btnDel) && $btnDel == 1) {
            $delId = filter_input(INPUT_GET, 'mid');
            $status = filter_input(INPUT_GET, 'aktif');
            $status = !$status;
            $delResult = $this->dosenDao->statusDosen($delId, $status);

            if ($delResult) {
                echo '<script>alert("Data has been changed")</script>';
                echo '<script>window.location = "index.php?menu=dosen";</script>';
            } else {
                echo '<script>alert("Error when delete data")</script>';
            }
        } elseif (isset($btnDel) && $btnDel == 2) {
            $delId = filter_input(INPUT_GET, 'mid');
            $delResult = $this->dosenDao->deleteDosen($delId);

            if ($delResult) {
                echo '<script>alert("Data has been deleted")</script>';
                echo '<script>window.location = "index.php?menu=dosen";</script>';
            } else {
                echo '<script>alert("Error when delete data")</script>';
            }
        }
        $submitPressed = filter_input(INPUT_POST, 'btnSubmit');
        $btnbatchdosen = filter_input(INPUT_POST, 'btnBatchFile');
        if (isset($submitPressed)) {
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');
            $confirmpassword = filter_input(INPUT_POST, 'confirmpassword');
            $result = $this->userDao->checkEmail($email);
            if (!$result) {
                if (empty($email) || empty($password) || empty($confirmpassword)) {
                    $message = "Please Fill all the blank field";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                if ($password != $confirmpassword) {
                    $message = "Password dan Confirm Password tidak sama";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                $user = new User();
                $user->setEmail($email);
                $user->setPassword(md5($password));
                $user->setRole("dosen");
                $result2 = $this->userDao->insertNewUser($user);
                if ($result2) {
                    $nip = filter_input(INPUT_POST, 'NIP');
                    $name = filter_input(INPUT_POST, 'Name');
                    $result3 = $this->dosenDao->checkNIP($nip);
                    if ($result3) {
                        $message = "NIP Sudah digunakan";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    } elseif (empty($nip) || empty($name)) {
                        $message = "Please Fill all the blank field";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    } else {
                        $result4 = $this->userDao->checkEmail($email);
                        $dosen = new Dosen();
                        $dosen->setNIP($nip);
                        $dosen->setNamaDosen($name);
                        $dosen->setUserIdUser($result4->getIdUser());
                        $result3 = $this->dosenDao->insertNewDosen($dosen);
                        if ($result4) {
                            echo '<div class="bg-success">Data succesfully added</div>';
                            header('location:?menu=dosen');
                        } else {
                            echo '<div class="bg-danger">Error on add data</div>';
                        }
                    }
                } else {
                    echo '<div class="bg-danger">Error on add data</div>';
                }
            }
            if (empty($email) || empty($password) || empty($confirmpassword)) {
                $message = "Please Fill all the blank field";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } elseif ($password != $confirmpassword) {
                $message = "Password dan Confirm Password tidak sama";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $message = "Email Sudah digunakan";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }elseif (isset($btnbatchdosen)) {
            if (isset($_FILES['dosenFile']['name']) && $_FILES['dosenFile']['name'] != '') {
                $directory = 'uploads/';
                $fileExtension = pathinfo($_FILES['dosenFile']['name'], PATHINFO_EXTENSION);
                $newFileName = 'Tanggal' . date("d M Y H i s") . '.' . $fileExtension;
                $targetFile = $directory . $newFileName;
                move_uploaded_file($_FILES['dosenFile']['tmp_name'], $targetFile);
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetFile);
                $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $result3 = false;
                    for ($i = 2; $i <= count($data); $i++) {
                        $users = new User();
                        $users->setEmail($data[$i]["A"]);
                        $users->setPassword(md5($data[$i]["B"]));
                        $users->setRole("dosen");
                        $this->userDao->insertNewUser($users);
                        $result4 = $this->userDao->checkEmail($data[$i]["A"]);
                        $filedosen = new Dosen();
                        $filedosen->setNIP($data[$i]["C"]);
                        $filedosen->setNamaDosen($data[$i]["D"]);
                        $filedosen->setUserIdUser($result4->getIdUser());
                        $result3 = $this->dosenDao->insertNewDosen($filedosen);
                    }
                    if ($result3) {
                        echo "
                                    <script>$.toast({
                        heading: 'Success',
                        text: 'Success Add Batch Data dosen',
                        showHideTransition: 'slide',
                        stack: false,
                        icon: 'success'
                    })</script>";
                    } else {
                        echo "<script>$.toast({
                            heading: 'Error',
                            text: 'Failed Add Batch Data dosen',
                            stack: false,
                            showHideTransition: 'fade',
                            icon: 'error'
                    })</script>";
                    }
                } else {
                    echo "<script>$.toast({
                            heading: 'Error',
                            text: 'Please Input File First',
                            stack: false,
                            showHideTransition: 'fade',
                            icon: 'error'
                    })</script>";
                }
            }

        $btnUpdate = filter_input(INPUT_POST, 'btnUpdate');

        if (isset($btnUpdate)) {
            $namas = filter_input(INPUT_POST, 'namas');
            $nip = filter_input(INPUT_POST, 'nip');


            $dsn = new Dosen();
            $dsn->setNamaDosen($namas);
            $dsn->setNIP($nip);


            $result = $this->dosenDao->updateDosen($dsn);

            if ($result) {
                echo "
                <script>$.toast({
    heading: 'Success',
    text: 'Success Update Data Dosen',
    showHideTransition: 'slide',
    stack: false,
    icon: 'success'
})</script>";
            } else {
                echo "<script>$.toast({
    heading: 'Error',
    text: 'Failed Update Data',
    showHideTransition: 'fade',
    icon: 'error'
})</script>";
            }
        }

        $dosen = $this->dosenDao->fetchAllDosen();
        include_once 'view/dosen-view.php';
    }
}