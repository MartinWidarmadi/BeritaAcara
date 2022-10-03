<?php

class Kelas
{
    private $idKelas;
    private $NamaKelas;

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
    public function getNamaKelas()
    {
        return $this->NamaKelas;
    }

    /**
     * @param mixed $NamaKelas
     */
    public function setNamaKelas($NamaKelas)
    {
        $this->NamaKelas = $NamaKelas;
    }
}