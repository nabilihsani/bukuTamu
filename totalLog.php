<!DOCTYPE html>
<?php 
	session_start();
	include("Database/function.php");
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    	if (isLoginSessionExpired()) {
    		header("Location:Database/logout.php?session_expired=1");
    	}
	} else {
		header("location: login.php");
    	exit;
	}		
 ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">  
  	<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="Buttons-1.6.1/css/buttons.dataTables.min.css">
	<title></title>
	<script src="vendor/jquery/jquery.slim.min.js"></script>
	<script src="Js/popper1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<script type="text/javascript" src="Js/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="Buttons-1.6.1/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="JSZip-2.5.0/jszip.min.js"></script>
	<script type="text/javascript" src="pdfmake-0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="pdfmake-0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="Buttons-1.6.1/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="Buttons-1.6.1/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="datatables.js"></script>
	<style type="text/css">
		.table td, .table th{
			padding: .5rem;
		}	
	</style>
</head>
<body>
	<nav class="navbar navbar-expand navbar-light" style="background-color: #44B600">
		
		<a class="navbar-brand" href="Dashboard.php">
			<img src="IMG/Schneider_logo.png" width="151.25" height="31.25" alt="">
		</a>
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="Dashboard.php" style="color: #fff">Dashboard</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="activeVisit.php" style="color: #fff">Active Visit</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="" style="color: #fff">Total Visit Log</a>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto ml-md-0">
			<span style="position: relative; top: 7px; left: 5px; color: #fff;"><?php echo htmlspecialchars($_SESSION["Nama"]); ?></span>
		  	<li class="nav-item dropdown" style="color: #fff;">
       			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff">
         			<i class="fas fa-user-circle fa-fw"></i>
			    </a>
       			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          			<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        		</div>
      		</li>
		</ul>
	</nav>
	<!-- Logout Modal-->
  	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
      		<div class="modal-content">
		        <div class="modal-header">
        		  	<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
        		</div>
        		<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        		<div class="modal-footer">
          			<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          			<a class="btn btn-primary" href="Database/logout.php">Logout</a>
        		</div>
      		</div>
    	</div>
  	</div>
	<div id="wrapper">
		<div id="content-wrapper" style="padding-top: 1rem;">
			<div class="container-fluid">
				<nav aria-label="breadcumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="#">Total Visit Log</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Table</li>
					</ol>	
				</nav>
				<div class="card mb-3">
					<div class="card-header">
						<i class="fas fa-table"></i>
						Single Visit
					</div>
					<div class="card-body">
						<div class="table-responsive" style="font-size: 12px;">
							<table class="table table-bordered table-hover" id="example">
								<thead style="text-align: center;">
									<tr>

										<th width="40">Visit Id</th>
										<th width="48">Guest Id</th>
										<th width="100">Visitor Name</th>
										<th width="10">Phone</th>
										<th width="10">Visitor Email</th>
										<th width="100">Company</th>
										<th width="10">Location</th>
										<th width="78">Person To Visit</th>
										<th width="91">Purpose Of Visit</th>
										<th width="81">Check In</th>
										<th width="78">Check Out</th>
									</tr>
								</thead>
								<tbody>
									<?php include 'Database/singleTotalLog.php'; ?>
								</tbody>
  							</table>
						</div>
					</div>
				</div>
				<div class="card mb-3">
					<div class="card-header">
						<i class="fas fa-table"></i>
						Group Visit
					</div>
					<div class="card-body">
						<div class="table-responsive" style="font-size: 12px;">
							<table class="table table-bordered table-hover" id="table1">
								<thead style="text-align: center;">
									<tr>
										<th width="40">Visit Id</th>
										<th width="51">Group Id</th>
										<th width="73">Group Name</th>
										<th width="10">Phone</th>
										<th width="125">Company</th>
										<th width="10">Location</th>
										<th width="75">Visitor Count</th>
										<th width="84">Person To Visit</th>
										<th width="92">Purpose Of Visit</th>
										<th width="88">Check In</th>
										<th width="88">Check Out</th>
									</tr>
								</thead>
								<tbody>
									<?php include 'Database/grupTotalLog.php'; ?>
								</tbody>
  							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
    	$(document).ready(function() {
    		$('#example').DataTable( {
        		dom: 'Bfrtip',
        		buttons: [
            		'excel', 'print'
        		]
    		} );
		} );
    </script>
    <script type="text/javascript">
    	$(document).ready(function() {
    		$('#table1').DataTable( {
        		dom: 'Bfrtip',
        		buttons: [
            		'excel', 'print'
        		]
    		} );
		} );
    </script>
    <!-- Core plugin JavaScript-->
  	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>


  	<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  	<!-- Custom scripts for all pages-->
  	<script src="js/sb-admin.min.js"></script>

  	<!-- Demo scripts for this page-->
  	<script src="js/demo/datatables-demo.js"></script>
</body>
</html>