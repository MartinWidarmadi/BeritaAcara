<?php 

class DetailJadwal {
  private $nipDosen;
  private $idMatkul;
  private $kodeKelas;
  private $idSemester;
  private $type;
  private $pertemuan;
  private $tanggalPertemuan;
  private $waktuMulai;
  private $waktuSelesai;
  private $rangkuman;
  private $fotoPresensi;
  private $kelas;
  private $hari;
  public $asisten;

    /**
     * @return mixed
     */
    public function getHari()
    {
        return $this->hari;
    }

    /**
     * @param mixed $hari
     */
    public function setHari($hari)
    {
        $this->hari = $hari;
    }
  private $jumlah_mahasiswa;

    /**
     * @return mixed
     */
    public function getJumlahMahasiswa()
    {
        return $this->jumlah_mahasiswa;
    }

    /**
     * @param mixed $jumlah_mahasiswa
     */
    public function setJumlahMahasiswa($jumlah_mahasiswa)
    {
        $this->jumlah_mahasiswa = $jumlah_mahasiswa;
    }

  /**
     * @return mixed
     */
    public function getNipDosen()
    {
        return $this->nipDosen;
    }

    /**
     * @param mixed $NipDosen
     */
    public function setNipDosen($nipDosen)
    {
        $this->nipDosen = $nipDosen;
    }

  /**
     * @return mixed
     */
    public function getIdMatkul()
    {
        return $this->idMatkul;
    }

    /**
     * @param mixed $idMatkul
     */
    public function setIdMatkul($idMatkul)
    {
        $this->idMatkul = $idMatkul;
    }

    /**
     * @return mixed
     */
    public function getKodeKelas()
    {
        return $this->kodeKelas;
    }

    /**
     * @param mixed $KodeKelas
     */
    public function setKodeKelas($kodeKelas)
    {
        $this->kodeKelas = $kodeKelas;
    }

    /**
     * @return mixed
     */
    public function getIdSemester()
    {
        return $this->idSemester;
    }

    /**
     * @param mixed $IdSemester
     */
    public function setIdSemester($idSemester)
    {
        $this->idSemester = $idSemester;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPertemuan()
    {
        return $this->pertemuan;
    }

    /**
     * @param mixed $pertemuan
     */
    public function setPertemuan($pertemuan)
    {
        $this->pertemuan = $pertemuan;
    }

    /**
     * @return mixed
     */
    public function getTanggalPertemuan()
    {
        return $this->tanggalPertemuan;
    }

    /**
     * @param mixed $tanggalPertemuan
     */
    public function setTanggalPertemuan($tanggalPertemuan)
    {
        $this->tanggalPertemuan = $tanggalPertemuan;
    }

    /**
     * @return mixed
     */
    public function getWaktuMulai()
    {
        return $this->waktuMulai;
    }

    /**
     * @param mixed $waktuMulai
     */
    public function setWaktuMulai($waktuMulai)
    {
        $this->waktuMulai = $waktuMulai;
    }

    /**
     * @return mixed
     */
    public function getWaktuSelesai()
    {
        return $this->waktuSelesai;
    }

    /**
     * @param mixed $waktuSelesai
     */
    public function setWaktuSelesai($waktuSelesai)
    {
        $this->waktuSelesai = $waktuSelesai;
    }

    /**
     * @return mixed
     */
    public function getRangkuman()
    {
        return $this->rangkuman;
    }

    /**
     * @param mixed $rangkuman
     */
    public function setRangkuman($rangkuman)
    {
        $this->rangkuman = $rangkuman;
    }

    /**
     * @return mixed
     */
    public function getFotoPresensi()
    {
        return $this->fotoPresensi;
    }

    /**
     * @param mixed $fotoPresensi
     */
    public function setFotoPresensi($fotoPresensi)
    {
        $this->fotoPresensi = $fotoPresensi;
    }

    /**
     * @return mixed
     */
    public function getKelas()
    {
        return $this->kelas;
    }

    /**
     * @param mixed $kelas
     */
    public function setKelas($kelas)
    {
        $this->kelas = $kelas;
    }

    public function __set($name,$value)
    {
      if (!isset($this->idSemester)) {
        $this->idSemester = new Semester();
      }
      if (!isset($this->nipDosen)) {
        $this->nipDosen = new Dosen();
      }
      if (!isset($this->idMatkul)) {
        $this->idMatkul = new Matakuliah();
      }

        switch ($name) {
          case "jadwal_Dosen_NIP":
            $this->nipDosen->setNIP($value);
            break;
          case "jadwal_kode_kelas":
            $this->kodeKelas = $value;
            break;
          case "jadwal_type":
            $this->type = $value;
            break;
          case "jadwal_kelas":
            $this->kelas = $value;
            break;
          case "jadwal_hari":
            $this->hari = $value;
            break;
          case "tanggal_pertemuan":
            $this->tanggalPertemuan = $value;
            break;
          case "jadwal_Semester_id_Semester":
            $this->idSemester->setIdSemester($value);
            break;
          case "semester":
            $this->idSemester->setNamaSemester($value);
            break;
          case "Dosen_NIP":
            $this->nipDosen->setNIP($value);
            break;
          case "namadosen":
            $this->nipDosen->setNamaDosen($value);
            break;
          case "jadwal_MataKuliah_idMataKuliah":
            $this->idMatkul->setIdMataKuliah($value);
            break;
          case "matakuliah":
            $this->idMatkul->setNamaMataKuliah($value);
            break;
          case "tanggal_pertemuan":
            $this->tanggalPertemuan = $value;
            break;
          case "waktu_mulai":
            $this->waktuMulai = $value;
            break;
          case "waktu_selesai":
            $this->waktuSelesai = $value;
            break;
          case "foto_presensi":
            $this->fotoPresensi = $value;
            break;
        }
    }
  }

?>