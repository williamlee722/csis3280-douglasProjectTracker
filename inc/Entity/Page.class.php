<?php

# CSIS 3280 - 004 Final Project
# Title : Group Project File Management System
# Group Member : (1) William, Lee (2) Gabrielle, Bocardi de Morais

# File : Page class for all page elements of the project

class Page {

    // notification is only used during login
    public static $notification;

//-Header for all pages-------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    static function getHeader(){
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title></title>
                <meta charset="utf-8">
                <meta name="author" content="">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
                <link href="../FinalProject_WLe41465_GBo51454/css/styles.css" rel="stylesheet">
            </head>
            <body>
        <?php
    }

//-Footer for all pages-------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    static function getFooter(){
        ?>
        </body>
        </html>
        <?php        
    }

//-Login Page-------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    static function getLogin(){
        ?>
        <section>
            <div class="text-center login w-100 m-auto">
                <form method="post">
                    <img class="mb-4" src="../FinalProject_WLe41465_GBo51454/img/Douglas_Logo.png" alt="Douglas College Logo" width="150" height="75">
                    <h1 class="h3 mb-4 fw-">File Management System Portal Login</h1>

                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" name="studentIDLogin" placeholder="3003XXXXX">
                        <label for="floatingInput">Student ID</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" name="passwordLogin" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <p class="mt-1 mb-3 text-danger">&ensp;<?php echo self::$notification?>&ensp;</p>
                    <button class="w-100 btn btn-lg btn-success" type="submit" name="login">Login</button>
                    <p class="fs-6 text-end"><button class="button btn btn-link" type="submit" name="forgotPassword">Forgot Password?</button></p>
                    <p class="mt-4 mb-3 text-muted">Don't have an Account? <button class="button btn btn-link" id="signUp" type="submit" name="signUp">Sign Up</button></p>

                </form>
            </div>
        </section>
        <?php
    }

    // Forgot password modal (pop up)
    static function getForgotPassword($valid_status){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow px-5 py-5">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h2 class="fw-bold mb-0">Forgot Password</h2>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_login_WLe41465_GBo51454.php"></a>
                    </div>
                    <div class="modal-body p-5 pt-0">
                    <form class="needs-validation" novalidate method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3
                        <?php if(array_key_exists('studentID', $valid_status))
                            echo "is-invalid"; if(isset($_POST['studentID']) && !array_key_exists('studentID', $valid_status))
                            echo "is-valid"; else echo"";?>" 
                            id="studentID" name="studentID" placeholder="3003XXXXX" value=<?php
                            if(isset($_POST['studentID']) && (array_key_exists('studentID', $valid_status)))
                            echo "";
                            if(isset($_POST['studentID']) && (!array_key_exists('studentID', $valid_status)))
                            echo $_POST['studentID'];
                            ?>>
                        <label for="studentID">Student ID</label>
                        <?php if(array_key_exists('studentID', $valid_status)){
                            echo '<div class="invalid-feedback">';
                            echo $valid_status['studentID'];
                            echo "</div>"; }?>
                    </div>
                    <button class="hi w-100 mb-2 btn btn-lg rounded-3 btn-success" id="loading" type="submit" name="findPassword">
                        <span class="spinner-border spinner-border-sm"></span>
                        <span class="text">Find Password&ensp;&ensp;</span></button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

        // After student ID is verified, change password mail is sent. This modal (pop up) is shown after mail is sent 
        static function getPasswordEmailSent(){
            ?>
            <div class="text-center modal d-block bg-secondary" id="hi">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-4 shadow px-5 py-5">
                    <div class="modal-header border-bottom-0 float-end">
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_login_WLe41465_GBo51454.php"></a>
                        </div>
                        <div class="p-3 pb-2">
                            <h2 class="fw-bold mb-0">Verification Email Sent</h2>
                        </div>
                        <form method="post">
                        <div class="modal-body pt-5">
                            <p>Please check your email for verification to change your password.</p>
                        </div>
                        <div class="modal-footer flex-column border-top-0">
                            <a href="https://outlook.office365.com/mail/" class="w-50 mb-2 btn btn-lg rounded-3 btn-success">Check Email</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }

    // After user opens the email for find password verification, user is redirected to this modal (pop up)
    static function getResetPassword($valid_status){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow px-5 py-5">
                    <div class="modal-header border-bottom-0 float-end">
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_login_WLe41465_GBo51454.php"></a>
                    </div>
                    <div class="p-3 pb-2">
                        <h2 class="mx-auto fw-bold pb-4">Reset Password</h2>
                    </div>
                    <div class="modal-body p-5 pt-0">
                    <form class="needs-validation" novalidate method="post">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3
                            <?php if(array_key_exists('password', $valid_status))
                            echo "is-invalid"; if(isset($_POST['password']) && !array_key_exists('password', $valid_status))
                            echo "is-valid"; else echo"";?>" 
                            id="password" name="password" placeholder="Password" value=<?php
                            if(isset($_POST['password']) && (array_key_exists('password', $valid_status)))
                            echo "";
                            if(isset($_POST['password']) && (!array_key_exists('password', $valid_status)))
                            echo $_POST['password'];
                            ?>>
                        <label for="password">Password</label>
                        <?php if(array_key_exists('password', $valid_status)){
                            echo '<div class="invalid-feedback">';
                            echo $valid_status['password'];
                            echo "</div>"; }?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3
                            <?php if(array_key_exists('password2', $valid_status))
                            echo "is-invalid"; if(isset($_POST['password2']) && !array_key_exists('password2', $valid_status))
                            echo "is-valid"; else echo"";?>" 
                            id="password2" name="password2" placeholder="Password" value=<?php
                            if(isset($_POST['password2']) && (array_key_exists('password2', $valid_status)))
                            echo "";
                            if(isset($_POST['password2']) && (!array_key_exists('password2', $valid_status)))
                            echo $_POST['password2'];
                            ?>>
                        <label for="password2">Confirm Password</label>
                        <?php if(array_key_exists('password2', $valid_status)){
                            echo '<div class="invalid-feedback">';
                            echo $valid_status['password2'];
                            echo "</div>"; }?>
                    </div>
                    <input type="hidden" name="vkey" value="<?php echo $_GET['vkey'];?>">
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-success" type="submit" name="resetPassword">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    // After user resets the password, show success message
    static function getResetPasswordComplete(){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow px-5 py-5">
                <div class="modal-header border-bottom-0 float-end">
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_login_WLe41465_GBo51454.php"></a>
                    </div>
                    <div class="p-3 pb-2">
                        <h2 class="mx-auto fw-bold pb-4">Password Changed!</h2>
                    </div>
                    <div class="modal-body pt-5">
                        <p>Password successfully changed! Please login again to continue</p>
                    </div>
                    <div class="modal-footer flex-column border-top-0">
                        <a href="../FinalProject_WLe41465_GBo51454/FinalProject_login_WLe41465_GBo51454.php" class="w-50 mb-2 btn btn-lg rounded-3 btn-success">Login</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    // Register form
    static function getRegister($valid_status){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Sign up!</h2>
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_login_WLe41465_GBo51454.php"></a>
                </div>

                <div class="modal-body p-5 pt-0">
                    <form class="needs-validation" novalidate method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3
                        <?php if(array_key_exists('studentID', $valid_status))
                            echo "is-invalid"; if(isset($_POST['studentID']) && !array_key_exists('studentID', $valid_status))
                            echo "is-valid"; else echo"";?>" 
                            id="studentID" name="studentID" placeholder="3003XXXXX" value=<?php
                            if(isset($_POST['studentID']) && (array_key_exists('studentID', $valid_status)))
                            echo "";
                            if(isset($_POST['studentID']) && (!array_key_exists('studentID', $valid_status)))
                            echo $_POST['studentID'];
                            ?>>
                        <label for="studentID">Student ID</label>
                        <?php if(array_key_exists('studentID', $valid_status)){
                            echo '<div class="invalid-feedback">';
                            echo $valid_status['studentID'];
                            echo "</div>"; }?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3
                        <?php if(array_key_exists('name', $valid_status))
                            echo "is-invalid"; if(isset($_POST['name']) && !array_key_exists('name', $valid_status))
                            echo "is-valid"; else echo"";?>" 
                            id="name" name="name" placeholder="First Name" value=<?php
                            if(isset($_POST['name']) && (array_key_exists('name', $valid_status)))
                            echo "";
                            if(isset($_POST['name']) && (!array_key_exists('name', $valid_status)))
                            echo $_POST['name'];
                            ?>>
                        <label for="name">Name</label>
                        <?php if(array_key_exists('name', $valid_status)){
                            echo '<div class="invalid-feedback">';
                            echo $valid_status['name'];
                            echo "</div>"; }?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3
                        <?php if(array_key_exists('email', $valid_status))
                            echo "is-invalid"; if(isset($_POST['email']) && !array_key_exists('email', $valid_status))
                            echo "is-valid"; else echo"";?>" 
                            id="email" name="email" placeholder="XXXX@student.douglascollege.ca" value=<?php
                            if(isset($_POST['email']) && (array_key_exists('email', $valid_status)))
                            echo "";
                            if(isset($_POST['email']) && (!array_key_exists('email', $valid_status)))
                            echo $_POST['email'];
                            ?>>
                        <label for="email">Email</label>
                        <?php if(array_key_exists('email', $valid_status)){
                            echo '<div class="invalid-feedback">';
                            echo $valid_status['email'];
                            echo "</div>"; }?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3
                            <?php if(array_key_exists('password', $valid_status))
                            echo "is-invalid"; if(isset($_POST['password']) && !array_key_exists('password', $valid_status))
                            echo "is-valid"; else echo"";?>" 
                            id="password" name="password" placeholder="Password" value=<?php
                            if(isset($_POST['password']) && (array_key_exists('password', $valid_status)))
                            echo "";
                            if(isset($_POST['password']) && (!array_key_exists('password', $valid_status)))
                            echo $_POST['password'];
                            ?>>
                        <label for="password">Password</label>
                        <?php if(array_key_exists('password', $valid_status)){
                            echo '<div class="invalid-feedback">';
                            echo $valid_status['password'];
                            echo "</div>"; }?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3
                            <?php if(array_key_exists('password2', $valid_status))
                            echo "is-invalid"; if(isset($_POST['password2']) && !array_key_exists('password2', $valid_status))
                            echo "is-valid"; else echo"";?>" 
                            id="password2" name="password2" placeholder="Password" value=<?php
                            if(isset($_POST['password2']) && (array_key_exists('password2', $valid_status)))
                            echo "";
                            if(isset($_POST['password2']) && (!array_key_exists('password2', $valid_status)))
                            echo $_POST['password2'];
                            ?>>
                        <label for="password2">Confirm Password</label>
                        <?php if(array_key_exists('password2', $valid_status)){
                            echo '<div class="invalid-feedback">';
                            echo $valid_status['password2'];
                            echo "</div>"; }?>
                    </div>
                    <button class="hi w-100 mb-2 btn btn-lg rounded-3 btn-success" id="loading" type="submit" name="submit">
                        <span class="spinner-border spinner-border-sm"></span>
                        <span class="text">Sign up&ensp;&ensp;</span></button>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <?php
    }

    // After registeration, account verification mail is sent. This modal (pop up) is shown after mail is sent 
    static function getThankyou(){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow px-5 py-5">
                <div class="modal-header border-bottom-0 float-end">
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_login_WLe41465_GBo51454.php"></a>
                    </div>
                    <div class="p-3 pb-2">
                        <h2 class="fw-bold mb-0">Sign Up Complete</h2>
                    </div>
                    <form method="post">
                    <div class="modal-body pt-5">
                        <p>Thank you for registering! Please check your email for account verification.</p>
                    </div>
                    <div class="modal-footer flex-column border-top-0">
                        <a href="https://outlook.office365.com/mail/" class="w-50 mb-2 btn btn-lg rounded-3 btn-success">Check Email</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    // After verification is complete, this modal (pop up) will show
    static function getRegisterationComplete(){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow px-5 py-5">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h2 class="fw-bold mb-0">Sign Up Complete</h2>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_login_WLe41465_GBo51454.php"></a>
                    </div>
                    <div class="modal-body pt-5">
                        <p>Registeration complete! Please login to continue</p>
                    </div>
                    <div class="modal-footer flex-column border-top-0">
                        <a href="../FinalProject_WLe41465_GBo51454/FinalProject_login_WLe41465_GBo51454.php" class="w-50 mb-2 btn btn-lg rounded-3 btn-success">Login</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    // If there are any errors regarding verfication, this modal(pop up) will show
    static function getMailErrorMessage(){
        ?>
        <div class="text-center modal d-block bg-secondary" id="hi">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow px-5 py-5">
                    <div class="modal-header border-bottom-0 float-end">
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_login_WLe41465_GBo51454.php"></a>
                    </div>
                    <h2 class="mx-auto fw-bold mb-0 fs-1">Oops!</h2>
                    <form method="post">
                    <div class="modal-body pt-5">
                        <p>There seems to be an issue,<br>please try again and if the problem continues,<br>please contact the administration office:<br><a href="mailto:douglascollege.filemanagement@outlook.com">douglascollege.filemanagement@outlook.com</a></p>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

//-Project Page-------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    // Nav bar of the project page
    static function getProjectHeader($existingProject){
        ?>
        <header class="px-3 pt-2 pb-1 bg-dark text-white">
        <div class="container">
            <form method="post" class="m-0">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="https://www.douglascollege.ca/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <div>
                    <img class="bi me-2" src="../FinalProject_WLe41465_GBo51454/img/Douglas_Logo_White.png" alt="Douglas College Logo" width="40" height="40" role="img" aria-label="Bootstrap">
                    <p class="m-0 fs-6"><b>Douglas College</b> File Management Portal</p>
                    </div>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"></ul>

                <button type="submit" name="createProject" class="btn btn-success me-2">Create New Project</button>
                <p class="pt-3">or</p>
                <div class="input-group pe-1 me-5 ms-2" style="width:300px;">
                    <select class="form-select" aria-label="Default select example" name="selectProject">
                    <option selected>Open different project</option>
                    <?php for($i=0; $i<count($existingProject); $i++){
                        if($existingProject[$i]->getRoleID() != 4)
                            echo '<option value="'.$i.'"><b>'.$existingProject[$i]->getProjectname().'</b>&nbsp&nbsp<i>('.$existingProject[$i]->getCoursename().')</i>&nbsp&nbsp</option>';}?>
                    </select>
                    <button class="btn btn-success" type="submit" name="chooseProject" >Go</button>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-success" name="settings">Settings</button>
                    <button type="submit" class="btn btn-secondary" name="logout">Logout</button>
                </div>
            </div>
            </form>
        </div>
        </header>
        <?php
    }

    // If user does not have any on going projects, this modal (pop up) will show
    static function getCreateNewProject(){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow px-5 py-5">
                    <div class="modal-header border-bottom-0">
                    </div>
                    <div class="modal-body">
                        <h3>Looks like you don't have any on going projects!<br><br>Why not start one?</h3>
                    </div>
                    <form method="post">
                    <div class="modal-footer flex-column border-top-0">
                        <input class="w-50 mb-2 btn btn-lg rounded-3 btn-success" type="submit" name="createProject" value="Create Project">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    // If user selects create new project, this form will show
    static function getCreateProject($valid_status){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Create New Project</h2>
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_project_WLe41465_GBo51454.php"></a>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form class="needs-validation" novalidate method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3
                        <?php if(array_key_exists('projectName', $valid_status))
                            echo "is-invalid"; if(isset($_POST['projectName']) && !array_key_exists('projectName', $valid_status))
                            echo "is-valid"; else echo"";?>" 
                            id="projectName" name="projectName" placeholder="3003XXXXX" value=<?php
                            if(isset($_POST['projectName']) && (array_key_exists('projectName', $valid_status)))
                            echo "";
                            if(isset($_POST['projectName']) && (!array_key_exists('projectName', $valid_status)))
                            echo $_POST['projectName'];
                            ?>>
                        <label for="studentID">Project Name</label>
                        <?php if(array_key_exists('projectName', $valid_status)){
                            echo '<div class="invalid-feedback">';
                            echo $valid_status['projectName'];
                            echo "</div>"; }?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3
                        <?php if(array_key_exists('courseName', $valid_status))
                            echo "is-invalid"; if(isset($_POST['courseName']) && !array_key_exists('courseName', $valid_status))
                            echo "is-valid"; else echo"";?>" 
                            id="courseName" name="courseName" placeholder="First Name" value=<?php
                            if(isset($_POST['courseName']) && (array_key_exists('courseName', $valid_status)))
                            echo "";
                            if(isset($_POST['courseName']) && (!array_key_exists('courseName', $valid_status)))
                            echo $_POST['courseName'];
                            ?>>
                        <label for="courseName">Course Name</label>
                        <?php if(array_key_exists('courseName', $valid_status)){
                            echo '<div class="invalid-feedback">';
                            echo $valid_status['courseName'];
                            echo "</div>"; }?>
                    </div>
                    <button class="hi w-100 mb-2 btn btn-lg rounded-3 btn-success" id="loading" type="submit" name="createNewProject">
                        <span class="spinner-border spinner-border-sm"></span>
                        <span class="text">Create New Project&ensp;&ensp;</span></button>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <?php
    }

    // settings form of the nav bar
    static function getSettings(){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow px-5 py-5">
                <div class="modal-header border-bottom-0 float-end">
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_project_WLe41465_GBo51454.php"></a>
                    </div>
                    <div class="p-0">
                        <h2 class="fw-bold fs-1 mb-0">Settings</h2>
                    </div>
                    <form method="post">
                    <div class="modal-body">
                        <button type="submit" name="changePassword" class="px-3 py-2 mt-4 btn btn-lg rounded-3 btn-success">Change Password</button><br>
                        <a href="mailto:douglascollege.filemanagement@outlook.com" class="px-3 py-2 mt-2 btn btn-lg rounded-3 btn-success">Contact Admin</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    // if user selects change password from settings
    static function getChangePassword($valid_status){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow px-5 py-5">
                    <div class="modal-header border-bottom-0 float-end">
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_project_WLe41465_GBo51454.php"></a>
                    </div>
                    <div class="p-3 pb-2">
                        <h2 class="mx-auto fw-bold pb-4">Change Password</h2>
                    </div>
                    <div class="modal-body p-5 pt-0">
                    <form class="needs-validation" novalidate method="post">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3
                            <?php if(array_key_exists('password', $valid_status))
                            echo "is-invalid"; if(isset($_POST['password']) && !array_key_exists('password', $valid_status))
                            echo "is-valid"; else echo"";?>" 
                            id="password" name="password" placeholder="Password" value=<?php
                            if(isset($_POST['password']) && (array_key_exists('password', $valid_status)))
                            echo "";
                            if(isset($_POST['password']) && (!array_key_exists('password', $valid_status)))
                            echo $_POST['password'];
                            ?>>
                        <label for="password">Password</label>
                        <?php if(array_key_exists('password', $valid_status)){
                            echo '<div class="invalid-feedback">';
                            echo $valid_status['password'];
                            echo "</div>"; }?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3
                            <?php if(array_key_exists('password2', $valid_status))
                            echo "is-invalid"; if(isset($_POST['password2']) && !array_key_exists('password2', $valid_status))
                            echo "is-valid"; else echo"";?>" 
                            id="password2" name="password2" placeholder="Password" value=<?php
                            if(isset($_POST['password2']) && (array_key_exists('password2', $valid_status)))
                            echo "";
                            if(isset($_POST['password2']) && (!array_key_exists('password2', $valid_status)))
                            echo $_POST['password2'];
                            ?>>
                        <label for="password2">Confirm Password</label>
                        <?php if(array_key_exists('password2', $valid_status)){
                            echo '<div class="invalid-feedback">';
                            echo $valid_status['password2'];
                            echo "</div>"; }?>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-success" type="submit" name="resetPassword">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    // When password is successfully changed
    static function getChangePasswordComplete(){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow px-5 py-5">
                <div class="modal-header border-bottom-0 float-end">
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_project_WLe41465_GBo51454.php"></a>
                    </div>
                    <div class="pt-4 pb-2">
                        <h2 class="mx-auto fw-bold pb-4">Password Changed!</h2>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

//-File Management Element------------------------------------------------------------------------------------------------------------------------------------------------------------------

    static function getFileList(array $files){
        ?>
        <div class="container">
            <div class="row">

                <div class="col-lg-8">
                    <div class="row mt-2 lg-5">
                    <div class="col m-3 pt-2 bg-white rounded">
                        <h2>Files</h2>
                        <form class="mb-3" method="post" enctype="multipart/form-data">
                        <div class="table-responsive mb-3" style="height:317px;">
                        <table class="table table-striped text-center table-sm table align-middle">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Size</th>
                                <th scope="col">Author</th>
                                <th scope="col">Date Modified</th>
                                <?php
                                if($_SESSION['roleID'] == 1 || $_SESSION['roleID'] == 2)
                                    echo '<th colspan="2">User Interaction</th>';
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=0;
                            if(empty($files)){
                                echo "<tr><td colspan=\"7\"><b>Upload a file to start</b></td></tr>";
                            }
                            foreach($files as $file){
                                if($i%2==0){
                                    echo "<tr class=\"evenRow\">";
                                }else{
                                    echo "<tr class=\"oddRow\">";
                                }
                                echo "<td>".$file->getFileName()."</td>";
                                echo "<td>".$file->getFileExt()."</td>";
                                echo "<td>".$file->getFileSize()."</td>";
                                echo "<td>".$file->getName()."</td>";
                                echo "<td>".$file->getModifyTime()."</td>";
                                if($_SESSION['roleID'] == 1 || $_SESSION['roleID'] == 2){
                                    echo '<td><a class="btn btn-success btn-sm" href="'.$file->getFilePath().'" target="_blank">Download</a></td>';
                                    echo '<td><a class="btn btn-secondary btn-sm" href="?action=fileDelete&id='.$file->getContentID().'">Delete</a></td>'; 
                                }
                                echo "</tr>";
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                        </div>
                        <?php 
                            if(!isset($_POST['upload'])){
                                echo '<div class="text-end">';
                                echo '<input class="btn '; if($_SESSION['roleID']==3) echo 'btn-light disabled"'; else echo 'btn-success"'; echo' type="submit" name="upload" value="Upload">';
                                echo '</div>';}
                            if(isset($_POST['upload'])) {
                                echo '<div class="float-end text-end input-group mb-3 w-50">';
                                echo '<input type="file" name="file" class="form-control">';
                                echo '<input class="input-group-text btn btn-success" type="submit" name="fileupload" value="Upload">';
                                echo '</div>';}?>
                        </form>
                    </div>
                    </div>
        <?php
    }

//-Task Tracker Element------------------------------------------------------------------------------------------------------------------------------------------------------------------

    static function getTaskTracker(array $tasks, $valid_status){
        ?>
        <div class="row lg-5">
            <div class="col m-3 pt-2 pb-1 bg-white rounded">
                <h2>Tasks</h2>
                <form method="post" class="mb-3 needs-validation" novalidate>
                <div class="table-responsive" style="height:317px;">
                    <table class="table table-striped table-sm text-center table align-middle">
                    <thead>
                        <tr>
                        <th class="text-center" scope="col">Task</th>
                        <th class="text-center" scope="col">Details</th>
                        <th class="text-center" scope="col">Student</th>
                        <th class="text-center" scope="col">Status</th>
                        <?php if($_SESSION['roleID']==1 || $_SESSION['roleID']==2) 
                        echo "<th scope=\"col\">Delete</th>";?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=0;
                        if(empty($tasks || isset($_POST['addTask']) || !empty($valid_status))){
                            echo "<tr><td colspan=\"9\"><b>Write a Task and start working</b></td></tr>";
                        }
                        foreach($tasks as $task){
                            if($i%2==0){
                                echo "<tr class=\"evenRow\">";
                            }else{
                                echo "<tr class=\"oddRow\">";
                            }
                            echo "<td class=\"text-center\"><div style=\"word-break: break-all;\">".$task->getTaskName()."</div></td>";
                            echo "<td class=\"text-center\"><div style=\"word-break: break-all;\">".$task->getTaskDetails()."</div></td>";
                            echo "<td class=\"text-center\"><div style=\"word-break: break-all;\">".$task->getUserName()."</div></td>";
                            if($task->getCompletion()==0){
                            echo '<td class="text-center" style="width:120px;"><a class="btn '; if($_SESSION["roleID"]==3) echo'btn-light btn-sm disabled px-1"'; else echo'btn-warning btn-sm px-1"'; echo ' href="?action=inProgress&id='.$task->getTaskID().'">In-Progress</a></td>';}
                            if($task->getCompletion()==1){
                            echo '<td class="text-center"><a class="btn '; if($_SESSION["roleID"]==3) echo'btn-light btn-sm disabled"'; else echo'btn-success btn-sm"'; echo ' href="?action=complete&id='.$task->getTaskID().'">Complete</a></td>';}
                            if($_SESSION['roleID']==1 || $_SESSION['roleID']==2){
                            echo '<td class="text-center"><a class="btn btn-secondary btn-sm" href="?action=taskDelete&id='.$task->getTaskID().'">Delete</a></td>'; 
                            }
                            echo "</tr>";
                            $i++;
                        }

                        if(isset($_POST['addTask'])||isset($_POST['submitTask'])&&!empty($valid_status)){

                            echo '<td><input class="form-control ';
                            if(array_key_exists('taskName', $valid_status))
                                echo "is-invalid";
                            if(isset($_POST['taskName']) && !array_key_exists('taskName', $valid_status))
                                echo "is-valid";
                            else
                                echo ""; 
                            echo '" id="taskName" name="taskName" value="';
                            if(isset($_POST['taskName']) && (array_key_exists('taskName', $valid_status)))
                                echo "";
                            if(isset($_POST['taskName']) && (!array_key_exists('taskName', $valid_status)))
                                echo $_POST['taskName'];
                            echo '">';

                            if(array_key_exists('taskName', $valid_status)){
                                echo '<div class="invalid-feedback">';
                                echo $valid_status['taskName'];
                                echo '</div>'; }
                            echo '</td>';

                            echo '<td><input class="form-control ';
                            if(array_key_exists('taskDetails', $valid_status))
                                echo "is-invalid";
                            if(isset($_POST['taskDetails']) && !array_key_exists('taskDetails', $valid_status))
                                echo "is-valid";
                            else
                                echo ""; 
                            echo '" id="taskDetails" name="taskDetails" value="';
                            if(isset($_POST['taskDetails']) && (array_key_exists('taskDetails', $valid_status)))
                                echo "";
                            if(isset($_POST['taskDetails']) && (!array_key_exists('taskDetails', $valid_status)))
                                echo $_POST['taskDetails'];
                            echo '">';

                            if(array_key_exists('taskDetails', $valid_status)){
                                echo '<div class="invalid-feedback">';
                                echo $valid_status['taskDetails'];
                                echo '</div>'; }
                            echo '</td>';

                            echo '<td><input class="form-control ';
                            if(array_key_exists('userName', $valid_status))
                                echo "is-invalid";
                            if(isset($_POST['userName']) && !array_key_exists('userName', $valid_status))
                                echo "is-valid";
                            else
                                echo ""; 
                            echo '" id="userName" name="userName" value="';
                            if(isset($_POST['userName']) && (array_key_exists('userName', $valid_status)))
                                echo "";
                            if(isset($_POST['userName']) && (!array_key_exists('userName', $valid_status)))
                                echo $_POST['userName'];
                            echo '">';

                            if(array_key_exists('userName', $valid_status)){
                                echo '<div class="invalid-feedback">';
                                echo $valid_status['userName'];
                                echo '</div>'; }
                            echo '</td>';

                            echo '<td class="text-center" style="width:120px;"><a class="completion btn btn-light btn-sm text-light px-1" disabled>In-Progress</a></td>';

                            echo '<td class="text-center"><a class="btn btn-light btn-sm text-light" disabled>Delete</a></td>'; 
                        }
                        ?>
                    </tbody>
                    </table>
                </div>
                <?php
                    if(isset($_POST['addTask'])||!empty($valid_status)) {
                        echo '<div class="text-end">';
                        echo '<input class="btn btn-success" type="submit" name="submitTask" value="Add">';
                        echo '</div>';
                    }   
                    if(!isset($_POST['addTask'])&&empty($valid_status)){
                        echo '<div class="text-end">';
                        echo '<input class="btn '; if($_SESSION['roleID']==3) echo 'btn-light disabled"'; else echo 'btn-success"'; echo' type="submit" name="addTask" value="Add">';
                        echo '</div>';
                    }?>
                </form>
                </div>
            </div>
        </div>
        <?php
    }

//-Project Info Element------------------------------------------------------------------------------------------------------------------------------------------------------------------

    static function getProjectName($project){
        ?>
        <div class="col-lg mt-4">
            <div class="row-lg lg-5 mb-4">
                <div class="col p-2 bg-white rounded">
                    <form method="post" class="m-0">
                        <h2 class="d-inline">Project Name</h2>
                        <?php if($_SESSION['roleID']==1)
                            echo '<button class = "btn btn-success btn-sm mt-1 float-end" type="submit" name="deleteProject">Delete Project</button>';
                        ?>
                    </form>
                    <p class="text-center fs-1 fw-bold mb-0"><?php 
                    if($project==false) 
                        echo "&ensp;"; 
                    else
                        echo $project->getProjectName();
                    echo '</p>
                    <p class="text-center mb-2 fs-6 fw-bold">';
                    if($project==false)
                        echo "&ensp;";
                    else
                        echo $project->getCoursename();
                    echo '</p>';?>
                </div>
            </div>
        <?php
    }

//-Progress Bar Element------------------------------------------------------------------------------------------------------------------------------------------------------------------

    static function getProgressStatus($currentPercent){
        ?>
        <div class="row-lg lg-5 mb-4">
        <div class="col p-2 bg-white rounded">
        <h2>Progress</h2>
            <?php echo
            '<div class="progress mx-2 mb-3" style="height:30px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: '.$currentPercent.'%;" aria-valuenow="'.$currentPercent.'" aria-valuemin="0" aria-valuemax="100">'.$currentPercent.'%</div>
            </div>';?>
        </div>
        </div>
        <?php
    }

//-Project Notice Element------------------------------------------------------------------------------------------------------------------------------------------------------------------

    static function getNotice($project){
        ?>
        <div class="row-lg lg-5 mb-4">
        <div class="col p-2 bg-white rounded">
        <h2>Notice</h2>
            <form method="post" class="m-0">
            <textarea class="form-control rounded-3 <?php if($_SESSION['roleID']!=1)echo 'mb-1 text-center';?>" name="notice" rows="<?php if($_SESSION['roleID']!=1)echo '9';else echo'7';?>" cols="10" <?php if($_SESSION['roleID']!=1) echo 'readonly';?>><?php if($project==false) echo ""; else echo $project->getNotice()?></textarea>
            <?php if($_SESSION['roleID']==1){
            echo '<div class = "text-end">';
            echo '<input type="submit" class = "btn btn-success m-1 mt-2" name="noticeUpdate" value="Update Notice">';
            echo '</div>';
            }?>
            </form>
        </div>
        </div>
        <?php
    }

//-Project Members Info Element------------------------------------------------------------------------------------------------------------------------------------------------------------------

    static function getProjectMembers($projectMembers, $user){
        ?>
        <div class="row-lg lg-5 mb-4">
        <div class="col p-2 bg-white rounded">
            <form method="post" class="mb-3">
            <h2 class="d-inline">Members</h2>
            <?php if($_SESSION['roleID']==2)
                echo'<button type="submit" class = "btn btn-success btn-sm mx-1 float-end" name="invite">Invite Members</button>';
            if($_SESSION['roleID']==1){
                echo '<div class="btn-group btn-group-sm float-end mt-1">';
                echo '<button type="submit" class="btn btn-outline-success" name="invite">Invite</button>';
                echo '<button type="submit" class="btn btn-outline-success" name="updateStatus">Update</button>';
                echo '</div>';
            }?>
            <div class="table-responsive" style="height:200px;">
                <table class="table table-striped table-sm text-center fs-2 table align-middle">
                <thead>
                    <tr>
                    <th class="text-center" scope="col">Name</th>
                    <th class="text-center" scope="col">Email</th>
                    <th class="text-center" scope="col">User Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    foreach($projectMembers as $projectMember){
                        if($i%2==0){
                            echo "<tr class=\"evenRow\">";
                        }else{
                            echo "<tr class=\"oddRow\">";
                        }
                        echo "<td class=\"text-center\"><div style=\"word-break: break-all;\">".$projectMember->getName()."</div></td>";
                        echo "<td class=\"text-center\"><div style=\"word-break: break-all;\">".$projectMember->getEmail()."</div></td>";
                        if($user->getUserType()=="Admin"){
                            if($projectMember->getRoleID()=="1"){
                                echo '<td><select class="form-select form-select-sm" name="userStatusChoice" disabled>';
                                echo '<option selected="">Admin</option>';
                            }else{
                            echo '<td><select class="form-select form-select-sm" name="'.$projectMember->getUserID().'">';
                            echo '<option value="2" '; if($projectMember->getRoleID()==2) echo 'selected'; echo '>User</option>';
                            echo '<option value="3" '; if($projectMember->getRoleID()==3) echo 'selected'; echo '>Guest</option>';
                            echo '<option value="4" '; if($projectMember->getRoleID()==4) echo 'selected'; echo '>Suspend</option>';
                            echo '</select>';
                            echo '</td>';}
                        }else{
                            echo "<td class=\"text-center\"><div style=\"word-break: break-all;\">".$projectMember->getUserType()."</div></td>";
                        }
                        echo "</tr>";
                        $i++;}?>
                </tbody>
                </table>
            </div>
            </form>
            </div>
        </div>
        </div>
        <?php
    }

    // If user wants to invite new members
    static function getInviteMembers($valid_status){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Invite Members!</h2>
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_project_WLe41465_GBo51454.php"></a>
                </div>
                <div class="modal-body p-5 pt-0">
                <form class="needs-validation" novalidate method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3
                        <?php if(array_key_exists('studentID', $valid_status))
                            echo "is-invalid"; if(isset($_POST['studentID']) && !array_key_exists('studentID', $valid_status))
                            echo "is-valid"; else echo"";?>" 
                            id="studentID" name="studentID" placeholder="3003XXXXX" value=<?php
                            if(isset($_POST['studentID']) && (array_key_exists('studentID', $valid_status)))
                            echo "";
                            if(isset($_POST['studentID']) && (!array_key_exists('studentID', $valid_status)))
                            echo $_POST['studentID'];
                            ?>>
                        <label for="studentID">Student ID</label>
                        <?php if(array_key_exists('studentID', $valid_status)){
                            echo '<div class="invalid-feedback">';
                            echo $valid_status['studentID'];
                            echo "</div>"; }?>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-success" type="submit" name="inviteMembers">Invite!</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    // When new members are successfully added, choice is given to the user to update new member from guest to user
    static function getInviteSuccess(){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow px-5 py-5">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h2 class="fw-bold mb-0">Invite Complete!</h2>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_project_WLe41465_GBo51454.php"></a>
                    </div>
                    <div class="modal-body pt-5">
                    <form method="post">
                        <p>Your new member is added to the project as 'Guest'.<br>Would you like to upgrade member to 'User'?</p>
                    </div>
                    <input type="hidden" name=student value="<?php echo $_POST["studentID"] ?>">
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-success" type="submit" name="upgradeUser">Yes</button>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-warning" href="../FinalProject_WLe41465_GBo51454/FinalProject_project_WLe41465_GBo51454.php">No</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    // If User decides to upgrade new member to user and succeeds 
    static function getUpgradeSuccess(){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow px-5 py-5">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h2 class="fw-bold mb-0">Upgrade Complete!</h2>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_project_WLe41465_GBo51454.php"></a>
                    </div>
                    <div class="modal-body pt-5">
                        <p>Your new member is added to the project as 'User'.</p>
                    </div>
                    <form method='post'>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-success" href="../FinalProject_WLe41465_GBo51454/FinalProject_project_WLe41465_GBo51454.php">Close</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    // If Admin decided to change project member status
    static function getUpdateSuccess(){
        ?>
        <div class="text-center modal d-block bg-secondary">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-4 shadow px-5 py-5">
                    <div class="modal-header border-bottom-0">
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="../FinalProject_WLe41465_GBo51454/FinalProject_project_WLe41465_GBo51454.php"></a>
                    </div>
                    <div class="modal-body fw-bold fs-1 mb-2">
                        <p>Members have been updated!</p>
                    </div>
                    <form method='post'>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-success" href="../FinalProject_WLe41465_GBo51454/FinalProject_project_WLe41465_GBo51454.php">Close</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}
?>