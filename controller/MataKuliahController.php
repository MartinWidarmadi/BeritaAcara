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

    public function index()
    {
        $btnDel = filter_input(INPUT_GET, 'delcom');
        if (isset($btnDel) && $btnDel == 1) {
            $delId = filter_input(INPUT_GET, 'mid');
            $delResult = $this->mkDao->deleteMatkul($delId);

            if ($delResult) {
                echo "
                <script>$.toast({
                heading: 'DELETED',
                text: 'Success DELETE Data Matakuliah',
                showHideTransition: 'slide',
                stack: false,
                icon: 'error'
            })</script>";
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
                    echo "
                <script>$.toast({
                heading: 'Success',
                text: 'Success Add Data Matakuliah',
                showHideTransition: 'slide',
                stack: false,
                icon: 'success'
            })</script>";
                } else {
                    echo '<div class="bg-danger">Error on add data</div>';
                }
            }
        }

        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');

        if (isset($btnSubmit)) {
            $id = filter_input(INPUT_POST, 'IDmatkul');
            $nama = filter_input(INPUT_POST, 'namaMatkul');
            $sks = filter_input(INPUT_POST, 'sks');
            $prodi = filter_input(INPUT_POST, 'prodi');


            $matkul = new MataKuliah();
            $matkul->setIdMataKuliah($id);
            $matkul->setNamaMataKuliah($nama);
            $matkul->setSKS($sks);
            $matkul->setIdProdi($prodi);

            $result = $this->mkDao->updateMatkul($matkul);

            if ($result) {
                echo "
                <script>$.toast({
                heading: 'Success',
                text: 'Success Update Data Matakuliah',
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
        $prodis = $this->prodiDao->fetchAllProdi();
        $mk = $this->mkDao->fetchAllMK();
        include_once 'view/mataKuliah-view.php';
    }
}