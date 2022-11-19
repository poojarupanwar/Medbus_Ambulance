
<?php
		session_start();
		if(isset($_REQUEST['btn1']))
		{	
			$amb_type=$_REQUEST['choose'];
			$name=$_REQUEST['na'];
			$phone=$_REQUEST['mbl'];
			$pass=$_REQUEST['pwd'];
			$conpass=$_REQUEST['conpwd'];
			$city=$_REQUEST['city'];
			$fare=$_REQUEST['fare'];
			if($amb_type=="Choose" || $name=="" || $phone==""  || $pass==""  || $conpass=="" || $fare=="")
			{
					echo '<script>alert("All fields are required");</script>';
			}
			else
			{
				if(strlen($phone) !=10)
					echo '<script>alert("Enter 10 digit phone number");</script>';
				else if(strlen($pass) <= 6)
				{
					echo '<script>alert("Password must be greater than 6 character");</script>';
				}
				else if($pass != $conpass)
				{
					echo '<script>alert("Password and confirm password should be match");</script>';
				}
				else
				{	
					$con=mysqli_connect("localhost","root","","ambulance");
					$s1="select * from driver_reg where password='$pass'";
					$res=mysqli_query($con,$s1);
					if(mysqli_num_rows($res) > 0)
					{
						echo '<script>alert("Password has already taken by someone!!Choose another password and try again");</script>';
					}	
					else
					{
							$s2="insert into driver_reg values('$name','$phone','$city','$amb_type','$fare','$pass','Available')";
							if(mysqli_query($con,$s2))
							{
								echo '<script>alert("Registration Successfull")</script>';
							}
					}		
					
					
				}
				
					
			}	
		}
		
		if(isset($_REQUEST['btn2']))
		{
			
			$name=$_REQUEST['na'];
			$add=$_REQUEST['add'];
			$phone=$_REQUEST['phno'];
			$pass=$_REQUEST['pass'];
			$conpass=$_REQUEST['conpwd'];
			if($add=="" || $name=="" || $phone==""  || $pass==""  || $conpass=="")
			{
					echo '<script>alert("All fields are required");</script>';
			}
			else
			{
				if(strlen($phone) !=10)
					echo '<script>alert("Enter 10 digit phone number");</script>';
				else if(strlen($pass) <= 6)
				{
					echo '<script>alert("Password must be greater than 6 character");</script>';
				}
				else if($pass != $conpass)
				{
					echo '<script>alert("Password and confirm password should be match");</script>';
				}
				else
				{	
					$con=mysqli_connect('localhost','root','','ambulance');
					$s1="select * from user_reg where password='$pass'";
					$res=mysqli_query($con,$s1);
					if(mysqli_num_rows($res) > 0){
						echo '<script>alert("Password has already taken by someone!!Choose another password and try again");</script>';
					}	
					else
					{	
						$s2="insert into user_reg values('$name' ,'$add','$phone','$pass')";
						if(mysqli_query($con,$s2))
						{
							echo '<script>alert("Registration Successfull")</script>';
						}
					}
			}	}
		}
		if(isset($_REQUEST['btn3']))
		{	
			$name=$_REQUEST['user'];
			$pwd=$_REQUEST['pwd'];
			$type=$_REQUEST['ch'];
			if($name=="" || $pwd=="" ||$type=="Choose")
			{
				echo '<script>alert("All fields are required");</script>';
			}
			else	
			{
				$con=mysqli_connect('localhost','root','','ambulance');
				if($type=="User")
				{
					$s1="select * from user_reg where name='$name' AND password='$pwd'";
					$res1=mysqli_query($con,$s1);
					$res=mysqli_num_rows($res1);
					if($res)
					{
							echo '<script>alert("Login Successfull")</script>';
							$_SESSION['user']=$pwd;

							header("location:user_login.php");
							
					}
					else
					{
						echo '<script>alert("Login Failed")</script>';
					}
				}
				else if($type=="Driver")
				{
					
					$s1="select * from driver_reg where name='$name' AND password='$pwd'";
					$res1=mysqli_query($con,$s1);
					$res=mysqli_num_rows($res1);
					if($res)
					{
							echo '<script>alert("Login Successfull")</script>';
							$_SESSION['user']=$pwd;
							header("location:driver_login.php");
							
					}
					else
					{
						echo '<script>alert("Login Failed")</script>';
					}
				}
				
			}
		}
?>
<html lang="en">

	<head>

		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="stylesheet" href="css\bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
		
	</head>

	<body>
		<div class="container-fluid ">
			<div class="row  ">
				<div class="offset-sm-1 col-sm-2 mt-5"><img src="logo.png"></div>
				<div class="offset-sm-3 col sm-4 my-5"><h1>MedBus Ambulance Service</h1><h3 style="font-family:georgia; font-weight:bold;">Fast Service</h3><h4 style="font-family:georgia; font-weight:bold;">NO MATTER HOW LONG IT TAKE</h4></div>
			</div>
		</div>
	<div class="container-fluid back">
			<div class="row box1"> 
				<div class="col-sm-4 ">
					<form name="abc" class="form-group">
					<lable class=" text-white"><br><h1>Login Here</h1></lable><br>
					<lable class="text-white">Username:</lable> <input type="text" name="user" class="form-control">
					<lable class="text-white">Password: </lable><input type="password" name="pwd" class="form-control">
					<lable class="text-white ">Select</lable>
					<select name="ch" class="form-control">
					<option value="Choose">Choose</option>
					<option value="Driver">Driver</option>
					<option value="User">User</option>
					</select>
					<br><button type="submit"  class="btn btn-primary" name="btn3">Submit</button>
					
					</form>
				</div>
			</div>
	</div>
	<div class="container-fluid header">
			<div class="row">
			<div class=" col-sm-1 "></div>
			<div class=" col-sm-1 "><a href="index.php" style="color:white;">Home</a></div>
			<div class=" col-sm-1 "><a href="about_us.html" style="color:white;">About Us</a></div>
			<div class=" col-sm-1 "><a href="contact_us.php" style="color:white;">Contact Us</a></div>
			</div>
	</div>
	

	<div class="container">
	     <div class="login-box">
		<div class="row">
		<div class="col-sm-8 text-justify">
		<b>Basic Life Support Ambulance: </b>These ambulances are more suitable for those patients who do not require advance medical support or cardiac monitoring until they reach the hospital. BLS ambulances are equipped with basic lifesaving equipment such as BP monitor, stretcher, and oxygen cylinder.<br>
		<b>Advance Life Support Ambulance: </b>ALS ambulances are used to transport patients who require a higher level of care until they reach the hospital. These emergency ambulance services are staffed with a paramedic or relevant doctor to aid the patient. These are fitted with all advanced life support supplies required to aid the severely ill or injured patient or cardiac patient, like cardiac monitor, incubator, IV supplies, ventilator, defibrillators, oxygen cylinders, nebulizer, resuscitation kit and BP apparatus.
		<br><b>Patient Transfer Ambulance: </b>Also known as Non-Emergency Patient Transfer or Transport, this ambulance is for patients who require constant clinical monitoring but are not in the dire need of time-critical emergency or those who are confined to wheelchairs and need mobility assistance.
		<br><b>Mortuary Ambulance: </b>These ambulances are mainly for the transportation of a dead body.
		</div>
		<div class="mx-3 px-2"><img src="img1.jpg"></div>
                <div class="w-100"></div>
		<br><br>
		<div class="col-sm-5  px-5 ">
			<p class="box3"> Create Driver Account</p>
				<form action="" method="post">
				
				<div class="form-group ">
				 	<lable>Name</lable>
					<input type="text" name="na" class="form-control">
				</div>
				<div class="form-group">
				 	<lable>Mobile Number</lable>
					<input type="text" name="mbl" class="form-control">
				</div>
				<div class="form-group">
				 	<lable>City</lable>
					<input type="text" name="city" class="form-control">
				</div>
				<div class="form-group">
					<lable>Ambulance Type</lable>
					<select class="form-control" name="choose">
						<option value="Choose">Choose</option>
						<option value="Basic Life Support Ambulance">Basic Life Support Ambulance</option>
						<option value="Advance Life Support Ambulance">Advance Life Support Ambulance</option>
						<option value="Patient Transfer Ambulance">Patient Transfer Ambulance</option>
						<option value="Mortuary Ambulance">Mortuary Ambulance</option>
					</select>
				</div>
				<div class="form-group">
				 	<lable>Ambulance Fare</lable>
					<input type="text" name="fare" class="form-control">
				</div>
				<div class="form-group">
					<lable>Password</lable>
					<input type="password" name="pwd" class="form-control">
				</div>
				<div class="form-group">
					<lable>Conform password</lable>
					<input type="password" name="conpwd" class="form-control">
				</div>
				
					<button type="submit" class="btn btn-primary" name="btn1">submit</button><br>
					
				</form>
		</div>

			   <div class="offset-sm-2 col-sm-5  px-5 ">
				<p class="box3"> Create User Account</p>
				<form action="" method="post">
				
				<div class="form-group">
				 	<lable>UserName</lable>
					<input type="text" name="na" class="form-control">
				</div>
				<div class="form-group">
				 	<lable>Address</lable>
					<input type="text" name="add" class="form-control">
				</div>
				<div class="form-group">
				 	<lable>Phone No</lable>
					<input type="text" name="phno" class="form-control">
				</div>
				<div class="form-group">
					<lable>Password</lable>
					<input type="password" name="pass" class="form-control">
				</div>
				<div class="form-group">
					<lable>Conform password</lable>
					<input type="password" name="conpwd" class="form-control">
				</div>
				
					<button type="submit"  class="btn btn-primary" name="btn2">submit</button>
			    	
				</form>
			  </div>	
		</div>
	    </div>	
	</div>
	<div class="container-fluid bg-secondary py-5">
		<div class="row text-white">
			<div class="offset-sm-2 col-sm-2 "><h5><b><u><a href="about_us.html" style="color:white;">About Us</a></u></b></h5></div>
			<div class="col-sm-2"><b><u><h5><a href="service.html" style="color:white;">Service</a></h5></u></b></div>
			<div class="col-sm-2"><b><u><h5>Follow us</h5></u></b></h4></div>
			<div class="col-sm-1"><img src="insta.png"></div>
			<div class="col-sm-1"><img src="wh.png"></div>
			<div class="col-sm-1"><img src="gmail1.png"></div>
		</div>
	<div>
		<script  src="js\jquery.js"></script>
		<script src="js\bootstrap.min.js"></script>
		
		
	</body>

	
</html>