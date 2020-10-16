<?php
    require 'Helpers/PHPMailer.php';
    require 'Helpers/SMTP.php';
    require 'Helpers/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

    $name = $_POST['name'];
    $visitorEmail = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

//Init mailclass
    $mail = new PHPMailer();
//Set mailer to use smtp
	$mail->isSMTP();
//Define smtp host
	$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	$mail->SMTPSecure = "tls";
//Port to connect smtp
	$mail->Port = "587";
//Set gmail username
	$mail->Username = "yasiru9733@gmail.com";
//Set gmail password
	$mail->Password = "YASIRU12345";
//Email subject
	$mail->Subject = "New Contact Form Submisson";
//Set sender email
	$mail->setFrom('yasiru9733@gmail.com');
//Enable HTML
	$mail->isHTML(true);
//Attachment
	//$mail->addAttachment('img/attachment.png');
//Email body
	$mail->Body = "<ul>
            <li>
                <div>Name : $name</div>
            </li>
            <li>
                <div>Email : $visitorEmail</div>
            </li>
            <li>
                <div>Subject : $subject</div>
            </li>
            <li>
                <div>Message : $message</div>
            </li>
        </ul>";

//Add recipient
	$mail->addAddress('yasiru97@gmail.com');
//Finally send email
	if ( $mail->send()) {
        echo "<div style=\"text-align:center;\">
        <h1>Thank you!</h1>
        <p>Your submission has been received Succssfully!.</p>
        <span id=\"timer\">
        </span>
        </div>
        <script type=\"text/javascript\">
        var count = 5;
        var redirect = \"../contact.php\";
         
        function countDown(){
            var timer = document.getElementById(\"timer\");
            if(count > 0){
                count--;
                timer.innerHTML = \"This page will redirect in \"+count+\" seconds.\";
                setTimeout(\"countDown()\", 1000);
            }else{
                window.location.href = redirect;
            }
        }
        countDown();
        </script>";
    }
    else {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
//Closing smtp connection
	$mail->smtpClose();

?>