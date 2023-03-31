<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS crud_project_management_db";
if (!mysqli_query($conn, $sql)) {
	echo "Error creating database: " . mysqli_error($conn);
}

$dbname = "crud_project_management_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "CREATE TABLE IF NOT EXISTS team_member_tb (
member_id INT(11) PRIMARY KEY AUTO_INCREMENT,
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL
)";

if (!mysqli_query($conn, $sql)) {
	echo "Error creating table: " . mysqli_error($conn);
}

$sql = "CREATE TABLE IF NOT EXISTS item_admin_tb (
item_id INT(11) PRIMARY KEY AUTO_INCREMENT,
item_title VARCHAR(255) NOT NULL,
item_desc LONGTEXT NOT NULL,
status VARCHAR(50) NOT NULL,
type VARCHAR(50) NOT NULL,
member_id VARCHAR(255) NOT NULL
)";

if (!mysqli_query($conn, $sql)) {
	echo "Error creating table: " . mysqli_error($conn);
}

$sql = "CREATE TABLE IF NOT EXISTS project_admin_tb (
project_id INT(11) PRIMARY KEY AUTO_INCREMENT,
project_title VARCHAR(255) NOT NULL,
project_desc LONGTEXT NOT NULL,
member_id VARCHAR(255) NOT NULL,
project_status VARCHAR(255) NOT NULL
)";

if (!mysqli_query($conn, $sql)) {
	echo "Error creating table: " . mysqli_error($conn);
}
?>