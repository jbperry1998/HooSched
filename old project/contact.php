<?php
ini_set('display_errors', 'On');
$send_email = 'hoocooks@gmail.com';
//$send_password = '@Hoocooks19';

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message1 = $_POST['message'];

$message = $message1 . "\r\n" . 'From: ' . $name . "\r\n" . 'With Email: ' . $email ;

$to      = 'hoocooks@gmail.com';
$headers = 'From: hoocooks@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    
    /* Include the Composer generated autoload.php file. */
    require 'vendor/autoload.php';
    
    /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
    $mail = new PHPMailer(TRUE);

    $mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = "tls";
//Whether to use SMTP authentication
$mail->SMTPAuth = true;



    
    /* Open the try/catch block. */
    try {
       /* Set the mail sender. */
       $mail->Username = 'hoocooks@gmail.com';
       //Password to use for SMTP authentication
       $mail->Password = '@Hoocooks19';

       $mail->setFrom($send_email, 'HooCooks');
    
       /* Add a recipient. */
       $mail->addAddress($send_email, 'HooCooks');
    
       /* Set the subject. */
       $mail->Subject = $subject;
    
       /* Set the mail message body. */
       $mail->Body = $message;
    
       /* Finally send the mail. */
       $mail->send();
    }
    catch (Exception $e)
    {
       /* PHPMailer exception. */
       echo $e->errorMessage();
    }
    catch (\Exception $e)
    {
       /* PHP exception (note the backslash to select the global namespace Exception class). */
       echo $e->getMessage();
    }
    header('Location: index.html');
?>