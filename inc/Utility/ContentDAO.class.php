<?php

class ContentDAO  {

    private static $db;

    static function initialize(string $className)    {
        self::$db = new PDOService($className);
    }

    static function createContent($newFile) {
        $sql = "INSERT INTO Content (Filename, Filesize, FileExt, FilePath)
                VALUES (:filename, :filesize, :fileext, :filepath)";
 
        self::$db->query($sql);

        self::$db->bind(':filename', $newFile->getFileName());
        self::$db->bind(':filesize', $newFile->getFileSize());
        self::$db->bind(':fileext', $newFile->getFileExt());
        self::$db->bind(':filepath', $newFile->getFilePath());

        self::$db->execute();

        return self::$db->LastInsertedId();
    }
    
    static function getContent(int $contentID)  {
        $sql = "SELECT * FROM Content
                WHERE ContentID = :contentid";
        self::$db->query($sql);
        self::$db->bind(':contentid', $contentID);

        self::$db->execute();

        return self::$db->singleResult();
    }

    static function getContents(){
        $sql = "SELECT * FROM Content";
        self::$db->query($sql);
        self::$db->execute();
        return self::$db->ResultSet();
    }

    static function deleteContent(int $contentID){
        $sql = "DELETE FROM Content
                WHERE ContentID = :contentid";
        self::$db->query($sql);
        self::$db->bind(':contentid', $contentID);
        self::$db->execute();
    }
}
?>