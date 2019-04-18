<?php
$response = array();
if (isset($_POST['Email']))
{
	require '../dbConfig/dbconfig.php';
	
	$email = $_POST['Email'];

	//Finding Question Details based on QuestionId
	$query="SELECT * FROM `content` WHERE user_content_email ='".$email."'";
	$content_details = mysqli_query($con,$query);
	$content_details = mysqli_fetch_assoc($category_details);
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
}
else
{
	$response["error"] = "Unauthorized Access";
	echo json_encode($response);
}
?>