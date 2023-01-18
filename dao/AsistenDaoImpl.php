<?php

class AsistenDaoImpl
{
    public function fetchAllAsdos(){
        $link = PDOUtil::connectDb();
        $query = 'SELECT Mahasiswa_NRP, SUM(Jumlah_Jam) as jumlah_jam, Mahasiswa.Nama as namaAsdos FROM asisten_dosen JOIN Mahasiswa ON Mahasiswa.NRP = asisten_dosen.Mahasiswa_NRP GROUP BY Mahasiswa_NRP';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'AssistenDosen');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }

    public function fetchAsdosWithFilter($tanggal1,$tanggal2){
        $link = PDOUtil::connectDb();
        if ($tanggal1 != "" && $tanggal2 != ""){
            $query = 'SELECT Mahasiswa_NRP, SUM(Jumlah_Jam) as jumlah_jam, Mahasiswa.Nama as namaAsdos FROM asisten_dosen JOIN Mahasiswa ON Mahasiswa.NRP = asisten_dosen.Mahasiswa_NRP WHERE tanggal_aktivitas BETWEEN ? AND ? GROUP BY Mahasiswa_NRP';
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'AssistenDosen');
            $stmt->bindValue(1, $tanggal1);
            $stmt->bindValue(2, $tanggal2);
            $stmt->execute();
            $link = null;
            return $stmt->fetchAll();
        }
        else {
            $link = PDOUtil::connectDb();
            $query = 'SELECT Mahasiswa_NRP, SUM(Jumlah_Jam) as jumlah_jam, Mahasiswa.Nama as namaAsdos FROM asisten_dosen JOIN Mahasiswa ON Mahasiswa.NRP = asisten_dosen.Mahasiswa_NRP GROUP BY Mahasiswa_NRP';
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'AssistenDosen');
            $stmt->execute();
            $link = null;
            return $stmt->fetchAll();
        }

    }
}