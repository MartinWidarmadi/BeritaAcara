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
        $btnSubmit = filter_input(INPUT_POST, 'btnNext');
        $pertemuan = filter_input(INPUT_POST, 'pertemuan');
        $jadwal = filter_input(INPUT_POST, 'jadwal');
        
        if (isset($btnSubmit)) {
            header('location: index.php?menu=second&idJadwal=' . $jadwal . '&idPertemuan=' . $pertemuan);
        }

        $dosenId = $this->dosenDao->fetchDosen($_SESSION['user_id'])->getNIP();
        $jadwal = $this->jadwalDao->fetchAllJadwal($dosenId);
        // echo '<pre>' . var_dump($jadwal) . '</pre>'; 

        include_once 'view/home-view.php';
    }
}