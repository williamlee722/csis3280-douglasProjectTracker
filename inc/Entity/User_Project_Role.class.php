<?php

class User_Project_Role {

    private $Projectname;
    private $Coursename;
    private $UserType;
    private $RoleID;
    private $StudentID;
    private $Name;
    private $Email;
    private $UserID;

    function getName(){
        return $this->Name;
    }

    function getStudentID(){
        return $this->StudentID;
    }

    function getEmail(){
        return $this->Email;
    }

    function getProjectname(){
        return $this->Projectname;
    }

    function getCoursename(){
        return $this->Coursename;
    }

    function getUserType(){
        return $this->UserType;
    }

    function getRoleID(){
        return $this->RoleID;
    }

    function getUserID(){
        return $this->UserID;
    }
}    
?>