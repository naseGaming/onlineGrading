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
					$source = $_GET['source'];
					
					$sql1 = mysqli_query($con,"SELECT * FROM `studentlist` order by `schoolYear` asc");
	
					while($row=mysqli_fetch_array($sql1)){
						$sy = $row['schoolYear'];
					}
					
					if($source == "admin"){
						$sql2 = mysqli_query($con,"SELECT * FROM `studentlist` where `year` = '$year' and `schoolYear` = '$sy' order by `section` and `last`");
					}
					else{
						$sql2 = mysqli_query($con,"SELECT * FROM `studentlist` where `year` = '$year' and `section` = '$section' and `schoolYear` = '$sy' order by `last`");
					}
					
					echo "<table id='grades'><tr>";
					echo "<th>Student Number</th>";
					echo "<th>Student Name</th>";
					echo "<th>Year</th>";
					echo "<th>Section</th>";
					echo "<th></th></tr>";
					while($row2=mysqli_fetch_array($sql2))
					{
						$flag = true;
						$sn = $row2['studentNumber'];
						$first = $row2['first'];
						$middle = $row2['middle'];
						$last = $row2['last'];
						$stY = $row2['year'];
						$stS = $row2['section'];
						echo "<tr><td>$sn</td>";
						echo "<td class = 'sn'>$last, $first $middle</td>";
						echo "<td>$stY</td>";
						echo "<td>$stS</td>";
						echo "<td><button class = 'manual' onClick = 'printSolo(this);' id = '$year' name = '$section'>Print</button></td></tr>";
					}
					
					if($flag == false){
						echo "<h1>No Result Found</h1>";
					}
					mysqli_close($con);
					echo"</table>";
				?>
			</center>
		</div>
	</body>
</html>