<?php

class MataKuliahController
{

    private $mkDao;
    private $dosenDao;
    private $prodiDao;
    public function __construct()
    {
        $this->mkDao = new MataKuliahDaoImpl();
        $this->dosenDao = new DosenDaoImpl();
        $this->prodiDao = new ProdiDaoImpl();
    }
    public function index() {
        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');

        if (isset($btnSubmit)) {
            header('location: index.php?menu=addmatkul');
        }

        $mk = $this->mkDao->fetchAllMK();
        include_once 'view/mataKuliah-view.php';
    }

    public function addIndex() {
        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');

        if (isset($btnSubmit)) {
            header('location: index.php?menu=matkul');
        }

        $prodi = $this->prodiDao->fetchAllProdi();
        include_once 'view/addMataKuliah-view.php';
    }
}