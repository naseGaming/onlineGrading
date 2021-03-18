<!DOCTYPE HTML>
<html>
	<head>
		<title>Online Grading System</title>
		<link rel="stylesheet" type="text/css" href="Design/teacher.css" />
		<script src = "jQuery/jquery-3.1.1.min.js" ></script>
		<script src = "jQuery/jquery-ui.min.js" ></script>
		<script src = "Scripts/teachProcess.js" ></script>
		<script src = "Scripts/teachNav.js" ></script>
	</head>
	<body>
		<div id = "navigation" >
			<ul class="mainbar" >
			  <li><button class="inactive" id="userName"></button></li>
			  <br>
			  <br>
			  <li><button class="active" id="upGrade">Upload Grades</button></li>
			  <br><br>
			  <li><button class="inactive" id="logout">Logout</button></li>
			</ul>
		</div>
		<div id="changePassword" style = "margin-left: 200px;">
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
		<br>
		<div id = "upGradeForm" style = "margin-left: 200px;">
		</div>
		<div id = "upForm" style = "margin-left: 200px;">
			<center>
				<form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "post" enctype = "multipart/form-data" />
					Subject Code:  <input type = "text" id = "selectedSubject" name = "selectedSubject" class = "inp" readonly />
					<br>
					<br>
					School Year:  <input type = "text" id = "currentYear" name = "currentYear" class = "inp" readonly />
					<br>
					<br>
					Section:  <input type = "text" id = "selectedSection" name = "selectedSection" class = "inp" readonly />
					<br>
					<br>
					<?php
						$con = mysqli_connect("localhost","root","","onlinegrading");
						if(!$con){
							echo "Failed connecting to the database";
						}
						$flag = false;
						
						$sub = $_GET["sub"];
						$sec = $_GET["sec"];
						
						$sql2 = mysqli_query($con,"SELECT * FROM `subjects` where `subjcode` = '$sub'");
	
						while($row2=mysqli_fetch_array($sql2)){
							$year = $row2['year'];
							$flag = true;
						}
						
						if($year == 'Grade 11' or $year == 'Grade 12'){
							$sqls = mysqli_query($con,"SELECT * FROM `grades` where `subjCode` = '$sub' and `section` = '$sec' order by `period`");
							while($row=mysqli_fetch_array($sqls)){
								$period = $row['period'];
								$bool = true;
							}
							if($bool == true){
								if($period = "1st Sem"){
									echo "Grading Period:  <input type = 'text' id = 'Period' name = 'Period' value = '2nd Sem' class = 'inp' readonly />";
								}
							}
							else{
								echo "Grading Period:  <input type = 'text' id = 'Period' name = 'Period' value = '1st Sem' class = 'inp' readonly />";
							}
						}
						else{
							$sqls = mysqli_query($con,"SELECT * FROM `grades` where `subjCode` = '$sub' and `section` = '$sec' order by `period`");
							while($row=mysqli_fetch_array($sqls)){
								$period = $row['period'];
								$bool = true;
							}
							if($bool == true){
								if($period == "1st Grading"){
									echo "Grading Period:  <input type = 'text' id = 'Period' name = 'Period' value = '2nd Grading' class = 'inp' readonly />";
								}
								else if($period == "2nd Grading"){
									echo "Grading Period:  <input type = 'text' id = 'Period' name = 'Period' value = '3rd Grading' class = 'inp' readonly />";
								}
								else if($period == "3rd Grading"){
									echo "Grading Period:  <input type = 'text' id = 'Period' name = 'Period' value = '4th Grading' class = 'inp' readonly />";
								}
								else{}
							}
							else{
								echo "Grading Period:  <input type = 'text' id = 'Period' name = 'Period' value = '1st Grading' class = 'inp' readonly />";
							}
						}
					?>
					</select>
					<br>
					<br>
					<input type="file" name = "filesss" id = "filesss" />
					<br>
					<input type = "hidden" id = "cYear" name = "cYear"/>
					<br>
					<input type= "submit" name= "saveImport" />
				</form>
				<br>
				<br>
				<button onClick = "exportData();" />Export</button>
			</center>
		</div>
		<div id = "manualForms" style = "margin-left: 200px;">
		</div>
		<div id = "viewEnrolledForm" style = "margin-left: 200px;">
		</div>
		<div id = "completionform" style = "margin-left: 200px;">
		</div>
	</body>
</html>
<?php
	$con = mysqli_connect("localhost","root","","onlinegrading");
	if(!$con){
		echo "Failed connecting to the database";
	}
if(isset($_POST['saveImport'])){
    echo "Please wait while the data is analyzing....<br/>";
   $file = $_FILES['filesss']['tmp_name'];
    $handle = fopen($file, "r");
	$sub = $_POST['selectedSubject'];
	$sec = $_POST['selectedSection'];
	$sy = $_POST['cYear'];
	$period = $_POST['Period'];
    $i=0;
	$flag = false;
    while(($filesop = fgetcsv($handle, 1000, ",")) !== false) {

        if(!isset($filesop[1])){
            echo "Error while uploading! <br/> Your file is not supported";
            exit();
        }
        if($i >= 0){
			$accType = "2";
			$id = $filesop[0];
			$grades = $filesop[2];
			
			if($id == "Student Number"){
			}else{
				$sql1 = mysqli_query($con,"INSERT INTO `grades`(`studentNumber`, `subjCode`, `grade`, `section`, `period`, `schoolYear`) VALUES ('$id','$sub','$grades','$sec','$period','$sy')");
					if(!$sql1){
						$message = "Failed";
					}
					else{
						$message = "Successful";
					}
			}
		}

        $i++;
    }
	echo "<script> alert('$message'); </script>";

}