<?php
include("../class/crud.php");
include("../class/general.php");
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json"); 

$crud = new Crud();
$general = new General();

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {

	$count = $general->check_user_exists($_GET['id']);

	if ($count == 0) {
		$result =  ["status" => FALSE, "message" => "User not found."];
	}
	else {
		$sql = "delete from users where id=".$_GET['id'];
		$res = $crud->deletes($sql);

		if ($res) {
			$result = ["status" => true , "message" => "User deleted successfully."];
		}
		else {
			$result = ["status" => false , "message" => "Something went wrong."];
		}
	}

	echo json_encode($result);
}
else {
	$error = ["status" => 405 , "message" => 'Method not allowed.'];
	echo json_encode($error);
} 