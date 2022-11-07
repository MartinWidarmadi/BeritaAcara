<?php

class MahasiswaController
{
    private $mahasiswaDao;
    public function __construct()
    {
        $this->mahasiswaDao = new MahasiswaDaoImpl();
    }

    public function index() {
        $submitPressed = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($submitPressed)) {
            header('location:?menu=addMahasiswa');
        }
        $mahasiswa = $this->mahasiswaDao->fetchAllMahasiswa();
        include_once 'view/mahasiswa-view.php';
    }
}