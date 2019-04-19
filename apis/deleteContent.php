<?php
$response = array();
if (isset($_POST['Email'],$_POST['content_id']))
{
	require '../dbConfig/dbconfig.php';
	
	$email = $_POST['Email'];
	$content_id = $_POST['content_id'];
	//Finding Question Details based on QuestionId
	$query = "DELETE from `content` WHERE content_id = '$content_id'";
	$result = mysqli_query($con,$query);
	if($result)
	{
		$response["status"] = "success";
		$response["msg"] = "Content deleted Successfully..";
		echo json_encode($response);
	}
	else
	{
		$response["status"] = "failure";
		$response["msg"] = "Content not deleted!!..";
		echo json_encode($response);
	}
}
else
{
	$response["error"] = "Unauthorized Access";
	echo json_encode($response);
}
?>