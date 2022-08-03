<?php

class User_Project_ContentDAO {

    private static $db;

    static function initialize(string $className)  {
        self::$db = new PDOService($className);
    }

    static function getAllProjectContents(string $projectName){
        $sql = "SELECT *
                FROM User, Project, Role, Content, User_Project_Content
                WHERE User.UserID = User_Project_Content.UserID
                AND Project.ProjectID = User_Project_Content.ProjectID
                AND Role.RoleID = User_Project_Content.RoleID
                AND Content.ContentID = User_Project_Content.ContentID
                AND Project.ProjectName = :projectname;";
        
        self::$db->query($sql);

        self::$db->bind(':projectname', $projectName);

        self::$db->execute();

        return self::$db->resultSet();
    }

    static function createNewProjectContent(int $userID, int $projectID, int $roleID, int $contentID){
        $sql = "INSERT INTO User_Project_Content(UserID, ProjectID, RoleID, ContentID, ModifyTime)
                VALUES (:userid, :projectid, :roleid, :contentid, :modifytime)";

        self::$db->query($sql);

        self::$db->bind(':userid', $userID);
        self::$db->bind(':projectid', $projectID);
        self::$db->bind(':roleid', $roleID);
        self::$db->bind(':contentid', $contentID);
        date_default_timezone_set('America/Vancouver');
        $date = date('Y-M-d g:iA');
        self::$db->bind(':modifytime', $date);
        self::$db->execute();
    }

}

?>