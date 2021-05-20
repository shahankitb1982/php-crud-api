<?php

include("../class/crud.php");

header("Access-Control-Allow-Origin: *");
header("Content-type:application/json");

$crud = new Crud();

if ($_SERVER["REQUEST_METHOD"] == "GET") {

	$sql = "select * from users";
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

	echo json_encode($result);
}
else {
	$error = ["status" => 405, "message" => 'Method not allowed...'];
	echo json_encode($error);
}