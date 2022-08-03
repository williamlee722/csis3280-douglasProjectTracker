<?php

class User {

    private $UserID;
    private $StudentID;
    private $Password;
    private $Name;
    private $Email;
    private $Status;
    private $VKey;

    function setUserID(int $id){
        $this->UserID = $id;
    }

    function setStudentID(string $studentId){
        $this->StudentID = $studentId;
    }

    function setPassword(string $password){
        $this->Password = $password;
    }

    function setName(string $name){
        $this->Name = $name;
    }

    function setEmail(string $email){
        $this->Email = $email;
    }

    function setStatus(string $status){
        $this->Status = $status;
    }

    function setVKey(string $vkey){
        $this->VKey = $vkey;
    }
    
    function getUserID(){
        return $this->UserID;
    }

    function getStudentID(){
        return $this->StudentID;
    }

    function getPassword(){
        return $this->Password;
    }

    function getName(){
        return $this->Name;
    }

    function getEmail(){
        return $this->Email;
    }

    function getStatus(){
        return $this->Status;
    }

    function getVKey(){
        return $this->VKey;
    }

    function verifyPassword(string $passwordToVerify){
        return password_verify($passwordToVerify, $this->Password);
    }

}    
?>