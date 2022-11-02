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
            header('location:?menu=addDosen');
        }
        $dosen = $this->dosenDao->fetchAllDosen();
        include_once 'view/dosen-view.php';
    }
}