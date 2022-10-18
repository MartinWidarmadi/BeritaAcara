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
        $query = 'UPDATE user SET password = ? WHERE email = ?';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$user->getPassword());
        $stmt->bindValue(2,$user->getEmail());
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