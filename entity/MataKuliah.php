<?php

class MataKuliah
{
    private $idMataKuliah;
    private $NamaMataKuliah;
    private $Hari;
    private $Jam;
    private $idKelas;
    private $idProdi;

    /**
     * @return mixed
     */
    public function getIdMataKuliah()
    {
        return $this->idMataKuliah;
    }

    /**
     * @param mixed $idMataKuliah
     */
    public function setIdMataKuliah($idMataKuliah)
    {
        $this->idMataKuliah = $idMataKuliah;
    }

    /**
     * @return mixed
     */
    public function getNamaMataKuliah()
    {
        return $this->NamaMataKuliah;
    }

    /**
     * @param mixed $NamaMataKuliah
     */
    public function setNamaMataKuliah($NamaMataKuliah)
    {
        $this->NamaMataKuliah = $NamaMataKuliah;
    }

    /**
     * @return mixed
     */
    public function getHari()
    {
        return $this->Hari;
    }

    /**
     * @param mixed $Hari
     */
    public function setHari($Hari)
    {
        $this->Hari = $Hari;
    }

    /**
     * @return mixed
     */
    public function getJam()
    {
        return $this->Jam;
    }

    /**
     * @param mixed $Jam
     */
    public function setJam($Jam)
    {
        $this->Jam = $Jam;
    }

    /**
     * @return mixed
     */
    public function getIdKelas()
    {
        return $this->idKelas;
    }

    /**
     * @param mixed $idKelas
     */
    public function setIdKelas($idKelas)
    {
        $this->idKelas = $idKelas;
    }

    /**
     * @return mixed
     */
    public function getIdProdi()
    {
        return $this->idProdi;
    }

    /**
     * @param mixed $idProdi
     */
    public function setIdProdi($idProdi)
    {
        $this->idProdi = $idProdi;
    }

    public function __set($name,$value)
    {
        switch ($name) {
            case "Kelas_idKelas":
                $this->idKelas = $value;
                break;
            case "Prodi_idProdi":
                $this->idProdi = $value;
                break;
        }
    }

}