<?php

require('connect.php');
session_start();
if(isset($_POST["login"]))
{
    $check="select * from register_user where email='$_POST[email]'";

    $result= mysqli_query($conn,$check);
    if($result)
	{
		if(mysqli_num_rows($result)>0)
		{
			$result_fetch = mysqli_fetch_assoc($result);
			if($result_fetch['email_status']==1)
            {
                if(password_verify($_POST['password'],$result_fetch['password']))
			    {

                    $_SESSION["logged_in"]=$result_fetch['name'];
                    header("location:userdash.php?user=$result_fetch[name]");
			     }
			else{
                echo
                "<script>
				alert('password is incorrect ');
				window.location='login.php';
				</script>";
				
			    }
            }
            else{
                echo
                "<script>
                alert('email is not verfied');
				window.location='login.php';
				</script>";
            }
			
		}
        else{
            echo 
				"<script>
				alert('Email Id is already registered ');
				window.location='login.php';
				</script>";
        }
    }
    else
    {
        echo
        "<script>
        alert('Email Id is not registered ');
        window.location='login.php';
        </script>";
    }

}
// else{
//     echo
//     "<script>
//     alert('something went worng');
//     window.location='login.php';
//     </script>";
// }
?>

    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>user-login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/adstyle.css">
        <link rel="stylesheet" href="../css/verify.css">
        <script src="http://code.jquery.com/jquery.js"></script>

    </head>

    <body>
        <header class="header">

            <a href="#" class="logo"><span>U</span>secure</a>

            <nav class="navbar">
                <a href="">home</a>

                <a href="index.php">register</a>
            </nav>

            <div id="menu-bars" class="fas fa-bars"></div>

        </header>

        <section class="lgn">

            <h1 class="heading"> <span>User</span> login </h1>
            <form action="" class="user" method="post" enctype="multipart/form-data">
                <div class="dk2Box">

                    <input type="text" name="email" placeholder="Enter email id" required="required"><br>

                    <input type="password" name="password" placeholder="Password" required="required"><br>
                </div>
                <input type="submit" name="login" value="login" class="btn"><br> <br>New user?
                <a href="index.php"> Sign up</a>
            </form>
        </section>
        <script src="" async defer></script>
    </body>

    </html>