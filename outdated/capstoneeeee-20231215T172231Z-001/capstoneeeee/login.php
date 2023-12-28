
<!DOCTYPE html>
<html lang="eng">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div class="container">
		<form method="post" action="index.php" class="form">
			<h2>SIGN IN</h2>
			<h3>Email</h3>
			<input type="username" name="email" class="box" placeholder="Enter Email">
			<h3>Password</h3>
			<input type="password" name="password" class="box" placeholder="Enter Password">
			<input type="submit" value="SIGN IN" id="submit">
		<div class="register">
			<p>Don't have an account?
			<a href="registration.html">Register here</a></p>
		</div>
			<a href="#">Forget Password</a>
		</form>
		<div class="side">
			<img src="img/cvsu.png" alt="">
		</div>
	</div>
</body>
</html>