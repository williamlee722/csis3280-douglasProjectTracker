<?php

class Project {

    private $ProjectID;
    private $Projectname;
    private $Coursename;
    private $Notice;

    function setProjectname(string $projectname){
        $this->Projectname = $projectname;
    }

    function setCoursename(string $coursename){
        $this->Coursename = $coursename;
    }

    function setNotice(string $notice){
        $this->Notice = $notice;
    }
    
    function getProjectID(){
        return $this->ProjectID;
    }
    function getProjectname(){
        return $this->Projectname;
    }

    function getCoursename(){
        return $this->Coursename;
    }

    function getNotice(){
        return $this->Notice;
    }

}    
?>