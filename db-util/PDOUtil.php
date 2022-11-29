<?php 
class PDOUtil {
  public static function connectDb () {
    $link = new PDO('mysql:host=18.143.100.149;dbname=pbmdb', 'admindbs', '');
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $link;
  }
}

?>