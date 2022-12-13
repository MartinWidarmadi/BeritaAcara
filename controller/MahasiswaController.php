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
            $delResult = $this->mkDao->deleteMatkul($delId);

            if ($delResult) {
                echo "
                <script>$.toast({
                heading: 'DELETE',
                text: 'Success DELETE Data Mahasiswa',
                showHideTransition: 'slide',
                stack: false,
                icon: 'error'
            })</script>";
                header('location: index.php?menu=matkul');
            } else {
                echo '<script>alert("Error when delete data")</script>';
            }
        }

        $submitPressed = filter_input(INPUT_POST, 'addMahasiswa');
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
        $btnBack = filter_input(INPUT_POST, 'btnBack');

        if (isset($btnBack)) {
            header('location: index.php?menu=mahasiswa');
        }

        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');

        if (isset($btnSubmit)) {
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