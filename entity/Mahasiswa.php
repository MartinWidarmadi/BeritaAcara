<?php

class Mahasiswa implements JsonSerializable
{
    private $NRP;
    private $Nama;
    private $alamat;
    private $no_tlp;
    private $status;

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

    /**
     * @return mixed
     */
    public function getNRP()
    {
        return $this->NRP;
    }

    /**
     * @param mixed $NRP
     */
    public function setNRP($NRP)
    {
        $this->NRP = $NRP;
    }

    /**
     * @return mixed
     */
    public function getNama()
    {
        return $this->Nama;
    }

    /**
     * @param mixed $Nama
     */
    public function setNama($Nama)
    {
        $this->Nama = $Nama;
    }

    /**
     * @return mixed
     */
    public function getAlamat()
    {
        return $this->alamat;
    }

    /**
     * @param mixed $alamat
     */
    public function setAlamat($alamat)
    {
        $this->alamat = $alamat;
    }

    /**
     * @return mixed
     */
    public function getNoTlp()
    {
        return $this->no_tlp;
    }

    /**
     * @param mixed $no_tlp
     */
    public function setNoTlp($no_tlp)
    {
        $this->no_tlp = $no_tlp;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}