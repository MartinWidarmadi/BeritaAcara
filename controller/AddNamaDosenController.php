<?php

class AddNamaDosenController
{
    private $userDao;
    private $dosenDao;
    public function __construct()
    {
        $this->userDao = new UserDaoImpl();
        $this->dosenDao = new DosenDaoImpl();
    }

    public function index(){
        $email = filter_input(INPUT_GET, 'email');
        $btnAdd = filter_input(INPUT_POST,'addNameDosen');
        if (isset($btnAdd)){
            $nip = filter_input(INPUT_POST, 'NIP');
            $name = filter_input(INPUT_POST, 'Name');
            $result = $this->dosenDao->checkNIP($nip);
            if ($result) {
                $message = "NIP Sudah digunakan";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } elseif (empty($nip) || empty($name)) {
                $message = "Please Fill all the blank field";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else{
                $result2 = $this->userDao->checkEmail($email);
                $dosen = new Dosen();
                $dosen->setNIP($nip);
                $dosen->setNamaDosen($name);
                $dosen->setUserIdUser($result2->getIdUser());
                $result3 = $this->dosenDao->insertNewDosen($dosen);
                if ($result3) {
                    echo '<div class="bg-success">Data succesfully added</div>';
                    header('location:?menu=dosen');
                } else {
                    echo '<div class="bg-danger">Error on add data</div>';
                }
            }
        }
        include_once 'view/addNamaDosen-view.php';
    }
}