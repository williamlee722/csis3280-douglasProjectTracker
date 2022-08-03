<?php

class Content{

    private $ContentID;
    private $Filename;
    private $Filesize;
    private $FileExt;
    private $FilePath;

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

    function setFileName(string $fileName){
        $this->Filename = $fileName;
    }

    function setFileSize(string $fileSize){
        $this->Filesize = $fileSize;
    }

    function setFileExt(string $fileExt){
        $this->FileExt = $fileExt;
    }

    function setFilePath(string $filePath){
        $this->FilePath = $filePath;
    }
}
?>