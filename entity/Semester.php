<?php 
class Semester {
  private $idSemester;
  private $namaSemester;

   /**
     * @return mixed $idSemester
     */
    public function getIdSemester()
    {
        return $this->idSemester;
    }

    /**
     * @param mixed $idKelas
     */
    public function setIdSemester($idSemester)
    {
        $this->idSemester = $idSemester;
    }

   /**
     * @return mixed $namaSemester
     */
    public function getNamaSemester()
    {
        return $this->namaSemester;
    }

    /**
     * @param mixed $idKelas
     */
    public function setNamaSemester($namaSemester)
    {
        $this->namaSemester = $namaSemester;
    }
    
    public function __set($name, $value) {
      switch ($name) {
        case 'id_Semester':
          $this->idSemester = $value;
          break;
        case 'nama_semester':
          $this->namaSemester = $value;
          break;
      }
    }
  }
?>