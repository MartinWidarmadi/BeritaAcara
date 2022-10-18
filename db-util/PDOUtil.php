<?php 
class PDOUtil {
  public static function connectDb () {
    $link = new PDO('mysql:host=localhost;dbname=pbmdb', 'root', '');
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $link;
  }
}

?>