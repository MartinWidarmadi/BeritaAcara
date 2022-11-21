<?php

class MataKuliahController
{

    private $mkDao;
    private $dosenDao;
    private $prodiDao;
    public function __construct()
    {
        $this->mkDao = new MataKuliahDaoImpl();
        $this->dosenDao = new DosenDaoImpl();
        $this->prodiDao = new ProdiDaoImpl();
    }
    public function index() {
        $btnDel = filter_input(INPUT_GET, 'delcom');
        if (isset($btnDel) && $btnDel == 1) {
            $delId = filter_input(INPUT_GET, 'mid');
            $delResult = $this->mkDao->deleteMatkul($delId);

            if ($delResult) {
                echo '<script>alert("Data delete success")</script>';
                header('location: index.php?menu=matkul');
            } else {
                echo '<script>alert("Error when delete data")</script>';
            }
        }

        $btnSubmit = filter_input(INPUT_POST, 'addMatkul');
        if (isset($btnSubmit)) {
            $matkul = filter_input(INPUT_POST, 'matkul');
            $idmatkul = filter_input(INPUT_POST, 'IDmatkul');
            $sks = filter_input(INPUT_POST, 'sks');
            $prodi = filter_input(INPUT_POST, 'prodi');
            $result = $this->mkDao->checkIdMatkul($idmatkul);
            if ($result) {
                $message = "ID Mata Kuliah Telah Ada";
                echo "<script type='text/javascript'>alert('$message');</>";
            } else if (empty($idmatkul) || empty($matkul) || empty($prodi)) {
                $message = "Please Fill all the blank field";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $matakuliah = new MataKuliah();
                $matakuliah->setIdMataKuliah($idmatkul);
                $matakuliah->setNamaMataKuliah($matkul);
                $matakuliah->setSKS($sks);
                $matakuliah->setIdProdi($prodi);
                $result2 = $this->mkDao->insertNewMataKuliah($matakuliah);
                if ($result2) {
                    echo '<div class="bg-success">Data succesfully added</div>';
                    header('location:?menu=matkul');
                } else {
                    echo '<div class="bg-danger">Error on add data</div>';
                }
            }
        }
        $prodis = $this->prodiDao->fetchAllProdi();
        $mk = $this->mkDao->fetchAllMK();
        include_once 'view/mataKuliah-view.php';
    }

    public function updateIndex() {
        $mkId = filter_input(INPUT_GET, 'mid');
        if (isset($mkId) && $mkId != '') {
            $mk = $this->mkDao->fetchMK($mkId);
        }

        $btnBack = filter_input(INPUT_POST, 'btnBack');

        if (isset($btnBack)) {
            header('location: index.php?menu=matkul');
        }

        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');

        if(isset($btnSubmit)) {
            $id = filter_input(INPUT_POST, 'IDmatkul');
            $nama = filter_input(INPUT_POST, 'namaMatkul');
            $sks = filter_input(INPUT_POST, 'sks');
            $prodi = filter_input(INPUT_POST, 'prodi');

            $checkIdMatkul = $this->mkDao->checkIdMatkul($id);

            if ($checkIdMatkul) {
                $message = 'Id Matakuliah sudah ada';
                echo "<script>alert('$message');</script>";
            } else {
                $matkul = new MataKuliah();
                $matkul->setIdMataKuliah($id);
                $matkul->setNamaMataKuliah($nama);
                $matkul->setSKS($sks);
                $matkul->setIdProdi($prodi);
    
                $result = $this->mkDao->updateMatkul($matkul, $mkId);

                if ($result) {
                    echo '<script>alert("Data insert success")</script>';
                    header('location: index.php?menu=matkul');
                } else {
                    echo '<script>alert("Data insert failed")</script>';
                }
            }

        }

        $prodis = $this->prodiDao->fetchAllProdi();
        include_once 'view/mataKuliah-edit-view.php';
    }
}