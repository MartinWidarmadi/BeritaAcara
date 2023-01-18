<?php

class AcaraController
{
    private $dosenDao;
    private $detailDao;
    private $jadwalDao;
    private $semesterDao;
    public function __construct()
    {
        $this->dosenDao = new DosenDaoImpl();
        $this->detailDao = new DetailJadwalDaoImpl();
        $this->jadwalDao = new JadwalDaoImpl();
        $this->semesterDao = new SemesterDaoImpl();
    }

    public function index() {
        $dosenId = $this->dosenDao->fetchDosen($_SESSION['user_id'])->getNIP();
        $jadwal = $this->jadwalDao->fetchAllJadwal($dosenId);
        $jadwals = $this->jadwalDao->fetchAllJadwals();
        $array_jadwals = [];
        $array_jadwal = [];
        $array_assisten = [];
        $array_assistens = [];
        $dosen = $this->dosenDao->fetchDosenActive();
        $semester = $this->semesterDao->fetchAllSemester();

        foreach ($jadwals as $index => $jadwalone){
            $array_jadwals[$index] = $this->detailDao->fetchBeritaAcara($jadwalone);
        }
        foreach ($jadwal as $index => $jadwaltwo){
            $array_jadwal[$index] = $this->detailDao->fetchBeritaAcara($jadwaltwo);
        }
        foreach ($jadwal as $index =>  $jadwalthree){
            $array_assisten[$index] = $this->detailDao->fetchAssitenDosen($jadwalthree);
        }
        foreach ($jadwals as $index => $jadwalfour){
            $array_assistens[$index] = $this->detailDao->fetchAssitenDosen($jadwalfour);
        }
//        var_dump($array_jadwal);
        include_once 'view/acara-view.php';
    }
}