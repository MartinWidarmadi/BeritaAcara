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

    public function fetchProdi($prodi) {
        $link = PDOUtil::connectDb();
        $query = 'SELECT * FROM Prodi WHERE NamaProdi = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$prodi);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt->fetchObject('Prodi');
    }

    public function fetchNamaProdi() {
        $link = PDOUtil::connectDb();
        $query = 'SELECT NamaProdi FROM Prodi';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Prodi');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }
}

?>