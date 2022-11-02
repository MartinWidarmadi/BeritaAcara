<?php 

class MataKuliahDaoImpl {
  public function fetchAllMataKuliah($idMataKuliah) {
    $link = PDOUtil::connectDb();
    $query = 'SELECT MataKuliah.* FROM MataKuliah JOIN Dosen ON Dosen.MataKuliah_idMataKuliah = MataKuliah.idMataKuliah WHERE MataKuliah.idMataKuliah = ? ORDER BY idMataKuliah';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $idMataKuliah);
    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'MataKuliah');
    $stmt->execute();
    $link = null;
    return $stmt->fetchAll();
  }
}

?>