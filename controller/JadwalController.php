<?php
require 'db-util/spreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
            $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
        $jadwalfile = filter_input(INPUT_POST, 'btnBatchFile');

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
            else if (isset($jadwalfile)){
                if (isset($_FILES['jadwalFile']['name']) && $_FILES['jadwalFile']['name'] != '') {
                    $semesters = filter_input(INPUT_POST, 'semesters');
                    $directory = 'uploads/';
                    $fileExtension = pathinfo($_FILES['jadwalFile']['name'], PATHINFO_EXTENSION);
                    $newFileName = 'Tanggal' . date("d M Y H i s") . '.' . $fileExtension;
                    $targetFile = $directory . $newFileName;
                    move_uploaded_file($_FILES['jadwalFile']['tmp_name'],$targetFile);
                    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetFile);
                    $data = $spreadsheet->getActiveSheet()->toArray(null, true, true , true);
                    foreach ($data as $index=> $jadwal){
                        $filejadwal = new Jadwal();
                        $filejadwal->setNipDosen($jadwal["A"]);
                        $filejadwal->setIdMatkul($jadwal["B"]);
                        $filejadwal->setHari($jadwal["C"]);
                        $filejadwal->setJamAwal($jadwal["D"]);
                        $filejadwal->setJamAkhir($jadwal["E"]);
                        $filejadwal->setType($jadwal["F"]);
                        $filejadwal->setKelas($jadwal["G"]);
                        $filejadwal->setIdSemester($semesters);
                        $result = $this->jadwalDao->insertNewJadwal($filejadwal);
                    }
                    if ($result) {
                        echo "
                                    <script>$.toast({
                        heading: 'Success',
                        text: 'Success Add Batch Data Jadwal',
                        showHideTransition: 'slide',
                        stack: false,
                        icon: 'success'
                    })</script>";
                    } else {
                        echo "<script>$.toast({
                            heading: 'Error',
                            text: 'Failed Add Batch Data Jadwal',
                            showHideTransition: 'fade',
                            icon: 'error'
                    })</script>";
                    }
                } else {
                    echo "<script>$.toast({
                            heading: 'Error',
                            text: 'Please Input File First',
                            showHideTransition: 'fade',
                            icon: 'error'
                    })</script>";
                }
            }



        $dosenId = $this->dosenDao->fetchDosen($_SESSION['user_id'])->getNIP();
        $jadwal = $this->jadwalDao->fetchAllJadwal($dosenId);
        $jadwals = $this->jadwalDao->fetchAllJadwals();
        $dosen = $this->dosenDao->fetchDosenActive();
        $matkul = $this->mkDao->fetchMKstatus();
        $semester = $this->semesterDao->fetchAllSemester();
        include_once 'view/jadwal-view.php';
    }
}