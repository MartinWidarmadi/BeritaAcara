<?php 

class JadwalDaoImpl {
  public function fetchAllJadwal($nipDosen) {
    $link = PDOUtil::connectDb();
    $query = 'SELECT jadwal.*, matakuliah.NamaMataKuliah AS "matakuliah", matakuliah.idMataKuliah, Semester.nama_semester AS "semester" FROM jadwal JOIN dosen ON dosen.NIP = jadwal.Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = jadwal.MataKuliah_idMataKuliah JOIN Semester ON Semester.id_semester = jadwal.Semester_id_Semester WHERE dosen.NIP = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $nipDosen);
    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Jadwal');
    $stmt->execute();
    $link = null;
    return $stmt->fetchAll();
  }

  public function fetchAllJadwals() {
    $link = PDOUtil::connectDb();
    $query = 'SELECT jadwal.*,Dosen.NamaDosen AS "namadosen", matakuliah.NamaMataKuliah AS "matakuliah", matakuliah.idMataKuliah, Semester.nama_semester AS "semester" FROM jadwal JOIN dosen ON dosen.NIP = jadwal.Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = jadwal.MataKuliah_idMataKuliah JOIN Semester ON Semester.id_semester = jadwal.Semester_id_Semester';
    $stmt = $link->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Jadwal');
    $stmt->execute();
    $link = null;
    return $stmt->fetchAll();
  }

  public function fetchJadwal($nipDosen, $idMatkul) {
    $link = PDOUtil::connectDb();
    $query = 'SELECT * FROM jadwal WHERE Dosen_NIP = ? AND MataKuliah_idMataKuliah = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $nipDosen);
    $stmt->bindParam(2, $idMatkul);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute();
    $link = null;
    return $stmt->fetchObject('Jadwal');
  }
}

?>
