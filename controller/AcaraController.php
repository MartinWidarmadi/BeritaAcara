<?php

class AcaraController
{
    private $dosenDao;
    private $detailDao;
    public function __construct()
    {
        $this->dosenDao = new DosenDaoImpl();
        $this->detailDao = new DetailJadwalDaoImpl();
    }

    public function index() {
        $dosenId = $this->dosenDao->fetchDosen($_SESSION['user_id'])->getNIP();
        $jadwal = $this->detailDao->fetchAllJadwal($dosenId);
        include_once 'view/acara-view.php';
    }
}