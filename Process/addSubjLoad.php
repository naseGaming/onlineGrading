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
					$last = $_GET['last'];
					
					echo "<input type = 'text' placeholder = 'Search by Last Name' id = 'txtSearch' /><button onClick = 'searchProf();'>Search</button>	";
					echo "<br>";
					echo "<br>";
					
					if($last == ""){
						$sql1 = mysqli_query($con,"SELECT * FROM `accounts` where `accountType` = '1' order by `last` asc");
					}
					else{
						$sql1 = mysqli_query($con,"SELECT * FROM `accounts` where `accountType` = '1' and `last` = '$last' order by `last` asc");
					}
					echo "<table id='grades'><tr>";
					echo "<th>Teacher Name</th>";
					echo "<th></th>";
					echo "<th></th></tr>";
					while($row=mysqli_fetch_array($sql1))
					{
						$flag = true;
						$first = $row['first'];
						$middle = $row['middle'];
						$last = $row['last'];
						$id = $row['username'];
						echo "<tr><td class = 'sn'>$last, $first $middle</td>";
						echo "<td><button class = 'edit' onClick = 'viewHere(this);' id = '$id'>View</button></td>";
						echo "<td><button class = 'edit' onClick = 'addHere(this);' id = '$id'>Add</button></td></tr>";
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