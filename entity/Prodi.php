<?php

class Prodi
{
    private $idProdi;
    private $NamaProdi;

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

    /**
     * @return mixed
     */
    public function getNamaProdi()
    {
        return $this->NamaProdi;
    }

    /**
     * @param mixed $NamaProdi
     */
    public function setNamaProdi($NamaProdi)
    {
        $this->NamaProdi = $NamaProdi;
    }
}