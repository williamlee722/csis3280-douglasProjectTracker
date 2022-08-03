<?php

class Task{

    private $TaskID;
    private $Taskname;
    private $Taskdetails;
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

    function getUserName(){
        return $this->UserName;
    }

    function setTaskName(string $taskName){
        $this->Taskname = $taskName;
    }

    function setTaskDetails(string $taskDetails){
        $this->Taskdetails = $taskDetails;
    }

    function setUserName(string $userName){
        $this->UserName = $userName;
    }
}
?>