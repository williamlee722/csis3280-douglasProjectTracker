<?php

class User_Project_RoleDAO{

    private static $db;

    static function initialize(string $className)  {
        self::$db = new PDOService($className);
    }

    static function getAllUserProjects(string $studentID){
        $sql = "SELECT *
                FROM User, Project, Role, User_Project_Role
                WHERE User.UserID = User_Project_Role.UserID
                AND Project.ProjectID = User_Project_Role.ProjectID
                AND Role.RoleID = User_Project_Role.RoleID
                AND User.StudentID = :studentid;";
        
        self::$db->query($sql);

        self::$db->bind(':studentid', $studentID);

        self::$db->execute();

        return self::$db->resultSet();
    }

    static function createNewUserProjects($userID, $projectID){
        $sql = "INSERT INTO User_Project_Role(UserID, ProjectID, RoleID)
                VALUES (:userid, :projectid, :roleid)";

        self::$db->query($sql);

        self::$db->bind(':userid', $userID);
        self::$db->bind(':projectid', $projectID);
        self::$db->bind(':roleid', 1);

        self::$db->execute();
    }

    static function getAllProjectUsers(string $projectName){
        $sql = "SELECT *
                FROM User, Project, Role, User_Project_Role
                WHERE User.UserID = User_Project_Role.UserID
                AND Project.ProjectID = User_Project_Role.ProjectID
                AND Role.RoleID = User_Project_Role.RoleID
                AND Project.ProjectName = :projectname;";
        
        self::$db->query($sql);

        self::$db->bind(':projectname', $projectName);

        self::$db->execute();

        return self::$db->resultSet();
    }

    static function getUserType(string $studentID, string $projectName){
        $sql = "SELECT UserType
                FROM User, Project, Role, User_Project_Role
                WHERE User.UserID = User_Project_Role.UserID
                AND Project.ProjectID = User_Project_Role.ProjectID
                AND Role.RoleID = User_Project_Role.RoleID
                AND User.StudentID = :studentid
                AND Project.ProjectName = :projectname;";
        
        self::$db->query($sql);

        self::$db->bind(':studentid', $studentID);
        self::$db->bind(':projectname', $projectName);

        self::$db->execute();

        return self::$db->singleResult();
    }

    static function inviteNewUser($userID, $projectID){
        $sql = "INSERT INTO User_Project_Role(UserID, ProjectID, RoleID)
                VALUES (:userid, :projectid, :roleid)";

        self::$db->query($sql);

        self::$db->bind(':userid', $userID);
        self::$db->bind(':projectid', $projectID);
        self::$db->bind(':roleid', 3);

        self::$db->execute();
    }

    static function changeUserStatus($userID, $projectID, $roleID){
        $sql = "UPDATE User_Project_Role
                SET RoleID = :roleid
                WHERE UserID = :userid AND ProjectID = :projectid";

        self::$db->query($sql);

        self::$db->bind(':userid', $userID);
        self::$db->bind(':projectid', $projectID);
        self::$db->bind(':roleid', $roleID);

        self::$db->execute();
    }

}

?>