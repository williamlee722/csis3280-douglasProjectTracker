<?php

class User_Project_TaskDAO {

    private static $db;

    static function initialize(string $className)  {
        self::$db = new PDOService($className);
    }

    static function getAllProjectTasks(string $projectName){
        $sql = "SELECT *
                FROM User, Project, Role, Task, User_Project_Task
                WHERE User.UserID = User_Project_Task.UserID
                AND Project.ProjectID = User_Project_Task.ProjectID
                AND Role.RoleID = User_Project_Task.RoleID
                AND Task.TaskID = User_Project_Task.TaskID
                AND Project.ProjectName = :projectname";
        
        self::$db->query($sql);

        self::$db->bind(':projectname', $projectName);

        self::$db->execute();

        return self::$db->resultSet();
    }

    static function createNewTaskContent(int $userID, int $projectID, int $roleID, int $taskID){
        $sql = "INSERT INTO User_Project_Task(UserID, ProjectID, RoleID, TaskID, Completion)
                VALUES (:userid, :projectid, :roleid, :taskid, :completion)";

        self::$db->query($sql);

        self::$db->bind(':userid', $userID);
        self::$db->bind(':projectid', $projectID);
        self::$db->bind(':roleid', $roleID);
        self::$db->bind(':taskid', $taskID);
        self::$db->bind(':completion', 0);
        self::$db->execute();
    }

    static function updateTaskCompletion($taskID, $status){
        $sql = "UPDATE User_Project_Task SET Completion = :status WHERE TaskID = :taskid";
        self::$db->query($sql);
        self::$db->bind(':status', $status);
        self::$db->bind(':taskid', $taskID);
        self::$db->execute();
    }
}

?>