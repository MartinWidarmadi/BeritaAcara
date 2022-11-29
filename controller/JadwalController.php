<?php

class JadwalController
{
    private $jadwalDao;
    private $dosenDao;
    private $mkDao;
    private $semesterDao;
    public function __construct()
    {
        $this->jadwalDao = new JadwalDaoImpl();
        $this->dosenDao = new DosenDaoImpl();
        $this->mkDao = new MataKuliahDaoImpl();
        $this->semesterDao = new SemesterDaoImpl();
    }

    public function index() {
        if ($_SESSION['roles'] == "admin") {
            $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');

            if (isset($btnSubmit)) {
                $nipDosen = filter_input(INPUT_POST, 'dosen');
                $idMatkul = filter_input(INPUT_POST, 'matkul');
                $type = filter_input(INPUT_POST, 'type');
                $kelas = filter_input(INPUT_POST, 'kelas');
                $hari = filter_input(INPUT_POST, 'hari');
                $jamMulai = filter_input(INPUT_POST, 'jamMulai');
                $jamSelesai = filter_input(INPUT_POST, 'jamSelesai');
                $semester = filter_input(INPUT_POST, 'semester');

                if (empty($namaDosen) && empty($matkul) && empty($type) && empty($kelas) && empty($hari) && empty($jamMulai) && empty($jamSelesai) && empty($semester)) {
                    echo '<script>alert(\'Input semua field!\')</script>';
                } else {
                    $jadwal = new Jadwal();
                    $jadwal->setKelas($kelas);
                    $jadwal->setHari($hari);
                    $jadwal->setJamAwal($jamMulai);
                    $jadwal->setJamAkhir($jamSelesai);
                    $jadwal->setType($type);
                    $jadwal->setIdMatkul($idMatkul);
                    $jadwal->setNipDosen($nipDosen);
                    $jadwal->setIdSemester($semester);
                    $result = $this->jadwalDao->insertNewJadwal($jadwal);
                    if ($result) {
                        echo '<script>alert(\'Jadwal berhasil diinput!\')</script>';
                        header('location: index.php?menu=jadwal');
                    } else {
                        echo '<script>alert(\'Jadwal gagal diinput!\')</script>';
                    }
                }
            }
        }

        $dosenId = $this->dosenDao->fetchDosen($_SESSION['user_id'])->getNIP();
        $jadwal = $this->jadwalDao->fetchAllJadwal($dosenId);
        $jadwals = $this->jadwalDao->fetchAllJadwals();
        $dosen = $this->dosenDao->fetchDosenActive();
        $matkul = $this->mkDao->fetchAllMK();
        $semester = $this->semesterDao->fetchAllSemester();
        include_once 'view/jadwal-view.php';
    }
}