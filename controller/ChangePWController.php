<?php

class ChangePWController
{
    private $userDao;
    public function __construct()
    {
        $this->userDao = new UserDaoImpl();
    }

    public function index(){
//        echo "<script>console.log($_POST["name"]);</script>";

        include_once 'view/changepassword-view.php';
    }

    public function updateindex(){
        $email = filter_input(INPUT_GET, 'email');
        $checkPassword = filter_input(INPUT_POST,'check-password');
        if (isset($checkPassword)) {
            $password = filter_input(INPUT_POST, 'password');
            $result = $this->userDao->userLogin($email, $password);
            if ($result) {
                $message = "Katasandi Yang Dimasukkan Sama!!!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else  {
                $user = $this->userDao->checkEmail($email);
                $user->setPassword($password);
                $this->userDao->updatePassword($user);
                header('location:?menu=login');
            }
        }
    }
}