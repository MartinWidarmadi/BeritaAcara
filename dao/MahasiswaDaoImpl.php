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

    public function fetchMahasiswa($id) {
        $link = PDOUtil::connectDb();
        $query = 'SELECT * FROM Mahasiswa WHERE NRP = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $link = null;
        return $stmt->fetchObject('Mahasiswa');
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

    public function deleteMahasiswa($id) {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'DELETE FROM Mahasiswa WHERE NRP = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
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

    public function updateMahasiswa(Mahasiswa $mhs, $nrp) {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'UPDATE Mahasiswa SET NRP = ?, Nama = ?, alamat = ?, no_tlp = ? WHERE NRP = ?';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $mhs->getNRP());
        $stmt->bindValue(2, $mhs->getNama());
        $stmt->bindValue(3, $mhs->getAlamat());
        $stmt->bindValue(4, $mhs->getNoTlp());
        $stmt->bindValue(5, $nrp);
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