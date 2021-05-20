<?php

include("../class/crud.php");
include("../class/general.php");
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json");

$crud = new Crud();
$general = new General();
if ($_SERVER["REQUEST_METHOD"] == "GET") {

	if (empty($_GET['q'])) {
		$result = ["status" => FALSE, "message" => 'Parameter (q) is missing or empty.'];
	}
	else {
		$q = stripslashes(trim($_GET['q']));
		$sql = "select * from users WHERE email LIKE '%$q%'";
		$res = $crud->read($sql);

		$count = mysqli_num_rows($res);

		if ($count > 0) {
			$getdata = [];

			while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
				$getdata[] = $row;
			}
			$result = ["status" => TRUE, "alldata" => $getdata];
		}
		else {
			$result = ["status" => FALSE, "message" => 'No user(s) found.'];
		}
	}

	echo json_encode($result);
}
else {
	$error = ["status" => 405, "message" => 'Method not allowed...'];
	echo json_encode($error);
}