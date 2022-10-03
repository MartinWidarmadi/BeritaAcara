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
}