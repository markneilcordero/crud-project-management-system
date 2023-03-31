<?php
session_start();
include "database_connection.php";

function test_input($database, $data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = mysqli_real_escape_string($database, $data);
	return $data;
}

$item_title = $item_desc = $status = $type = $member_id = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$item_id = $_POST["item_id"];
	if (!empty($_POST["item_title"]) && !empty($_POST["item_description"]) && !empty($_POST["status"]) && !empty($_POST["type"]) && !empty($_POST["member_id"])) {
		$item_title = test_input($conn, $_POST["item_title"]);
		$item_desc = test_input($conn, $_POST["item_description"]);
		$status = test_input($conn, $_POST["status"]);
		$type = test_input($conn, $_POST["type"]);
		$member_id = test_input($conn, $_POST["member_id"]);

		$sql = "UPDATE item_admin_tb SET item_title = '$item_title', item_desc = '$item_desc', status = '$status', type = '$type', member_id = '$member_id' WHERE item_id = '$item_id'";

		if (!mysqli_query($conn, $sql)) {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		$_SESSION["update_item_status"] = "Success";
		mysqli_close($conn);
		header("Location://localhost/crud-project-management-system/items_admin_page.php");
	} else {
		$_SESSION["update_item_status"] = "Failed";
		header("Location://localhost/crud-project-management-system/items_admin_page.php");
	}
}
?>