<html>
	<head>
		<style>
			#grades {
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
				border-collapse: collapse;
				width: 100%;
				text-align: center;
				margin-left: 40px;
			}

			#grades td, #grades th {
				border: 1px solid #ddd;
				padding: 8px;
			}

			td{
				color: white;
			}

			#grades tr{
				background-color: #006400;
			}

			#grades tr:hover {
				background-color: black;
			}

			#grades th {
				padding-top: 12px;
				padding-bottom: 12px;
				background-color: rgba(50, 150, 50, 0.9);
				color: white;
			}
			
			.sn{
				text-align: left;
			}
			
			.manual{
				outline: none;
				background: none;
				border: none;
				color: white;
			}
			
			.edit:hover{
				color:red;
			}
		</style>
	</head>
	<body>
		<div>
			<center>
				<?php
					$con = mysqli_connect("localhost","root","","onlinegrading");
					if(!$con){
						echo "Failed connecting to the database";
					}
					$flag = false;
					$year = $_GET['year'];
					$section = $_GET['section'];
					
					echo "<select id = 'searchYear' class = 'addInps' onChange = 'checkYear(this);'>
							<option></option>";
							for($i=1;$i<=12;$i++){
								echo "<option>Grade $i";
								echo "</option>";
							}
						echo "</select>";
						
					echo "<br>";
					echo "<br>";
					
					if($year == ""){
						$sql1 = mysqli_query($con,"SELECT * FROM `subjects` order by `year` asc");
					}
					else{
						$sql1 = mysqli_query($con,"SELECT * FROM `subjects` where `year` = '$year' order by `year` asc");
					}
					//else if($year == "" and $section != ""){
						//$sql1 = mysqli_query($con,"SELECT * FROM `subjects` where `section` = '$section' order by `year` asc");
					//}
					//else{
						//$sql1 = mysqli_query($con,"SELECT * FROM `subjects` where `section` = '$section' and `year` = '$year' order by `year` asc");
					//}
					echo "<table id='grades'><tr>";
					echo "<th>Subject Description</th>";
					echo "<th>Year</th>";
					echo "<th></th>";
					echo "<th></th></tr>";
					while($row=mysqli_fetch_array($sql1))
					{
						$flag = true;
						$code = $row['subjcode'];
						$desc = $row['subjdesc'];
						$year = $row['year'];
						echo "<tr><td>$desc</td>";
						echo "<td>$year</td>";
						echo "<td><button class = 'manual' onClick = 'viewEnrolls(this);' id = '$year' name = '$section'>View</button></td>";
						echo "<td><button class = 'manual' onClick = 'printClass(this);' id = '$year' name = '$section'>Print</button></td></tr>";
					}
					
					if($flag == false){
						echo "<h1>Empty Result Found</h1>";
					}
					mysqli_close($con);
					echo"</table>";
				?>
			</center>
		</div>
	</body>
</html>