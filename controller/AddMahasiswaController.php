<?php

class AddMahasiswaController
{
    private $mahasiswaDao;
    public function __construct()
    {
        $this->mahasiswaDao = new MahasiswaDaoImpl();
    }

    public function index() {
        $submitPressed = filter_input(INPUT_POST, 'addMahasiswa');
        if (isset($submitPressed)) {
            $nrp = filter_input(INPUT_POST, 'nrp');
            $nama = filter_input(INPUT_POST, 'nama');
            $alamat = filter_input(INPUT_POST,'alamat');
            $notelp = filter_input(INPUT_POST,'notelp');
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
        include_once 'view/addMahasiswa-view.php';
    }
}