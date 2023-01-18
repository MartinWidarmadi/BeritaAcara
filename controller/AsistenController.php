<?php

class AsistenController
{
    private $asistenDao;
    public function __construct()
    {
        $this->asistenDao = new AsistenDaoImpl();
    }

    public function index(){
        $btnFilter = filter_input(INPUT_POST, 'btnFilter');
        if (isset($btnFilter)){
            $date1 = filter_input(INPUT_POST,'calendar2');
            $date2 = filter_input(INPUT_POST,'calendar3');
            $asdos = $this->asistenDao->fetchAsdosWithFilter($date1,$date2);
        }
        else{
            $asdos = $this->asistenDao->fetchAllAsdos();
        }

        include_once 'view/asisten-view.php';
    }
}