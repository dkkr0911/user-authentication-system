<?php

//email_verify.php

require("connect.php");

$error_user_otp = '';
$user_authentication_code = '';
$message = '';
$user_otp=$_POST["user_otp"];
if(isset($_GET["code"]))
{
	$user_authentication_code = $_GET["code"];

	if(isset($_POST["verify"]))
	{
		
			$query = "
			SELECT * FROM register_user 
			WHERE user_authentication_code = '$user_authentication_code' 
			AND user_otp = '$user_otp'
			";

			$result=mysqli_query($conn,$query);

			if($result)
			{
				$query2 = "
				UPDATE register_user 
				SET email_status = 1
				WHERE user_authentication_code = '$user_authentication_code'
				";

				if(mysqli_query($conn,$query2))
                {
                    echo '<script>
                    alert("Account has verifed");
                    window.location="login.php";
                    </script>';
                }
                else
                {
                    echo '<script>
				alert("Renter the otp !!!!");
				window.location="verify.php";
				</script>';
                }
			}
			else
			{
				echo '<script>
				alert("error");
				window.location="verify.php";
				</script>';
			}
		
	}
}
else
{
	$message = '<label class="text-danger">Invalid Url</label>';
}

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>verify email </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/adstyle.css">
    <link rel="stylesheet" href="../css/verify.css">
</head>

<body>
    <header class="header">

        <a href="#" class="logo"><span>U</span>secure</a>

        <nav class="navbar">
            <a href="index.html">home</a>
            <a href="index.php">Register</a>
            <a href="login.php">login</a>
        </nav>

        <div id="menu-bars" class="fas fa-bars"></div>

    </header>

    <section class="lgn">

        <h1 class="heading"> <span>verify</span>account</h1>
        <p>we emailed you the four digit otp code to enter the code below to comfirm your email address</p>
        <form action="" class="user" method="post" enctype="multipart/form-data">
            <div class="dkBox">
                <input type="text" name="user_otp" placeholder="enter otp" required="required"><br>
            </div>

            <input type="submit"name="verify" value="verify" class="btn">
            <br> <br>
            <a href=""></a>
        </form>
    </section>

</body>

</html>