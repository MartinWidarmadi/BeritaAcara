<?php

class HomeController
{
    private $userDao;
    private $mataKuliahDao;
    private $dosenDao;
    private $prodiDao;
    public function __construct()
    {
        $this->mataKuliahDao = new MataKuliahDaoImpl();
        $this->dosenDao = new DosenDaoImpl();
        $this->userDao = new UserDaoImpl();
        $this->prodiDao = new ProdiDaoImpl();
    }

    public function index() {


        $prodis = $this->prodiDao->fetchAllProdi();

        $mataKuliah = $this->mataKuliahDao->fetchAllMataKuliah(2, 1); 
        // var_dump($mataKuliah);
        include_once 'view/home-view.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('location:index.php');
    }
}