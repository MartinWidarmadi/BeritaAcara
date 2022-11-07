<?php

class UserDaoImpl
{
    public function userLogin($userEmail, $userPassword) {
        $link = PDOUtil::connectDb();
        $query = 'SELECT * FROM User WHERE Email = ? AND Password = MD5(?)';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$userEmail);
        $stmt->bindParam(2,$userPassword);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt->fetchObject('User');
    }

    public function checkEmail($userEmail) {
        $link = PDOUtil::connectDb();
        $query = 'SELECT * FROM User WHERE Email = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$userEmail);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt->fetchObject('User');
    }

    public function updatePassword(User $user) {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'UPDATE user SET Password = MD5(?) WHERE idUser = ?';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$user->getPassword());
        $stmt->bindValue(2,$user->getIdUser());
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

    public function insertNewUser(User $user) {
        $result = 0;
        $link = PDOUtil::connectDb();
        $query = 'INSERT INTO user(Email,Password,Role) VALUES(?,?,?)';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$user->getEmail());
        $stmt->bindValue(2,$user->getPassword());
        $stmt->bindValue(3,$user->getRole());
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