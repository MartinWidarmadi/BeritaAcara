<?php

class HomeController
{
    private $userDao;
    private $mataKuliahDao;
    private $dosenDao;
    private $prodiDao;
    private $jadwalDao;
    public function __construct()
    {
        $this->mataKuliahDao = new MataKuliahDaoImpl();
        $this->dosenDao = new DosenDaoImpl();
        $this->userDao = new UserDaoImpl();
        $this->prodiDao = new ProdiDaoImpl();
        $this->jadwalDao = new JadwalDaoImpl();
    }

    public function index() {
        $btnNext = filter_input(INPUT_POST, 'btnNext');
        if (isset($btnNext)) {
            header('location: index.php?menu=second');
        }
        $dosenId = $this->dosenDao->fetchDosen($_SESSION['user_id'])->getNIP();
        $jadwal = $this->jadwalDao->fetchJadwal($dosenId);
        // echo '<pre>' . var_dump($jadwal) . '</pre>'; 
        include_once 'view/home-view.php';
    }
}