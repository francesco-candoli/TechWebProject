<?php 
namespace App\Models;
use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class SiteMailer
{
    protected $host;
    protected $username;
    protected $password;
    protected $mailMit;
    protected $mailDest;
    protected $subject;
    protected $body;
    protected $altBody;

    public function __construct(string $host, string $username,
                                string $password,string $mailMit, 
                                string $mailDest,string $subject,
                                string $body,string $altBody
                                ){
        $this->host=$host;
        $this->username=$username;
        $this->password=$password;
        $this->mailMit=$mailMit;
        $this->mailDest=$mailDest;
        $this->subject=$subject;
        $this->body=$body;
        $this->altBody=$altBody;
    }
	
    public function SendMail(){
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 4;                      //Enable verbose debug output
            $mail->isSMTP();    
            //$mail -> Auth = true ;                                        //Send using SMTP
            $mail->Host       = $this->host;                     //Set the SMTP server to send through
            //$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   =  $this->username;                     //SMTP username
            $mail->Password   = $this->password;;                              //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS ;          //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

        
            //Recipients
            $mail->setFrom($this->mailMit);
            $mail->addAddress($this->mailDest);    
            //Content
            $mail->isHTML(true);                                 
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";       
        }
   }
}

        /*
CONFIGURAZIONE PER SERVER SMTP mail.bebmeccanica.it:


$mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 4;                      //Enable verbose debug output
            $mail->isSMTP();    
            //$mail -> Auth = true ;                                        //Send using SMTP
            $mail->Host       = 'mail.bebmeccanica.it';                     //Set the SMTP server to send through
            //$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'info@bebmeccanica.it';                     //SMTP username
            $mail->Password   = 'Infobebmeccanica.it';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS ;          //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            //Custom connection options
            //Note that these settings are INSECURE
        
            //Recipients
            $mail->setFrom('info@bebmeccanica.it');
            $mail->addAddress('gianluca.bianchi0899@gmail.com');     //Add a recipient
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            
        }
*/
?>