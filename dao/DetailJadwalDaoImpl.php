<?php 
class DetailJadwalDaoImpl {
  public function fetchAllJadwal($nipDosen) {
    $link = PDOUtil::connectDb();
    $query = 'SELECT detail_jadwal.*, matakuliah.NamaMataKuliah AS "matakuliah", matakuliah.idMataKuliah FROM detail_jadwal JOIN dosen ON dosen.NIP = detail_jadwal.jadwal_Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = detail_jadwal.jadwal_MataKuliah_idMataKuliah WHERE dosen.NIP = ?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $nipDosen);
    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'DetailJadwal');
    $stmt->execute();
    $link = null;
    return $stmt->fetchAll();
}

public function fetchAllJadwals() {
    $link = PDOUtil::connectDb();
    $query = 'SELECT detail_jadwal.*, matakuliah.NamaMataKuliah AS "matakuliah", matakuliah.idMataKuliah, dosen.NamaDosen AS "namadosen" FROM detail_jadwal JOIN dosen ON dosen.NIP = detail_jadwal.jadwal_Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = detail_jadwal.jadwal_MataKuliah_idMataKuliah';
    $stmt = $link->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'DetailJadwal');
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



