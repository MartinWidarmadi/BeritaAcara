
<?php
class SemesterDaoImpl {
  public function fetchAllSemester() {
    $link = PDOUtil::connectDb();
    $query = 'SELECT * FROM Semester ORDER BY id_Semester ';
    $stmt = $link->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Semester');
    $stmt->execute();
    $link = null;
    return $stmt->fetchAll();
  }

  public function fetchSemesterName() {
        $link = PDOUtil::connectDb();
        $query = 'SELECT nama_semester FROM Semester ORDER BY id_Semester ASC';
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Semester');
        $stmt->execute();
        $link = null;
        return $stmt->fetchAll();
    }

    public function insertNewSemester(Semester $semester) {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'INSERT INTO Semester(id_semester, nama_semester) VALUES(?,?)';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$semester->getIdSemester());
        $stmt->bindValue(2,$semester->getNamaSemester());
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

    public function deleteSemester($id) {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'DELETE FROM Semester WHERE id_semester = ?';
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

    public function updateSemester(Semester $semester) {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'UPDATE Semester SET nama_semester = ? WHERE id_semester = ?';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $semester->getNamaSemester());
        $stmt->bindValue(2, $semester->getIdSemester());
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

