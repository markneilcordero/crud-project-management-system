<?php
session_start();
include "database_connection.php";
if (empty($_SESSION["new_project_status"])) {
	$_SESSION["new_project_status"] = "";
}
if (empty($_SESSION["update_project_status"])) {
	$_SESSION["update_project_status"] = "";
}
if (empty($_SESSION["delete_project_status"])) {
	$_SESSION["delete_project_status"] = "";
}
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
	<h1 class="text-center">Projects Administrative Page</h1>
	<div class="container border p-3">
		<form action="create_new_project.php" method="POST">
			<p class="font-weight-bold">New Project</p>
			<?php
			if ($_SESSION["new_project_status"] == "Failed") {
				echo 
					'<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Error!</strong>
					</div>';
				$_SESSION["new_project_status"] = "";
			} elseif ($_SESSION["new_project_status"] == "Success") {
				echo 
					'<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Success!</strong>
					</div>';
				$_SESSION["new_project_status"] = "";
			}
			?>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text bg-light">Project Title</span>
				</div>
				<input type="text" name="project_title" class="form-control" placeholder="Example: Project Metro">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text bg-light">Project Description</span>
				</div>
				<input type="text" name="project_description" class="form-control" placeholder="Example: Increase Productivity">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text bg-light">Team Members</span>
				</div>
				<select class="form-control" name="member_id">
					<?php
					$sql = "SELECT member_id, firstname, lastname FROM team_member_tb";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<option value="' . $row["member_id"] . '">' . $row["firstname"] . " " . $row["lastname"] . '</option>';
						}
					}
					?>
				</select>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text bg-light">Status</span>
				</div>
				<select class="form-control" name="project_status">
					<option value="To do">To do</option>
					<option value="To Validate">To Validate</option>
					<option value="Done">Done</option>
				</select>
			</div>
			<input type="submit" class="btn btn-block bg-success text-light" value="Save">
		</form>
	</div>
</div>

<div style="max-width:800px; margin:50px auto;">
<?php
if ($_SESSION["update_project_status"] == "Failed" || $_SESSION["delete_project_status"] == "Failed") {
	echo 
	'<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Error!</strong>
	</div>';
	$_SESSION["update_project_status"] = "";
	$_SESSION["delete_project_status"] = "";
} elseif ($_SESSION["update_project_status"] == "Success" || $_SESSION["delete_project_status"] == "Success") {
	echo 
	'<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Success!</strong>
	</div>';
	$_SESSION["update_project_status"] = "";
	$_SESSION["delete_project_status"] = "";
}
?>	
	<table class="table table-bordered">
		<thead>
			<tr class="text-center">
				<th>Title</th>
				<th>Description</th>
				<th>Status</th>
				<th>Assignee</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
<?php
$sql = "SELECT project.project_id, project.project_title, project.project_desc, member.member_id, project.project_status, member.firstname, member.lastname
FROM project_admin_tb as project
LEFT JOIN team_member_tb as member
ON project.member_id = member.member_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		echo '
			<tr class="text-center">
				<td>' . $row["project_title"] . '</td>
				<td>' . $row["project_desc"] . '</td>
				<td>' . $row["project_status"] . '</td>
				<td>' . $row["firstname"] . " " . $row["lastname"] . '</td>
				<td>
					<div class="form-group">
						<button type="button" class="btn bg-primary text-light" data-toggle="modal" data-target="#editModal' . $row["project_id"] . '">Edit</button>
						<button type="button" class="btn bg-danger text-light" data-toggle="modal" data-target="#deleteModal' . $row["project_id"] . '">Delete</button>
					</div>
					<div class="modal" id="editModal' . $row["project_id"] . '">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="text-center">Edit Project</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<form action="update_project.php" method="POST">
										<input type="hidden" name="project_id" value="' . $row["project_id"] . '">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-light">Project Title</span>
											</div>
											<input type="text" name="project_title" class="form-control" value="' . $row["project_title"] . '">
										</div>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-light">Project Description</span>
											</div>
											<input type="text" name="project_description" class="form-control" value="' . $row["project_desc"] . '">
										</div>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-light">Team Members</span>
											</div>
											<select class="form-control" name="member_id">';
					$selectMember = "SELECT member_id, firstname, lastname FROM team_member_tb";
					$selectMemberRes = mysqli_query($conn, $selectMember);

					if (mysqli_num_rows($selectMemberRes) > 0) {
						while ($memberRow = mysqli_fetch_assoc($selectMemberRes)) {
							echo '<option value="' . $memberRow["member_id"] . '">' . $memberRow["firstname"] . " " . $memberRow["lastname"] . '</option>';
						}
					}
										echo'
											</select>
										</div>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-light">Status</span>
											</div>
											<select class="form-control" name="project_status">
												<option value="To do">To do</option>
												<option value="To Validate">To Validate</option>
												<option value="Done">Done</option>
											</select>
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
					<div class="modal" id="deleteModal' . $row["project_id"] . '">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Are you sure you want to delete?</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<form action="delete_project.php" method="POST">
										<input type="hidden" name="project_id" value="' . $row["project_id"] . '">
										<table class="table">
											<thead>
												<tr class="text-center">
													<th>Title</th>
													<th>Description</th>
													<th>Status</th>
													<th>Assignee</th>
												</tr>
											</thead>
											<tbody>
												<tr class="text-center">
													<td>' . $row["project_title"] . '</td>
													<td>' . $row["project_desc"] . '</td>
													<td>' . $row["project_status"] . '</td>
													<td>' . $row["firstname"] . " " . $row["lastname"] . '</td>
												</tr>
												<tr>
													<td colspan="4"><input type="submit" class="btn btn-block bg-success text-light" value="Confirm"></td>
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