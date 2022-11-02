<?php

class MahasiswaDaoImpl
{
    public function fetchMahasiswa() {
        $link = PDOUtil::connectDb();
        $query = 'SELECT * FROM Mahasiswa';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Mahasiswa');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }
}