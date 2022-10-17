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
}