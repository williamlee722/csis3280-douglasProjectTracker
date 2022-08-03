<?php

# CSIS 3280 - 004 Final Project
# Title : Group Project File Management System
# Group Member : (1) William, Lee (2) Gabrielle, Bocardi de Morais

# File : Login / Register / Forgot Password / Account Verification

// Require the config
require_once('./inc/config.inc.php');

// Require the entities
require_once('./inc/Entity/Validate.class.php');
require_once('./inc/Entity/Page.class.php');
require_once('./inc/Entity/User.class.php');

// Require the utilities
require_once('./inc/Utility/UserDAO.class.php');
require_once('./inc/Utility/PDOService.class.php');
require_once('./inc/Utility/MailManager.class.php');

//-Login---------------------------------------------------------------------
// If user press the login button
if(isset($_POST['login'])){
    // Initialize User DAO
    UserDAO::initialize('User');
    // Seach database see if the user exists
    $authUser = UserDAO::getUser($_POST['studentIDLogin']);
    // If user does not exist or password is wrong
    if(!$authUser ||!$authUser->verifyPassword($_POST['passwordLogin']))
        // Show notification that the password is wrong
        Page::$notification = "* Wrong username or password";
    // else if the user have registered but havent verified account
    elseif($authUser->getStatus() == "0")
        // Show notification that the account is not verified
        Page::$notification = "* Account not verified";
    else{
        // If user does exist, check if the password is correct
        if($authUser->verifyPassword($_POST['passwordLogin'])){
            // If password is correct, then start the session
            session_start();
            // Add StudentID and UserID into session for further use
            $_SESSION['studentID'] = $authUser->getStudentID();
            $_SESSION['userID'] = $authUser->getUserID();
            // Go to Select Project Page
            header("Location: ./FinalProject_project_WLe41465_Gbo51454.php");
            // Exit current page
            exit;
        }
    }
}

// Initialize the valid status array to store validation messages
$valid_status = array();

// If the user press the "find password" button in the forgot password form
if(isset($_POST['findPassword'])){
    // Initialize the UserDAO to be used
    UserDAO::initialize('User');
    // Check for validation errors
    $valid_status = Validate::validateFindPassword(UserDAO::getUsers());
    // If all the inputs are correct
    if(empty($valid_status)){
        // Search for the user verification key
        $user = UserDAO::getUser($_POST['studentID']);
        $vkey = $user->getVKey();

        // Send the verification email to user
        if(MailManager::findPassword($user, $vkey)==true){
            // If verification email is sent successfully, show success message
            Page::getPasswordEmailSent();
        }
    }
}

// If the user presses submit button in register form
if(isset($_POST['submit'])){
    // Initialize the UserDAO to be used
    UserDAO::initialize('User');
    // Check for validation errors
    $valid_status = Validate::validate(UserDAO::getUsers());
    // If all the inputs are correct
    if(empty($valid_status)){
        // Create new User object
        $newUser = new User();

        // Assember new User data
        $newUser->setStudentID($_POST['studentID']);
        // Password is hashed before storing in the database
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $newUser->setPassword($password);
        $newUser->setName($_POST['name']);
        $newUser->setEmail($_POST['email']);
        // Verification key is generated using md5 hash of mixture of time of registeration and studentID
        $vkey = md5(time().$_POST['studentID']);
        $newUser->setVKey($vkey);

        // Send the verification email to user
        if(MailManager::accountVerification($newUser, $vkey)==true){
            // If verification email is sent successfully, 'then' create new user
            UserDAO::createUser($newUser);
            // 'then' show success message
            Page::getThankyou();
        }
    }
}

// If User click "Verify Account" on the email, it will be directed with $_GET variables
if(isset($_GET['action']) && ($_GET['action'] == "verifyAccount")){
    // Initialize the UserDAO to be used
    UserDAO::initialize('User');
    // Set verification key variable
    $vkey = $_GET['vkey'];

    // If user is found using verification key
    if(UserDAO::verifyUser($vkey) == 1){
        // Update user status
        UserDAO::updateVerifiedUser($vkey);
        // show verification success message
        Page::getRegisterationComplete();
    }else{
        // if there is an error, show error message
        Page::getMailErrorMessage();
    }
}

// Get Page elements
Page::getHeader();
Page::getLogin();

// Reset password direction pages are displayed here to show the login in the background of the modars

// If User click "Reset Password" on the email, it will be directed with $_GET variables
if(isset($_GET['action']) && ($_GET['action'] == "resetPassword")){
    // Initialize the UserDAO to be used
    UserDAO::initialize('User');
    // Set verification key variable
    $vkey = $_GET['vkey'];

    // Get user info to check if user exists
    $users = UserDAO::getUsers();

    // Extract verification keys to see if there is a match
    // Initialize verification key array
    $vkeys=array();
    // gather (push) existing verification keys to verification array
    for($i=0;$i<count($users); $i++){
        array_push($vkeys, $users[$i]->getVKey());
    }

    // If user's verification key exists 
    if(in_array($vkey, $vkeys)){
        // show password change page
        Page::getResetPassword($valid_status);
    }else{
        // else show error
        Page::getMailErrorMessage();
    }
}

// If user click "reset password" button
if(isset($_POST['resetPassword'])){
    // Initialize the UserDAO to be used
    UserDAO::initialize('User');
    // Check for validation errors
    $valid_status = Validate::validatePassword(UserDAO::getUsers());
    // If all the inputs are correct
    if(empty($valid_status)){
        // hash the new password before storing in the database
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // Set verification key variable for hidden input
        $vkey = $_POST['vkey'];
        // update new password
        UserDAO::updateUserPassword($password, $vkey);
        // show change password success message
        Page::getResetPasswordComplete();
    // If there are errors in input
    }if(!empty($valid_status)){
        // show the password page again with error message
        Page::getResetPassword($valid_status);
    }
}

// if User click "register" button from the login page
if(isset($_POST['signUp']) || (!empty($valid_status)&&(isset($_POST['submit']))))
    // show register form
    Page::getRegister($valid_status);

// if User click "forgot password?" button from the login page
if(isset($_POST['forgotPassword']) || isset($_POST['findPassword'])&&(!empty($valid_status)))
    // Show forgot password form
    Page::getForgotPassword($valid_status);

Page::getFooter();
?>