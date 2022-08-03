<?php

class User_Project_Task{

    private $Taskname;
    private $Taskdetails;
    private $Name;
    private $Completion;
    private $RoleID;
    private $UserName;

    function getTaskID(){
        return $this->TaskID;
    }

    function getTaskName(){
        return $this->Taskname;
    }

    function getTaskDetails(){
        return $this->Taskdetails;
    }

    function getName(){
        return $this->Name;
    }

    function getCompletion(){
        return $this->Completion;
    }

    function getRoleID(){
        return $this->RoleID;
    }

    function getUserName(){
        return $this->UserName;
    }

    function setCompletion(int $completion){
        $this->Completion = $completion;
    }
}

?>