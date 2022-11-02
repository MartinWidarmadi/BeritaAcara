<?php 

class DetailJadwal {
  private $nipDosen;
  private $idJadwal;
  private $kodeKelas;
  private $idSemester;
  private $type;
  private $pertemuan;
  private $tanggalPertemuan;

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
     * @return mixed $idJadwal
     */
    public function getIdJadwal()
    {
        return $this->idJadwal;
    }

    /**
     * @param mixed $idKelas
     */
    public function setidJadwal($idJadwal)
    {
        $this->idJadwal = $idJadwal;
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
            $this->idJadwal = $value;
            break;
          case "jadwal_kode_kelas":
            $this->kodeKelas = $value;
            break;
          case "jadwal_type":
            $this->type = $value;
            break;
          case "tanggal_pertemuan":
            $this->tanggalPertemuan = $value;
            break;
          case "jadwal_Semester_id_Semester":
            $this->idSemester->setIdSemester($value);
            break;
          case "Dosen_NIP":
            $this->nipDosen->setNIP($value);
            break;
          case "jadwal_MataKuliah_idMataKuliah":
            $this->idMatkul->setIdMataKuliah($value);
            break;
          case "matakuliah":
            $this->idMatkul->setNamaMataKuliah($value);
            break;
        }
    }
  }

?>