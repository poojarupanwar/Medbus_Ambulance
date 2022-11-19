
<html>
	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="stylesheet" href="css\bootstrap.min.css">
		
		<style>
			.back
			{
				background:url(img3.jpg);
				background-repeat:no-repeat;
				background-size:cover;
			}
		</style>
		
	</head>
	<body>
		<div class="container-fluid ">
			<div class="row  ">
				<div class="offset-sm-1 col-sm-2 mt-5"><img src="logo.png"></div>
				<div class="offset-sm-3 col sm-4 my-5"><h1>MedBus Ambulance Service</h1><h3 style="font-family:georgia; font-weight:bold;">Fast Service</h3><h4 style="font-family:georgia; font-weight:bold;">NO MATTER HOW LONG IT TAKE</h4></div>
			</div>
		</div>
		
		<div class="container-fluid back bg-success">
			<div class="row">
			<div class="container-fluid"><div class="row bg-success"><div class="offset-sm-8 col-sm-2 mt-3"><img src="home.png" class="pr-3"><b style="font-size:20px;"><a href="index.php" style="color:black;">Home</a></b></div><div class="col-sm-2 mt-3"><img src="profile.png" class="pr-2"><b style="font-size:20px;"><a href="user_profile.php" style="color:black;">Your Profile</a></b></div></div></div>
				<div class="offset-sm-6 col-sm-4 mt-4"> 
				<form class="form-group">
				<br><br><h2>Search Here</h2><br>
				<label><h4>Ambulance Type</h4></label>
					<select class="form-control" name="choose">
						<option value="Choose">Choose</option>
						<option value="Basic Life Support Ambulance">Basic Life Support Ambulance</option>
						<option value="Advance Life Support Ambulance">Advance Life Support Ambulance</option>
						<option value="Patient Transfer Ambulance">Patient Transfer Ambulance</option>
						<option value="Mortuary Ambulance">Mortuary Ambulance</option>
					</select
				<label><h4>City</h4></label>
				<input type="text" name="city" class="form-control"><br>
				<button type="submit" name="btn" class="btn btn-primary">Search</button>
				</form>
				</div>
			</div>
		</div>
			   
		
		<?php
			session_start();
			
			if(isset($_REQUEST['btn']))
			{
				$type=$_REQUEST['choose'];
				$city=$_REQUEST['city'];
				if($type=="choose" || $city=="")
				{
					echo '<script>alert("All fields are required");</script>';
				}
				else
				{	
					$con=mysqli_connect("localhost","root","","ambulance");
					$s="select * from driver_reg where city='$city' AND type='$type'";
					$res=mysqli_query($con,$s);	
					if(mysqli_num_rows($res) > 0)
					{	
						
						echo'<div class="container mt-5">
								<div class="row">
										<div class="offset-sm-1 col-sm-10">
									
											<table class="table table-dark">
											  <tr>
												<th>Name</th><th>Contact </th><th>City</th><th>Ambulance Type</th><th>Fare</th><th>Status</th><th>Book</th>
											  </tr>';
									while($row=mysqli_fetch_assoc($res))
									{			
										echo '<tr><td>'.$row["name"].'</td><td>'.$row["phone"].'</td><td>'.$row["city"].'</td><td>'.$row["type"].'</td><td>'.$row["fare"].'</td><td>'.$row['status'].'</td>';
										echo'<td><form class="form-group">
										<input type="hidden" name="name" value='.$row['name'].'>
										<input type="hidden" name="phone" value='.$row['phone'].'>
										<input type="hidden" name="type" value='.$row['type'].'>
										<input type="hidden" name="fare" value='.$row['fare'].'>
										<input type="hidden" name="pass" value='.$row['password'].'>
										<input type="hidden" name="status" value='.$row['status'].'>
										<button type="submit" class="btn btn-warning" name="btnmy">Book</button>
										</form></td>
										</tr>';
									}
												
						echo '</table></div></div></div>';
					}
					else
					{	
					
						echo '<script>alert(" Oops!!!Not Found ");</script>';
					}	
				}
				
		    }
				if(isset($_REQUEST['btnmy']))
				{
					 $na=$_REQUEST['name'];
					 $ph=$_REQUEST['phone'];
					 $type1=$_REQUEST['type'];
					 $fare1=$_REQUEST['fare'];
					 $pass2=$_SESSION['user'];
					 $date1=date("y-m-d");
					$driver_pass=$_REQUEST['pass'];
					 $status=$_REQUEST['status'];
					$con=mysqli_connect("localhost","root","","ambulance");
					$p="select * from  user_reg where password='$pass2'";
					$result=mysqli_query($con,$p);
					
					$myrow=mysqli_fetch_assoc($result);
					$user_name=$myrow['name'];
					$user_phone=$myrow['contact'];
					$user_add=$myrow['address'];
					if($status=="Busy")
					{
						echo '<script>alert("This ambulance is not available now choose another one");</script>';
					}
					else
					{
						
					$s2="insert into book_amb values('$na','$ph','$type1','$fare1','$pass2','$date1','$user_name','$user_add','$user_phone')";
					mysqli_query($con,$s2);	
					echo '<br><center style="font-size:20px; font-weight:bold;"><h2>Your Driver Information</h2><br>Name: '.$na.'<br>Contact No: '.$ph.'<br>Ambulance Type: '.$type1.'<br>Ambulance Fare: '.$fare1.'<br>';
					
					echo '<br><form><input type="hidden" name="driver_pass" value='.$driver_pass.'><button type="submit" class="btn btn-success mr-5" name="btnmy1">Confirm Booking</button>
					      <input type="hidden" name="name" value='.$na.'><input type="hidden" name="pwd" value='.$pass2.'><input type="hidden" name="type" value='.$type1.'><input type="hidden" name="date" value='.$date1.'><button type="submit" class="btn btn-danger" name="btnmy2">Cancel Booking</button></form></center><br><br>';
					}

					
				}	
				if(isset($_REQUEST['btnmy1']))
				{	
					 
					$driver_pass=$_REQUEST['driver_pass'];
					 
					$con=mysqli_connect("localhost","root","","ambulance");
					
					$w="update driver_reg set status='Busy' where password='$driver_pass'";
					mysqli_query($con,$w);
					echo '<script>alert(" Booking Successful !!!Thank You for Booking ");</script>';
					echo '<script>document.location="user_login.php"</script>';
				}
				if(isset($_REQUEST['btnmy2']))
				{	
					 $na=$_REQUEST['name'];
					 $pass=$_REQUEST['pwd'];
					 $type1=$_REQUEST['type'];
					 $date=$_REQUEST['date'];
					
					$con=mysqli_connect("localhost","root","","ambulance");
					$s3="delete from book_amb where name='$na' AND type='$type1' AND user_pwd='$pass' AND date='$date' ";
					mysqli_query($con,$s3);	
					echo '<script>alert(" Your Booking has been Canceled ");</script>';
				    echo '<script>document.location="user_login.php"</script>';
				}
	?>
	<script  src="js\jquery.js"></script>
		<script src="js\bootstrap.min.js"></script>
	</body>


</html>