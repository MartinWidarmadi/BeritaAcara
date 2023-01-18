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

        $btnFilter = filter_input(INPUT_POST, 'btnFilter');

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
            foreach ($array_jadwals[$index] as $i => $jadwalasdosadmin){
                $jadwalasdosadmin->asisten = $this->detailDao->fetchAssitenDosen($jadwalasdosadmin);
            }
        }
        foreach ($jadwal as $index => $jadwaltwo){
            $array_jadwal[$index] = $this->detailDao->fetchBeritaAcara($jadwaltwo);
            foreach ($array_jadwal[$index] as $i => $jadwalasdosdosen){
                $jadwalasdosdosen->asisten = $this->detailDao->fetchAssitenDosen($jadwalasdosdosen);
            }
        }

//        if (isset($btnFilter)) {
//
//            $filSemester = filter_input(INPUT_POST, 'filterSemester');
//            $filDosen = filter_input(INPUT_POST, 'filterDosen');
//            $jadwals = $this->jadwalDao->fetchFilterJadwal($filSemester,$filDosen);
//            foreach ($jadwals as $index => $jadwalone){
//                $array_jadwals[$index] = $this->detailDao->fetchFilterBeritaAcara($jadwalone, $filDosen,$filSemester);
//            }
//        }else{
//            $jadwals = $this->jadwalDao->fetchAllJadwals();
//            foreach ($jadwals as $index => $jadwalone){
//                $array_jadwals[$index] = $this->detailDao->fetchBeritaAcara($jadwalone);
//            }
//            foreach ($jadwal as $index => $jadwaltwo){
//                $array_jadwal[$index] = $this->detailDao->fetchBeritaAcara($jadwaltwo);
//            }
//        }

//        var_dump($array_jadwal);

        include_once 'view/acara-view.php';
    }
}