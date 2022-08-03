<?php

class UserDAO  {

    private static $db;

    static function initialize(string $className)    {
        self::$db = new PDOService($className);
    }

    static function createUser(User $newUser) {
        $sql = "INSERT INTO User (StudentID, Password, Name, Email, VKey)
                VALUES (:studentid, :password, :name, :email, :vkey)";
 
        self::$db->query($sql);

        self::$db->bind(':studentid', $newUser->getStudentID());
        self::$db->bind(':password', $newUser->getPassword());
        self::$db->bind(':name', $newUser->getName());
        self::$db->bind(':email', $newUser->getEmail());
        self::$db->bind(':vkey', $newUser->getVKey());

        self::$db->execute();

        return self::$db->rowCount();
    }
    
    static function getUser(string $studentID)  {
        $sql = "SELECT * FROM user
                 WHERE StudentID = :studentid";
        self::$db->query($sql);
        self::$db->bind(":studentid", $studentID);

        self::$db->execute();

        return self::$db->singleResult();
    }

    static function getUsers()  {
        $sql = "SELECT * from user";
        // you know the drill
        self::$db->query($sql);
        self::$db->execute();
        // return the multiple result query    
        return self::$db->resultSet();
    }

    static function updateVerifiedUser(string $vkey)  {
        $sql = "UPDATE user
                SET Status = 1 WHERE VKey = :vkey LIMIT 1";
        self::$db->query($sql);
        self::$db->bind(":vkey", $vkey);

        self::$db->execute();
    }

    static function verifyUser(string $vkey)  {
        $sql = "SELECT status, vkey FROM user
                WHERE Status = 0 AND VKey = :vkey LIMIT 1";
        self::$db->query($sql);
        self::$db->bind(':vkey', $vkey);

        self::$db->execute();

        return self::$db->rowCount();
    }

    static function updateUserPassword(string $password, string $vkey)  {
        $sql = "UPDATE user
                SET Password = :password WHERE VKey = :vkey";
        self::$db->query($sql);
        self::$db->bind(":password", $password);
        self::$db->bind(":vkey", $vkey);

        self::$db->execute();
    }

    static function changeUserPassword(string $password, string $userid)  {
        $sql = "UPDATE user
                SET Password = :password WHERE UserID = :userid";
        self::$db->query($sql);
        self::$db->bind(":password", $password);
        self::$db->bind(":userid", $userid);

        self::$db->execute();
    }
}
?>