<?php

require("connect.php");
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['email']))
$email=$_POST['email'];
function sentotp($email,$user_authentication_code,$user_otp) {

	
	require ("../PHPMailer/PHPMailer.php");
	require ("../PHPMailer/SMTP.php");
	require ("../PHPMailer/Exception.php");

	$mail = new PHPMailer(true);

	try {
		//Server settings
		                    //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'deepak.6295479@gmail.com';                     //SMTP username
		$mail->Password   = 'xgpqparwhfprjudi';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
		$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	
		//Recipients
		$mail->setFrom('deepak.6295479@gmail.com', 'DK');
		$mail->addAddress($email);     //Add a recipient
		
	
		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'email verification from dk';
		$mail->Body    = '
		<p>For verify your email address, enter this verification code when prompted: <b>'.$user_otp.'</b>.</p>
		<p>Sincerely,</p>
		';
		
	
		if($mail->Send())
			{
				echo '<script>alert("Please Check Your Email for Verification Code")</script>';

				header('location:verify.php?code='.$user_authentication_code);
				
			}
		return true;
	} catch (Exception $e) {
		return false;
	}
}

if(isset($_POST["register"]))
{
	$user_exit_query ="SELECT * FROM register_user WHERE email='$email' "; 
	$result=mysqli_query($conn,$user_exit_query);

	if($result)
	{
		if(mysqli_num_rows($result)>0)
		{
			$result_fetch = mysqli_fetch_assoc($result);
			if($result_fetch['email']==$email)
			{
				echo 
				"<script>
				alert('Email Id is already registered ');
				window.location='index.php';
				</script>";
			}
			else{
				echo 
				"<script>
				alert('an otp send on register email id ');
				window.location='../verify.html';
				</script>";
			}
			
		}
		else{
			$password=password_hash($_POST['password'],PASSWORD_BCRYPT);

			$user_authentication_code = md5(rand());

		    $user_otp = rand(100000, 999999);



			$query="INSERT INTO register_user (name, email, password,user_authentication_code, email_status, user_otp) 
			VALUES 
			('$_POST[name]','$email','$password','$user_authentication_code',0,'$user_otp')";

			if(mysqli_query($conn,$query)&& sentotp($_POST["email"],$user_authentication_code,$user_otp))
			{
				echo '<script>
				alert("Please Check Your Email for Verification Code");
				window.location="login.php";
				</script>';
			}
			else{
				echo '<script>
				alert("some error occure");
				window.location="index.php";
				</script>';
			}
		}
	}
	else{
		echo "<script>
				alert('something went wrong!!!');
				window.location='index.php';
				</script>";
	}
}

?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>user-registration</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.jquery.com/jquery.js"></script>
    <link rel="stylesheet" href="../css/adstyle.css">
</head>

<body>
    <header class="header">

        <a href="#" class="logo"><span>u</span>secure</a>

        <nav class="navbar">
            <a href="index.php">home</a>

            <a href="login.php">login</a>
        </nav>

        <div id="menu-bars" class="fas fa-bars"></div>

    </header>

    <section class="lgn">

        <h1 class="heading"> <span>user</span>registration</h1>
        <form action="" class="user " method="post" enctype="multipart/form-data">
            <div class="inputBox">
                <span></span>
                <input type="text" name="name" placeholder="Enter full name" required="required"><br>
                <input type="text" name="email" placeholder="Enter email" required="required"><br>
                <input type="password" name="password" placeholder="Password" required="required"><br>
                <input type="password" name="cfpassword" placeholder="Confirm Password" required="required"><br>

            </div>
            <input type="submit" name="register" value="register" class="btn"><br> <br>Already user?
            <a href="login.php">login</a>
        </form>
    </section>

</body>

</html>