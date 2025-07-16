<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
if(isset($_POST['email']) && !empty($_POST['email'])){

		$name = $_POST["name"];
		$email = $_POST["email"];
		$subject = $_POST["subject"];
		$message = $_POST["message"];


		//date_default_timezone_set('Asia/Kolkata');
		$timestamp_capture = time();
		//$reg_time = date('d-m-Y h:i:s a', time());
		//$reg_ip = $_SERVER['REMOTE_ADDR'];
		//$reg_ip_proxy = $_SERVER['HTTP_X_FORWARDED_FOR'];

		$mail = new PHPMailer(true); // Passing true enables exceptions

		/*if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
	    	$siteurl = "https://".$_SERVER['SERVER_NAME'];
	    }else{
	    	$siteurl = "http://".$_SERVER['SERVER_NAME'];
	    }*/

		try {
			// Server settings
			$mail->isSMTP(); // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
			$mail->SMTPAuth = true; // Enable SMTP authentication
			$mail->Username = 'seanepalesa01@gmail.com'; // SMTP username
			$mail->Password = 'Seane15212001065Palesa'; // SMTP password
			$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587; // TCP port to connect to
	
			// Recipients
			$mail->setFrom($email, $name);
			 $mail->addAddress($_POST['email']); // Add a recipient
	
			// Content
			$mail->isHTML(true); // Set email format to HTML
			$mail->Subject = "Contact Form Message Sent From $name | Message ID ".time();
			$mail->Body    = "
				<br>
				<p>Details:</p>
				<br>
				<p><strong>Name:</strong> $name</p> 
				<p><strong>Email:</strong> $email</p> 
				<p><strong>Subject:</strong> $subject</p> 
				<p><strong>Message:</strong></p> 
				<p>$message</p>
				<br><br><br>...<br>
				This message is sent from $siteurl using a contact form.
			";
	
			$mail->SMTPDebug = 2; // Enable verbose debug output
			$mail->send();
			$response['status'] = 'ok';
			$response['msg'] = 'Message Sent Successfully.';
			echo json_encode($response);
		} catch (Exception $e) {
			$response['status'] = 'error';
			$response['msg'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
			echo json_encode($response);
		}
			

}else{
	$response['status'] = 'error';
	$response['msg'] = 'Something Went Wrong (Error 2). Please Send Us an Email!';
	echo json_encode($response);
}
?>