<?php
if (isset($_POST['user_id']))
{
	require '../dbConfig/dbconfig.php';
	session_start();
	
	$user_id = $_SESSION['user_id'];

	//Finding Question Details based on QuestionId
	$query="SELECT * FROM `content`,`veterans_auth` WHERE veterans_auth.user_id ='".$user_id."'";
	$content_details = mysqli_query($con,$query);
	$content_details = mysqli_fetch_assoc($category_details);
	$content = $content_details['content'];
	$content_type = $content_details['content_type'];
	$content_desc = $content_details['content_desc'];
	$expected_price = $content_details['expected_price'];
	echo '
				{
					"status":"success",
					"msg":"Content Fetched Successfully",
					"content_desc":"'.$content_desc.'",
					"content_type":"'.$content_type.'",
					"content":"'.$content.'",
					"expected_price":"'.$expected_price.'"
				}
				';
}
else
{
	echo '{"error":"unautorized access"}';
}
?>