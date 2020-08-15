<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();
// Load Composer's autoloader
require 'vendor/autoload.php';
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug =2;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'erdemayberkae@gmail.com';                     // SMTP username
    $mail->Password   = 'Bondvar007';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('erdemayberkae@gmail.com', 'BirAtilim');


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $_GET['subject'];
    if($_GET['subject']=="E-mail Authorize")
    {
        $mail->addAddress($_GET['Email'],'Recipient');
      $mail->Body    = "<html>
      Welcome to biratilim.com

    <p>Please confirm your email address by clicking the link below <a href=https://localhost:90/BirAtilim/BirAtilim/Site/Php/authorize.php?subject=".$_GET['Email'].">E-mail authorize</a></p>
      </html> ";
    }
else if($_GET['subject']=="Destek"&&isset($_GET['Message']))
{
      $mail->addAddress('erdemayberkae@gmail.com','Recipient');
      $mail->Body  =$_GET['Message']."<br><br><br>Gönderen: ".$_SESSION['user'];
      $mail->send();
      header("Location:Home.php");
}


    $mail->send();
    echo 'Message has been sent';
    header("location:index.php");
}
 catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
