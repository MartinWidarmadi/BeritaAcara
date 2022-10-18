<?php 

class MataKuliahDaoImpl {
  public function fetchAllMataKuliah($idMataKuliah, $idProdi) {
    $link = PDOUtil::connectDb();
    $query = 'SELECT MataKuliah.* FROM MataKuliah JOIN Dosen ON Dosen.MataKuliah_idMataKuliah = MataKuliah.idMataKuliah JOIN Prodi ON Prodi.idProdi = MataKuliah.Prodi_idProdi WHERE MataKuliah.idMataKuliah = ? AND MataKuliah.Prodi_idProdi = ? ORDER BY idMataKuliah';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $idMataKuliah);
    $stmt->bindParam(2, $idProdi);
    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'MataKuliah');
    $stmt->execute();
    $link = null;
    return $stmt->fetchAll();
  }
}

?>