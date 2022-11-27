<?php

class AssistenDosen
{
    private $nipDosen;
    private $idMatkul;
    private $kodeKelas;
    private $idSemester;
    private $type;
    private $pertemuan;
    private $kelas;
    private $hari;
    private $nrpMahasiswa;
    private $jumlah_jam;

    /**
     * @return mixed
     */
    public function getNipDosen()
    {
        return $this->nipDosen;
    }

    /**
     * @param mixed $nipDosen
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
     * @param mixed $kodeKelas
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
     * @param mixed $idSemester
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

    /**
     * @return mixed
     */
    public function getNrpMahasiswa()
    {
        return $this->nrpMahasiswa;
    }

    /**
     * @param mixed $nrpMahasiswa
     */
    public function setNrpMahasiswa($nrpMahasiswa)
    {
        $this->nrpMahasiswa = $nrpMahasiswa;
    }

    /**
     * @return mixed
     */
    public function getJumlahJam()
    {
        return $this->jumlah_jam;
    }

    /**
     * @param mixed $jumlah_jam
     */
    public function setJumlahJam($jumlah_jam)
    {
        $this->jumlah_jam = $jumlah_jam;
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
        if (!isset($this->nrpMahasiswa)) {
            $this->nrpMahasiswa = new Mahasiswa();
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
            case "jadwal_Semester_id_Semester":
                $this->idSemester->setIdSemester($value);
                break;
            case "semester":
                $this->idSemester->setNamaSemester($value);
                break;
            case "Dosen_NIP":
                $this->nipDosen->setNIP($value);
                break;
            case "Mahasiswa_NRP":
                $this->nrpMahasiswa->setNRP($value);
                break;
            case "namaAsdos":
                $this->nrpMahasiswa->setNama($value);
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
        }
    }




}