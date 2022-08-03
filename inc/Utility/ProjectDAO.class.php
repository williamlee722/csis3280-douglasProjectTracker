<?php

class ProjectDAO  {

    private static $db;

    static function initialize(string $className)    {
        self::$db = new PDOService($className);
    }

    static function createProject(Project $newProject) {
        $sql = "INSERT INTO Project (Projectname, Coursename)
                VALUES (:projectname, :coursename)";
 
        self::$db->query($sql);

        self::$db->bind(':projectname', $newProject->getProjectname());
        self::$db->bind(':coursename', $newProject->getCoursename());

        self::$db->execute();

        return self::$db->LastInsertedId();
    }
    
    static function getProject(string $projectName)  {
        $sql = "SELECT * FROM Project
                 WHERE Projectname = :projectname";
        self::$db->query($sql);
        self::$db->bind(":projectname", $projectName);

        self::$db->execute();

        return self::$db->singleResult();
    }

    static function getProjects(){
        $sql = "SELECT * FROM Project";
        self::$db->query($sql);
        self::$db->execute();
        return self::$db->ResultSet();
    }

    static function updateNotice(string $notice, string $projectName){
        $sql= "UPDATE Project
                SET Notice = :notice
                WHERE Projectname = :projectname";
        self::$db->query($sql);
        self::$db->bind(":notice", $notice);
        self::$db->bind(":projectname", $projectName);
        self::$db->execute();
    }

    static function deleteProject($projectName){
        $sql= "DELETE FROM Project
                WHERE Projectname = :projectname";
        self::$db->query($sql);
        self::$db->bind(":projectname", $projectName);
        self::$db->execute();
    }
}
?>