<?php


//If the form is submitted
if($_SERVER['REQUEST_METHOD'] == "POST") {

	//Check to make sure that the name field is not empty
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
		
	} else {
		$name = trim($_POST['contactname']);
	}

	
	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
		
	} else if (!filter_var(trim($_POST['email']),FILTER_VALIDATE_EMAIL)) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$hasError = true;
		
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = 'tmitiloaga80@yahoo.com'; //Put your own email address here
		$subject= 'Portfolio message';
		$body = "Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nComments:\n $comments";
		$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
	if(isset($hasError)) {
		echo "Please check if you've filled all the fields with valid information. Thank you.";
	}
	if(isset($emailSent) && $emailSent == true) { //If email is sent
 		echo "Email Successfully Sent!"."<br /"."Thank you $name for using my contact form!";
		}
}
?>