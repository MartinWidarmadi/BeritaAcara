<?php

class OTPController
{
    private $userDao;
    public function __construct()
    {
        $this->userDao = new UserDaoImpl();
    }

    public function index(){
        include_once 'view/otp-view.php';
    }

    public function updateindex(){
        $email = filter_input(INPUT_GET, 'email');
        $checkOTP = filter_input(INPUT_POST,'send-OTP');
        if (isset($checkOTP)) {
            header('location:?menu=changepw&email=' . $email);
        }
    }
}