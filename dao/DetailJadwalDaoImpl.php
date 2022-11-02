<?php

class DetailJadwalDaoImpl
{
    public function fetchAllJadwal($nipDosen) {
        $link = PDOUtil::connectDb();
        $query = 'SELECT detail_jadwal.*, matakuliah.NamaMataKuliah AS "matakuliah" FROM detail_jadwal JOIN dosen ON dosen.NIP = detail_jadwal.jadwal_Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = detail_jadwal.jadwal_MataKuliah_idMataKuliah WHERE dosen.NIP = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $nipDosen);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'DetailJadwal');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }

    public function fetchAllJadwals() {
        $link = PDOUtil::connectDb();
        $query = 'SELECT detail_jadwal.*, matakuliah.NamaMataKuliah AS "matakuliah", dosen.NamaDosen AS "namadosen" FROM detail_jadwal JOIN dosen ON dosen.NIP = detail_jadwal.jadwal_Dosen_NIP JOIN matakuliah ON matakuliah.idMataKuliah = detail_jadwal.jadwal_MataKuliah_idMataKuliah';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'DetailJadwal');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }
}