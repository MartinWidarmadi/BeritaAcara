<?php

class UserController
{
    private $userDao;
    public function __construct()
    {
        $this->userDao = new UserDaoImpl();
    }

    public function index() {
        $loginSubmitted = filter_input(INPUT_POST,'btnLogin');
        if (isset($loginSubmitted)) {
            $email = filter_input(INPUT_POST,'txtEmail');
            $password = filter_input(INPUT_POST,'txtPassword');
            $result = $this->userDao->userLogin($email, $password);
            if ($result) {
                $_SESSION['is_logged'] = true;
                $_SESSION['user_id'] = $result->getIdUser();
//                $_SESSION['web_user_full_name'] = $result->getNamaDosen();
                $_SESSION['roles'] = $result->getRole();
                header('location:index.php');
            } else {
                echo '<div class="bg-error"> Invalid id or password</div>';
            }
        }
        include_once 'view/login-view.php';
    }

//    public function logout() {
//        session_unset();
//        session_destroy();
//        header('location:index.php');
//    }
}