<?php
session_start();
if (isset($_SESSION['user_id']))// Cheking if the POST fields are set
{

	require '../dbConfig/dbconfig.php';

	$user_id = $_SESSION['user_id'];

	//$quiz_id = (string)(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 2))."_".$admin_id;
	$content_id = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 4);
	$content_type = $_POST['content_type'];
	$content_desc = $_POST['content_desc'];
	$content = $_POST['content'];
	$expected_price = $_POST['expected_price'];
	
	$query = "INSERT into `content` (content_type,content_desc,expected_price,content_id,content) VALUES ('$content_type','$content_desc','$expected_price','$content_id','$content')";
	//echo $quiz_id;
	$result = mysqli_query($con,$query);
	if($result)
	{
	echo '

	{
		"status":"success",
		"msg":"Content Added Successfully",
		"user_id":"'.$user_id.'"
	}
	';
	}
	else
	{
		//Redirect to Error Page
		echo '{"status":"failure","error":"Error Saving Content"}';
	}
}
else
{
	echo '{"error":"unautorized access"}';
}

?>