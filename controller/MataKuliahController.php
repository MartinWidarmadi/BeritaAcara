<?php

class MataKuliahController
{

    private $mkDao;
    private $dosenDao;
    public function __construct()
    {
        $this->mkDao = new MataKuliahDaoImpl();
        $this->dosenDao = new DosenDaoImpl();
    }
    public function index() {
        $mk = $this->mkDao->fetchAllMK();
        include_once 'view/mataKuliah-view.php';
    }
}