<?php

class ForgotController
{
    private $userDao;
    public function __construct()
    {
        $this->userDao = new UserDaoImpl();
    }
    public function index(){
        include_once 'view/forgot-view.php';
    }
    public function checkingEmail(){
        $checkSubmitted = filter_input(INPUT_POST,'check-email');
        if (isset($checkSubmitted)) {
            $email = filter_input(INPUT_POST, 'email');
            $result = $this->userDao->checkEmail($email);
            if ($result) {
                header('location:?menu=changepw');

            }elseif (empty($email)){
                $message = "Harap Email Diisi";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $message = "Email Yang Dimasukkan Salah!!!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
    }
}