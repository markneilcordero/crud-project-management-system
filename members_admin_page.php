<?php
session_start();
if (empty($_SESSION["new_member_status"])) {
	$_SESSION["new_member_status"] = "";
}
if (empty($_SESSION["update_member_status"])) {
	$_SESSION["update_member_status"] = "";
}
if (empty($_SESSION["delete_member_status"])) {
	$_SESSION["delete_member_status"] = "";
}
include "database_connection.php";
?>
<!Doctype html>
<html lang="en">
<head>
<title>Crud Operation</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
* {
	/*border: 1px solid #EDEDED;*/
}
</style>
</head>
<body>

<div style="max-width:800px; margin:25px auto;">
	<div class="container">
		<div class="row">
			<div class="col border p-3 mx-1">
				<p class="font-weight-bold">Project Admin Page</p>
				<p class="font-weight-normal">Manage your team's projects.</p>
				<a href="projects_admin_page.php" class="btn btn-primary">Projects</a>
			</div>
			<div class="col border p-3 mx-1">
				<p class="font-weight-bold">Item Admin Page</p>
				<p class="font-weight-normal">Manage your team's items.</p>
				<a href="items_admin_page.php" class="btn btn-primary">Items</a>
			</div>
			<div class="col border p-3 mx-1">
				<p class="font-weight-bold">Members Admin Page</p>
				<p class="font-weight-normal">Manage team members.</p>
				<a href="members_admin_page.php" class="btn btn-primary">Members</a>
			</div>
		</div>
	</div>
</div>

<div style="width:700px; margin:50px auto;">
	<h1 class="text-center">Team Members Administrative Page</h1>
	<div class="container border p-3">
		<form action="create_new_member.php" method="POST">
			<p class="font-weight-bold">New Member</p>
			<?php
			if ($_SESSION["new_member_status"] == "Failed") {
				echo 
					'<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Error!</strong>
					</div>';
				$_SESSION["new_member_status"] = "";
			} elseif ($_SESSION["new_member_status"] == "Success") {
				echo 
					'<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Success!</strong>
					</div>';
				$_SESSION["new_member_status"] = "";
			}
			?>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text bg-light">First Name</span>
				</div>
				<input type="text" name="firstname" class="form-control" placeholder="Example: John">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text bg-light">Last Name</span>
				</div>
				<input type="text" name="lastname" class="form-control" placeholder="Example: Smith">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text bg-light">Email Address</span>
				</div>
				<input type="email" name="email" class="form-control" placeholder="Example: johnsmith@gmail.com">
			</div>
			<input type="submit" class="btn btn-block bg-success text-light" value="Save">
		</form>
	</div>
</div>

<div style="width:1000px; margin:50px auto;">
<?php
if ($_SESSION["update_member_status"] == "Failed" || $_SESSION["delete_member_status"] == "Failed") {
	echo 
	'<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Error!</strong>
	</div>';
	$_SESSION["update_member_status"] = "";
	$_SESSION["delete_member_status"] = "";
} elseif ($_SESSION["update_member_status"] == "Success" || $_SESSION["delete_member_status"] == "Success") {
	echo 
	'<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Success!</strong>
	</div>';
	$_SESSION["update_member_status"] = "";
	$_SESSION["delete_member_status"] = "";
}
?>
	<table class="table table-bordered">
		<thead>
			<tr class="text-center">
				<th>Last Name</th>
				<th>First Name</th>
				<th>Email Address</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
<?php
$sql = "SELECT * FROM team_member_tb";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		echo
			'<tr class="text-center">
				<td>' . $row["lastname"] . '</td>
				<td>' . $row["firstname"] . '</td>
				<td>' . $row["email"] . '</td>
				<td>
					<div class="form-group">
						<button type="button" class="btn bg-primary text-light" data-toggle="modal" data-target="#editModal' . $row["member_id"] . '">Edit</button>
						<button type="button" class="btn bg-danger text-light" data-toggle="modal" data-target="#deleteModal' . $row["member_id"] . '">Delete</button>
					</div>
					<div class="modal" id="editModal' . $row["member_id"] . '">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="text-center">Edit Member</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<form action="update_team_member.php" method="POST">
										<input type="hidden" name="member_id" value="' . $row["member_id"] . '">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-light">First Name</span>
											</div>
											<input type="text" name="firstname" class="form-control" value="' . $row["firstname"] . '">
										</div>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-light">Last Name</span>
											</div>
											<input type="text" name="lastname" class="form-control" value="' . $row["lastname"] . '">
										</div>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-light">Email Address</span>
											</div>
											<input type="email" name="email" class="form-control" value="' . $row["email"] . '">
										</div>
										<input type="submit" class="btn btn-block bg-success text-light" value="Save">
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<div class="modal" id="deleteModal' . $row["member_id"] . '">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Are you sure you want to delete?</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<form action="delete_team_member.php" method="POST">
										<input type="hidden" name="member_id" value="' . $row["member_id"] . '">
										<table class="table table-bordered">
											<thead>
												<tr class="text-center">
													<th>Last Name</th>
													<th>First Name</th>
													<th>Email Address</th>
												</tr>
											</thead>
											<tbody>
												<tr class="text-center">
													<td>' . $row["lastname"] . '</td>
													<td>' . $row["firstname"] . '</td>
													<td>' . $row["email"] . '</td>
												</tr>
												<tr>
													<td colspan="3"><input type="submit" class="btn btn-block bg-success text-light" value="Confirm"></td>
												</tr>
											</tbody>
										</table>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>';
	}
}
?>
		</tbody>
	</table>
</div>

</body>
</html>