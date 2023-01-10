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
        $btnFilter = filter_input(INPUT_POST, 'btnFilter');
        $jadwalfile = filter_input(INPUT_POST, 'btnBatchFile');

        $jadwals = $this->jadwalDao->fetchAllJadwals();

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
                    $result = false;
                    $data = $spreadsheet->getActiveSheet()->toArray(null, true, true , true);
                    for ($i = 2; $i <= count($data); $i++){
                        $filejadwal = new Jadwal();
                        $filejadwal->setNipDosen($data[$i]["A"]);
                        $filejadwal->setIdMatkul($data[$i]["B"]);
                        $filejadwal->setHari($data[$i]["C"]);
                        $filejadwal->setJamAwal($data[$i]["D"]);
                        $filejadwal->setJamAkhir($data[$i]["E"]);
                        $filejadwal->setType($data[$i]["F"]);
                        $filejadwal->setKelas($data[$i]["G"]);
                        $filejadwal->setIdSemester($semesters);

                        $checksuccess = $this->jadwalDao->fetchJadwal($data[$i]["A"],$data[$i]["B"]);
                        if (!$checksuccess){
                            $result = $this->jadwalDao->insertNewJadwal($filejadwal);
                        }
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
            }else if (isset($btnFilter)) {
            $filSemester = filter_input(INPUT_POST, 'filterSemester');
            $filDosen = filter_input(INPUT_POST, 'filterDosen');
            $jadwals = $this->jadwalDao->fetchFilterJadwal($filSemester,$filDosen);
        }



        $dosenId = $this->dosenDao->fetchDosen($_SESSION['user_id'])->getNIP();
        $jadwal = $this->jadwalDao->fetchAllJadwal($dosenId);
        $dosen = $this->dosenDao->fetchDosenActive();
        $matkul = $this->mkDao->fetchMKstatus();
        $semester = $this->semesterDao->fetchAllSemester();
        include_once 'view/jadwal-view.php';
    }
}