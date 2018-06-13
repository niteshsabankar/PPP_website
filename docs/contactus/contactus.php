<?php
	// message that will be displayed when everything is OK :)
	$okMessage = 'Contact form successfully submitted. Thank you, we will get back to you soon!';

	// If something goes wrong, we will display this message.
	$errorMessage = 'There was an error while submitting the form. Please try again later';

	$emailfrom = $_POST['email_from'];
	$name = $_POST['name'];
	$mailSub = $_POST['mail_sub'];
	$mailMsg = $_POST['mail_msg'];
	require("/var/www/html/docs/contactus/PHPMailer-master/src/PHPMailer.php");
	require("/var/www/html/docs/contactus/PHPMailer-master/src/SMTP.php");

	$mail = new PHPMailer\PHPMailer\PHPMailer();
	$mail->CharSet = "UTF-8";
	$mail->IsSMTP(); // enable SMTP

	$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; // or 587
	$mail->IsHTML(true);
	$mail->Username = "popgenplatform@gmail.com";
	$mail->Password = "del1r1um";
	$mail->SetFrom("popgenplatform@gmail.com");
	$mail->Subject = $mailSub;
	$message = nl2br("<b><u>Email Address:</u></b> $emailfrom<br><br><b><u>Name:</u></b> $name<br><br><b><u>Message:</u></b><br>$mailMsg");
	$mail->Body = $message;
	$mail->AddAddress("popgenplatform@gmail.com");

	if(!$mail->Send()) {
	$responseArray = array('type' => 'danger', 'message' => $errorMessage);
	} else {
	$responseArray = array('type' => 'success', 'message' => $okMessage);
	}

// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
// else just display the message
else {
    echo $responseArray['message'];
}

?>