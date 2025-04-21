<?php

namespace core\classes;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class EnviarEmail{

    // __________________________________________________________________________ //
    ////////////////////////////////////////////////////////////////////////////////
    public function send_user_email_confirmation($email_user, $purl){

        // constroi o purl (link de validação para o email)
        $link = BASE_URL.'index.php?a=confirm_email&purl='.$purl;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = EMAIL_HOST;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = EMAIL_FROM;                     //SMTP username
    $mail->Password   = EMAIL_PASS;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = EMAIL_PORT;  
    $mail->CharSet    = 'UTF-8';                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom(EMAIL_FROM, APP_NAME);
    $mail->addAddress($email_user);                  //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments para poder enviar ficheiros
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = APP_NAME . ', Confirmação de registo';
    $html = '<h1> Olá   </h1> <h3 style="color:green;">O registo <b>' . $_POST['text_nome'] . ' </b> foi efectuado com sucesso</h3>';
    $html .= '<h4> Por questões de segurança e para poder usrfruir de todos os recursos da ' . APP_NAME . ', necessita confirmar o seu email, abaixo: </h4>';
    $html .= '<p><a href="'. $link .'" >Confirmar email </a></p><br>';
    $html .= '<h2><p><i><small>'.APP_NAME.'</small></i></p></h2>';
    $mail->Body  = $html;
    $mail->AltBody = 'Olá, O seu registo foi efectuado com sucesso, necessita confirmar o seu email. Copie o link na url: https://lemm.pt/FastOrder/public/index.php?a=confirm_email&purl='.$purl;

    $mail->send();
    return true;
   // echo 'Mensagem enviada com sucesso!';
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return false;
}

}

}