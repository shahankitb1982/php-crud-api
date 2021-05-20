<?php
include("../class/crud.php");
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json");

$crud = new Crud();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (empty($_GET['id'])) {
		$result = ["status" => FALSE, "message" => 'Parameter (id) is missing or empty.'];
	}
	else {
		$id = trim($_GET['id']);
		$sql = "select * from users where id=" . $id;
		$res = $crud->read($sql);

		$count = mysqli_num_rows($res);

		if ($count > 0) {
			$user = [];

			while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
				$user[] = $row;
			}

			$result = ["status" => TRUE, "userInfo" => $user];
		}
		else {
			$result = ["status" => FALSE, "message" => 'User not found.'];
		}
	}

	echo json_encode($result);
}
else {
	$error = ["status" => 405, "message" => 'Method not allowed.'];
	echo json_encode($error);
}    
