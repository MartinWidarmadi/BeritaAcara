<?php 

class SecondController {
  private $dosenDao;
  private $jadwalDao;
  private $detailJadwalDao;

  public function __construct() {
    $this->dosenDao = new DosenDaoImpl();
    $this->jadwalDao = new JadwalDaoImpl();
    $this->detailJadwalDao = new DetailJadwalDaoImpl();
  }

  public function index() {
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
      $tipe = strval($jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getType());
      $semester = $jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getIdSemester()->getIdSemester();
      $kodeKelas = $jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getKodeKelas();
      $pertemuan = filter_input(INPUT_GET, 'idPertemuan');
      $tanggalPertemuan = filter_input(INPUT_POST, 'calendar');
      $waktuMulai = filter_input(INPUT_POST, 'timeStart');
      $waktuSelesai = filter_input(INPUT_POST, 'timeEnd');
      $jmlMahasiswa = filter_input(INPUT_POST, 'jumlahMahasiswa');
      $materi = filter_input(INPUT_POST, 'materi');
      $pbm = filter_input(INPUT_POST, 'pbm');
      $rangkuman = "Jumlah Mahasiswanya adalah {$jmlMahasiswa} orang, materinya adalah {$materi}, dan keterangan pbmnya adalah {$pbm}";

      var_dump("{$pertemuan}");

      $detailJadwal = new DetailJadwal();
      $detailJadwal->setNipDosen($nipDosen);
      $detailJadwal->setidMatkul($idMatKul);
      $detailJadwal->setKodeKelas($kodeKelas);
      $detailJadwal->setIdSemester($semester);
      $detailJadwal->setType($tipe);
      $detailJadwal->setPertemuan($pertemuan);
      $detailJadwal->setTanggalPertemuan($tanggalPertemuan);
      $detailJadwal->setWaktuMulai($waktuMulai);
      $detailJadwal->setWaktuSelesai($waktuSelesai);
      $detailJadwal->setRangkuman($rangkuman);

      if (isset($_FILES['photoFile']['name']) && ($_FILES['photoFile']['name'] != '')) {
        $directory = 'uploads/';
        $fileExtension = pathinfo($_FILES['photoFile']['name'], PATHINFO_EXTENSION);
        $newFileName = "{$detailJadwal->getIdMatkul()}_pertemuan{$detailJadwal->getPertemuan()}_{$detailJadwal->getType()}";
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

    include_once 'view/second-view.php';
  }
}

?>