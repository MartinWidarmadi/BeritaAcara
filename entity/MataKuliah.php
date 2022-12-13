<?php

class MataKuliah
{
    private $idMataKuliah;
    private $NamaMataKuliah;
    private $Hari;
    private $Jam;
    private $idKelas;
    private $idProdi;
    private $SKS;
    private $status;

    /**
     * @return mixed
     */
    public function getSKS()
    {
        return $this->SKS;
    }

    /**
     * @param mixed $SKS
     */
    public function setSKS($SKS)
    {
        $this->SKS = $SKS;
    }

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
        if (!isset($this->idProdi)) {
            $this->idProdi = new Prodi();
        }

        switch ($name) {
            case "prodi":
                $this->idProdi->setNamaProdi($value);
                break;
            case "Kelas_idKelas":
                $this->idKelas = $value;
                break;
            case "Prodi_idProdi":
                $this->idProdi = $value;
                break;
        }
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}