<?php 

class SecondController {
  public function index() {
    $btnPrev = filter_input(INPUT_POST, 'btnPrev');
    if (isset($btnPrev)) {
      header('location: index.php?menu=home');
    }

    include_once 'view/second-view.php';
  }
}

?>