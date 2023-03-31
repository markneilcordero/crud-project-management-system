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

$firstname = $lastname = $email = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"])) {
		$firstname = test_input($conn, $_POST["firstname"]);
		$lastname = test_input($conn, $_POST["lastname"]);
		$email = test_input($conn, $_POST["email"]);

		$sql = "INSERT INTO team_member_tb (firstname, lastname, email)
		VALUES ('$firstname', '$lastname', '$email')";

		if (!mysqli_query($conn, $sql)) {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		$_SESSION["new_member_status"] = "Success";
		mysqli_close($conn);
		header("Location: http://localhost/crud-project-management-system/members_admin_page.php");
	} else {
		$_SESSION["new_member_status"] = "Failed";
		header("Location: http://localhost/crud-project-management-system/members_admin_page.php");
	}
}
?>