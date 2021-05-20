<?php
include("../class/crud.php");
include("../class/general.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$crud = new Crud();
$general = new General();

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
	$data = [];
	parse_str(file_get_contents('php://input'), $data);

	$first_name = trim($data["first_name"]);
	$last_name = trim($data["last_name"]);
	$email = trim($data["email"]);

	if (empty($_GET['id'])) {
		$result = ["status" => FALSE, "message" => 'Parameter (id) is missing or empty.'];
	}
	else {
		if (empty($email)) {
			$result = ["status" => FALSE, "message" => 'Email is required.'];
		}
		else {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$result = ["status" => FALSE, "message" => 'Email is not valid.'];
			}
			else {
				$first_name = mysqli_real_escape_string($crud->con, $data["first_name"]);
				$last_name = mysqli_real_escape_string($crud->con, $data["last_name"]);
				$email = mysqli_real_escape_string($crud->con, $data["email"]);
				$id = trim($_GET['id']);

				$count = $general->check_user_exists($id);

				if ($count == 0) {
					$result = ["status" => FALSE, "message" => "User not found."];
				}
				else {
					$sql = "update users set first_name = '$first_name' , last_name = '$last_name', email = '$email'  where id=" . $id;
					$res = $crud->update($sql);

					if ($res)
					{
						$result = ["status" => TRUE, "message" => "User updated successfully."];
					} else
					{
						$result = ["status" => FALSE, "message" => "Something went wrong."];
					}
				}
			}
		}
	}

	echo json_encode($result);
}
else {
	$error = ["status" => 405, "message" => 'Method not allowed...'];
	echo json_encode($error);
} 