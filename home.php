<?php
	session_start();
	
	session_destroy(); 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Online Grading System</title>
		<link rel="stylesheet" type="text/css" href="Design/home.css" />
		<script src = "jQuery/jquery-3.1.1.min.js" ></script>
		<script src = "jQuery/jquery-ui.min.js" ></script>
		<script src = "Scripts/homeProcess.js" ></script>
		<script src = "Scripts/homeNav.js" ></script>
	</head>
	<body>
		<div id = "navigation" >
			<ul class="mainbar" >
			  <li><button class="active" id="loginNav">Login</button></li>
			</ul>
		</div>
		<div id = "loginForm" >
			<center>
				<h1>Login</h1>
				<br>
				<input type = "text" id = "txtUsername" class = "inp" onInput = "changeColor();" placeholder = "Username" />
				<br>
				<br>
				<input type = "password" id = "txtPassword" class = "inp" onInput = "changeColor();" placeholder = "Password"/>
				<br>
				<br>
				<button id = "btnLogin" onclick = "loginProcess();" class = "btns">Login</button>
				<br>
			</center>
		</div>
	</body>
</html>