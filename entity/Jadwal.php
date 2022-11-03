<?php 

class Jadwal {
  private $idJadwal;
  private $kodeKelas;
  private $hari;
  private $jamAwal;
  private $jamAkhir;
  private $idSemester;
  private $nipDosen;
  private $idMatkul;
  private $type;
  private $kelas;

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
    public function getHari()
    {
        return $this->hari;
    }

    /**
     * @param mixed $Hari
     */
    public function setHari($hari)
    {
        $this->Hari = $hari;
    }

    /**
     * @return mixed
     */
    public function getJamAwal()
    {
        return $this->jamAwal;
    }

    /**
     * @param mixed $JamAwal
     */
    public function setJamAwal($jamAwal)
    {
        $this->jamAwal = $jamAwal;
    }

    /**
     * @return mixed
     */
    public function getJamAkhir()
    {
        return $this->jamAkhir;
    }

    /**
     * @param mixed $JamAkhir
     */
    public function setJamAkhir($jamAkhir)
    {
        $this->jamAkhir = $jamAkhir;
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
     * @param mixed $IdMatkul
     */
    public function setIdMatkul($idMatkul)
    {
        $this->idMatkul = $idMatkul;
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
          case "id_jadwal":
            $this->idJadwal = $value;
            break;
          case "kode_kelas":
            $this->kodeKelas = $value;
            break;
          case "jam_awal":
            $this->jamAwal = $value;
            break;
          case "jam_akhir":
            $this->jamAkhir = $value;
            break;
          case "Semester_id_Semester":
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
          case "MataKuliah_idMataKuliah":
            $this->idMatkul->setIdMataKuliah($value);
            break;
          case "matakuliah":
            $this->idMatkul->setNamaMataKuliah($value);
            break;
        }
    }

}

?>