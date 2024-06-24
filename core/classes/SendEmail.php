<?php

namespace core\classes;

use core\classes\Functions;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Exception;


class SendEmail
{

    public static function send_email($client_email, $purl)
    {



        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';


        //Ready to send
        try {
            //Server settings
            $mail->SMTPDebug = 2; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = EMAIL_SMTP; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = EMAIL_USERNAME; //SMTP username
            $mail->Password = EMAIL_PASSWORD; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = EMAIL_PORT; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(EMAIL_SENDER, APP_DOMAIN);
            $mail->addAddress($client_email); //Add a recipient

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'test';

            //Email info
            $html = '<h3>Confirm your account</h3>';
            $html .= '<a href=" ' . APP_BASE_URL . '?a=confirm_email&purl=' . $purl . '" target="_blank">Confirm</a><br>';
            $html .= '<a href="#" target="_blank">' . APP_DOMAIN . '</a><br>';

            $mail->Body = $html;
            $mail->send();

            $_SESSION['success'] = "Email enviado com sucesso!";
            Functions::redirect('email-enviado');
            return;
        } catch (Exception $e) {
    
            $logger = new Log;
            $logger->logger($e->getMessage(), 'critical');


            return false;
        }
    }

    public static function send_email_reset_password($email, $token)
    {

        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';


        //Ready to send
        try {
            //Server settings
            $mail->SMTPDebug = 0; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = EMAIL_SMTP; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = EMAIL_SENDER; //SMTP username
            $mail->Password = EMAIL_PASSWORD; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = EMAIL_PORT; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(EMAIL_SENDER, APP_DOMAIN);
            $mail->addAddress($email); //Add a recipient

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Redefine password';

            //Email info
            $html = '<h3>Redefine password</h3>';
            $html .= '<a href=" ' . APP_BASE_URL . '?a=reset_password_page&token=' . $token . '" target="_blank">Redefine password</a><br>';
            $html .= '<a href="#" target="_blank">' . APP_DOMAIN . '</a><br>';

            $mail->Body = $html;
            $mail->send();

            Functions::redirect('email_sent_page');
            return;
        } catch (Exception $e) {

            $logger = new Log();
            $logger->logger($e->getMessage(), 'critical');



            return false;
        }
    }

    public function send_email_to_admin($user_message, $user_name, $user_email, $product_id)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';


        //Ready to send
        try {
            //Server settings
            $mail->SMTPDebug = 0; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = EMAIL_SMTP; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = EMAIL_SENDER; //SMTP username
            $mail->Password = EMAIL_PASSWORD; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = EMAIL_PORT; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(EMAIL_SENDER, APP_DOMAIN);
            $mail->addAddress("welerson194@gmail.com"); //Add a recipient

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = "Um cliente fez uma pergunta!";

            //Email info
            $html = '<h3>Pergunta do cliente ' . $user_name . ':</h3>';
            $html .= '<p>' . $user_message . '</p>';
            $html .= '<p>=============================================</p>';

            $html .= '<h3 style="font-weight:bold">Informações do cliente</h3>';
            $html .= '<p>Nome:' . $user_name . '</p>';
            $html .= '<p>Email: ' . $user_email . '</p>';

            $mail->Body = $html;
            $mail->send();

            //  Functions::redirect('contact_store_page');
            return true;

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
}
