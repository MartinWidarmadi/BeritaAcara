<?php

class MataKuliahDaoImpl
{

    public function fetchAllMK()
    {
        $link = PDOUtil::connectDb();
        $query = 'SELECT idMataKuliah, NamaMataKuliah ,SKS, status,Prodi.NamaProdi AS "prodi" FROM MataKuliah JOIN Prodi ON Prodi.idProdi = MataKuliah.Prodi_idProdi ORDER BY idMataKuliah ASC ';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'MataKuliah');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }

    public function fetchMKstatus()
    {
        $link = PDOUtil::connectDb();
        $query = 'SELECT idMataKuliah, NamaMataKuliah ,SKS, status,Prodi.NamaProdi AS "prodi" FROM MataKuliah JOIN Prodi ON Prodi.idProdi = MataKuliah.Prodi_idProdi WHERE matakuliah.status = 1 ORDER BY idMataKuliah ASC ';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'MataKuliah');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }

    public function fetchAllMKName()
    {
        $link = PDOUtil::connectDb();
        $query = 'SELECT NamaMataKuliah FROM MataKuliah ORDER BY idMataKuliah ASC';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'MataKuliah');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }

    public function statusMK($id, $status)
    {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'UPDATE MataKuliah SET status = ? WHERE idMataKuliah = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $status);
        $stmt->bindParam(2, $id);
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

    public function fetchMK($id)
    {
        $link = PDOUtil::connectDb();
        $query = 'SELECT * FROM MataKuliah WHERE idMataKuliah = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $link = null;
        return $stmt->fetchObject('MataKuliah');
    }

    public function insertNewMataKuliah(MataKuliah $matkul)
    {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'INSERT INTO MataKuliah(idMataKuliah,NamaMataKuliah,SKS,Prodi_idProdi) VALUES(?,?,?,?)';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $matkul->getIdMataKuliah());
        $stmt->bindValue(2, $matkul->getNamaMataKuliah());
        $stmt->bindValue(3, $matkul->getSKS());
        $stmt->bindValue(4, $matkul->getIdProdi());
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

    public function checkIdMatkul($id)
    {
        $link = PDOUtil::connectDb();
        $query = 'SELECT * FROM MataKuliah WHERE idMataKuliah = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt->fetchObject('MataKuliah');
    }

    public function updateMatkul(MataKuliah $mataKuliah)
    {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'UPDATE MataKuliah SET NamaMataKuliah = ?, SKS = ?, Prodi_idProdi = ? WHERE idMataKuliah = ?';
        $stmt = $link->prepare($query);

        $stmt->bindValue(1, $mataKuliah->getNamaMataKuliah());
        $stmt->bindValue(2, $mataKuliah->getSKS());
        $stmt->bindValue(3, $mataKuliah->getIdProdi());
        $stmt->bindValue(4, $mataKuliah->getIdMataKuliah());
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

    public function deleteMatkul($id)
    {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'DELETE FROM MataKuliah WHERE idMataKuliah = ?';
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
}

?>