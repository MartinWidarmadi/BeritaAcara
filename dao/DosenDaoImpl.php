<?php

class DosenDaoImpl
{
    public function fetchDosen($id) {
        $link = PDOUtil::connectDb();
        $query = 'SELECT * FROM Dosen WHERE User_idUser = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $link = null;
        return $stmt->fetchObject('Dosen');
    }

    public function fetchAllDosen() {
        $link = PDOUtil::connectDb();
        $query = 'SELECT NIP, NamaDosen FROM Dosen WHERE NIP != 1 ORDER BY NIP ASC ';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Dosen');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }

    public function insertNewDosen(Dosen $dosen) {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'INSERT INTO dosen(NIP,NamaDosen,User_idUser) VALUES(?,?,?)';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$dosen->getNIP());
        $stmt->bindValue(2,$dosen->getNamaDosen());
        $stmt->bindValue(3,$dosen->getUserIdUser());
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