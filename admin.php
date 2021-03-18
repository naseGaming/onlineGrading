<!DOCTYPE HTML>
<html>
	<head>
		<title>Online Grading System</title>
		<link rel="stylesheet" type="text/css" href="Design/admin.css" />
		<script src = "jQuery/jquery-3.1.1.min.js" ></script>
		<script src = "jQuery/jquery-ui.min.js" ></script>
		<script src = "Scripts/adminProcess.js" ></script>
		<script src = "Scripts/adminNav.js" ></script>
	</head>
	<body>
		<div id = "navigation" >
			<center>
			<ul class="mainbar" >
				<li><button class="active" id="students">Students</button></li>
					<div class="dropdown-container" id="studBar">
						<br>
						<li><button class="actives" id="upStud">Upload Students</button></li>
						<br>
						<li><button class="inactives" id="viewStud">View Students</button></li>
					</div>
				<br>
				<li><button class="inactive" id="subjects">Subjects</button></li>
					<div class="dropdown-container" id="subBar">
						<br>
						<li><button class="actives" id="addSub">Add Subjects</button></li>
						<br>
						<li><button class="inactives" id="subLoad">Add Subjects Load</button></li>
					</div>
				<br>
				<li><button class="inactiveT" id="teacher">Teacher</button></li>
					<div class="dropdown-container" id="profBar">
						<br>
						<li><button class="actives" id="addProf">Add Teacher</button></li>
					</div>
				<br>
				<li><button class="logout" id="logout">Logout</button></li>
			</ul>
			</center>
		</div>
		<div id = "addSubjs" style = "margin-left:200px;" >
			<center>
				<form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "post" enctype = "multipart/form-data" />
					<select id = "txtYear" name = "txtYear" class = "addInps">
						<?php
							for($i=1;$i<=12;$i++){
								if($i < 11){
									echo "<option value = 'Grade $i'>Grade $i</option>";
								}
								else{
									echo "<option value = 'Grade $i - ABM'>Grade $i - ABM</option>";
									echo "<option value = 'Grade $i - TVL'>Grade $i - TVL</option>";
									echo "<option value = 'Grade $i - HUMMS'>Grade $i - HUMMS</option>";
									echo "<option value = 'Grade $i - STEM'>Grade $i - STEM</option>";
									echo "<option value = 'Grade $i - GAS'>Grade $i - GAS</option>";
									echo "<option value = 'Grade $i - ICT'>Grade $i - ICT</option>";
								}
							}
						?>
					</select>
					<br>
					<br>
					<input type="file" name = "filezzz" id = "filezzz" />
					<br>
					<br>
					<input type= "submit" name= "saveSubject" />
				</form>
				</form>
				<br>
				<br>
				<button onClick = "exportCurriculum();" />Export</button>
			</center>
		</div>
		<div id = "addTeacher" style = "margin-left:200px;" >
			<center>
				<br>
				<br>
				<h1>Add Teacher</h1>
				<br>
				<input type = "text" id = "txtFirst" class = "addInp" placeholder = "First Name" onInput = "checkInput(this);" maxlength = "50" />
				<br>
				<br>
				<input type = "text" id = "txtMiddle" class = "addInp" placeholder = "Middle Name" onInput = "checkInput(this);" maxlength = "50" />
				<br>
				<br>
				<input type = "text" id = "txtLast" class = "addInp" placeholder = "Last Name" onInput = "checkInput(this);" maxlength = "50" />
				<br>
				<br>
				<button onClick = "addTeacher();" id ="saveTeacher" class = "addButton">Save</button>
			</center>
		</div>
		<div id = "addStudents" style = "margin-left:200px;" >
			<center>
				<form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "post" enctype = "multipart/form-data" />
					<select id="schoolYear" name = "schoolYear">
						<?php
							for($ctr = 20;$ctr<=30;$ctr++){
						?>
						<option value ="<?php echo $ctr; ?>">20<?php echo $ctr-1;?>-20<?php echo $ctr; ?></option>
						<?php 
							}
						?>
					</select>
					<br>
					<br>
					<input type="file" name = "filesss" id = "filesss" />
					<br>
					<br>
					<input type= "submit" name= "saveImport" />
				</form>
				<br>
				<br>
				<button onClick = "exportData();" />Export</button>
			</center>
		</div>
		<div id="addSubjLoad" style = "margin-left:240px;" >
		</div>
		<div id="addSubjLoad2" style = "margin-left:240px;" >
		</div>
		<div id="viewSubjectLoad" style = "margin-left:240px;" >
		</div>
		<div id="viewSubjects" style = "margin-left: 200px; width: 82%" >
		</div>
		<div id="viewStudents" style = "margin-left: 200px;" >
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
	$sy = $_POST['schoolYear'];
	$new = "";
	$old = "";
    $i=0;
	$flag = false;
    while(($filesop = fgetcsv($handle, 1000, ",")) !== false) {

        if(!isset($filesop[1])){
            echo "Error while uploading! <br/> Your file is not supported";
            exit();
        }
        if($i >= 0){
			$accType = "2";
			$user = $filesop[0];
			$hpass = password_hash($user, PASSWORD_DEFAULT);
			$first = $filesop[1];
			$middle = $filesop[2];
			$last = $filesop[3];
			$year = $filesop[4];
			$section = $filesop[5];
			
			$new = $section;
			
			if($new == $old){
			}else{
				$old = $new;
				if($section == "Section"){
					
				}else{
					$sql3 = mysqli_query($con,"INSERT INTO `sections`(`section`, `year`) VALUES ('$section','$year')");	
				}
			}
			
			if($user == "Student Number"){
			}
			else{
				$sql1 = mysqli_query($con,"SELECT * FROM accounts where `username` = '$user'");
				while($row=mysqli_fetch_array($sql1)){
					$flag = true;
				}
				
				if($flag == false){
					$sql2 = mysqli_query($con,"INSERT INTO `accounts`(`accountType`, `username`, `password`, `first`, `middle`, `last`, `year`, `section`, `schoolYear`) VALUES ('$accType','$user','$hpass','$first','$middle','$last','$year','$section','$sy')");	
					$sql3 = mysqli_query($con,"INSERT INTO `studentlist`(`studentNumber`, `first`, `middle`, `last`, `year`, `section`, `schoolYear`) VALUES ('$user','$first','$middle','$last','$year','$section','$sy')");
					if(!$sql2){
						$message = "Failed creating student account";
					}
					else if(!$sql3){
						$message = "Failed inserting student";
					}
					else{
						$message = "Succesful uploading studentlist";
					}
				}
				else{
					$sql4 = mysqli_query($con,"UPDATE `accounts` SET `year` = '$year',`section` = '$section',`schoolYear` = '$sy' where `username` = '$user'");
					$sql5 = mysqli_query($con,"UPDATE `studentList` SET `year` = '$year',`section` = '$section',`schoolYear` = '$sy' where `studentNumber` = '$user'");
					if(!$sql4){
						$message = "Failed updating student account";
					}
					else if(!$sql5){
						$message = "Failed updating student";
					}
					else{
						$message = "Succesful uploading studentlist";
					}
				}
				
				$flag = false;
			}
		}

        $i++;
    }
	echo "<script> alert('$message'); </script>";

}
if(isset($_POST['saveSubject'])){
    echo "Please wait while the data is analyzing....<br/>";
   $file = $_FILES['filezzz']['tmp_name'];
    $handle = fopen($file, "r");
	$level = $_POST['txtYear'];
	$blank = "";
    $i=0;
	$flag = false;
	$sql6 = mysqli_query($con,"DELETE FROM `subjects` where `year` = '$level'");
	if(!$sql6){
		$message = "Failed deleting old curriculum";
	}
	else{
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false) {

			if(!isset($filesop[1])){
				echo "Error while uploading! <br/> Your file is not supported";
				exit();
			}
			if($i >= 0){
				$accType = "2";
				$code = $filesop[0];
				$desc = $filesop[1];
				
				if($code == "Subject Code"){
				}
				else{
					$sql7 = mysqli_query($con,"INSERT INTO `subjects`(`subjcode`, `subjdesc`, `year`, `teacher`) VALUES ('$code','$desc','$level','$blank')");
					if(!$sql7){
						$message = "Failed inserting new curriculum";
					}
					else{
						$message = "Succesful updating curriculum";
					}
				}
			}

			$i++;
		}
	}
	echo "<script> alert('$message'); </script>";

}