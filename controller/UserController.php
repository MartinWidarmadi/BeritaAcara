<?php

class UserController
{
    private $userDao;
    public function __construct()
    {
        $this->userDao = new UserDaoImpl();
        $this->DosenDao = new DosenDaoImpl();
    }

    public function index() {
        $loginSubmitted = filter_input(INPUT_POST,'btnLogin');
        if (isset($loginSubmitted)) {
            $email = filter_input(INPUT_POST,'txtEmail');
            $password = filter_input(INPUT_POST,'txtPassword');
            $result = $this->userDao->userLogin($email, $password);

            if ($result) {
                $resultDosen = $this->DosenDao->fetchDosen($result->getIdUser());
                $_SESSION['is_logged'] = true;
                $_SESSION['user_id'] = $result->getIdUser();
                $_SESSION['password'] = $result->getPassword();
                $_SESSION['web_user_full_name'] = $resultDosen->getNamaDosen();
                $_SESSION['roles'] = $result->getRole();
                header('location:index.php');
                if(isset($_POST["remember"])) {
                    //buat cookie
                    setcookie ("txtEmail",$_POST["txtEmail"],time()+ (10 * 365 * 24 * 60 * 60));
                    setcookie ("txtPassword",$_POST["txtPassword"],time()+ (10 * 365 * 24 * 60 * 60));
                } else {
                    if(isset($_COOKIE["txtEmail"])) {
                        setcookie ("txtEmail","");
                    }
                    if(isset($_COOKIE["txtPassword"])) {
                        setcookie ("txtPassword","");
                    }
                }
            }elseif (empty($email) || empty($password)){
                $message = "Email Atau Password masih kosong";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            else {
                $message = "Email Atau Password Salah!!!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }

        }
        include_once 'view/login-view.php';
    }

    public function checkingEmail(){
        $checkSubmitted = filter_input(INPUT_POST,'check-email');
        if (isset($checkSubmitted)) {
            $email = filter_input(INPUT_POST, 'email');
            $result = $this->userDao->checkEmail($email);
            if ($result) {
                $message = "Email Yang Dimasukkan Salah!!!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $message = "Email Yang Dimasukkan Salah!!!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
        include_once 'view/changepassword-view.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('location:index.php');
    }
}