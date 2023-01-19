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
        $btnDel = filter_input(INPUT_GET, 'delcom');
        if (isset($btnDel)) {
            $delId = filter_input(INPUT_GET, 'jid');
            $type = filter_input(INPUT_GET, 'type');
            $kelas = filter_input(INPUT_GET, 'kelas');
            $hari = filter_input(INPUT_GET,'hari');
            $semester = filter_input(INPUT_GET, 'semester');

            if ($btnDel == 1) {
                $status = filter_input(INPUT_GET, 'aktif');

                $status = !$status;
                $delResult = $this->jadwalDao->updateStatusJadwal($delId, $type, $kelas, $semester, $status);
                
                if ($delResult && $status == 1) {
                    echo "
                    <script>$.toast({
                    heading: 'DEACTIVATED',
                    text: 'Success DEACTIVATED Data Jadwal',
                    showHideTransition: 'slide',
                    stack: false,
                    icon: 'success'
                    })</script>";
                } else if ($delResult && $status == 0) {
                    echo "
                    <script>$.toast({
                    heading: 'ACTIVATED',
                    text: 'Success ACTIVATED Data Jadwal',
                    showHideTransition: 'slide',
                    stack: false,
                    icon: 'success'
                    })</script>";
                } else {
                    echo '<script>alert("Error when deactivated data")</script>';
                }
        } else if ($btnDel == 2) {

            $delResult = $this->jadwalDao->deleteJadwal($type,$kelas,$hari);
                if ($delResult) {
                echo "
                <script>$.toast({
                heading: 'DELETE',
                text: 'Success DELETE Data Jadwal',
                showHideTransition: 'slide',
                stack: false,
                icon: 'error'
                })</script>";
                echo '<script>window.location = "index.php?menu=jadwal";</script>';
;
            } else {
                echo '<script>alert("Error when delete data")</script>';
            }
        }
    }

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
                        echo '<script>window.location = "index.php?menu=jadwal";</script>';
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

        // edit jadwal
        $btnUpdate = filter_input(INPUT_POST, 'btnUpdate');

        if (isset($btnUpdate)) {
            $idMatkul = strtok(filter_input(INPUT_POST, 'idMatkul'), " ");
            $dosen = filter_input(INPUT_POST, 'dosen');
            $hari = filter_input(INPUT_POST, 'hari');
            $jamMulai = filter_input(INPUT_POST, 'jamMulai');
            $jamSelesai = filter_input(INPUT_POST, 'jamSelesai');
            $tipe = filter_input(INPUT_POST, 'tipe');
            $kelas = filter_input(INPUT_POST, 'kelas');
            $semester = filter_input(INPUT_POST, 'semester');

            $jadwal = new Jadwal();
            // $jadwal->setIdMatkul($idMatkul);
            $jadwal->setKelas($kelas);
            $jadwal->setHari($hari);
            $jadwal->setJamAwal($jamMulai);
            $jadwal->setJamAkhir($jamSelesai);
            $jadwal->setType($tipe);
            $jadwal->setNipDosen($dosen);
            $jadwal->setIdSemester($semester);
            $jadwal->setIdMatkul($idMatkul);

            $result = $this->jadwalDao->updateJadwal($jadwal);

            if ($result) {
                echo "
                    <script>$.toast({
                    heading: 'Success',
                    text: 'Success Update Data Jadwal',
                    showHideTransition: 'slide',
                    stack: false,
                    icon: 'success'
                })</script>";
                echo '<script>window.location = "index.php?menu=jadwal";</script>';
            } else {
                echo "<script>$.toast({
                    heading: 'Error',
                    text: 'Failed Update Data',
                    showHideTransition: 'fade',
                    icon: 'error'
                })</script>";
            }
        }

        $dosenId = $this->dosenDao->fetchDosen($_SESSION['user_id'])->getNIP();
        $jadwal = $this->jadwalDao->fetchAllJadwal($dosenId);
        $dosen = $this->dosenDao->fetchDosenActive();
        $matkul = $this->mkDao->fetchMKstatus();
        $semester = $this->semesterDao->fetchAllSemester();
        include_once 'view/jadwal-view.php';
    }

}