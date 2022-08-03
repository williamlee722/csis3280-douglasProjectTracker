<?php

class User_Project_Content{

    private $ContentID;
    private $Filename;
    private $Filesize;
    private $FileExt;
    private $FilePath;
    private $Name;
    private $ModifyTime;
    private $UserType;

    function getContentID(){
        return $this->ContentID;
    }

    function getFileName(){
        return $this->Filename;
    }

    function getFileSize(){
        return $this->Filesize;
    }

    function getFileExt(){
        return $this->FileExt;
    }

    function getFilePath(){
        return $this->FilePath;
    }

    function getName(){
        return $this->Name;
    }

    function getModifyTime(){
        return $this->ModifyTime;
    }
}
?>