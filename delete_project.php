<?php
session_start();
include "database_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$project_id = $_POST["project_id"];
	$sql = "DELETE FROM project_admin_tb WHERE project_id = '$project_id'";
	if (!mysqli_query($conn, $sql)) {
		$_SESSION["delete_project_status"] = "Failed";
		echo "Error deleting record: " . mysqli_error($conn);
	}
	$_SESSION["delete_project_status"] = "Success";
	mysqli_close($conn);
	header("Location://localhost/crud-project-management-system/projects_admin_page.php");
}
?>