<?php

# CSIS 3280 - 004 Final Project
# Title : Group Project File Management System
# Group Member : (1) William, Lee (2) Gabrielle, Bocardi de Morais

# File : PHP Mailer - Using PHP Composer

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once ('phpMailer/vendor/autoload.php');

class MailManager{

    static function findPassword($user, $vkey){

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><head><!-- Compiled with Bootstrap Email version: 1.3.1 --><meta http-equiv="x-ua-compatible" content="ie=edge">';
        $message .= '<meta name="x-apple-disable-message-reformatting"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="format-detection" content="telephone=no, date=no, address=no, email=no"><meta http-equiv=';
        $message .= '"Content-Type" content="text/html; charset=utf-8"><style type="text/css">';
        $message .= 'body,table,td{font-family:Helvetica,Arial,sans-serif !important}.ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:150%}a{text-decoration:none}';
        $message .= '*{color:inherit}a[x-apple-data-detectors],u+#body a,#MessageViewBody a{color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit}img{-ms-interpolation-mode:bicubic}table:not([class^=s-])';
        $message .= '{font-family:Helvetica,Arial,sans-serif;mso-table-lspace:0pt;mso-table-rspace:0pt;border-spacing:0px;border-collapse:collapse}table:not([class^=s-]) td{border-spacing:0px;border-collapse:collapse}@media screen and (max-width: 600px){.w-full,';
        $message .= '.w-full>tbody>tr>td{width:100% !important}*[class*=s-lg-]>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-3>tbody>';
        $message .= 'tr>td{font-size:12px !important;line-height:12px !important;height:12px !important}.s-5>tbody>tr>td{font-size:20px !important;line-height:20px !important;height:20px !important}.s-8>tbody>tr>td{font-size:32px !important;line-height:32px !important;height:32px ';
        $message .= '!important}.s-10>tbody>tr>td{font-size:40px !important;line-height:40px !important;height:40px !important}}';
        $message .= '</style></head><body class="bg-light" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; ';
        $message .= '-moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">';
        $message .= '<table class="bg-light body" valign="top" role="presentation" border="0" cellpadding="0" cellspacing="0" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, ';
        $message .= 'sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">';
        $message .= '<tbody><tr><td valign="top" style="line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f7fafc">';
        $message .= '<table class="container" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"><tbody><tr>';
        $message .= '<td align="center" style="line-height: 24px; font-size: 16px; margin: 0; padding: 0 16px;"><!--[if (gte mso 9)|(IE)]><table align="center" role="presentation"><tbody><tr><td width="600">';
        $message .= '<![endif]--><table align="center" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; margin: 0 auto;"><tbody><tr>';
        $message .= '<td style="line-height: 24px; font-size: 16px; margin: 0;" align="left"><table class="s-10 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"><tbody><tr><td style="line-height: 40px; font-size: 40px; ';
        $message .= 'width: 100%; height: 40px; margin: 0;" align="left" width="100%" height="40">';
        $message .= '&#160;</td></tr></tbody></table><table class="ax-center" role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">';
        $message .= '<tbody><tr><td style="line-height: 24px; font-size: 16px; margin: 0;" align="left">';
        $message .= '<img class="" src="https://upload.wikimedia.org/wikipedia/commons/3/30/Douglas_College_logo.svg" alt="Douglas College Logo" width="90" height="45" style="height: auto; line-height: 100%; outline: none; text-decoration: none; display: block; border-style: none; border-width: 0;">';
        $message .= '</td></tr></tbody></table><table class="ax-center" role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">';
        $message .= '<tbody><tr><td style="line-height: 24px; font-size: 16px; margin: 0;" align="left">';
        $message .= '<p class="text-center  fw-700 text-2xl" style="line-height: 28.8px; font-size: 24px; font-weight: 700 !important; width: 100%; margin: 0;" align="center">Douglas College</p>';
        $message .= '</td></tr></tbody></table><table class="ax-center" role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;"><tbody><tr>';
        $message .= '<td style="line-height: 24px; font-size: 16px; margin: 0;" align="left"><p class="fw-100 text-2xl" style="line-height: 28.8px; font-size: 24px; font-weight: 100 !important; width: 100%; margin: 0;" align="left">File Management Portal</p>';
        $message .= '</td></tr></tbody></table><table class="s-8 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">';
        $message .= '<tbody><tr><td style="line-height: 32px; font-size: 32px; width: 100%; height: 32px; margin: 0;" align="left" width="100%" height="32">&#160;</td></tr></tbody></table>';
        $message .= '<table class="card" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important; width: 100%; overflow: hidden; border: 1px solid #e2e8f0;" bgcolor="#ffffff">';
        $message .= '<tbody><tr><td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;" align="left" bgcolor="#ffffff">';
        $message .= '<table class="card-body" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">';
        $message .= '<tbody><tr><td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 20px;" align="left">';
        $message .= '<h1 class="h3" style="padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 28px; line-height: 33.6px; margin: 0;" align="left">Password Reset</h1>';
        $message .= '<table class="s-2 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">';
        $message .= '<tbody><tr><td style="line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left" width="100%" height="8">';
        $message .= '&#160;</td></tr></tbody></table><table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">';
        $message .= '<tbody><tr><td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">';
        $message .= '&#160;</td></tr></tbody></table><table class="hr" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">';
        $message .= '<tbody><tr><td style="line-height: 24px; font-size: 16px; border-top-width: 1px; border-top-color: #e2e8f0; border-top-style: solid; height: 1px; width: 100%; margin: 0;" align="left">';
        $message .= '</td></tr></tbody></table><table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">';
        $message .= '<tbody><tr><td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">&#160;</td></tr></tbody></table><div class="space-y-3">';
        $message .= '<p class="text-gray-700" style="line-height: 24px; font-size: 16px; color: #4a5568; width: 100%; margin: 0;" align="left">You have received this email because you have requested password reset. If you havent requested password reset, then please ignore this email.</p>';
        $message .= '<table class="s-3 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">';
        $message .= '<tbody><tr><td style="line-height: 12px; font-size: 12px; width: 100%; height: 12px; margin: 0;" align="left" width="100%" height="12">';
        $message .= '&#160;</td></tr></tbody></table><p class="text-gray-700" style="line-height: 24px; font-size: 16px; color: #4a5568; width: 100%; margin: 0;" align="left">Please press <b>"Reset Password"</b> to reset your password.';
        $message .= '</p></div><table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">';
        $message .= '<tbody><tr><td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">';
        $message .= '&#160;</td></tr></tbody></table><table class="hr" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">';
        $message .= '<tbody><tr><td style="line-height: 24px; font-size: 16px; border-top-width: 1px; border-top-color: #e2e8f0; border-top-style: solid; height: 1px; width: 100%; margin: 0;" align="left">';
        $message .= '</td></tr></tbody></table><table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">';
        $message .= '<tbody><tr><td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">';
        $message .= '&#160;</td></tr></tbody></table><table class="btn btn-success ax-center" role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important; margin: 0 auto;">';
        $message .= '<tbody><tr><td style="line-height: 24px; font-size: 16px; border-radius: 6px; margin: 0;" align="center" bgcolor="#198754">';
        $message .= '<a href="http://localhost/FinalProject_WLe41465_GBo51454/FinalProject_login_WLe41465_GBo51454.php?action=resetPassword&vkey='.$vkey.'" target="_blank" style="color: #ffffff; font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; ';
        $message .= 'border-radius: 6px; line-height: 20px; display: block; font-weight: normal; white-space: nowrap; background-color: #198754; padding: 8px 12px; border: 1px solid #198754;">Reset Password</a>';
        $message .= '</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><table class="s-8 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">';
        $message .= '<tbody><tr><td style="line-height: 32px; font-size: 32px; width: 100%; height: 32px; margin: 0;" align="left" width="100%" height="32">';
        $message .= '&#160;</td></tr></tbody></table></td></tr></tbody></table><!--[if (gte mso 9)|(IE)]></td></tr></tbody></table><![endif]--></td></tr></tbody></table></td></tr></tbody></table></body></html>';
 
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try{
            //Server settings
            $mail->isSMTP();                                                    //Send using SMTP
            $mail->Host       = 'smtp-mail.outlook.com';                        //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                           //Enable SMTP authentication
            $mail->Username   = 'douglascollege.filemanagement@outlook.com';    //SMTP username
            $mail->Password   = 'Csis3280!';                                    //SMTP password
            $mail->SMTPSecure = 'tls';                                          //Enable implicit TLS encryption
            $mail->Port       = 587;                                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('douglascollege.filemanagement@outlook.com', 'Douglas College File Management Portal');
            $mail->addAddress($user->getEmail());               

            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = 'Douglas College File Management Portal Find Password';
            $mail->Body    = $message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            Page::getMailErrorMessage();
            return false;
        }
    }

    static function accountVerification($user, $vkey){
        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><head>';
        $message .= '<!-- Compiled with Bootstrap Email version: 1.3.1 --><meta http-equiv="x-ua-compatible" content="ie=edge">';
        $message .= '<meta name="x-apple-disable-message-reformatting"><meta name="viewport" content="width=device-width, initial-scale=1">';
        $message .= '<meta name="format-detection" content="telephone=no, date=no, address=no, email=no"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">';
        $message .= 'body,table,td{font-family:Helvetica,Arial,sans-serif !important}.ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,';
        $message .= '.ExternalClass div{line-height:150%}a{text-decoration:none}*{color:inherit}a[x-apple-data-detectors],u+#body a,#MessageViewBody a{color:inherit;text-decoration:none;font-size:inherit;';
        $message .= 'font-family:inherit;font-weight:inherit;line-height:inherit}img{-ms-interpolation-mode:bicubic}table:not([class^=s-]){font-family:Helvetica,Arial,sans-serif;mso-table-lspace:0pt;';
        $message .= 'mso-table-rspace:0pt;border-spacing:0px;border-collapse:collapse}table:not([class^=s-]) td{border-spacing:0px;border-collapse:collapse}@media screen and (max-width: 600px){.w-full,';
        $message .= '.w-full>tbody>tr>td{width:100% !important}*[class*=s-lg-]>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-2>tbody>tr>td{font-size:8px !important;';
        $message .= 'line-height:8px !important;height:8px !important}.s-3>tbody>tr>td{font-size:12px !important;line-height:12px !important;height:12px !important}.s-5>tbody>tr>td{font-size:20px !important;';
        $message .= 'line-height:20px !important;height:20px !important}.s-10>tbody>tr>td{font-size:40px !important;line-height:40px !important;height:40px !important}}</style></head>';
        $message .= '<body class="bg-light" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; ';
        $message .= 'line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc">';
        $message .= '<table class="bg-light body" valign="top" role="presentation" border="0" cellpadding="0" cellspacing="0" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; ';
        $message .= '-ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: ';
        $message .= 'border-box; color: #000000; margin: 0; padding: 0; border-width: 0;" bgcolor="#f7fafc"><tbody><tr>';
        $message .= '<td valign="top" style="line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f7fafc"><table class="container" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">';
        $message .= '<tbody><tr><td align="center" style="line-height: 24px; font-size: 16px; margin: 0; padding: 0 16px;"><!--[if (gte mso 9)|(IE)]><table align="center" role="presentation"><tbody><tr><td width="600"><![endif]-->';
        $message .= '<table align="center" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; margin: 0 auto;"><tbody><tr><td style="line-height: 24px; font-size: 16px; margin: 0;" align="left">';
        $message .= '<table class="s-10 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"><tbody><tr>';
        $message .= '<td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;" align="left" width="100%" height="40">&#160;</td></tr></tbody></table>';
        $message .= '<table class="ax-center" role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;"><tbody><tr><td style="line-height: 24px; font-size: 16px; margin: 0;" align="left">';
        $message .= '<img class="" src="https://upload.wikimedia.org/wikipedia/commons/3/30/Douglas_College_logo.svg" alt="Douglas College Logo" width="90" height="45" style="height: auto; line-height: 100%; outline: none; ';
        $message .= 'text-decoration: none; display: block; border-style: none; border-width: 0;"></td></tr></tbody></table><table class="ax-center" role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">';
        $message .= '<tbody><tr><td style="line-height: 24px; font-size: 16px; margin: 0;" align="left"><p class="text-center  fw-700 text-2xl" style="line-height: 28.8px; font-size: 24px; font-weight: 700 !important; width: 100%; margin: 0;" align="center">Douglas College</p>';
        $message .= '</td></tr></tbody></table><table class="ax-center" role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;"><tbody><tr>';
        $message .= '<td style="line-height: 24px; font-size: 16px; margin: 0;" align="left"><p class="fw-100 text-2xl" style="line-height: 28.8px; font-size: 24px; font-weight: 100 !important; width: 100%; margin: 0;" align="left">File Management Portal</p></td></tr></tbody></table>';
        $message .= '<table class="s-8 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"><tbody><tr><td style="line-height: 32px; font-size: 32px; width: 100%; height: 32px; margin: 0;" align="left" width="100%" height="32">';
        $message .= '&#160;</td></tr></tbody></table><table class="card" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important; width: 100%; overflow: hidden; border: 1px solid #e2e8f0;" bgcolor="#ffffff">';
        $message .= '<tbody><tr><td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;" align="left" bgcolor="#ffffff">';
        $message .= '<table class="card-body" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"><tbody><tr><td style="line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 20px;" align="left">';
        $message .= '<h1 class="h3" style="padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 28px; line-height: 33.6px; margin: 0;" align="left">Account Verification</h1>';
        $message .= '<table class="s-2 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"><tbody><tr>';
        $message .= '<td style="line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left" width="100%" height="8">&#160;</td></tr></tbody></table>';
        $message .= '<table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"><tbody><tr>';
        $message .= '<td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">&#160;</td></tr></tbody></table><table class="hr" role="presentation" ';
        $message .= 'border="0" cellpadding="0" cellspacing="0" style="width: 100%;"><tbody><tr>';
        $message .= '<td style="line-height: 24px; font-size: 16px; border-top-width: 1px; border-top-color: #e2e8f0; border-top-style: solid; height: 1px; width: 100%; margin: 0;" align="left"></td></tr></tbody></table>';
        $message .= '<table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"><tbody><tr>';
        $message .= '<td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">&#160;</td></tr></tbody></table><div class="space-y-3">';
        $message .= '<p class="text-gray-700" style="line-height: 24px; font-size: 16px; color: #4a5568; width: 100%; margin: 0;" align="left">Thank you for signing up to Douglas College File Management Portal!</p>';
        $message .= '<table class="s-3 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"><tbody><tr>';
        $message .= '<td style="line-height: 12px; font-size: 12px; width: 100%; height: 12px; margin: 0;" align="left" width="100%" height="12">';
        $message .= '&#160;</td></tr></tbody></table><p class="text-gray-700" style="line-height: 24px; font-size: 16px; color: #4a5568; width: 100%; margin: 0;" align="left">Please press <b>"Verify account"</b> below to activate your account.';
        $message .= '</p></div><table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">';
        $message .= '<tbody><tr><td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">';
        $message .= '&#160;</td></tr></tbody></table><table class="hr" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"><tbody><tr>';
        $message .= '<td style="line-height: 24px; font-size: 16px; border-top-width: 1px; border-top-color: #e2e8f0; border-top-style: solid; height: 1px; width: 100%; margin: 0;" align="left">';
        $message .= '</td></tr></tbody></table><table class="s-5 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"><tbody><tr>';
        $message .= '<td style="line-height: 20px; font-size: 20px; width: 100%; height: 20px; margin: 0;" align="left" width="100%" height="20">&#160;</td></tr></tbody></table>';
        $message .= '<table class="btn btn-success ax-center" role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="border-radius: 6px; border-collapse: separate !important; margin: 0 auto;">';
        $message .= '<tbody><tr><td style="line-height: 24px; font-size: 16px; border-radius: 6px; margin: 0;" align="center" bgcolor="#198754">';
        $message .= '<a href="http://localhost/FinalProject_WLe41465_GBo51454/FinalProject_login_WLe41465_GBo51454.php?action=verifyAccount&vkey='.$vkey.'" target="_blank" style="color: #ffffff; font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; ';
        $message .= 'border-radius: 6px; line-height: 20px; display: block; font-weight: normal; white-space: nowrap; background-color: #198754; padding: 8px 12px; border: 1px solid #198754;">Verify Account</a>';
        $message .= '</td></tr></tbody></table></td></tr></tbody></table></td>';
        $message .= '</tr></tbody></table><table class="s-10 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%"><tbody><tr>';
        $message .= '<td style="line-height: 40px; font-size: 40px; width: 100%; height: 40px; margin: 0;" align="left" width="100%" height="40">&#160;</td></tr></tbody></table>';
        $message .= '</td></tr></tbody></table><!--[if (gte mso 9)|(IE)]></td></tr></tbody></table><![endif]--></td></tr></tbody></table></td></tr></tbody></table></body></html>';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try{
            //Server settings
            $mail->isSMTP();                                                    //Send using SMTP
            $mail->Host       = 'smtp.office365.com';                           //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                           //Enable SMTP authentication
            $mail->Username   = 'douglascollege.filemanagement@outlook.com';    //SMTP username
            $mail->Password   = 'Csis3280!';                                    //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                 //Enable implicit TLS encryption
            $mail->Port       = 587;                                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('douglascollege.filemanagement@outlook.com', 'Douglas College File Management Portal');
            $mail->addAddress($user->getEmail());              

            //Content
            $mail->isHTML(true);                               
            $mail->Subject = 'File Management Portal Account Verification';
            $mail->Body    = $message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            Page::getMailErrorMessage();
            return false;
        }
    }
}
?>