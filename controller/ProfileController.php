<?php

class ProfileController
{
    private $dosenDao;
    private $userDao;
    public function __construct()
    {
        $this->dosenDao = new DosenDaoImpl();
        $this->userDao = new UserDaoImpl();
    }

    public function index() {
      $btnCheck = filter_input(INPUT_POST, 'btnCheck');
      if (isset($btnCheck)) {
        $idUser = $_SESSION['user_id'];
        $oldPassword = filter_input(INPUT_POST, 'oldPassword');
        $newPassword = filter_input(INPUT_POST, 'newPassword');
        $confirmPassword = filter_input(INPUT_POST, 'confirmPassword');
        $checkPassword = $this->userDao->fetchUser($idUser)->getPassword();
        if ($checkPassword != md5($oldPassword)) {
          $message = "Kata sandi lama salah!!";
          echo "<script>alert('$message')</script>";
        } else if ($newPassword != $confirmPassword) {
          $message = "Kata sandi tidak cocok!!";
          echo "<script>alert('$message')</script>";
        } else {
          $user = new User();
          $user->setPassword($newPassword);
          $user->setIdUser($idUser);
          $result = $this->userDao->updatePassword($user);

          if ($result) {
            echo "
                <script>$.toast({
                heading: 'Updated',
                text: 'Success Update Password',
                showHideTransition: 'slide',
                stack: false,
                icon: 'success'
            })</script>";
          } else {
            echo "
                <script>$.toast({
                heading: 'Error',
                text: 'Error Update Password',
                showHideTransition: 'slide',
                stack: false,
                icon: 'success'
            })</script>";
          }
        }
      }
      $dosen = $this->dosenDao->fetchDosen($_SESSION['user_id']);
      $user = $this->userDao->fetchUser($_SESSION['user_id']);
//        var_dump($array_jadwal);
      include_once 'view/profile-view.php';
    }
}