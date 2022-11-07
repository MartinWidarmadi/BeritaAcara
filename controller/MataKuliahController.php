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
        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');

        if (isset($btnSubmit)) {
            header('location: index.php?menu=addmatkul');
        }

        $mk = $this->mkDao->fetchAllMK();
        include_once 'view/mataKuliah-view.php';
    }

    public function addIndex() {
        $btnSubmit = filter_input(INPUT_POST, 'addMatkul');
        if (isset($btnSubmit)) {
            $matkul = filter_input(INPUT_POST, 'matkul');
            $idmatkul = filter_input(INPUT_POST, 'IDmatkul');
            $namaprodi = filter_input(INPUT_POST, 'prodi');
            $prodi = $this->prodiDao->fetchProdi($namaprodi);
            var_dump($idmatkul);
            $result = $this->mkDao->checkIdMatkul($idmatkul);
            if ($result) {
                $message = "ID Mata Kuliah Telah Ada";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else if (empty($idmatkul) || empty($matkul) || empty($namaprodi)) {
                $message = "Please Fill all the blank field";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $matakuliah = new MataKuliah();
                $matakuliah->setIdMataKuliah($idmatkul);
                $matakuliah->setNamaMataKuliah($matkul);
                $matakuliah->setIdProdi($prodi->getIdProdi());
                $result2 = $this->mkDao->insertNewMataKuliah($matakuliah);
                if ($result2) {
                    echo '<div class="bg-success">Data succesfully added</div>';
                    header('location:?menu=matakuliah');
                } else {
                    echo '<div class="bg-danger">Error on add data</div>';
                }
            }
        }
        $prodis = $this->prodiDao->fetchNamaProdi();
        include_once 'view/addMataKuliah-view.php';
    }
}