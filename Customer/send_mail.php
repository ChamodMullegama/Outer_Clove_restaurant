<?php

require '../Db/connection.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';


class send_mail{

    public $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mail->isSMTP();                                           //Send using SMTP
        $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->Username   = 'kingchamod2001@gmail.com';                     //SMTP username
        $this->mail->Password   = 'jbta ymaz vqxi gwgb';                               //SMTP password
        $this->mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $this->mail->Port       = 465;      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
     
    }


 public function send_mail($customer_name,$customer_email,$customer_otp){


    try {
        $this->mail->setFrom('kingchamod2001@gmail.com','Outer Clove');
        $this->mail->addAddress($customer_email);
        $this->mail->isHTML(true);                                  //Set email format to HTML
        $this->mail->Subject = 'Verification Code for Registration: ' . $customer_name;
        $this->mail->Body = 'Your OTP for registration is: ' . $customer_otp;   
        $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $this->mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: { $this->mail->ErrorInfo}";
    }

}

public function sendmailresetpassword($customer_email,$reset_link){
    
    try {
        //Server settings
     
        $this->mail->setFrom('kingchamod2001@gmail.com','Outer Clove');
        $this->mail->addAddress($customer_email);    
        $this->mail->isHTML(true);                    //Set email format to HTML
        $this->mail->Subject = 'Reset Your password';
        $this->mail->Body =  "Click the link to reset your password: $reset_link";
        $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $this->mail->send();
        $_SESSION['success'] = 'password reset link in your inbox please chek your inbox.';
        header("location: forgot_password.php");
        echo 'Message has been sent';
    
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: { $this->mail->ErrorInfo}";
    }

}


}
 


?>