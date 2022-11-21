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
            $delResult = $this->mahasiswaDao->deleteMahasiswa($delId);

            if ($delResult) {
                echo '<script>alert("Data delete success")</script>';
                header('location: index.php?menu=mahasiswa');
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
                    echo '<div class="bg-success">Data succesfully added</div>';
                    header('location:?menu=mahasiswa');
                } else {
                    echo '<div class="bg-danger">Error on add data</div>';
                }
            }
        }
        $mahasiswa = $this->mahasiswaDao->fetchAllMahasiswa();
        include_once 'view/mahasiswa-view.php';
    }


    public function updateIndex()
    {
        $mId = filter_input(INPUT_GET, 'mid');
        if (isset($mId) && $mId != '') {
            $mahasiswa = $this->mahasiswaDao->fetchMahasiswa($mId);
        }

        $btnBack = filter_input(INPUT_POST, 'btnBack');

        if (isset($btnBack)) {
            header('location: index.php?menu=mahasiswa');
        }

        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');

        if (isset($btnSubmit)) {
            $nrp = filter_input(INPUT_POST, 'nrp');
            $nama = filter_input(INPUT_POST, 'nama');
            $alamat = filter_input(INPUT_POST, 'alamat');
            $no_tlp = filter_input(INPUT_POST, 'no_tlp');

            $mhs = new Mahasiswa();
            $mhs->setNRP($nrp);
            $mhs->setNama($nama);
            $mhs->setAlamat($alamat);
            $mhs->setNoTlp($no_tlp);

            $result = $this->mahasiswaDao->updateMahasiswa($mhs, $mId);

            if ($result) {
                echo '<script>alert("Data update success")</script>';
                header('location: index.php?menu=mahasiswa');
            } else {
                echo '<script>alert("Data update failed")</script>';
            }
        }

        include_once 'view/mahasiswa-edit-view.php';
    }
}