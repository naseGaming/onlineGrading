<html>
	<head>
		<style>
			#grades {
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
				border-collapse: collapse;
				width: 100%;
				text-align: center;
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
			
			.edit{
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
					$id = $_GET['id'];
					
					$sql1 = mysqli_query($con,"SELECT * FROM `subjects` where `teacher` = '$id' order by `subjdesc` asc");
					
					echo "<table id='grades'><tr>";
					echo "<th>Subject Code</th>";
					echo "<th>Subject Description</th>";
					echo "<th>Year</th></tr>";
					while($row=mysqli_fetch_array($sql1))
					{
						$flag = true;
						$code = $row['subjcode'];
						$desc = $row['subjdesc'];
						$year = $row['year'];
						$id = $row['subjID'];
						echo "<tr><td>$code</td>";
						echo "<td>$desc</td>";
						echo "<td>$year</td></tr>";
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