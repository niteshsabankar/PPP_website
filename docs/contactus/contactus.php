<?php
	if(isset($_REQUEST["destination"])){
		header("Location: {$_REQUEST["destination"]}");
		}else if(isset($_SERVER["HTTP_REFERER"])){
		header("Location: {$_SERVER["HTTP_REFERER"]}");
		}else{
	/* some fallback, maybe redirect to index.php */
	}

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
	$mail->Username = "niteshsabankar@gmail.com";
	$mail->Password = "pa55w0rdlogic";
	$mail->SetFrom("niteshsabankar@gmail.com");
	$mail->Subject = $mailSub;
	$mail->Body = "<b><u>Email Address:</u></b> $emailfrom<br><br><b><u>Name:</u></b> $name<br><br><b><u>Message:</u></b> $mailMsg";
	$mail->AddAddress("niteshsabankar@gmail.com");

	if(!$mail->Send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	echo 'Success';
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