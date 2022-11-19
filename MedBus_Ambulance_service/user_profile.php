<html>
	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="stylesheet" href="css\bootstrap.min.css">
		
		<style>
			.back
			{
				background:url(img2.jpg);
				background-repeat:no-repeat;
				background-size:cover;
			}
		</style>
	</head>
	<body>
		<div class="container-fluid ">
			<div class="row">
				<div class="offset-sm-1 col-sm-2 mt-5"><img src="logo.png"></div>
				<div class="offset-sm-3 col sm-4 my-5"><h1>MedBus Ambulance Service</h1><h3 style="font-family:georgia; font-weight:bold;">Fast Service</h3><h4 style="font-family:georgia; font-weight:bold;">NO MATTER HOW LONG IT TAKE</h4></div>
			</div>
			
		</div>
		
		<?php
		session_start();
		
		$con=mysqli_connect("localhost","root","","ambulance");
		$pwd=$_SESSION['user'];
		$s="select * from user_reg where password='$pwd'";
		$res=mysqli_query($con,$s);
		$row=mysqli_fetch_assoc($res);
		echo '<div class="container-fluid py-3" style="background-color:#DC143C;"><div class="row"><div class="offset-sm-4 col-sm-5">';
		echo '<center><h1 class="text-white">Welcome    '.$row['name'].'</h1></center></div><div class="w-100"></div>';
		echo '<div class="offset-sm-5 col-sm-4"><b class="text-white" style="font-size:28px;">Address: '.$row['address'].'</b></div><div class="w-100"></div>';
		echo '<div class="offset-sm-5 col-sm-4"><b class="text-white" style="font-size:25px;">Contact No: '.$row['contact'].'</b></div>';
		echo '</div></div></div>';
		
		$s2="select * from book_amb where user_pwd='$pwd'";
		$res1=mysqli_query($con,$s2);
		
		
		/*echo '<div class="container-fluid py-3" ><div class="row"><div class="offset-sm-2 col-sm-5"><b style="font-size:28px; color:red;">YOUR BOOKING HISTORY</b></div>';
		while($row1=mysqli_fetch_assoc($res1)){
		echo '<div class="w-100"></div><div class="offset-sm-2 col-sm-4"><b style="font-size:20px;"><br>Name: '.$row1['name'].'</b></div><div class="w-100"></div>';
		echo '<div class="offset-sm-2 col-sm-4"><b class="" style="font-size:20px;">Contact No: '.$row1['phone'].'</b></div><div class="w-100"></div>';
		echo '<div class="offset-sm-2 col-sm-4"><b class="" style="font-size:20px;">Abulance Type: '.$row1['type'].'</b></div><div class="w-100"></div>';
		echo '<div class="offset-sm-2 col-sm-4"><b class="" style="font-size:20px;">Fare: '.$row1['fare'].'</b></div><div class="w-100"></div>';
		echo '<div class="offset-sm-2 col-sm-4"><b class="" style="font-size:20px;">Date: '.$row1['date'].'</b><br></div>';
		}
		echo '</div></div>';*/
		
		
		echo '<div class="container-fluid py-3" ><div class="row"><div class="offset-sm-4 col-sm-5 mt-5"><b style="font-size:28px; color:red;">YOUR BOOKING HISTORY</b></div>';
		echo '<div class="w-100"></div><div class="offset-sm-3 col-sm-6"><table class="table my-5"><tr><th>Driver Name</th><th>Contact No</th><th>Ambulance Type</th><th>Fare</th><th>Date</th></tr>';
		while($row1=mysqli_fetch_assoc($res1)){
			echo '<tr><td>'.$row1['name'].'</td><td>'.$row1['phone'].'</td><td>'.$row1['type'].'</td><td>'.$row1['fare'].'</td><td>'.$row1['date'].'</td></tr>';
		}
		echo '</table></div></div></div>';
		?>
		<div class="container-fluid py-3" style="background-color:#4682B4;">
			<div class="row">
				<div class="offset-sm-4 col-sm-6 text-white"><h2>Thank You For Visiting Our Site</h2>
				</div>
			</div>
		</div>
		<script  src="js\jquery.js"></script>
		<script src="js\bootstrap.min.js"></script>
	</body>
	
</html>