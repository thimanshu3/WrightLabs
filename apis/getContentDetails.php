<?php
$response = array();
if (isset($_POST['Email']))
{
	require '../dbConfig/dbconfig.php';
	
	$email = $_POST['Email'];

	/*$check="SELECT * FROM quiz_details WHERE users_details_admin_id ='".$admin_id."' AND quiz_id ='".$quiz_id."'";
	$existing=mysqli_query($con,$check);
	$no_of_existing_entries=mysqli_num_rows($existing);
	if($no_of_existing_entries>0)
	*/

		$query1 = "SELECT * FROM `veterans_auth` WHERE email='$email'";
		$result = mysqli_query($con,$query1);
		$result = mysqli_fetch_assoc($result);
		 
				  if($result['email']=$email)
				  {
					$query="SELECT * FROM `content` WHERE user_content_email ='".$email."'";
					$content_details = mysqli_query($con,$query);
					$content_details = mysqli_fetch_assoc($content_details);
					$content = $content_details['content'];
					$publish_status = $content_details['publish_status'];
					$content_type = $content_details['content_type'];
					$content_desc = $content_details['content_desc'];
					$expected_price = $content_details['expected_price'];
					
					$response["status"]="success";
					$response["msg"]="Content Fetched Successfully";
					$response["content_desc"]=$content_desc;
					$response["content_type"]=$content_type;
					$response["content"]=$content;
					$response["publish_status"]=$publish_status;
					$response["expected_price"]=$expected_price;
					echo json_encode($response);
					  
					  
					  $response["status"] = "success";
					  $response["msg"] = "Logged In..";
					  echo json_encode($response);
				  }
				  else
				  {
					  $response["status"] = "failure";
					  $response["msg"] = "Oops.. connection lost or user not found..";
					  echo json_encode($response);
				  }
	
	//Finding Question Details based on QuestionId
		
}
else
{
	$response["error"] = "Unauthorized Access";
	echo json_encode($response);
}
?>