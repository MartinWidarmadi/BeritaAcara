<?php

class MahasiswaDaoImpl
{
    public function fetchAllMahasiswa() {
        $link = PDOUtil::connectDb();
        $query = 'SELECT * FROM Mahasiswa';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Mahasiswa');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }

    public function checkNRP($NRP) {
        $link = PDOUtil::connectDb();
        $query = 'SELECT * FROM Mahasiswa WHERE NRP = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$NRP);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt->fetchObject('Mahasiswa');
    }

    public function insertNewMahasiswa(Mahasiswa $mahasiswa) {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'INSERT INTO Mahasiswa(NRP,Nama,alamat,no_tlp) VALUES(?,?,?,?)';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$mahasiswa->getNRP());
        $stmt->bindValue(2,$mahasiswa->getNama());
        $stmt->bindValue(3,$mahasiswa->getAlamat());
        $stmt->bindValue(4,$mahasiswa->getNoTlp());
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