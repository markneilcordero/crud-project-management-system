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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$member_id = $_POST["member_id"];
	if (!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"])) {
		$firstname = test_input($conn, $_POST["firstname"]);
		$lastname = test_input($conn, $_POST["lastname"]);
		$email = test_input($conn, $_POST["email"]);

		$sql = "UPDATE team_member_tb SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE member_id = '$member_id'";

		if (!mysqli_query($conn, $sql)) {
			$_SESSION["update_member_status"] = "Failed";
			echo "Error updating record: " . mysqli_error($conn);
		}
		$_SESSION["update_member_status"] = "Success";
		mysqli_close($conn);
		header("Location://localhost/crud-project-management-system/members_admin_page.php");
	}
}
?>