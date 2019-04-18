<?php
	require '../dbConfig/dbconfig.php';
	$response = array();
	if (isset($_POST['Name'],$_POST['Password'],$_POST['Email']))
	{
		$username = mysqli_real_escape_string($con,stripslashes($_POST['Name']));
		$password = mysqli_real_escape_string($con,stripslashes($_POST['Password']));
		$email = mysqli_real_escape_string($con,stripslashes($_POST['Email']));
		//Checking is user existing in the database or not
		$query = "SELECT * FROM `veterans_auth` WHERE email='$email'";
		$result = mysqli_query($con,$query);
		$result = mysqli_fetch_assoc($result);
		 
				  if($result['username']==$username and $result['password']=$password and $result['email']=$email)
				  {
					  $response["status"] = "success";
					  $response["msg"] = "Logged In..";
					  echo json_encode($response);
				  }
				  else
				  {
					  $response["status"] = "failure";
					  $response["msg"] = "Invalid Credentials";
					  echo json_encode($response);
				  }
				  					
	}		
	else
		{
			$response["error"] = "Value Missing";
			echo json_encode($response);
		}
			  
			   
?>