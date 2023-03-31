<?php
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

<div style="max-width:800px; margin:50px auto;">
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

</body>
</html>