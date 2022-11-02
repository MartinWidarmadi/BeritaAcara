<?php

class JadwalController
{
    private $jadwalDao;
    private $dosenDao;
    public function __construct()
    {
        $this->jadwalDao = new JadwalDaoImpl();
        $this->dosenDao = new DosenDaoImpl();
    }

    public function index() {
        $dosenId = $this->dosenDao->fetchDosen($_SESSION['user_id'])->getNIP();
        $jadwal = $this->jadwalDao->fetchAllJadwal($dosenId);
        $jadwals = $this->jadwalDao->fetchAllJadwals();
        include_once 'view/jadwal-view.php';
    }
}