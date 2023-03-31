<?php
session_start();
include "database_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$member_id = $_POST["member_id"];
	$sql = "DELETE FROM team_member_tb WHERE member_id = '$member_id'";
	if (!mysqli_query($conn, $sql)) {
		$_SESSION["delete_member_status"] = "Failed";
		echo "Error deleting record: " . mysqli_error($conn);
	}
	$_SESSION["delete_member_status"] = "Success";
	mysqli_close($conn);
	header("Location://localhost/crud-project-management-system/members_admin_page.php");
}
?>