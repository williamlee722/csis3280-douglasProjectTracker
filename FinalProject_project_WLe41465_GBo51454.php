<?php

# CSIS 3280 - 004 Final Project
# Title : Group Project File Management System
# Group Member : (1) William, Lee (2) Gabrielle, Bocardi de Morais

# File : Project / Project Details / File Management / User Management

// Require the config
require_once('./inc/config.inc.php');

// Require the Entities
require_once('./inc/Entity/Validate.class.php');
require_once('./inc/Entity/Page.class.php');
require_once('./inc/Entity/User.class.php');
require_once('./inc/Entity/Project.class.php');
require_once('./inc/Entity/Role.class.php');
require_once('./inc/Entity/Content.class.php');
require_once('./inc/Entity/Task.class.php');
require_once('./inc/Entity/User_Project_Role.class.php');
require_once('./inc/Entity/User_Project_Content.class.php');
require_once('./inc/Entity/User_Project_Task.class.php');

// Require the Utilities
require_once('./inc/Utility/UserDAO.class.php');
require_once('./inc/Utility/ProjectDAO.class.php');
require_once('./inc/Utility/ContentDAO.class.php');
require_once('./inc/Utility/TaskDAO.class.php');
require_once('./inc/Utility/User_Project_RoleDAO.class.php');
require_once('./inc/Utility/User_Project_ContentDAO.class.php');
require_once('./inc/Utility/User_Project_TaskDAO.class.php');
require_once('./inc/Utility/PDOService.class.php');
require_once('./inc/Utility/MailManager.class.php');


// Start the session
session_start();

// If the session have been started for 600 seconds == 10 minutes, unset and destory session
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    session_unset();     
    session_destroy();  
}

// Initialize Valid_status array to store validate array
$valid_status = array();

// Verify the Login
if(isset($_SESSION['studentID'])){

    // if User have logged in, start counting session time (line 39)
    $_SESSION['LAST_ACTIVITY'] = time();

    // Initialize DAOs
    UserDAO::initialize('User');
    ProjectDAO::initialize('Project');
    ContentDAO::initialize('Content');
    TaskDAO::initialize('Task');
    User_Project_RoleDAO::initialize('User_Project_Role');
    User_Project_ContentDAO::initialize("User_Project_Content");
    User_Project_TaskDAO::initialize('User_Project_Task');

    // call existing projects, however if user is suspended from a project, delete project from list
    // call all the project user is linked to
    $callProject = User_Project_RoleDAO::getAllUserProjects($_SESSION['studentID']);
    // if user is suspended, delete project from list
    for($i=0; $i<count($callProject); $i++){
        if($callProject[$i]->getRoleID() == "4"){
            unset($callProject[$i]);
        }
    }
    // initialize project objects key number
    $existingProject = array_values(array_filter($callProject));
        
    // get project info
    $Projects = ProjectDAO::getProjects();

    // If user click "create new project" in new project form
    if(isset($_POST['createNewProject'])){
        // Check for validation errors
        $valid_status = Validate::validateNewProjectForm($Projects);

        // If there are no errors
        if(empty($valid_status)){
            // Create new Project Object
            $newProject = new Project();

            // Assemble new Project info
            $newProject->setProjectname($_POST['projectName']);
            $newProject->setCoursename($_POST['courseName']);
            
            // create new project in database
            User_Project_RoleDAO::createNewUserProjects($_SESSION['userID'], ProjectDAO::createProject($newProject));

            // add project info to session, the user is automatically set as admin
            $_SESSION['projectName']=$_POST['projectName'];
            $_SESSION['roleID']=1;

            // Go to the Projects page
            header("Location: ./FinalProject_project_WLe41465_GBo51454.php");
            
            // Exit current page
            exit;
        }

        // If there are errors
        if(!empty($valid_status)){
            // show error messages
            Page::getCreateProject($valid_status);
        }
    }

    // If user does have ongoing projects, open project from list
    if(!isset($_SESSION['projectName']) && !empty($existingProject)){
        $_SESSION['projectName']=$existingProject[0]->getProjectname();
        $_SESSION['roleID']=$existingProject[0]->getRoleID();
    }

    // If user selects another ongoing project from drop down list, direct to the selected project
    for($i=0; $i<count($existingProject); $i++){
        if(isset($_POST["selectProject"]) && ($_POST["selectProject"] == $i)){
            $_SESSION['projectName']=$existingProject[$i]->getProjectname();
            $_SESSION['roleID']=$existingProject[$i]->getRoleID();
            
            // Go to project page
            header("Location: ./FinalProject_project_WLe41465_GBo51454.php");
            
            // Exit current page
            exit;
        }
    }
    
    // If user does not have any ongoing projects, create new project
    if(empty($existingProject) && empty($valid_status)){
        Page::getHeader();
        Page::getCreateNewProject();
    }

    // If user selects create project, go to create new project form
    if(isset($_POST['createProject'])){
        Page::getCreateProject($valid_status);
    }

    // If user selects settings, show settings options (change password, contact admin)
    if(isset($_POST['settings'])){
        Page::getSettings();
    }

    //-File Management-------------------------------------------------------------------------------------------------------------------------------
    # This part contains the functions for file management, include file upload, file delete, file download, etc.

    // If user uploads the file and there are no errors
    if(isset($_POST['fileupload']) && ($_FILES['file']['error'])==0){

        // Set all variables needed for the file upload
        $fileFullName = $_FILES['file']['name'];                                                        // File Full Name
        $fileString = explode('.', $fileFullName);                                                      // File Full Name String
        $fileName = reset($fileString);                                                                 // File Name
        $fileExt = end($fileString);                                                                    // File Extension
    //  -------------------------------------------------------------------------------------------------------------------------------------------
        $size = $_FILES['file']['size'];                                                                // File size is bits
        $base = log($size, 1024);                                                                       // Chris Jester-Young's implementation
        $suffixes = array('', 'KB', 'MB', 'GB');                                                        // to change to other formats
        $fileSize = round(pow(1024, $base - floor($base)), 2) .' '. $suffixes[floor($base)];            // File Size
    //  -------------------------------------------------------------------------------------------------------------------------------------------
        $filePath = 'uploads/'.$_SESSION['projectName'].'/';                                            // Set Path for File Upload
        $fileTemp = $_FILES['file']['tmp_name'];                                                        // Current Path location for File Upload
    //  -------------------------------------------------------------------------------------------------------------------------------------------
        if(!is_dir($filePath))mkdir($filePath);                                                         // If directory doesnt exist create new
        $fileSavePath = $filePath.$fileFullName;                                                        // Create file path
        move_uploaded_file($fileTemp, $fileSavePath);                                                   // File Path
    //  -------------------------------------------------------------------------------------------------------------------------------------------
        
        // Assemble new File
        $newFile = new Content();
        $newFile->setFileName($fileName);
        $newFile->setFileSize($fileSize);
        $newFile->setFileExt($fileExt);
        $newFile->setFilePath($fileSavePath);
        

        // Assemble UserID, ProjectID, RoleID and ContentID for relationship Entity
        $userID = $_SESSION['userID'];
        $projectID = ProjectDAO::getProject($_SESSION['projectName'])->getProjectID();
        $roleID = $_SESSION['roleID'];
        // Store data into new Content entity. Returns contentID.
        $contentID = ContentDAO::createContent($newFile);

        // Store data into relationship entity
        User_Project_ContentDAO::createNewProjectContent($userID, $projectID, $roleID, (int)$contentID);
    }

    // If user selects delete for a file
    if (isset($_GET["action"]) && $_GET["action"] == "fileDelete"){
        // get the file from database
        $file = (ContentDAO::getContent($_GET['id']));
        // delete file directory
        unlink($file->getFilePath());   
        if(empty(glob('./uploads/'.$_SESSION['projectName'].'/*')))
        rmdir('./uploads/'.$_SESSION['projectName'].'/');
        // delete the file from database 
        ContentDAO::deleteContent($_GET['id']);
        // initialize URL, back to project page
        header('Location:./FinalProject_project_WLe41465_GBo51454.php');
        exit;
    }

    //-Progress Bar-------------------------------------------------------------------------------------------------------------------------------
    # This part contains the functions for progress bar, entirely out of php

    // if User selects in-progress, task is completed
    if (isset($_GET["action"]) && $_GET["action"] == "inProgress"){
        User_Project_TaskDAO::updateTaskCompletion($_GET['id'] , 1);
        header('Location:./FinalProject_project_WLe41465_GBo51454.php');
        exit;
    }

    // if user selects complete, task is still in-progress
    if (isset($_GET["action"]) && $_GET["action"] == "complete"){
        User_Project_TaskDAO::updateTaskCompletion($_GET['id'], 0);
        header('Location:./FinalProject_project_WLe41465_GBo51454.php');
        exit;
    }

    //-Task Element-------------------------------------------------------------------------------------------------------------------------------
    # This part contains the functions used to create, and delete tasks

    // If User click "submit task" after filling out inputs in the new task form
    if(isset($_POST['submitTask'])){
        // Check for validation errors
        $valid_status = Validate::validateTask();
        // If there are no errors
        if(empty($valid_status)){
            // call variables needed for new task creation
            $userID = $_SESSION['userID'];
            $projectID = ProjectDAO::getProject($_SESSION['projectName'])->getProjectID();
            $roleID = $_SESSION['roleID'];

            // create new Task object
            $newTask = new Task();
            // Assember new task variables
            $newTask->setTaskName($_POST['taskName']);
            $newTask->setTaskDetails($_POST['taskDetails']);
            $newTask->setUserName($_POST['userName']);

            // Create new task
            $taskID = TaskDAO::createTask($newTask);

            // Create new task relationship schema
            User_Project_TaskDAO::createNewTaskContent($userID, $projectID, $roleID, (int)$taskID);
        }
    }

    // If user selects task delete, task is deleted
    if (isset($_GET["action"]) && $_GET["action"] == "taskDelete"){
        // delete task
        TaskDAO::deleteTask($_GET['id']);
        header('Location:./FinalProject_project_WLe41465_GBo51454.php');
        exit;
    }

    // If admin click delet Project button
    if(isset($_POST['deleteProject'])){
        // Project gets deleted from the database
        ProjectDAO::deleteProject($_SESSION['projectName']);
        // User gets directed to a different Project or to create new project if no project exists
        $_SESSION['projectName']=$existingProject[0]->getProjectname();
        $_SESSION['roleID']=$existingProject[0]->getRoleID();
        header('Location:./FinalProject_project_WLe41465_GBo51454.php');
        exit;
    }

    // If user or admin wants to invite new members (NOTE: new member must be registered)
    if(isset($_POST['invite'])){
        Page::getInviteMembers($valid_status);
    }

    // If user click invite new member button after filling in the new member student ID
    if(isset($_POST['inviteMembers'])){
        // check if there are any errors
        $valid_status = Validate::validateInvites(UserDAO::getUsers(), User_Project_RoleDAO::getAllProjectUsers($_SESSION['projectName']));
        // if there are no errors
        if(empty($valid_status)){
            // Assemble new member info
            $projectID=ProjectDAO::getProject($_SESSION['projectName'])->getProjectID();
            $userID=UserDAO::getUser($_POST['studentID'])->getUserID();
            // Invite new member
            User_Project_RoleDAO::inviteNewUser($userID, $projectID);
            // if new member is successfully invited, show success message
            Page::getInviteSuccess();
        }else
        // If there are errors, show error message
        Page::getInviteMembers($valid_status);
    }

    // If User click on upgrade user button from the invite members form
    if(isset($_POST['upgradeUser'])){
        // Upgrade new member from guest to user
        $projectID=ProjectDAO::getProject($_SESSION['projectName'])->getProjectID();
        $userID=UserDAO::getUser($_POST['student'])->getUserID();
        User_Project_RoleDAO::changeUserStatus($userID, $projectID, 2);
        // Show upgrade success message
        Page::getUpgradeSuccess();
    }

    // If Admin click on update member button
    if(isset($_POST['updateStatus'])){
        // extract userID from $_POST
        foreach($_POST as $key=>$value){
            foreach((User_Project_RoleDAO::getAllProjectUsers($_SESSION['projectName'])) as $user)
            if($key == $user->getUserID()){
                // For every matching User ID set RoleID
                User_Project_RoleDAO::changeUserStatus($key, ProjectDAO::getProject($_SESSION['projectName'])->getProjectID(), $value);
            }
        }
        // Show Update Success Message
        Page::getUpdateSuccess();
    }

    // If There is a project opened
    if(isset($_SESSION['projectName'])){
        $allTasks = User_Project_TaskDAO::getAllProjectTasks($_SESSION['projectName']);

        //-This part is used to calculate the progress status--------------------------------------------------------------------------------------------------------------------
        $completion = array();
        $currentPercent="0";
        for($i=0; $i<count($allTasks); $i++){
            $completion[] = $allTasks[$i]->getCompletion();
        }
        if(!empty($completion)){
            if(!isset(array_count_values($completion)['1']))
                $currentPercent=0;
            else
                $currentPercent = (array_count_values($completion)['1']) / (count($allTasks)) * 100;
            $currentPercent = (number_format($currentPercent, 0, '.', ''));
        }

        // If Admin posts a new notice
        if(isset($_POST['noticeUpdate'])){
            $notice = $_POST['notice'];
            // add to database for storage
            ProjectDAO::updateNotice($notice, $_SESSION['projectName']);
        }

        // If User selects logout, unset and destroy session and logout
        if(isset($_POST['logout'])){
            header("Location: ./FinalProject_login_WLe41465_GBo51454.php");
            // Reset session
            session_unset();
            session_destroy();
        }
    }
        
    // display page elements
    Page::getHeader();
    Page::getProjectHeader($existingProject);

    // show only if there is project opened
    if(isset($_SESSION['projectName'])){
        Page::getFileList((User_Project_ContentDAO::getAllProjectContents($_SESSION['projectName'])));
        Page::getTaskTracker($allTasks, $valid_status);
        Page::getProjectName(ProjectDAO::getProject($_SESSION['projectName']));
        Page::getProgressStatus($currentPercent);
        Page::getNotice(ProjectDAO::getProject($_SESSION['projectName']));
        Page::getProjectMembers(User_Project_RoleDAO::getAllProjectUsers($_SESSION['projectName']), (User_Project_RoleDAO::getUserType($_SESSION['studentID'], $_SESSION['projectName'])));
    }

    // If user selects change password from settings (left here due to background modar)
    if(isset($_POST['changePassword'])){
        Page::getChangePassword($valid_status);
    }

    // If user click reset password
    if(isset($_POST['resetPassword'])){
        // Initialize the UserDAO to be used
        UserDAO::initialize('User');
        // Check for validation errors
        $valid_status = Validate::validatePassword(UserDAO::getUsers());
        // If all the inputs are correct
        if(empty($valid_status)){
            // hash the new password before storing in the database
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $userID = $_SESSION['userID'];
            // Update new password
            UserDAO::changeUserPassword($password, $userID);
            // show update new password complete message
            Page::getChangePasswordComplete();
        // If there is an error
        }if(!empty($valid_status)){
            //show error message
            Page::getChangePassword($valid_status);
        }
    }

// If login is not verified, redirect to the login page
}else{
    header("Location: ./FinalProject_login_WLe41465_GBo51454.php");
    // Reset session
    session_unset();
    session_destroy();
}

Page::getFooter();
?>