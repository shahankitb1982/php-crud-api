<?php
include("../class/crud.php");
include("../class/general.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$crud = new Crud();
$general = new General();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$data = [];
	parse_str(file_get_contents('php://input'), $data);

	$first_name = trim($data["first_name"]);
	$last_name = trim($data["last_name"]);
	$email = trim($data["email"]);

	if (empty($email)) {
		$result = ["status" => FALSE, "message" => 'Email is required.'];
	}
	else {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$result = ["status" => FALSE, "message" => 'Email is not valid.'];
		}
		else {
			$first_name = mysqli_real_escape_string($crud->con, $first_name);
			$last_name = mysqli_real_escape_string($crud->con, $last_name);
			$email = mysqli_real_escape_string($crud->con, $email);

			$count = $general->check_user_exists_email($email);

			if ($count > 0 ) {
				$result = ["status" => FALSE, "message" => "User already exists with given email."];
			}
			else {
				$sql = "insert into users (first_name,last_name,email) values ('$first_name','$last_name','$email')";

				$res = $crud->create($sql);

				if ($res) {
					$result = ["status" => TRUE, "message" => "User created successfully."];
				}
				else {
					$result = ["status" => FALSE, "message" => "Something went wrong."];
				}
			}
		}
	}

	echo json_encode($result);
}
else {
	$error = ["status" => 405, "message" => 'Method not allowed.'];
	echo json_encode($error);
}
