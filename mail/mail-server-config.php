<?php
use PHPMailer\PHPMailer\PHPMailer;

function send_mail_to_user($receiver,$subject,$message) {

    require_once("PHPMailer/PHPMailer.php");
    require_once("PHPMailer/SMTP.php");
    require_once("PHPMailer/Exception.php");

    $mail = new PHPMailer();

    //SMTP Settings
    $mail->isSMTP();
    $mail->Host = "mail.himusharier.xyz"; // host address
    $mail->SMTPAuth = true;
    $mail->SMTPAutoTLS = true;
    $mail->Username = "admin@himusharier.xyz"; // server mail address
    $mail->Password = 'HbJfb#]Q{u$R'; // server mail password
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom('admin@himusharier.xyz', '@admin, Sharier Himu'); // server mail, site name
    $mail->addAddress($receiver); //enter your email address
    $mail->Subject = ($subject);
    $mail->Body = $message;

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }

}
