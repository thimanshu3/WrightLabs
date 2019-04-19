<?php
$response = array();
if (isset($_POST['Name'],$_POST['Email'],$_POST['Password']))// If form submitted, insert values into the database.
	{
	require '../dbConfig/dbconfig.php';
	$user_id = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 4);
	$username = $_POST['Name'];
	$user_email = $_POST['Email'];
	$user_password = $_POST['Password'];

	$check="SELECT * FROM `veterans_auth` WHERE email ='".$user_email."'";
	$duplicate=mysqli_query($con,$check);
	$no_of_duplicate_entries=mysqli_num_rows($duplicate);
	
	if($no_of_duplicate_entries>0)
	{
		$response["status"]="failure";
		$response["msg"]="Email Already Registered";
		echo json_encode($response);
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
				$response["status"]="success";
				$response["msg"]="User Registered Successfully";
				echo json_encode($response);
		}	
		else
			{
				$response["status"]="failure";
				$response["msg"]="Error Registering user";
				echo json_encode($response);
			}
	}
}
else
{
	$response["error"] = "Unauthorized Access";
	echo json_encode($response);
}


?>