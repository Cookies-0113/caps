<?php
session_start();
$msg="";
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$web1Uname = "admin";
	$web1Pass = "admin123";
	if($username == $web1Uname && $password == $web1Pass){
		header("location:admin.html");
		exit;
	}
	
	else{
		$msg="<span style='color:#ff0000; display:flex; justify-content:center;'> Invalid Credentials!!! </span>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Time Table</title>
    <link rel="stylesheet" href="css/style.css" href="js/index.js">
</head>
<body>
    <header>
        <a href="index1.html" class="logo">GSTRO-IT</a>
        <nav>
            <a href="#home" class="active">Home</a>
            <a href="#about">About</a>
            <a href="#team">Team</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>
    <section id="home">
        <p>Welcome to GSTRO-IT<br>Schedule<br>
            <a href="login.html">
                <button type="submit" class="signin">SIGN IN</button>
            </a></p>
        <img src="img/cvsu.png">
    </section>
    <section id="about">
        <h3><u>ABOUT US</u></h3>
    </section>
    <section id="team">
        <h3><u>TEAM</u></h3>
    </section>
    <section id="contact">
        <h3><u>CONTACT</u></h3>
    </section>
    <script src="js/index.js"></script>
</body>
</html>