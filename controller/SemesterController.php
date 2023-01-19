<?php

class SemesterController
{
    private $semesterDao;
    public function __construct()
    {
        $this->semesterDao = new SemesterDaoImpl();
    }

    public function index(){
        $btnDel = filter_input(INPUT_GET, 'delcom');
        if (isset($btnDel) && $btnDel == 2) {
            $delId = filter_input(INPUT_GET, 'sid');
            $delResult = $this->semesterDao->deleteSemester($delId);

            if ($delResult) {
                echo "
                    <script>$.toast({
                    heading: 'DELETE',
                    text: 'Success DELETE Data Semester',
                    showHideTransition: 'slide',
                    stack: false,
                    icon: 'error'
                })</script>";
            } else {
                echo "
                    <script>$.toast({
                    heading: 'ERROR',
                    text: 'WHEN DELETE DATA ',
                    showHideTransition: 'slide',
                    stack: false,
                    icon: 'error'
                })</script>";
            }
        }
        $btnAdd = filter_input(INPUT_POST,'addSemester');
        if (isset($btnAdd)){
            $nama = filter_input(INPUT_POST, 'nama');
            $smtr = new Semester();
            $smtr->setNamaSemester($nama);
            $result = $this->semesterDao->insertNewSemester($smtr);
            if ($result){
                echo "
                <script>$.toast({
                heading: 'Success',
                text: 'Success Add Data Semester',
                showHideTransition: 'slide',
                stack: false,
                icon: 'success'
            })</script>";
            } else {
                echo "
                <script>$.toast({
                heading: 'Error',
                text: 'Add Data Semester',
                showHideTransition: 'slide',
                stack: false,
                icon: 'error'
            })</script>";
            }
        }

        $btnUpdate = filter_input(INPUT_POST,'btnUpdate');
        if (isset($btnUpdate)){
            $id = filter_input(INPUT_POST,'id');
            $nama = filter_input(INPUT_POST,'nama');
            $smtrs = new Semester();
            $smtrs->setIdSemester($id);
            $smtrs->setNamaSemester($nama);
            $result2 = $this->semesterDao->updateSemester($smtrs);
            if ($result2){
                echo "
                <script>$.toast({
                heading: 'Success',
                text: 'Success Update Data Semester',
                showHideTransition: 'slide',
                stack: false,
                icon: 'success'
            })</script>";
            } else {
                echo "
                <script>$.toast({
                heading: 'Error',
                text: 'Update Data Semester',
                showHideTransition: 'slide',
                stack: false,
                icon: 'error'
            })</script>";
            }

        }
        $semester = $this->semesterDao->fetchAllSemester();
        include_once 'view/semester-view.php';
    }
}