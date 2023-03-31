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
	if (!empty($_POST["item_title"]) && !empty($_POST["item_description"]) && !empty($_POST["status"]) && !empty($_POST["type"]) && !empty($_POST["member_id"])) {
		$item_title = test_input($conn, $_POST["item_title"]);
		$item_desc = test_input($conn, $_POST["item_description"]);
		$status = test_input($conn, $_POST["status"]);
		$type = test_input($conn, $_POST["type"]);
		$member_id = test_input($conn, $_POST["member_id"]);

		$sql = "INSERT INTO item_admin_tb (item_title, item_desc, status, type, member_id)
		VALUES ('$item_title', '$item_desc', '$status', '$type', '$member_id')";

		if (!mysqli_query($conn, $sql)) {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		$_SESSION["new_item_status"] = "Success";
		mysqli_close($conn);
		header("Location://localhost/crud-project-management-system/items_admin_page.php");
	} else {
		$_SESSION["new_item_status"] = "Failed";
		header("Location://localhost/crud-project-management-system/items_admin_page.php");
	}
}
?>