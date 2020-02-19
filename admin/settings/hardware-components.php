<!--  InfoTechServices System

      Programmer: 
        Dalmo, Manilyn

-->

<!--  department page  -->

<!--  InfoTechServices System

      Programmer: 
        Dalmo, Manilyn

-->

<?php

//start session
session_start();

//check if user is not logged in
if (!isset($_SESSION["username"]) && !isset($_SESSION['usertype'])) {

	//redirect to login page
	header('location: ../login.php');
} else {
	if ($_SESSION['usertype'] !== 'admin' && $_SESSION['usertype'] !== 'programmer') {
		//redirect to login page
		header('location: ../login.php');
	}
}

//include database connection
require_once('../../config/db_connection.php');

//include file containing queries
include_once "../../config/controllers/controller.php";

//instantiate Controller
$control = new Controller();

$hardware_components = $control->getHardwareComponents();

// var_dump($hardware_components); die;

$main_hwcomponents = $control->getHardwareComponentsByCategory('main');

?>

<!DOCTYPE html>

<html class="h-100 w-100">

<head>

	<!-- Meta Tag to Set Page's Width -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--  Title Page  -->
	<title>PGO IT Services - Admin Page</title>

	<!--  Link Bootstrap stylesheet -->
	<link href="../../plug-ins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!--  Link sidebar stylesheet  -->
	<link href="../../css/simple-sidebar.css" rel="stylesheet">

	<!-- Font Awesome Icons Stylesheet -->
	<link href="../../plug-ins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<!-- Bootstrap core JavaScript -->
	<script src="../../plug-ins/jquery/jquery.min.js"></script>
	<script src="../../plug-ins/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>

<body class="h-100 w-100">

	<!-- /# Wrapper -->
	<div class="d-flex" id="wrapper">

		<!-- Sidebar -->
		<div class="bg-secondary border-right mt-5 pt-2" id="sidebar-wrapper">

			<div class="list-group list-group-flush">

				<a href="../incoming-requests.php" class="list-group-item list-group-item-action bg-secondary text-light border-bottom"><i class="fa fa-bell" aria-hidden="true"></i> Incoming Requests</a>

				<a href="../incoming-repairs.php" class="list-group-item list-group-item-action bg-secondary text-light border-bottom"><i class="fa fa-wrench" aria-hidden="true"></i> Incoming Repairs</a>

				<!-- <a href="#reportsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action bg-secondary text-light"><i class="fa fa-file" aria-hidden="true"></i> Repair Reports</a>
	        <ul class="collapse list-unstyled" id="reportsSubmenu">
	          <li><a href="../repairassess-reports.php" class="list-group-item list-group-item-action text-white border-bottom" style="background-color: #adb5bd">Repair Assessment Reports</a></li>
	          <li><a href="../repairinspect-reports.php" class="list-group-item list-group-item-action text-white" style="background-color: #adb5bd">Repair Inspection Reports</a></li>
	        </ul> -->

				<?php
				if ($_SESSION['usertype'] === 'admin' || $_SESSION['usertype'] === 'programmer') {
				?>
					<a href="#settingsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action bg-secondary text-light"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
					<ul class="collapse list-unstyled" id="settingsSubmenu">

						<li><a href="user-accounts.php" class="list-group-item list-group-item-action text-white border-bottom" style="background-color: #adb5bd">User Accounts</a></li>

						<li><a href="employees.php" class="list-group-item list-group-item-action text-white border-bottom" style="background-color: #adb5bd">Employees</a></li>

						<li><a href="departments.php" class="list-group-item list-group-item-action text-white border-bottom" style="background-color: #adb5bd">Departments</a></li>

						<li><a href="hardware-components.php" class="list-group-item list-group-item-action text-white" style="background-color: #adb5bd">Hardware Components</a></li>

					</ul>
				<?php
				}
				?>

			</div>

		</div>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div class="h-100 w-100">

			<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">

				<button class="btn btn-primary" id="menu-toggle" data-toggle="tooltip" title="Toggle Sidebar"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link text-primary font-weight-bold" href="../incoming-requests.php">INFO TECH SERVICES</a>
						</li>
					</ul>
				</div>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">

					<ul class="navbar-nav ml-auto mt-2 mt-lg-0">

						<li class="nav-item">
							<a class="nav-link text-primary font-weight-bold disabled"><?php echo $_SESSION['username']; ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-primary " href="../../logout.php" data-toggle="tooltip" title="Logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
						</li>

					</ul>
				</div>

			</nav>

			<div class="container-fluid h-100" style="margin-top: 80px;">

				<div class="row">
					<p class="h3 mx-auto"><i class="fa fa-desktop" aria-hidden="true"></i> Hardware Components </p>
				</div>

				<hr class="border border-bottom border-primary">

				<div class="row">

					<div class="col-lg-3">
						<div class="input-group">
							<input type="text" class="form-control" id="search" placeholder="Search">
							<div class="input-group-append">

								<button type="button" class="btn btn-primary" id="add" data-toggle="tooltip" title="Add Hardware Component"><i class="fa fa-plus" aria-hidden="true"></i> <i class="fa fa-desktop" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
					<!-- <div class="col-lg-3">
					</div> -->
				</div>

			</div>
			<!--/# Container -->

			<!-- Modal  -->
			<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<!-- Forms -->
						<!--  Add Modal  -->
						<div id="add-form">
							<?php
							include_once('../../forms/hardwareComponent-addingform.php');
							?>
						</div>
						<!-- /#Add Modal -->

						<!--  Edit Modal  -->
						<div id="edit-form">
						</div>
						<!--  /#Edit Div  -->

						<!-- /#Forms -->
					</div>
				</div>
			</div>
			<!-- /# Modal  -->

			<!-- Table Container -->
			<div class="container-fluid mt-2">
				<?php include_once('../../tables/hardwareComponent-tbl.php');	?>
			</div>
			<!--/#Table Container-->

		</div>
		<!-- /# Page Content -->

	</div>
	<!-- /# Wrapper -->

</body>

</html>

<script>
	$(document).ready(function() {

		/* Menu Toggle Script */
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});

		$("#search").on("keyup", function() {
			var search_text = $(this).val().toLowerCase();
			$("#table_body tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(search_text) > -1)
			});
		});

		$('#add').click(function(e) {
			$('#modal').modal({
				backdrop: 'static',
				keyboard: false
			});
		});

		$('#hwcomponent_type').change(function(e) {
			var hwcomponent_type = $('#hwcomponent_type').val();
			if (hwcomponent_type !== 'sub') {
				$('.sub_type').hide();
			} else {
				$('.sub_type').show();
			}
		});

		//Add Hardware Component Script
		$('#hardwareComponent-form').submit(function(e) {
			e.preventDefault();

			$.ajax({
				url: "../../config/processors/settingsArguments.php",
				type: "POST",
				data: $(this).serialize(),
			}).done(function(val) {
				alert(val);
				location.reload(true);
			});

		});

		//Edit Hardware Component Script
		$(".edit").click(function(e) {
			e.preventDefault();
			var action = 'editHardwareComponent';
			var hwcomponent_id = $(this).attr('id');

			$.ajax({
				url: "../../config/processors/settingsArguments.php",
				type: "post",
				data: {
					action: action,
					hwcomponent_id: hwcomponent_id
				},
				dataType: 'JSON',
			}).done(function(component) {
				$('.modal-title').text('HARDWARE COMPONENT UPDATING FORM');
				$('#hwcomponent_id').append('<input type="hidden" name="hwcomponent_id" id="hwcomponent_id" value=' + component.hwcomponent_id + '>');
				$('#hwcomponent_name').val(component.hwcomponent_name);
				$('#hwcomponent_type').val(component.hwcomponent_type);

				if (component.hwcomponent_type == 'sub') {
					$('.sub_type').show();
				} else {
					$('.sub_type').hide();
				}

				$('#hwcomponent_btn').text('Save Changes');
				$('#action').val('updateHardwareComponent');
			});

			$('#modal').modal({
				backdrop: 'static',
				keyboard: false
			});
		});

	});
</script>