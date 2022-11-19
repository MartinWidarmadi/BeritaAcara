<?php

class AcaraController
{
    private $dosenDao;
    private $detailDao;
    private $jadwalDao;
    public function __construct()
    {
        $this->dosenDao = new DosenDaoImpl();
        $this->detailDao = new DetailJadwalDaoImpl();
        $this->jadwalDao = new JadwalDaoImpl();
    }

    public function index() {
        $dosenId = $this->dosenDao->fetchDosen($_SESSION['user_id'])->getNIP();
        $jadwal = $this->jadwalDao->fetchAllJadwal($dosenId);
        $jadwals = $this->jadwalDao->fetchAllJadwals();
        $array_jadwals = [];
        $array_jadwal = [];
        foreach ($jadwals as $jadwalone){
            $array_jadwals[$jadwalone->getIdJadwal()] = $this->detailDao->fetchBeritaAcara($jadwalone);
        }
        foreach ($jadwal as $jadwaltwo){
            $array_jadwal[$jadwaltwo->getIdJadwal()] = $this->detailDao->fetchBeritaAcara($jadwaltwo);
        }
        include_once 'view/acara-view.php';
    }
}