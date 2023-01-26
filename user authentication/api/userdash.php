<?php
session_start();
if($_SESSION["logged_in"]==$user)
{
    header("location:login.php");
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashpage</title>
    <link rel="stylesheet" href="../css/adstyle.css">
    <link rel="stylesheet" href="../css/dash.css">
</head>

<body>
    <header class="header">

        <a href="#" class="logo"><span>U</span>secure</a>

        <nav class="navbar">
            <a href="userdash.">home</a>
            <a href="">hello_user</a>
            <a href="logout.php">logout</a>
        </nav>

        <div id="menu-bars" class="fas fa-bars"></div>

    </header>
    <section>
        <h2>Welcome : <span>abc@gamil.com</span></h2>
    </section>
</body>

</html>