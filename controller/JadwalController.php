<?php

class JadwalController
{
    private $jadwalDao;
    private $dosenDao;
    private $mkDao;
    public function __construct()
    {
        $this->jadwalDao = new JadwalDaoImpl();
        $this->dosenDao = new DosenDaoImpl();
        $this->mkDao = new MataKuliahDaoImpl();
    }

    public function index() {
        $dosenId = $this->dosenDao->fetchDosen($_SESSION['user_id'])->getNIP();
        $jadwal = $this->jadwalDao->fetchAllJadwal($dosenId);
        $jadwals = $this->jadwalDao->fetchAllJadwals();
        $dosen = $this->dosenDao->fetchDosenName();
        $matkul = $this->mkDao->fetchAllMKName();
        include_once 'view/jadwal-view.php';
    }
}