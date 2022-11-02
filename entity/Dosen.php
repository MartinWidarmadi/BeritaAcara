<?php

class Dosen
{
    private $NIP;
    private $NamaDosen;
    private $Prodi_idProdi;
    private $MataKuliah_idMataKuliah;
    private $User_idUser;

    /**
     * @return mixed
     */
    public function getNIP()
    {
        return $this->NIP;
    }

    /**
     * @param mixed $NIP
     */
    public function setNIP($NIP)
    {
        $this->NIP = $NIP;
    }

    /**
     * @return mixed
     */
    public function getNamaDosen()
    {
        return $this->NamaDosen;
    }

    /**
     * @param mixed $NamaDosen
     */
    public function setNamaDosen($NamaDosen)
    {
        $this->NamaDosen = $NamaDosen;
    }

    /**
     * @return mixed
     */
    public function getProdiIdProdi()
    {
        return $this->Prodi_idProdi;
    }

    /**
     * @param mixed $Prodi_idProdi
     */
    public function setProdiIdProdi($Prodi_idProdi)
    {
        $this->Prodi_idProdi = $Prodi_idProdi;
    }

    /**
     * @return mixed
     */
    public function getMataKuliahIdMataKuliah()
    {
        return $this->MataKuliah_idMataKuliah;
    }

    /**
     * @param mixed $MataKuliah_idMataKuliah
     */
    public function setMataKuliahIdMataKuliah($MataKuliah_idMataKuliah)
    {
        $this->MataKuliah_idMataKuliah = $MataKuliah_idMataKuliah;
    }

    /**
     * @return mixed
     */
    public function getUserIdUser()
    {
        return $this->User_idUser;
    }

    /**
     * @param mixed $User_idUser
     */
    public function setUserIdUser($User_idUser)
    {
        $this->User_idUser = $User_idUser;
    }

    public function __set($name,$value){
        switch ($name){
            case "Prodi_idProdi":
                $this->Prodi_idProdi = $value;
                break;
            case "MataKuliah_idMataKuliah":
                $this->MataKuliah_idMataKuliah = $value;
                break;
        }
        if(!isset($this->user)) {
            $this->user = new User();
        }
        switch ($name) {
            case 'User_idUser':
                $this->user->setIdUser($value);
                break;
        }
    }


}