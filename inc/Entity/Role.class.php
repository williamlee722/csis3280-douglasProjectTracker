<?php

class Role{
    
    private $RoleID;
    private $UserType;

    function getRoleID(){
        return $this->RoleID;
    }

    function getUserType(){
        return $this->UserType;
    }
}
?>