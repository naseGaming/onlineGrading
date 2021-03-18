<!DOCTYPE HTML>
<html>
	<head>
		<title>Online Grading System</title>
		<link rel="stylesheet" type="text/css" href="Design/student.css" />
		<script src = "jQuery/jquery-3.1.1.min.js" ></script>
		<script src = "jQuery/jquery-ui.min.js" ></script>
		<script src = "Scripts/studProcess.js" ></script>
		<script src = "Scripts/studNav.js" ></script>
	</head>
	<body>
		<div id = "navigation" >
			<ul class="mainbar" >
			  <li><button class="inactive" id="userName"></button></li>
			  <br>
			  <br>
			  <li><button class="active" id="viewGrades">View Grades</button></li>
			  <br><br>
			  <li><button class="inactive" id="logout">Logout</button></li>
			</ul>
		</div>
		<div id="changePassword" style = "margin-left: 200px;" >
			<center>
				<h1>Change Password</h1>
				<br>
				<br>
				<input type = "password" id = "txtOld" class = "inp" onInput = "checkOldPassword(this);" placeholder = "Old Password"/>
				<br>
				<br>
				<input type = "password" id = "txtNew" class = "inp" onInput = "checkInput(this);" placeholder = "New Password"/>
				<br>
				<br>
				<input type = "password" id = "txtConfirm" class = "inp" onInput = "checkInput(this);" placeholder = "Confirm Password"/>
				<br>
				<br>
				<button id = "btnChange" onclick = "changePassword();" class = "btns">Change Password</button>
			</center>
		</div>
		<div id = "viewGrade" style = "margin-left:200px" >
		</div>
	</body>
</html>