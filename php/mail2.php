<?php
//phpinfo();
//if($_SERVER['REQUEST_METHOD']=='POST')
function sendMail($username, $randompass)
{
	
//echo "mailing";
require("lib/PHPMailer_5.2.1/class.phpmailer.php");
$mail = new PHPMailer(); 
$mail->SMTPDebug = 2 ;
 
$mail->IsSMTP();  // telling the class to use SMTP
$mail->Mailer = "smtp";
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "daiictintegratedcampus"; // SMTP username
$mail->Password = "daiictreset123"; // SMTP password 
 
$mail->From     = "daiictintegratedcampus@gmail.com";
$mail->AddAddress($username."@daiict.ac.in", "User");  
 
$mail->Subject  = "Integrated Campus - Forgot Password";
$mail->Body     = "New Password is ".$randompass;
$mail->WordWrap = 50;  
 
if(!$mail->Send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
echo 'Message has been sent.';
}
}
?>
<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action = "mail2.php" method = "post">
 <input type="submit" align="center" value="Submit" STYLE="background-color:#686868; color:#FFFFFF; font-size:18px" />
</form>
</body>
</html>-->