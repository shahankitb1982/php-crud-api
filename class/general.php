<?php

/**
 * Class General
 */
class General extends Crud {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Checks user is already exists or not by ID
	 *
	 * @param $id
	 * @return int|string
	 */
	function check_user_exists($id) {
		$crud = new Crud();
		$sql = "select * from users where id=" . $_GET['id'];
		$res = $crud->read($sql);

		return mysqli_num_rows($res);
	}

	/**
	 * Checks user is already exists or not by email
	 *
	 * @param $email
	 * @return int|string
	 */
	function check_user_exists_email($email) {
		$crud = new Crud();
		$sql = "select * from users where email='" . $email."'";
		$res = $crud->read($sql);

		return mysqli_num_rows($res);
	}
}

