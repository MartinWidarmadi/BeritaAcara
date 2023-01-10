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
            $rangkuman = "Rangkuman Materi hari ini adalah {$materi}, dan keterangan pbmnya adalah {$pbm}";
            $asdos1 = filter_input(INPUT_POST,'asdos1');
            $asdos2 = filter_input(INPUT_POST,'asdos2');
            $asdos3 = filter_input(INPUT_POST,'asdos3');
            $kelas = $jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getKelas();
            $hari = $jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getHari();
            var_dump($kelas);
            var_dump($tipe);
            var_dump($idMatKul);
            var_dump($nipDosen);
            var_dump($semester);
            var_dump($hari);
            $time1 = filter_input(INPUT_POST,'time1');
            $time2 = filter_input(INPUT_POST,'time2');
            $time3 = filter_input(INPUT_POST,'time3');

            if ($asdos1 != NULL){
                $asdos1 = explode("-",$asdos1);
                $namaAsdos1 = trim($asdos1[0]);
                $nrpAsdos1 = trim($asdos1[1]);
            }
            if ($asdos2 != NULL){
                $asdos2 = explode("-",$asdos2);
                $namaAsdos2 = trim($asdos2[0]);
                $nrpAsdos2 = trim($asdos2[1]);
            }

            if ($asdos3 != NULL){
                $asdos3 = explode("-",$asdos3);
                $namaAsdos3 = trim($asdos3[0]);
                $nrpAsdos3 = trim($asdos3[1]);
            }




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
                $detailJadwal->setTanggalPertemuan(date($tanggalPertemuan));
                $detailJadwal->setWaktuMulai($waktuMulai);
                $detailJadwal->setWaktuSelesai($waktuSelesai);
                $detailJadwal->setRangkuman($rangkuman);
                $detailJadwal->setKelas($kelas);
                $detailJadwal->setHari($hari);

                if ($asdos1 != NULL){
                    $assistendosen1 = new AssistenDosen();

                    $assistendosen1->setKelas($kelas);
                    $assistendosen1->setHari($jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getHari());
                    $assistendosen1->setIdMatkul($idMatKul);
                    $assistendosen1->setIdSemester($semester);
                    $assistendosen1->setJumlahJam($time1);
                    $assistendosen1->setNipDosen($nipDosen);
                    $assistendosen1->setNrpMahasiswa($nrpAsdos1);
                    $assistendosen1->setPertemuan($pertemuan);
                    $assistendosen1->setType($tipe);
                    $assistendosen1->setTanggal(date($tanggalPertemuan));
                }

                if ($asdos2 != NULL){
                    $assistendosen2 = new AssistenDosen();

                    $assistendosen2->setKelas($kelas);
                    $assistendosen2->setHari($jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getHari());
                    $assistendosen2->setIdMatkul($idMatKul);
                    $assistendosen2->setIdSemester($semester);
                    $assistendosen2->setJumlahJam($time1);
                    $assistendosen2->setNipDosen($nipDosen);
                    $assistendosen2->setNrpMahasiswa($nrpAsdos1);
                    $assistendosen2->setPertemuan($pertemuan);
                    $assistendosen2->setType($tipe);
                    $assistendosen2->setTanggal(date($tanggalPertemuan));
                }

                if ($asdos3 != NULL){
                    $assistendosen3 = new AssistenDosen();

                    $assistendosen3->setKelas($kelas);
                    $assistendosen3->setHari($jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getHari());
                    $assistendosen3->setIdMatkul($idMatKul);
                    $assistendosen3->setIdSemester($semester);
                    $assistendosen3->setJumlahJam($time1);
                    $assistendosen3->setNipDosen($nipDosen);
                    $assistendosen3->setNrpMahasiswa($nrpAsdos1);
                    $assistendosen3->setPertemuan($pertemuan);
                    $assistendosen3->setType($tipe);
                    $assistendosen3->setTanggal(date($tanggalPertemuan));
                }


                if (isset($_FILES['photoFile']['name'])) {
                    $directory = 'uploads/';
                    $fileExtension = pathinfo($_FILES['photoFile']['name'], PATHINFO_EXTENSION);
                    $newFileName = $idMatKul . '_pertemuan' . $pertemuan . '_' . $tipe . '_kelas' . $kelas . '.' . $fileExtension;
                    $targetFile = $directory . $newFileName;

                    if ($_FILES['photoFile']['size'] > 1024 * 2048) {
                        echo '<div class="bg-error">Upload error. file size exceed 2MB</div>';
                        $result = $this->detailJadwalDao->insertNewDetailJadwal($detailJadwal);
                        if ($asdos1 != NULL){
                            $this->detailJadwalDao->insertNewAsdos($assistendosen1);
                        }

                        if ($asdos2 != NULL){
                            $this->detailJadwalDao->insertNewAsdos($assistendosen2);
                        }

                        if ($asdos3 != NULL){
                            $this->detailJadwalDao->insertNewAsdos($assistendosen3);
                        }

                    } else {
                        move_uploaded_file($_FILES['photoFile']['tmp_name'], $targetFile);
                        $detailJadwal->setFotoPresensi($newFileName);
                        $result = $this->detailJadwalDao->insertNewDetailJadwal($detailJadwal);
                        if ($asdos1 != NULL){
                            $this->detailJadwalDao->insertNewAsdos($assistendosen1);
                        }

                        if ($asdos2 != NULL){
                            $this->detailJadwalDao->insertNewAsdos($assistendosen2);
                        }

                        if ($asdos3 != NULL){
                            $this->detailJadwalDao->insertNewAsdos($assistendosen3);
                        }
                    }
                } else {
                    $result = $this->detailJadwalDao->insertNewDetailJadwal($detailJadwal);
                    if ($asdos1 != NULL){
                        $this->detailJadwalDao->insertNewAsdos($assistendosen1);
                    }

                    if ($asdos2 != NULL){
                        $this->detailJadwalDao->insertNewAsdos($assistendosen2);
                    }

                    if ($asdos3 != NULL){
                        $this->detailJadwalDao->insertNewAsdos($assistendosen3);
                    }

                }
                if ($result) {
                    header('location: index.php?menu=acara');
                } else {
                    echo '<div class="bg-error">Error on input data</div>';
                }
            }
        }

        include_once 'view/second-view.php';
    }
}

?>