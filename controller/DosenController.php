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
            $nip = filter_input(INPUT_POST,'txtNIP');
            $name = filter_input(INPUT_POST,'txtName');
            $email = filter_input(INPUT_POST,'txtEmail');
            $password = filter_input(INPUT_POST,'txtPassword');
            if (empty($nip) or empty($name)) {
                echo '<div class="bg-error">Please fill carefully</div>';
            } else {
                $user = new User();
                $userid = $user->setIdUser(10);
                $user->setEmail($email);
                $user->setPassword(md5($password));
                $user->setRole("dosen");
                $result = $this->userDao->insertNewUser($user);
                $dosen = new Dosen();
                $dosen->setNIP($nip);
                $dosen->setNamaDosen($name);
                $dosen->setUserIdUser($userid);
                $result2 = $this->dosenDao->insertNewDosen($dosen);
                if ($result) {
                    echo '<div class="bg-success">Data succesfully added</div>';
                } else {
                    echo '<div class="bg-danger">Error on add data</div>';
                }
            }
        }
        $dosen = $this->dosenDao->fetchAllDosen();
        include_once 'view/dosen-view.php';
    }
}