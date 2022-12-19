<?php

class MahasiswaController
{
    private $mahasiswaDao;

    public function __construct()
    {
        $this->mahasiswaDao = new MahasiswaDaoImpl();
    }

    public function index()
    {
        $btnDel = filter_input(INPUT_GET, 'delcom');
        if (isset($btnDel) && $btnDel == 1) {
            $delId = filter_input(INPUT_GET, 'mid');
            $status = filter_input(INPUT_GET, 'aktif');
            $status = !$status;
            $delResult = $this->mahasiswaDao->statusMahasiswa($delId, $status);

            if ($delResult) {
                echo "
                <script>$.toast({
                heading: 'DEACTIVATED',
                text: 'Success DEACTIVATED Data Mahasiswa',
                showHideTransition: 'slide',
                stack: false,
                icon: 'success'
            })</script>";
            } else {
                echo '<script>alert("Success deactivated data")</script>';
            }
        } elseif (isset($btnDel) && $btnDel == 2) {
            $delId = filter_input(INPUT_GET, 'mid');
            $delResult = $this->mahasiswaDao->deleteMahasiswa($delId);

            if ($delResult) {
                echo "
                <script>$.toast({
                heading: 'DELETE',
                text: 'Success DELETE Data Mahasiswa',
                showHideTransition: 'slide',
                stack: false,
                icon: 'error'
            })</script>";
            } else {
                echo '<script>alert("Error when delete data")</script>';
            }
        }

        $submitPressed = filter_input(INPUT_POST, 'addMahasiswa');
        $mahasiswafile = filter_input(INPUT_POST, 'btnBatchFile');
        if (isset($submitPressed)) {
            $nrp = filter_input(INPUT_POST, 'nrp');
            $nama = filter_input(INPUT_POST, 'nama');
            $alamat = filter_input(INPUT_POST, 'alamat');
            $notelp = filter_input(INPUT_POST, 'notelp');
            $result = $this->mahasiswaDao->checkNRP($nrp);
            if ($result) {
                $message = "NRP Sudah Digunakan";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } elseif (empty($nrp) || empty($nama) || empty($alamat) || empty($notelp)) {
                $message = "Please Fill all the blank field";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $mahasiswa = new Mahasiswa();
                $mahasiswa->setNRP($nrp);
                $mahasiswa->setNama($nama);
                $mahasiswa->setAlamat($alamat);
                $mahasiswa->setNoTlp($notelp);
                $result2 = $this->mahasiswaDao->insertNewMahasiswa($mahasiswa);
                if ($result2) {
                    echo "
                <script>$.toast({
                heading: 'Success',
                text: 'Success Add Data Mahasiswa',
                showHideTransition: 'slide',
                stack: false,
                icon: 'success'
            })</script>";
                } else {
                    echo '<div class="bg-danger">Error on add data</div>';
                }
            }
        }
        else if (isset($mahasiswafile)){
            if (isset($_FILES['mahasiswaFile']['name']) && $_FILES['mahasiswaFile']['name'] != '') {
                $directory = 'uploads/';
                $fileExtension = pathinfo($_FILES['mahasiswaFile']['name'], PATHINFO_EXTENSION);
                $newFileName = 'Tanggal' . date("d M Y H i s") . '.' . $fileExtension;
                $targetFile = $directory . $newFileName;
                move_uploaded_file($_FILES['mahasiswaFile']['tmp_name'],$targetFile);
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetFile);
                $data = $spreadsheet->getActiveSheet()->toArray(null, true, true , true);
                foreach ($data as $index=> $mahasiswa){
                    $filemahasiswa = new Mahasiswa();
                    $filemahasiswa->setNRP($mahasiswa["A"]);
                    $filemahasiswa->setNama($mahasiswa["B"]);
                    $filemahasiswa->setAlamat($mahasiswa["C"]);
                    $filemahasiswa->setNoTlp($mahasiswa["D"]);
                    $result3 = $this->mahasiswaDao->insertNewMahasiswa($filemahasiswa);
                }
                if ($result3) {
                    echo "
                                    <script>$.toast({
                        heading: 'Success',
                        text: 'Success Add Batch Data mahasiswa',
                        showHideTransition: 'slide',
                        stack: false,
                        icon: 'success'
                    })</script>";
                } else {
                    echo "<script>$.toast({
                            heading: 'Error',
                            text: 'Failed Add Batch Data mahasiswa',
                            stack: false,
                            showHideTransition: 'fade',
                            icon: 'error'
                    })</script>";
                }
            } else {
                echo "<script>$.toast({
                            heading: 'Error',
                            text: 'Please Input File First',
                            stack: false,
                            showHideTransition: 'fade',
                            icon: 'error'
                    })</script>";
            }
        }
        

        $btnSubmits = filter_input(INPUT_POST, 'btnSubmit');

        if (isset($btnSubmits)) {
            $nrps = filter_input(INPUT_POST, 'nrps');
            $namas = filter_input(INPUT_POST, 'namas');
            $alamats = filter_input(INPUT_POST, 'alamats');
            $no_tlps = filter_input(INPUT_POST, 'no_tlps');

            $mhs = new Mahasiswa();
            $mhs->setNama($namas);
            $mhs->setAlamat($alamats);
            $mhs->setNoTlp($no_tlps);
            $mhs->setNRP($nrps);

            $result = $this->mahasiswaDao->updateMahasiswa($mhs);

            if ($result) {
                echo "
                <script>$.toast({
    heading: 'Success',
    text: 'Success Update Data Mahasiswa',
    showHideTransition: 'slide',
    stack: false,
    icon: 'success'
})</script>";
            } else {
                echo "<script>$.toast({
    heading: 'Error',
    text: 'Failed Update Data',
    showHideTransition: 'fade',
    icon: 'error'
})</script>";
            }
        }

        $mahasiswa = $this->mahasiswaDao->fetchAllMahasiswa();
        include_once 'view/mahasiswa-view.php';
    }
}