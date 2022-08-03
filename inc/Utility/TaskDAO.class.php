<?php

class TaskDAO  {

    private static $db;

    static function initialize(string $className)    {
        self::$db = new PDOService($className);
    }

    static function createTask(Task $newTask) {
        $sql = "INSERT INTO Task (Taskname, Taskdetails, UserName)
                VALUES (:taskname, :taskdetails, :username)";
 
        self::$db->query($sql);

        self::$db->bind(':taskname', $newTask->getTaskName());
        self::$db->bind(':taskdetails', $newTask->getTaskDetails());
        self::$db->bind(':username', $newTask->getUserName());

        self::$db->execute();

        return self::$db->LastInsertedId();
    }
    
    static function getTask(int $taskID)  {
        $sql = "SELECT * FROM Task
                WHERE TaskID = :taskid";
        self::$db->query($sql);
        self::$db->bind(':contentid', $taskID);

        self::$db->execute();

        return self::$db->singleResult();
    }

    static function getTasks(){
        $sql = "SELECT * FROM Task";
        self::$db->query($sql);
        self::$db->execute();
        return self::$db->ResultSet();
    }

    static function deleteTask(int $taskID){
        $sql = "DELETE FROM Task
                WHERE TaskID = :taskid";
        self::$db->query($sql);
        self::$db->bind(':taskid', $taskID);
        self::$db->execute();
    }
}
?>