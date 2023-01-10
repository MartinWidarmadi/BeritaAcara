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

  public function fetchJadwalStatus()
    {
        $link = PDOUtil::connectDb();
        $query = 'SELECT * FROM jadwal WHERE status = 1 ORDER BY MataKuliah_idMataKuliah ASC';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Jadwal');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }

    public function fetchJadwal($nipDosen, $idMatkul)
    {
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

    public function fetchFilterJadwal($semester, $namadosen)
    {
        $link = PDOUtil::connectDb();
        if ($semester != "" && $namadosen != "") {
            $query = 'SELECT jadwal.*,Dosen.NamaDosen AS "namadosen", matakuliah.NamaMataKuliah AS "matakuliah", matakuliah.idMataKuliah, Semester.nama_semester AS "semester" FROM jadwal JOIN dosen ON dosen.NIP = jadwal.Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = jadwal.MataKuliah_idMataKuliah JOIN Semester ON Semester.id_semester = jadwal.Semester_id_Semester WHERE Semester_id_semester = ? AND Dosen_NIP = ?';
            $stmt = $link->prepare($query);
            $stmt->bindParam(1, $semester);
            $stmt->bindParam(2, $namadosen);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Jadwal');
            $stmt->execute();
            $link = null;
            return $stmt->fetchAll();
        } elseif ($semester == "" && $namadosen != "") {
            $query = 'SELECT jadwal.*,Dosen.NamaDosen AS "namadosen", matakuliah.NamaMataKuliah AS "matakuliah", matakuliah.idMataKuliah, Semester.nama_semester AS "semester" FROM jadwal JOIN dosen ON dosen.NIP = jadwal.Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = jadwal.MataKuliah_idMataKuliah JOIN Semester ON Semester.id_semester = jadwal.Semester_id_Semester WHERE Dosen_NIP = ?';
            $stmt = $link->prepare($query);
            $stmt->bindParam(1, $namadosen);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Jadwal');
            $stmt->execute();
            $link = null;
            return $stmt->fetchAll();
        } elseif ($namadosen == "" && $semester != "") {
            $query = 'SELECT jadwal.*,Dosen.NamaDosen AS "namadosen", matakuliah.NamaMataKuliah AS "matakuliah", matakuliah.idMataKuliah, Semester.nama_semester AS "semester" FROM jadwal JOIN dosen ON dosen.NIP = jadwal.Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = jadwal.MataKuliah_idMataKuliah JOIN Semester ON Semester.id_semester = jadwal.Semester_id_Semester WHERE Semester_id_semester = ?';
            $stmt = $link->prepare($query);
            $stmt->bindParam(1, $semester);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Jadwal');
            $stmt->execute();
            $link = null;
            return $stmt->fetchAll();
        } elseif ($namadosen == "" && $semester == "") {
            $query = 'SELECT jadwal.*,Dosen.NamaDosen AS "namadosen", matakuliah.NamaMataKuliah AS "matakuliah", matakuliah.idMataKuliah, Semester.nama_semester AS "semester" FROM jadwal JOIN dosen ON dosen.NIP = jadwal.Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = jadwal.MataKuliah_idMataKuliah JOIN Semester ON Semester.id_semester = jadwal.Semester_id_Semester';
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Jadwal');
            $stmt->execute();
            $link = null;
            return $stmt->fetchAll();
        }
    }

    public function insertNewJadwal(Jadwal $jadwal)
    {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'INSERT INTO jadwal(kelas, hari, jam_awal, jam_akhir, type, MataKuliah_idMataKuliah, Dosen_NIP, Semester_id_Semester) VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $jadwal->getKelas());
        $stmt->bindValue(2, $jadwal->getHari());
        $stmt->bindValue(3, $jadwal->getJamAwal());
        $stmt->bindValue(4, $jadwal->getJamAkhir());
        $stmt->bindValue(5, $jadwal->getType());
        $stmt->bindValue(6, $jadwal->getIdMatkul());
        $stmt->bindValue(7, $jadwal->getNipDosen());
        $stmt->bindValue(8, $jadwal->getIdSemester());
        $link->beginTransaction();

        if ($stmt->execute()) {
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
