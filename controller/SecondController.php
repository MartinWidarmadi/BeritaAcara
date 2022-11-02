<?php 

class SecondController {
  private $dosenDao;
  private $jadwalDao;

  public function __construct() {
    $this->dosenDao = new DosenDaoImpl();
    $this->jadwalDao = new JadwalDaoImpl();
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
      $kodeKelas = $jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getKodeKelas();
      $semester = $jadwalDao->fetchJadwal($nipDosen, $idMatKul);
      $tipe = $jadwalDao->fetchJadwal($nipDosen, $idMatKul)->getType();
      $pertemuan = filter_input(INPUT_GET, 'idPertemuan');
      $tanggalPertemuan = filter_input(INPUT_POST, 'calendar');

      
    }

    include_once 'view/second-view.php';
  }
}

?>