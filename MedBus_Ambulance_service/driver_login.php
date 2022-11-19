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
		<div class="container-fluid">
			<div class="row">
				<div class="offset-sm-1 col-sm-2 mt-5"><img src="logo.png"></div>
				<div class="offset-sm-3 col sm-4 my-5"><h1>MedBus Ambulance Service</h1><h3 style="font-family:georgia; font-weight:bold;">Fast Service</h3><h4 style="font-family:georgia; font-weight:bold;">NO MATTER HOW LONG IT TAKE</h4></div>
			</div>
			
		</div>
		
		<?php
		session_start();
		$con=mysqli_connect("localhost","root","","ambulance");
		$pwd=$_SESSION['user'];
		$s1="select * from driver_reg where password='$pwd'";
		$res=mysqli_query($con,$s1);
		echo '<div class="container-fluid back"><div class="container "><div class="row mt-5 "><div class="w-100"></div><div class="offset-sm-3 col-sm-6 pt-3  bg-white "><div class="offset-sm-4 col-sm-5"><img src="driver.png"><br><h3>Your Account</h3></div>';
		while($row=mysqli_fetch_assoc($res))
		{
			echo '<br><h5><b>Name: </b>'.$row['name'].'<br><br><b>Phone: </b>'.$row['phone'].'<br><br><b>City: </b>'.$row['city'].'<br><br><b>Ambulance Type: </b>'.$row['type'].'<br><br><b>Fare:  </b>'.$row['fare'].'<br><br><b>Status: </b>'.$row['status'].'<br>';
			
		}
		echo '<br><center><form><button class="btn btn-primary" type="submit" name="mybtn">Edit Here</button><button class="btn btn-primary ml-5" type="submit" name="mybtn2">View Customer</button><form></center></h5></div></div></div></div><br><br><br><br>';
		
		if(isset($_REQUEST['mybtn']))
		{
	      echo  '<div class="container"><div class="row"><div class="offset-sm-4 col-sm-4 bg-secondary text-white px-5">
				<form class="form-group"><br>
					<label>Name </label>
					<input type="text" name="na" class="form-control">
					<label>Phone </label>
					<input type="text" name="ph" class="form-control">
					<label>city </label>
					<input type="text" name="city" class="form-control">
					<lable>Ambulance Type</lable>
					<select class="form-control" name="choose">
						<option value="Choose">Choose</option>
						<option value="Basic Life Support Ambulance">Basic Life Support Ambulance</option>
						<option value="Advance Life Support Ambulance">Advance Life Support Ambulance</option>
						<option value="Patient Transfer Ambulance">Patient Transfer Ambulance</option>
						<option value="Mortuary Ambulance">Mortuary Ambulance</option>
					</select
					<label>Fare </label>
					<input type="text" name="fare" class="form-control"><br>
					<lable>Status</lable>
					<select class="form-control" name="select">
						<option value="choose">choose</option>
						<option value="Available">Available</option>
						<option value="Busy">Busy</option>
					</select>
					<br><button class="btn btn-primary" type="submit" name="btn1">Submit</button><br><br>
				</form>
				</div></div></div>';
	    }
		if(isset($_REQUEST['btn1']))
		{		
				$con1=mysqli_connect("localhost","root","","ambulance");
				$name=$_REQUEST['na'];
				$phone=$_REQUEST['ph'];
				$type=$_REQUEST['choose'];
				$city=$_REQUEST['city'];
				$fare=$_REQUEST['fare'];
				$ch=$_REQUEST['select'];
				if($name==""||$phone==""||$type==""||$city==""||$fare=="" || $ch=="choose")
				{
					echo '<script>alert("All fields are required");</script>';
				}
				else
				{
					$s5="update driver_reg set name='$name',phone='$phone',city='$city',type='$type',fare='$fare',status='$ch' where password='$pwd'";
					if(mysqli_query($con1,$s5))
					{
						echo '<script>alert("Your Profile Updated");</script>';
					}
					else
					   echo '<script>alert("Your Profile Not Updated");</script>';
				}
		}
		if(isset($_REQUEST['mybtn2']))
		{
			
			$date=date("y-m-d");
			$con=mysqli_connect("localhost","root","","ambulance");
			
			$pwd=$_SESSION['user'];
			$p="select * from driver_reg where password='$pwd'";
			$result=mysqli_query($con,$p);
		    $row1=mysqli_fetch_assoc($result);
			$name=$row1['name'];
			
			$s="select * from book_amb where name='$name' and date='$date'";
			$res=mysqli_query($con,$s);
			
			if(mysqli_num_rows($res)>0)
			{	
				echo '<div class="container"><div class="row"><div class="offset-sm-2 col-sm-8"><table class="table table-dark"><tr><th>Customer Name</th><th>Address</th><th>Contact Number</th><th>Date</th></tr>';
				while($row=mysqli_fetch_assoc($res))
				{
					echo '<tr><td>'.$row['user_name'].'</td><td>'.$row['user_address'].'</td><td>'.$row['user_phone'].'</td><td>'.$date.'</td></tr></div>';
				}
				echo '</div></div></div>';
			}
			
			else{
				echo '<h2><center>No Customer</center></h2><br><br><br>';
			}
			
		}
	?>
		<script  src="js\jquery.js"></script>
		<script src="js\bootstrap.min.js"></script>
	</body>
	
</html>