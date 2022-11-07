
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

}
?>

