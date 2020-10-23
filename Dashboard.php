<!DOCTYPE html>
<?php 
	session_start();
	include 'Database/function.php';
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
	<meta http-equiv="refresh" content="3600">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  	<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<title></title>
	<script src="vendor/fontawesome-free/js/all.js" crossorigin="anonymous"></script>
	<script src="vendor/jquery/jquery.slim.min.js"></script>
	<script src="Js/popper1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="Js/Chart.js"></script>
	<script type="text/javascript" src="Js/jquery.min.js"></script>
	<style type="text/css">
		.table td, .table th{
			padding: .5rem;
		}
	</style>
	
</head>
<body>
	<?php include 'Database/numRows.php'; ?>

	<nav class="navbar navbar-expand navbar-light" style="background-color: #44B600">		
		<a class="navbar-brand" href="Dashboard.php">
			<img src="IMG/Schneider_logo.png" width="151.25" height="31.25" alt="">
		</a>
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="" style="color: #fff">Dashboard <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="activeVisit.php" style="color: #fff">Active Visit</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="totalLog.php" style="color: #fff">Total Visit Log</a>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto ml-md-0">
			<span style="position: relative; top: 7px; left: 5px; color: #fff;"><?= htmlspecialchars($_SESSION["Nama"]) ?></span>
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
        		<div class="modal-body">
        			Select "Logout" below if you are ready to end your current session.
        		</div>
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
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="#">Dashboard</a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Overview</li>
				</ol>
				<div class="row">
					<div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-success o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon" style="display: block; top: -1rem; position: absolute; right: 0rem; font-size: 5rem; opacity: 0.4; transform: rotate(15deg);">
									<i class="fas fa-walking"></i>
								</div>
								<div class="mr-5"><?= $numRow+$numRow1 ?> Total Visitor Today</div>
							</div>
							<a class="card-footer text-white clearfix small z-1" href="#">
								<!-- <span class="float-left">View Details</span>
								<span class="float-right" style="color: black;">
								</span> -->
							</a>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-info o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon" style="display: block; top: -1rem; position: absolute; right: -1rem; font-size: 5rem; opacity: 0.4; transform: rotate(15deg);">
									<i class="fas fa-user fa-fw"></i>
								</div>
								<div class="mr-5"><? $numRow2+$numRow3 ?> Active Visit</div>
							</div>
							<a class="card-footer text-white clearfix small z-1" href="activeVisit.php"><!-- 
								<span class="float-left">View Details</span>
								<span class="float-right">
    								<i class="fas fa-angle-right"></i>
								</span> -->
							</a>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-primary o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon" style="display: block; top: -1rem; position: absolute; right: 0rem; font-size: 5rem; opacity: 0.4; transform: rotate(15deg);">
											<i class="fas fa-users fa-fw"></i>
								</div>
								<div class="mr-5"><?= $numRow4+$numRow5 ?> Check Out!</div>
							</div>
							<a class="card-footer text-white clearfix small z-1" href="#">
								<!-- <span class="float-left">View Details</span>
								<span class="float-right">
    								<i class="fas fa-angle-right"></i>
								</span> -->
							</a>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-secondary o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon" style="display: block; top: -1rem; position: absolute; right: 0.7rem; font-size: 5rem; opacity: 0.4; transform: rotate(15deg);">
									<i class="fa fa-book" aria-hidden="true"></i>
								</div>
								<div class="mr-5"><?= $numRow6+$numRow7 ?> New Booking Visit!</div>
							</div>
							<a class="card-footer text-white clearfix small z-1" href="#">
								<!-- <span class="float-left">View Details</span>
								<span class="float-right">
    								<i class="fas fa-angle-right"></i>
								</span> -->
							</a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="card mb-3 w-49">
							<div class="card-header">
								<i class="fas fa-table"></i>
								Access Card Table
							</div>
							<div class="card-body">
								<div class="table-responsive" style="font-size: 12px;">
									<table class="table table-sm table-bordered table-hover" id="dataTable1" width="560">
										<thead align="center">
											<tr>
												<th>Acces Card</th>
												<th>Guest/Group Id</th>
												<th>Status</th>
											</tr>
										</thead>
										<?php include 'Database/card.php'; ?>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="card mb-3 w-49">
							<div class="card-header">
            					<i class="fas fa-chart-area"></i>
            					Weekly Visit
            				</div>
          					<div class="card-body">
            					<canvas id="myChart" width="100%" height="31"></canvas>
         	 				</div>
						</div>
						<div class="card mb-3 w-49">
							<div class="card-header">
            					<i class="fas fa-chart-area"></i>
									Visitor by company
	            				</div>
          					<div class="card-body">
            					<canvas id="myChart1" width="100%" height="31"></canvas>
         	 				</div>
						</div>
					</div>
				</div>
				<div class="card mb-3">
					<div class="card-header">
						<i class="fas fa-table"></i>
						Single Visit
					</div>
					<div class="card-body">
						<div class="table-responsive" style="font-size: 12px;">
							<table class="table table-bordered table-hover" id="dataTable">
								<thead align="center">
									<tr>
										<th class="d-none">Visit Id</th>
										<th>Guest Id</th>
										<th>Access Card</th>
										<th>Visitor Name</th>
										<th>Visitor Email</th>
										<th>Phone</th>
										<th>Company</th>
										<th>Location</th>
										<th>Person To Visit</th>
										<th>Purpose Of Visit</th>
										<th>Check In</th>
										<th>Check Out</th>
										<th>Action</th>
									</tr>
								</thead>
								<?php include 'Database/singleTableDashboard.php'; ?>
							</table>
						</div>
					</div>
				</div>
				<div class="modal fade" id="codeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    				<div class="modal-dialog" role="document">
      					<div class="modal-content">
		        			<div class="modal-header">
        		  				<h5 class="modal-title" id="exampleModalLabel">Code</h5>
          						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
        					</div>
        					<form id="formCode" name="formCode" method="POST" autocomplete="off" action="Dashboard.php">
        						<div class="modal-body">
        							<div class="form-group text-center d-none">
                    					<label for="staticCodeIn">Code</label>
                      					<input type="text" readonly class="form-control" name="staticCodeIn" id="staticCodeIn" value=""></input>
                  					</div>
        							<div class="form-group text-center">
                  						<label for="inputCode">Please enter the Access Card</label>
                						<input type="text" class="form-control" id="inputCode" name="inputCode" placeholder="Code" style="text-align: center;" required>
                					</div>
        						</div>
        						<div class="modal-footer">
          							<button class="btn btn-success" type="submit" id="submitCode" name="submitCode">Submit</button>
        						</div>
        					</form>
     					</div>
    				</div>
  				</div>
  				<div class="modal fade" id="codeModalG" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    				<div class="modal-dialog" role="document">
      					<div class="modal-content">
		        			<div class="modal-header">
        		  				<h5 class="modal-title" id="exampleModalLabel">Code</h5>
          						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
        					</div>
        					<form id="formCodeG" name="formCodeG" method="POST" autocomplete="off" action="Dashboard.php">
        						<div class="modal-body">
        							<div class="form-group text-center d-none">
                    					<label for="staticCodeInG">Code</label>
                      					<input type="text" readonly class="form-control" name="staticCodeInG" id="staticCodeInG" value=""></input>
                  					</div>
        							<div class="form-group text-center">
                  						<label for="inputCode">Please enter the Access Card</label>
                						<input type="text" class="form-control" id="inputCodeG" name="inputCodeG" placeholder="Code" style="text-align: center;" required>
                					</div>
        						</div>
        						<div class="modal-footer">
          							<button class="btn btn-success" type="submit" id="submitCodeG" name="submitCodeG">Submit</button>
        						</div>
        					</form>
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
										<th class="d-none">Visit Id</th>
										<th>Group Id</th>
										<th>Access Card</th>
										<th>Group Name</th>
										<th>Phone</th>
										<th>Company</th>
										<th>Location</th>
										<th>Visitor Count</th>
										<th>Person To Visit</th>
										<th>Purpose Of Visit</th>
										<th>Check In</th>
										<th>Check Out</th>
										<th>Action</th>
									</tr>
								</thead>
								<?php include 'Database/grupTableDashboard.php'; ?>
  							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="inModalS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
			<div class="modal-content">
		        <div class="modal-header">
        		  	<h5 class="modal-title" id="exampleModalLabel">Check In</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
        		</div>
        		<form id="formCodeInS" name="formCodeInS" method="POST" autocomplete="off" action="Dashboard.php">
        			<div class="modal-body">
        				<div class="form-group text-center d-none">
                    		<label for="staticCodeInS">Code</label>
                      		<input type="text" readonly class="form-control" name="staticCodeInS" id="staticCodeInS" value=""></input>
                  		</div>
                  		<div class="form-group text-center">
                  			<label for="inputCode">Please enter the Access Card</label>
                			<input type="text" class="form-control" id="inputCodeIn" name="inputCodeIn" placeholder="Code" style="text-align: center;" required>
                		</div>
                  		Are you sure want to check In this person manually?
        			</div>
        			<div class="modal-footer">
          				<button class="btn btn-primary" type="submit" id="submitInS" name="submitInS">Yes</button>
          				<button class="btn btn-danger" type="submit" data-dismiss="modal">No</button>
        			</div>
        		</form>
     		</div>
    	</div>
  	</div>
  	<div class="modal fade" id="inModalG" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
			<div class="modal-content">
		        <div class="modal-header">
        		  	<h5 class="modal-title" id="exampleModalLabel">Check In</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
        		</div>
        		<form id="formCodeInG" name="formCodeInG" method="POST" autocomplete="off" action="Dashboard.php">
        			<div class="modal-body">
        				<div class="form-group text-center">
                    		<label for="staticCodeInG2">Code</label>
                      		<input type="text" readonly class="form-control" name="staticCodeInG2" id="staticCodeInG2" value=""></input>
                  		</div>
                  		<div class="form-group text-center">
                  			<label for="inputCode">Please enter the Access Card</label>
                			<input type="text" class="form-control" id="inputCodeInG" name="inputCodeInG" placeholder="Code" style="text-align: center;" required>
                		</div>
                  		Are you sure want to check In this Group manually?
        			</div>
        			<div class="modal-footer">
          				<button class="btn btn-primary" type="submit" id="submitInG" name="submitInG">Yes</button>
          				<button class="btn btn-danger" type="submit" data-dismiss="modal">No</button>
        			</div>
        		</form>
     		</div>
    	</div>
  	</div>
	<div class="modal fade" id="OutModalS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
			<div class="modal-content">
		        <div class="modal-header">
        		  	<h5 class="modal-title" id="exampleModalLabel">Check Out</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
        		</div>
        		<form id="formCodeOutS" name="formCodeOutS" method="POST" autocomplete="off" action="Dashboard.php">
        			<div class="modal-body">
        				<div class="form-group text-center d-none">
                    		<label for="staticCodeOutS">Code</label>
                      		<input type="text" readonly class="form-control" name="staticCodeOutS" id="staticCodeOutS" value=""></input>
                  		</div>
                  		Are you sure want to check out this person manually?
        			</div>
        			<div class="modal-footer">
          				<button class="btn btn-primary" type="submit" id="submitOutS" name="submitOutS">Yes</button>
          				<button class="btn btn-danger" type="submit" data-dismiss="modal">No</button>
        			</div>
        		</form>
     		</div>
    	</div>
  	</div>
  	<div class="modal fade" id="OutModalG" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
			<div class="modal-content">
		        <div class="modal-header">
        		  	<h5 class="modal-title" id="exampleModalLabel">Check Out</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
        		</div>
        		<form id="formCodeOutG" name="formCodeOutG" method="POST" autocomplete="off" action="Dashboard.php">
        			<div class="modal-body">
        				<div class="form-group text-center d-none">
                    		<label for="staticCodeOutG">Code</label>
                      		<input type="text" readonly class="form-control" name="staticCodeOutG" id="staticCodeOutG" value=""></input>
                  		</div>
                  		Are you sure want to check out this Group manually?
        			</div>
        			<div class="modal-footer">
          				<button class="btn btn-primary" type="submit" id="submitOutG" name="submitOutG">Yes</button>
          				<button class="btn btn-danger" type="submit" data-dismiss="modal">No</button>
        			</div>
        		</form>
     		</div>
    	</div>
  	</div>
	<div class="modal fade" id="DelModalS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
			<div class="modal-content">
		        <div class="modal-header">
        		  	<h5 class="modal-title" id="exampleModalLabel">Delete</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
        		</div>
        		<form id="formCodeDelS" name="formCodeDelS" method="POST" autocomplete="off" action="Dashboard.php">
        			<div class="modal-body">
        				<div class="form-group text-center d-none">
                    		<label for="staticCodeS">Code</label>
                      		<input type="text" readonly class="form-control" name="staticCodeS" id="staticCodeS" value=""></input>
                  		</div>
                  		<div class="form-group text-center d-none">
                    		<label for="staticCodeS1">Code</label>
                      		<input type="text" readonly class="form-control" name="staticCodeS1" id="staticCodeS1" value=""></input>
                  		</div>
                  		Are you sure want to delete this?
        			</div>
        			<div class="modal-footer">
          				<button class="btn btn-primary" type="submit" id="submitDelS" name="submitDelS">Yes</button>
          				<button class="btn btn-danger" type="submit" data-dismiss="modal">No</button>
        			</div>
        		</form>
     		</div>
    	</div>
  	</div>
  	<div class="modal fade" id="DelModalG" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
			<div class="modal-content">
		        <div class="modal-header">
        		  	<h5 class="modal-title" id="exampleModalLabel">Delete</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
        		</div>
        		<form id="formCodeDelG" name="formCodeDelG" method="POST" autocomplete="off" action="Dashboard.php">
        			<div class="modal-body">
        				<div class="form-group text-center d-none">
                    		<label for="staticCodeG">Code</label>
                      		<input type="text" readonly class="form-control" name="staticCodeG" id="staticCodeG" value=""></input>
                  		</div>
                  		<div class="form-group text-center d-none">
                    		<label for="staticCodeG1">Code</label>
                      		<input type="text" readonly class="form-control" name="staticCodeG1" id="staticCodeG1" value=""></input>
                  		</div>
                  		Are you sure want to delete this?
        			</div>
        			<div class="modal-footer">
          				<button class="btn btn-primary" type="submit" id="submitOutG" name="submitOutG">Yes</button>
          				<button class="btn btn-danger" type="submit" data-dismiss="modal">No</button>
        			</div>
        		</form>
     		</div>
    	</div>
  	</div>
	<?php 
		include 'Database/db_login.php';
		$result = $db->query("SELECT COUNT(a.idTamu), b.Company FROM kunjungan as a INNER JOIN tamu as b ON a.idTamu = b.idTamu GROUP BY Company");
		$numRow = $result->num_rows;
		while ($row1 = mysqli_fetch_row($result)) {
				$row[] = $row1[1];	
				$rows[]	= $row1[0];	
		}
		$result1 = $db->query("SELECT COUNT(a.grupId), b.Company FROM grupvisit as a INNER JOIN grup as b ON a.grupId = b.grupId GROUP BY Company");
		$numRow1 = $result1->num_rows;
		while ($row2 = mysqli_fetch_row($result1)) {
				$row1[] = $row2[1];	
				$rows1[]	= $row2[0];	
		}
	 ?>

	<script type="text/javascript">
		var companyS = <?= json_encode($row) ?>;
		var companyG = <?= json_encode($row1) ?>;
		var val = <?= $numRow ?>;
		var val1 = <?= $numRow1 ?>;
		function random_rgba() {
    		var o = Math.round, r = Math.random, s = 255;
    		return 'rgb(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ')';
		}
		var a = [];
		var b = [];
		var countS = <?= json_encode($rows) ?>;
		var countG = <?= json_encode($rows1) ?>;
		var j = 0;
		for (var i = 0; i < val; i++) {
			a.push(companyS[i]);
			b.push(countS[i]);
		}
		for (var i = 0; i < val1; i++) {
			if (a.indexOf(companyG[i]) == -1) {
				a.push(companyG[i]);
				b.push(countG[i]);
			} else {
				var x = parseInt(b[a.indexOf(companyG[i])]);
				var y = parseInt(countG[i]);
				var z = x+y;
				b[a.indexOf(companyG[i])] = z;
				j += 1;
			}
		}
		function getRandomColor(count) {
    		var data =[];
    		for (var i = 0; i < count; i++) {
        		data.push(random_rgba());
    		}
    		return data;
		}
		var ctx_live = document.getElementById("myChart1");
		var myChart1 = new Chart(ctx_live, {
  			type: 'pie',
  			data: {
    			labels: [],
    			datasets: [{
      				data: [],
      				backgroundColor: getRandomColor(val),
      				label: '',
      				borderAlign: 'inner'
    			}]
  			},
  			options: {
  				legend: {
  					display: true,
  					position: 'right',
  					align: 'end',
  					labels: {
  						fontColor: 'black'
  					}
  				}, 
  				title: {
  					display: true,
  					text: 'Visitor by company'
  				}
  			}
		});
		var getData = function() {
  			$.ajax({
    			success: function(data) {
      				for (var i = 0; i < val+val1-j; i++) {
      					myChart1.data.labels.push(a[i]);
      					myChart1.data.datasets[0].data.push(b[i]);
    					myChart1.update();
      				}  
    			}
  			});
		};

		window.onload = getData;
	</script>
	<script type="text/javascript">
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Monday","Tuesday","Wednesday","Thursday","Friday"],
				datasets: [{
					label: '',
					data: [
					<?php 
					$result = $db->query("SELECT * FROM `kunjungan` WHERE WEEKDAY(MASUK) = 0 AND YEARWEEK(Masuk) = YEARWEEK(NOW())");
					$numRow = $result->num_rows;
					$result1 = $db->query("SELECT * FROM `grupvisit` WHERE WEEKDAY(MASUK) = 0 AND YEARWEEK(Masuk) = YEARWEEK(NOW())");
					$numRow1 = $result1->num_rows;
		    			 ?>
					<?= $numRow+$numRow1 ?>,
					<?php 
					$result = $db->query("SELECT * FROM `kunjungan` WHERE WEEKDAY(MASUK) = 1 AND YEARWEEK(Masuk) = YEARWEEK(NOW())");
					$numRow = $result->num_rows;
					$result1 = $db->query("SELECT * FROM `grupvisit` WHERE WEEKDAY(MASUK) = 1 AND YEARWEEK(Masuk) = YEARWEEK(NOW())");
					$numRow1 = $result1->num_rows;
					 ?>
					<?= $numRow+$numRow1 ?>,
					<?php 
					$result = $db->query("SELECT * FROM `kunjungan` WHERE WEEKDAY(MASUK) = 2 AND YEARWEEK(Masuk) = YEARWEEK(NOW())");
					$numRow = $result->num_rows;
					$result1 = $db->query("SELECT * FROM `grupvisit` WHERE WEEKDAY(MASUK) = 2 AND YEARWEEK(Masuk) = YEARWEEK(NOW())");
					$numRow1 = $result1->num_rows;
					 ?>
					<?= $numRow+$numRow1 ?>,
					<?php 
					$result = $db->query("SELECT * FROM `kunjungan` WHERE WEEKDAY(MASUK) = 3 AND YEARWEEK(Masuk) = YEARWEEK(NOW())");
					$numRow = $result->num_rows;
					$result1 = $db->query("SELECT * FROM `grupvisit` WHERE WEEKDAY(MASUK) = 3 AND YEARWEEK(Masuk) = YEARWEEK(NOW())");
					$numRow1 = $result1->num_rows;
					 ?>
					<?= $numRow+$numRow1 ?>,
					<?php 
					$result = $db->query("SELECT * FROM `kunjungan` WHERE WEEKDAY(MASUK) = 4 AND YEARWEEK(Masuk) = YEARWEEK(NOW())");
					$numRow = $result->num_rows;
					$result1 = $db->query("SELECT * FROM `grupvisit` WHERE WEEKDAY(MASUK) = 4 AND YEARWEEK(Masuk) = YEARWEEK(NOW())");
					$numRow1 = $result1->num_rows;
					 ?>
					<?= $numRow+$numRow1 ?>
					],
					fill: false,
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)'					
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Total visit per day this week'
				},
				tooltips: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
	<script type="text/javascript">
   		$(function() {
    		$("#table1").dataTable({
        		"iDisplayLength": 10,
        		"aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]]
       		});
   		});
   		$(function() {
    		$("#dataTable1").dataTable({
        		"iDisplayLength": 14,
        		"aLengthMenu": [[14, 25, 50, 100], [14, 25, 50, 100]]
       		});
   		});
  	</script>
  	<script type="text/javascript">
  		var table = document.getElementById("dataTable");
  		var table1 = document.getElementById("table1");

  		for (var i = 1; i < table.rows.length; i++) {
  			table.rows[i].onclick = function(){
  				document.getElementById("staticCodeIn").value = this.cells[0].innerHTML;
  				document.getElementById("staticCodeS").value = this.cells[0].innerHTML;
  				document.getElementById("staticCodeS1").value = this.cells[1].innerHTML;
  				document.getElementById("staticCodeOutS").value = this.cells[0].innerHTML;
  				document.getElementById("staticCodeInS").value = this.cells[0].innerHTML;
  			};
  		}
  		
  		for (var i = 1; i < table1.rows.length; i++) {
  			table1.rows[i].onclick = function(){
  				document.getElementById("staticCodeInG").value = this.cells[0].innerHTML;
  				document.getElementById("staticCodeG").value = this.cells[0].innerHTML;
  				document.getElementById("staticCodeG1").value = this.cells[1].innerHTML;
  				document.getElementById("staticCodeOutG").value = this.cells[0].innerHTML;
  				document.getElementById("staticCodeInG2").value = this.cells[0].innerHTML;
  			};
  		}
  	</script>
  	
  	<!-- Core plugin JavaScript-->
  	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  	<!-- Page level plugin JavaScript-->
  	<script src="vendor/datatables/jquery.dataTables.js"></script>
  	<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  	<!-- Custom scripts for all pages-->
  	<script src="js/sb-admin.min.js"></script>

  	<!-- Demo scripts for this page-->
  	<script src="js/demo/datatables-demo.js"></script>	

</body>
</html>
