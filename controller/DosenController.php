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

    public function index() {
        $submitPressed = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($submitPressed)) {
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');
            $confirmpassword = filter_input(INPUT_POST,'confirmpassword');
            $result = $this->userDao->checkEmail($email);
            if (!$result) {
                if (empty($email) || empty($password) || empty($confirmpassword)) {
                    $message = "Please Fill all the blank field";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                if ($password != $confirmpassword){
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
                    } else{
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
            } if (empty($email) || empty($password) || empty($confirmpassword)) {
                $message = "Please Fill all the blank field";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } elseif($password != $confirmpassword){
                $message = "Password dan Confirm Password tidak sama";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $message = "Email Sudah digunakan";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
        $dosen = $this->dosenDao->fetchAllDosen();
        include_once 'view/dosen-view.php';
    }
}