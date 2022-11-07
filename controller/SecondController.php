<?php

class SecondController
{
    private $dosenDao;
    private $jadwalDao;
    private $detailJadwalDao;
//    private $mahasiswaDao;

    public function __construct()
    {
        $this->dosenDao = new DosenDaoImpl();
        $this->jadwalDao = new JadwalDaoImpl();
        $this->detailJadwalDao = new DetailJadwalDaoImpl();
//        $this->mahasiswaDao = new MahasiswaDaoImpl();
    }

    public function index()
    {
        // ambil btn previous
        $btnPrev = filter_input(INPUT_POST, 'btnPrev');
        // kalo btn previous ditekan.
        if (isset($btnPrev)) {
            header('location: index.php?menu=home');
        }

        // ambil btn submit.
        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
        // kalo btnSubmit ditekan.
        if (isset($btnSubmit)) {
            $jadwalDao = $this->jadwalDao;
            $dosenDao = $this->dosenDao;
            // ambil value dari semua kolom input form
            $nipDosen = $dosenDao->fetchDosen($_SESSION['user_id'])->getNIP();
            $idMatKul = filter_input(INPUT_GET, 'idJadwal');
            $namaMatKul = $jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getIdMatkul()->getNamaMataKuliah();
            $tipe = strval($jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getType());
            $semester = $jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getIdSemester()->getIdSemester();
            $pertemuan = filter_input(INPUT_GET, 'idPertemuan');
            $tanggalPertemuan = filter_input(INPUT_POST, 'calendar');
            $waktuMulai = filter_input(INPUT_POST, 'timeStart');
            $waktuSelesai = filter_input(INPUT_POST, 'timeEnd');
            $jmlMahasiswa = filter_input(INPUT_POST, 'jumlahMahasiswa');
            $materi = filter_input(INPUT_POST, 'materi');
            $pbm = filter_input(INPUT_POST, 'pbm');
            $rangkuman = "Rangkuman Materi hari ini adalah{$materi}, dan keterangan pbmnya adalah {$pbm}";
            $kelas = $jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getKelas();

            if ($jmlMahasiswa < 0) {
                $message = "Jumlah Mahasiswa minimal 0 orang";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {

                $detailJadwal = new DetailJadwal();
                $detailJadwal->setJumlahMahasiswa($jmlMahasiswa);
                $detailJadwal->setNipDosen($nipDosen);
                $detailJadwal->setidMatkul($idMatKul);
                $detailJadwal->setIdSemester($semester);
                $detailJadwal->setType($tipe);
                $detailJadwal->setPertemuan($pertemuan);
                $detailJadwal->setTanggalPertemuan($tanggalPertemuan);
                $detailJadwal->setWaktuMulai($waktuMulai);
                $detailJadwal->setWaktuSelesai($waktuSelesai);
                $detailJadwal->setRangkuman($rangkuman);
                $detailJadwal->setKelas($kelas);

                if (isset($_FILES['photoFile']['name'])) {
                    $directory = 'uploads/';
                    $fileExtension = pathinfo($_FILES['photoFile']['name'], PATHINFO_EXTENSION);
                    $newFileName = $idMatKul . '_pertemuan' . $pertemuan . '_' . $tipe . '_kelas' . $kelas . '.' . $fileExtension;
                    $targetFile = $directory . $newFileName;

                    if ($_FILES['photoFile']['size'] > 1024 * 2048) {
                        echo '<div class="bg-error">Upload error. file size exceed 2MB</div>';
                        $result = $this->detailJadwalDao->insertNewDetailJadwal($detailJadwal);
                    } else {
                        move_uploaded_file($_FILES['photoFile']['tmp_name'], $targetFile);
                        $detailJadwal->setFotoPresensi($newFileName);
                        $result = $this->detailJadwalDao->insertNewDetailJadwal($detailJadwal);
                    }
                } else {
                    $result = $this->detailJadwalDao->insertNewDetailJadwal($detailJadwal);
                }
                if ($result) {
                    header('location: index.php?menu=home');
                } else {
                    echo '<div class="bg-error">Error on input data</div>';
                }
            }
        }

        include_once 'view/second-view.php';
    }
}

?>