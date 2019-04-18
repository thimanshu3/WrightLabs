<?php
if (isset($_POST['name']))// If form submitted, insert values into the database.
	{

	require '../../config/dbConnection.php';
	$user_id = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 4);
	$username = $_POST['name'];
	$user_email = $_POST['email'];
	$user_password = $_POST['password'];

	$check="SELECT * FROM `veterans_auth` WHERE email ='".$user_email."'";
	$duplicate=mysqli_query($con,$check);
	$no_of_duplicate_entries=mysqli_num_rows($duplicate);
	
	if($no_of_duplicate_entries>0)
	{
		echo "{'status':'failure','error':'Email Already Registered'}";
	}
	else
	{

		$user_id = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16);
		$username = stripslashes($username);
		$username = mysqli_real_escape_string($con,$username);
		$user_email = stripslashes($user_email);
		$user_email = mysqli_real_escape_string($con,$user_email);
		$user_password = stripslashes($user_password);
		$user_password = mysqli_real_escape_string($con,$user_password);
		$query = "INSERT into `veterans_auth` (user_id,username, email, password) VALUES ('$user_id','$username','$user_email', '$user_password')";
		
		$result = mysqli_query($con,$query);
		if($result)
		{

			echo '
			{
				"status":"success",
				"msg":"User Registered Successfully",
				}

			';
		}	
		else
			{
				echo "{'status':'failure','error':'Error Adding Trial Quota'}";
			}
		
		
	
	
	}
}
else
{
	echo "{'error':'unauthorized access'}";
}


?>