<?php 

class ProdiDaoImpl {
  public function fetchAllProdi() {
    $link = PDOUtil::connectDb();
    $query = 'SELECT * FROM Prodi ORDER BY idProdi';
    $stmt = $link->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Prodi');
    $stmt->execute();
    $link = null;
    return $stmt->fetchAll();
  }
}

?>