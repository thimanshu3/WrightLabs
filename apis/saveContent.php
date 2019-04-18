<?php
$response = array();
if (isset($_POST['Email']))// Cheking if the POST fields are set
{

	require '../dbConfig/dbconfig.php';

	$user_email = $_POST['Email'];

	//$quiz_id = (string)(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 2))."_".$admin_id;
	$content_id = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 4);
	$content_type = $_POST['content_type'];
	$content_desc = $_POST['content_desc'];
	$content = $_POST['content'];
	$expected_price = $_POST['expected_price'];
	$query = "INSERT into `content` (content_type,content_desc,expected_price,content_id,content,publish_status,user_content_email) VALUES ('$content_type','$content_desc','$expected_price','$content_id','$content',0,'$user_email')";
	//echo $quiz_id;
	$result = mysqli_query($con,$query);
	if($result)
	{
		
		$response["status"]="success";
		$response["msg"]="Content Added Successfully";
		$response["user_email"]=$user_email;
		echo json_encode($response);
	
	}
	else
	{
		
		$response["status"]="failure";
		$response["msg"]="Error Saving Content";
			echo json_encode($response);
	}
}
else
{
	$response["error"] = "Unauthorized Access";
	echo json_encode($response);
}

?>