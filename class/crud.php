<?php
include("../includes/connection.php");

/**
 * Class Crud
 */
class Crud extends Connection {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Create data.
	 *
	 * @param $data
	 * @return mixed
	 */
	public function create($data) {
		$insert = $this->con->query($data) or die();

		if ($insert) {
			return $insert;
		}
		else {
			echo "Query failed...";
		}
	}

	/**
	 * Read data
	 *
	 * @param $data
	 * @return mixed
	 */
	public function read($data) {
		$view = $this->con->query($data) or die();

		if ($view->num_rows > 0) {
			return $view;
		}
		else {
			return $view;
		}
	}

	/**
	 * Update data
	 *
	 * @param $data
	 * @return mixed
	 */
	public function update($data) {
		$update = $this->con->query($data) or die();

		if ($update) {
			return $update;
		}
		else {
			echo "Query failed...";
		}
	}

	/**
	 * Delete data
	 *
	 * @param $data
	 * @return mixed
	 */
	public function deletes($data) {
		$delete = $this->con->query($data) or die();

		if ($delete) {
			return $delete;
		}
		else {
			echo "Query failed...";
		}
	}
}