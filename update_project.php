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

$project_title = $project_desc = $member_id = $project_status = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$project_id = $_POST["project_id"];
	if (!empty($_POST["project_title"]) && !empty($_POST["project_description"]) && !empty($_POST["member_id"]) && !empty($_POST["project_status"])) {
		$project_title = test_input($conn, $_POST["project_title"]);
		$project_desc = test_input($conn, $_POST["project_description"]);
		$member_id = test_input($conn, $_POST["member_id"]);
		$project_status = test_input($conn, $_POST["project_status"]);

		$sql = "UPDATE project_admin_tb SET project_title = '$project_title', project_desc = '$project_desc', member_id = '$member_id', project_status = '$project_status' WHERE project_id = '$project_id'";

		if (!mysqli_query($conn, $sql)) {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		$_SESSION["update_project_status"] = "Success";
		mysqli_close($conn);
		header("Location://localhost/crud-project-management-system/projects_admin_page.php");
	} else {
		$_SESSION["update_project_status"] = "Failed";
		header("Location://localhost/crud-project-management-system/projects_admin_page.php");
	}
}
?>