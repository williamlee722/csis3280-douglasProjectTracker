<?php

class Validate {

    static $valid_status =[];

    static function validate($users){

        $studentIDOptions = array("options"=>array("regexp"=> "/^3003\d{5}$/"));
        $validStudentID = filter_input(INPUT_POST, 'studentID', FILTER_VALIDATE_REGEXP, $studentIDOptions);
        if(!$validStudentID){
            self::$valid_status['studentID'] = "Student ID needs to be Douglas College 3003XXXXX format.";
        }

        for($i=0; $i<count($users); $i++){
            if(($users[$i]->getStudentID()) == ($_POST['studentID'])){
                self::$valid_status['studentID'] = "Student ID already exists.";
            }
        }

        if(empty($_POST['name'])){
            self::$valid_status['name'] = "Please enter your first name.";
        }

        $validEmail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if(!$validEmail){
            self::$valid_status['email'] = "Email address format incorrect.";
        }

        if(!str_contains($_POST['email'], '@student.douglascollege.ca')){
            self::$valid_status['email'] = "Email address needs to be Douglas College Student Email address.";
        }

        for($i=0; $i<count($users); $i++){
            if(($users[$i]->getEmail()) == ($_POST['email'])){
                self::$valid_status['email'] = "Email address already exists.";
            }
        }

        if(empty($_POST['password'])){
            self::$valid_status['password'] = "Please enter a password.";
        }

        $passwordOptions = array("options"=>array("regexp"=> "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"));
        $validPassword = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_REGEXP, $passwordOptions);
        if(!empty($_POST['password']) && !$validPassword){
            self::$valid_status['password'] = "Password needs to have minimum 8 characters, 1 capital character, 1 small character and 1 special character.";
        }
        
        if(empty($_POST['password2'])){
            self::$valid_status['password2'] = "Please confirm the password.";
        }
        if(isset($_POST['password2']) && $_POST['password2'] != $_POST['password'] || !$validPassword){
            self::$valid_status['password2'] = "Please confirm your password again.";
        }
        
        return self::$valid_status;
    }

    static function validateNewProjectForm($Projects){
        if(empty($_POST['projectName'])){
            self::$valid_status['projectName'] = "Project name cannot be empty.";
        }

        if(strlen($_POST['projectName']) > 13){
            self::$valid_status['projectName'] = "Project name can only be 13 characters.";
        }
        
        if(!empty($_POST['projectName'])){
            for($i=0; $i<count($Projects); $i++){
                if(($_POST['projectName']) == ($Projects[$i]->getProjectname())){
                    self::$valid_status['projectName'] = "Project name exists, please try another.";
                }
            }
        }

        $courseOptions = array("options"=>array("regexp" => "/^[A-Z]{4}\d{4}$/"));
        $validCourseName = filter_input(INPUT_POST, 'courseName', FILTER_VALIDATE_REGEXP, $courseOptions);
        if(!$validCourseName){
            self::$valid_status['courseName'] = "Course name should be in the ABCDXXXX format. (ex/CSIS3280).";
        }

        return self::$valid_status;
    }

    static function validateFindPassword($users){

        $studentIDOptions = array("options"=>array("regexp"=> "/^3003\d{5}$/"));
        $validStudentID = filter_input(INPUT_POST, 'studentID', FILTER_VALIDATE_REGEXP, $studentIDOptions);
        if(!$validStudentID){
            self::$valid_status['studentID'] = "Student ID needs to be Douglas College 3003XXXXX format.";
        }

        if(empty($_POST['studentID'])){
            self::$valid_status['studentID'] = "Please enter your studentID.";
        }

        $user=array();
        for($i=0;$i<count($users); $i++){
            array_push($user, $users[$i]->getStudentID());
        }

        if($validStudentID && !in_array($_POST["studentID"], $user)){
            self::$valid_status['studentID'] = "Account doesnt exist.";
        }

        return self::$valid_status;
    }

    static function validatePassword($users){

        if(empty($_POST['password'])){
            self::$valid_status['password'] = "Please enter a password.";
        }

        $passwordOptions = array("options"=>array("regexp"=> "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"));
        $validPassword = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_REGEXP, $passwordOptions);
        if(!empty($_POST['password']) && !$validPassword){
            self::$valid_status['password'] = "Password needs to have minimum 8 characters, 1 capital character, 1 small character and 1 special character.";
        }
        
        if(empty($_POST['password2'])){
            self::$valid_status['password2'] = "Please confirm the password.";
        }
        if(isset($_POST['password2']) && $_POST['password2'] != $_POST['password'] || !$validPassword){
            self::$valid_status['password2'] = "Please confirm your password again.";
        }
        
        return self::$valid_status;
    }

    static function validateInvites($users){

        $studentIDOptions = array("options"=>array("regexp"=> "/^3003\d{5}$/"));
        $validStudentID = filter_input(INPUT_POST, 'studentID', FILTER_VALIDATE_REGEXP, $studentIDOptions);
        if(!$validStudentID){
            self::$valid_status['studentID'] = "Student ID needs to be Douglas College 3003XXXXX format.";
        }

        if(empty($_POST['studentID'])){
            self::$valid_status['studentID'] = "Please enter a studentID.";
        }

        $user=array();
        for($i=0;$i<count($users); $i++){
            array_push($user, $users[$i]->getStudentID());
        }

        if($validStudentID && !in_array($_POST["studentID"], $user) && ($_POST["studentID"] == $_SESSION['studentID'])){
            self::$valid_status['studentID'] = "You cannot invite yourself.";
        }
        
        if($validStudentID && !in_array($_POST["studentID"], $user)){
            self::$valid_status['studentID'] = "Account doesnt exist.";
        }

        return self::$valid_status;
    }

    static function validateTask(){

        if(empty($_POST['taskName'])){
            self::$valid_status['taskName'] = "Please enter a task name.";
        }

        if(empty($_POST['taskDetails'])){
            self::$valid_status['taskDetails'] = "Please enter the task details.";
        }

        if(strlen($_POST['taskDetails']) > 255){
            self::$valid_status['taskDetails'] = "Task details can be maximum 255 characters.";
        }

        if(empty($_POST['userName'])){
            self::$valid_status['userName'] = "Please enter student name.";
        }

        return self::$valid_status;
    }
}



?>