<?php

class DetailJadwalDaoImpl
{
    public function fetchAllJadwal($nipDosen)
    {
        $link = PDOUtil::connectDb();
        $query = 'SELECT detail_jadwal.*, matakuliah.NamaMataKuliah AS "matakuliah",Semester.nama_semester AS "semester", matakuliah.idMataKuliah, Semester.nama_semester AS "semester" FROM detail_jadwal JOIN dosen ON dosen.NIP = detail_jadwal.jadwal_Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = detail_jadwal.jadwal_MataKuliah_idMataKuliah JOIN Semester ON Semester.id_semester = detail_jadwal.jadwal_Semester_id_Semester WHERE dosen.NIP = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $nipDosen);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Jadwal');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }

    public function fetchAllJadwals()
    {
        $link = PDOUtil::connectDb();
        $query = 'SELECT detail_jadwal.*, matakuliah.NamaMataKuliah AS "matakuliah", matakuliah.idMataKuliah, dosen.NamaDosen AS "namadosen" , Semester.nama_semester AS "semester" FROM detail_jadwal JOIN dosen ON dosen.NIP = detail_jadwal.jadwal_Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = detail_jadwal.jadwal_MataKuliah_idMataKuliah JOIN Semester ON Semester.id_semester = detail_jadwal.jadwal_Semester_id_Semester';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'DetailJadwal');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }

    public function fetchBeritaAcara(Jadwal $detailJadwal)
    {
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

    public function fetchFilterBeritaAcara(Jadwal $detailJadwal, $dosenFil, $semesterFil)
    {
        $link = PDOUtil::connectDb();
        if ($semesterFil != "" && $dosenFil != "") {
            $query = 'SELECT detail_jadwal.*  FROM detail_jadwal WHERE jadwal_kelas = ? AND jadwal_type = ? AND jadwal_MataKuliah_idMataKuliah = ? AND jadwal_Dosen_NIP = ? AND  jadwal_Semester_id_Semester = ?';
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'DetailJadwal');
            $stmt->bindValue(1, $detailJadwal->getKelas());
            $stmt->bindValue(2, $detailJadwal->getType());
            $stmt->bindValue(3, $detailJadwal->getIdMatkul()->getIdMataKuliah());
            $stmt->bindValue(4, $dosenFil);
            $stmt->bindValue(5, $semesterFil);

            $stmt->execute();
            $link = null;
            return $stmt->fetchAll();
        } elseif ($semesterFil == "" && $dosenFil != "") {
            $query = 'SELECT detail_jadwal.*  FROM detail_jadwal WHERE jadwal_kelas = ? AND jadwal_type = ? AND jadwal_MataKuliah_idMataKuliah = ? AND jadwal_Dosen_NIP = ? ';
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'DetailJadwal');
            $stmt->bindValue(1, $detailJadwal->getKelas());
            $stmt->bindValue(2, $detailJadwal->getType());
            $stmt->bindValue(3, $detailJadwal->getIdMatkul()->getIdMataKuliah());
            $stmt->bindValue(4, $dosenFil);

            $stmt->execute();
            $link = null;
            return $stmt->fetchAll();
        } elseif ($semesterFil != "" && $dosenFil == "") {
            $query = 'SELECT detail_jadwal.*  FROM detail_jadwal WHERE jadwal_kelas = ? AND jadwal_type = ? AND jadwal_MataKuliah_idMataKuliah = ? AND  jadwal_Semester_id_Semester = ? ';
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'DetailJadwal');
            $stmt->bindValue(1, $detailJadwal->getKelas());
            $stmt->bindValue(2, $detailJadwal->getType());
            $stmt->bindValue(3, $detailJadwal->getIdMatkul()->getIdMataKuliah());
            $stmt->bindValue(4, $semesterFil);

            $stmt->execute();
            $link = null;
            return $stmt->fetchAll();
        } elseif ($semesterFil == "" && $dosenFil == "") {
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
    }

    public function fetchBeritaAcaraFilterTanggal(Jadwal $detailJadwal, $tanggal1 , $tanggal2){
        $link = PDOUtil::connectDb();
        $query = 'SELECT detail_jadwal.*  FROM detail_jadwal WHERE jadwal_kelas = ? AND jadwal_type = ? AND jadwal_MataKuliah_idMataKuliah = ? AND jadwal_Dosen_NIP = ? AND  jadwal_Semester_id_Semester = ? AND tanggal_pertemuan BETWEEN ? AND ?';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'DetailJadwal');
        $stmt->bindValue(1, $detailJadwal->getKelas());
        $stmt->bindValue(2, $detailJadwal->getType());
        $stmt->bindValue(3, $detailJadwal->getIdMatkul()->getIdMataKuliah());
        $stmt->bindValue(4, $detailJadwal->getNipDosen()->getNIP());
        $stmt->bindValue(5, $detailJadwal->getIdSemester()->getIdSemester());
        $stmt->bindValue(6, $tanggal1);
        $stmt->bindValue(7, $tanggal2);

        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }

    public function fetchAssitenDosen(DetailJadwal $assistenDosen)
    {
        $link = PDOUtil::connectDb();
        $query = 'SELECT asisten_dosen.*, Mahasiswa.Nama AS "namaAsdos"  FROM asisten_dosen JOIN Mahasiswa ON Mahasiswa.NRP = asisten_dosen.Mahasiswa_NRP WHERE jadwal_kelas = ? AND jadwal_type = ? AND jadwal_MataKuliah_idMataKuliah = ? AND jadwal_Dosen_NIP = ? AND  jadwal_Semester_id_Semester = ? AND pertemuan = ?';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'AssistenDosen');
        $stmt->bindValue(1, $assistenDosen->getKelas());
        $stmt->bindValue(2, $assistenDosen->getType());
        $stmt->bindValue(3, $assistenDosen->getIdMatkul()->getIdMataKuliah());
        $stmt->bindValue(4, $assistenDosen->getNipDosen()->getNIP());
        $stmt->bindValue(5, $assistenDosen->getIdSemester()->getIdSemester());
        $stmt->bindValue(6, $assistenDosen->getPertemuan());

        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }

    public function insertNewDetailJadwal(DetailJadwal $detailJadwal)
    {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'INSERT INTO detail_jadwal(jadwal_Dosen_NIP, jadwal_MataKuliah_idMataKuliah, jadwal_Semester_id_Semester, jadwal_type, pertemuan, tanggal_pertemuan, waktu_mulai, waktu_selesai, rangkuman, foto_presensi, jadwal_kelas, jumlah_mahasiswa,jadwal_hari) VALUES(?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?, ?, ?)';
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
        $stmt->bindValue(13, $detailJadwal->getHari());
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

    public function insertNewAsdos(AssistenDosen $assistenDosen)
    {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'INSERT INTO asisten_dosen(jadwal_kelas,jadwal_hari,jadwal_Matakuliah_idMatakuliah,jadwal_Semester_id_Semester,jumlah_jam,jadwal_Dosen_NIP,Mahasiswa_NRP,pertemuan,jadwal_type,tanggal_aktivitas) VALUES(?, ?, ?, ? ,?, ?, ?, ?, ?, ?)';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $assistenDosen->getKelas());
        $stmt->bindValue(2, $assistenDosen->getHari());
        $stmt->bindValue(3, $assistenDosen->getIdMatkul());
        $stmt->bindValue(4, $assistenDosen->getIdSemester());
        $stmt->bindValue(5, $assistenDosen->getJumlahJam());
        $stmt->bindValue(6, $assistenDosen->getNipDosen());
        $stmt->bindValue(7, $assistenDosen->getNrpMahasiswa());
        $stmt->bindValue(8, $assistenDosen->getPertemuan());
        $stmt->bindValue(9, $assistenDosen->getType());
        $stmt->bindValue(10, $assistenDosen->getTanggal());

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



