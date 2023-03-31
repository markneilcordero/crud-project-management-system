<?php
session_start();
include "database_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$item_id = $_POST["item_id"];
	$sql = "DELETE FROM item_admin_tb WHERE item_id = '$item_id'";
	if (!mysqli_query($conn, $sql)) {
		$_SESSION["delete_item_status"] = "Failed";
		echo "Error deleting record: " . mysqli_error($conn);
	}
	$_SESSION["delete_item_status"] = "Success";
	mysqli_close($conn);
	header("Location://localhost/crud-project-management-system/items_admin_page.php");
}
?>