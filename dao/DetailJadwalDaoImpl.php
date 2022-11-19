<?php 
class DetailJadwalDaoImpl {
  public function fetchAllJadwal($nipDosen) {
    $link = PDOUtil::connectDb();
    $query = 'SELECT detail_jadwal.*, matakuliah.NamaMataKuliah AS "matakuliah",Semester.nama_semester AS "semester", matakuliah.idMataKuliah, Semester.nama_semester AS "semester" FROM detail_jadwal JOIN dosen ON dosen.NIP = detail_jadwal.jadwal_Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = detail_jadwal.jadwal_MataKuliah_idMataKuliah JOIN Semester ON Semester.id_semester = detail_jadwal.jadwal_Semester_id_Semester WHERE dosen.NIP = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $nipDosen);
    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Jadwal');
    $stmt->execute();
    $link = null;
    return $stmt->fetchAll();
}

public function fetchAllJadwals() {
    $link = PDOUtil::connectDb();
    $query = 'SELECT detail_jadwal.*, matakuliah.NamaMataKuliah AS "matakuliah", matakuliah.idMataKuliah, dosen.NamaDosen AS "namadosen" , Semester.nama_semester AS "semester" FROM detail_jadwal JOIN dosen ON dosen.NIP = detail_jadwal.jadwal_Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = detail_jadwal.jadwal_MataKuliah_idMataKuliah JOIN Semester ON Semester.id_semester = detail_jadwal.jadwal_Semester_id_Semester';
    $stmt = $link->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'DetailJadwal');
    $stmt->execute();
    $link = null;
    return $stmt->fetchAll();
}

  public function fetchBeritaAcara(Jadwal $detailJadwal) {
    $link = PDOUtil::connectDb();
    $query = 'SELECT detail_jadwal.*  FROM detail_jadwal WHERE jadwal_kelas = ? AND jadwal_type = ? AND jadwal_MataKuliah_idMataKuliah = ? AND jadwal_Dosen_NIP = ? AND  jadwal_Semester_id_Semester = ?';
    $stmt = $link->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'DetailJadwal');
    $stmt->bindValue(1, $detailJadwal->getKelas());
    $stmt->bindValue(2, $detailJadwal->getType());
    $stmt->bindValue(3, $detailJadwal->getIdMatkul()->getIdMataKuliah());
    $stmt->bindValue(4, $detailJadwal->getNipDosen()->getNIP());
    $stmt->bindValue(5, $detailJadwal->getIdSemester()->getIdSemester());

    $stmt->execute();
    $link = null;
    return $stmt->fetchAll();
  }

  public function insertNewDetailJadwal (DetailJadwal $detailJadwal) {
    $result = 0;
    $link = PDOUtil::connectDb();
    $query = 'INSERT INTO detail_jadwal(jadwal_Dosen_NIP, jadwal_MataKuliah_idMataKuliah, jadwal_Semester_id_Semester, jadwal_type, pertemuan, tanggal_pertemuan, waktu_mulai, waktu_selesai, rangkuman, foto_presensi, jadwal_kelas, jumlah_mahasiswa) VALUES(?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $link->prepare($query);
    $stmt->bindValue(1, $detailJadwal->getNipDosen());
    $stmt->bindValue(2, $detailJadwal->getIdMatkul());
    $stmt->bindValue(3, $detailJadwal->getIdSemester());
    $stmt->bindValue(4, $detailJadwal->getType());
    $stmt->bindValue(5, $detailJadwal->getPertemuan());
    $stmt->bindValue(6, $detailJadwal->getTanggalPertemuan());
    $stmt->bindValue(7, $detailJadwal->getWaktuMulai());
    $stmt->bindValue(8, $detailJadwal->getWaktuSelesai());
    $stmt->bindValue(9, $detailJadwal->getRangkuman());
    $stmt->bindValue(10, $detailJadwal->getFotoPresensi());
    $stmt->bindValue(11, $detailJadwal->getKelas());
    $stmt->bindValue(12, $detailJadwal->getJumlahMahasiswa());
    $link->beginTransaction();
  
    if($stmt->execute()) {
      $link->commit();
      $result = 1;
    } else {
      $link->rollBack();
    }
    $link = null;
    return $result;
  }
}
?>



