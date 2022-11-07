<?php

class AddDosenController
{
    private $dosenDao;
    private $userDao;
    public function __construct()
    {
        $this->userDao = new UserDaoImpl();
    }

    public function index(){

        $btnAdd = filter_input(INPUT_POST,'addDosen');
        if (isset($btnAdd)) {
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
                $result = $this->userDao->insertNewUser($user);
                if ($result) {
                    echo '<div class="bg-success">Data succesfully added</div>';
                    header('location:?menu=addNamaDosen&email=' . $email);
                } else {
                    echo '<div class="bg-danger">Error on add data</div>';
                }
            } elseif (empty($email) || empty($password) || empty($confirmpassword)) {
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
        include_once 'view/addDosen-view.php';
    }
}