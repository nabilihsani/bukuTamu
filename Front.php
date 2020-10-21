<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="CSS/select2.min.css">
	<link rel="stylesheet" type="text/css" href="CSS/Front.css?ver=<?php echo rand(111,999)?>">
  <link rel="stylesheet" href="build/css/intlTelInput.css">
	<title></title>
	<script src="vendor/jquery/jquery.slim.min.js"></script>
	<script src="Js/popper.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>  
</head>
<body>
  <?php include 'Database/chek.php'; ?>
	<div class="bg"></div>
	<div class="cover-container p-3 d-flex w-100 h-100 mx-auto flex-column">
		<header class="text-center">
			<img src="IMG/Schneider_logo.png" width="302.5" height="62.5">
		</header>
		<div class="text-center">
			<h1 class="welcome">Welcome to Schneider Electric Ventura!</h1>
			<button type="button" class="btn btn-lg btn-success" data-toggle="modal" data-target="#modal1">Start!</button>
		</div>
		<footer class="mastfoot mt-auto">
			<div class="text-center">
				<p>Pt. Schneider Electric</p>
			</div>
		</footer>
	</div>
	<!-- Modal Awal -->
	<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1CenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-sm-5" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
				<!-- 	<h5 class="modal-title" id="modal1CenterTitle">Modal Title</h5> -->
					<nav class="nav nav-pills nav-fill w-100" id="pills-tab" role="tablist">
						<a class="nav-item nav-link active" id="pills-in-tab" data-toggle="pill" href="#pills-in" role="tab" aria-controls="pills-in" aria-selected="true">Check In</a>
						<a class="nav-item nav-link" id="pills-out-tab" data-toggle="pill" href="#pills-out" role="tab" aria-controls="pills-out" aria-selected="false">Check Out</a>
					</nav>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="tab-content" id="pills-tabcontent">
          <div class="tab-pane fade show active" id="pills-in" role="tabpanel" aria-labelledby="pills-in-tab">  
      			<form id="formVerifyIn" name="formVerifyIn" method="POST" autocomplete="off" action="Front.php">
            	<div class="modal-body">
				        <div class="form-group text-center">
                  <label for="inputIdIn">Please enter your Guest/Group ID</label>
                	<input type="text" class="form-control" id="inputIdIn" name="inputIdIn" placeholder="Guest/Group ID" list="idIn" style="text-align: center;" required>
                    <datalist id="idIn">
                      <?php  
                        while ($row = mysqli_fetch_array($re1)) {
                          echo "<option value='".$row['idTamu']."'>".$row['Nama']."</option>";
                        }
                        while ($row = mysqli_fetch_array($re1G)) {
                          echo "<option value='".$row['grupId']."'>".$row['grupName']."</option>";
                        }
                      ?>  
                    </datalist> 
                  </input>
                </div>
            	</div>
            	<div class="modal-footer">
              	<button id="verifyIn" name="verifyIn" type="submit" class="btn btn-primary">Verify</button>
        				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal2" data-dismiss="modal" onclick="">Create New Visit</button>
      				</div>
            </form>
          </div>
    			<div class="tab-pane fade" id="pills-out" role="tabpanel" aria-labelledby="pills-out-tab">  
            <form id="formOut" name="formOut" method="POST" autocomplete="off">
            	<div class="modal-body">
                <div class="form-group text-center">
                  <label for="inputIdOut">Please enter your Guest/Group ID</label>
                	<input type="text" class="form-control" id="inputIdOut" name="inputIdOut" placeholder="Guest/Group ID" list="idOut" style="text-align: center;" required>
                    <datalist id="idOut">
                      <?php 
                        while ($row = mysqli_fetch_array($re)) {
                          echo "<option value='".$row['idTamu']."'>".$row['Nama']."</option>";
                        }
                        while ($row = mysqli_fetch_array($reG)) {
                          echo "<option value='".$row['grupId']."'>".$row['grupName']."</option>";
                        }
                      ?>
                    </datalist> 
                  </input>
            		</div>
      				</div>
      				<div class="modal-footer">
                <button id="submitOut" name="submitOut" type="submit" class="btn btn-danger">Check Out</button>
          		</div>
          	</form>
      		</div>
    		</div>
			</div>
		</div>
	</div>
  <!-- Modal Awal End -->
  <!-- Notifikasi Check Out -->
	<div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="modal4CenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="checkOutLabel">Check Out</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
        <form id="formOutY" name="formOutY" method="POST" autocomplete="off" action="Front.php">
          <div class="modal-body">
            <div class="form-group text-center d-none">
              <label for="inputIdOutY">Please enter your Visit Id</label>
              <input type="text" class="form-control" id="inputIdOutY" name="inputIdOutY" placeholder="Visit Id" style="text-align: center;" required value="<?php echo $idOut; ?>"></input>
            </div>
            <?php echo $name; ?>, Are you sure want to Check Out?.
          </div>
          <div class="modal-footer">
            <button id="submitOutY" name="submitOutY" type="submit" class="btn btn-primary">Yes</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
          </div>  
        </form>
			</div>
		</div>
	</div>
  <!-- Notifikasi Check Out End -->
  <!-- Notifikasi Invalid Check Out -->
  <div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="modal6CenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="invalidCheckOutLabel">Check Out</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Please enter the correct Guest ID or Group ID.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Done</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Notifikasi Invalid Check Out End -->
  <!-- Modal Verify Single -->
  <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modal3CenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <nav class="nav nav-pills nav-fill w-100" id="pills-tabIn" role="tablist">
            <a class="nav-item nav-link active" id="pills-in-tab" data-toggle="pill" href="#pills-in" role="tab" aria-controls="pills-in" aria-selected="true">Check In</a>
          </nav>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="tab-content" id="pills-tabcontent">
          <div class="tab-pane fade show active" id="pills-in" role="tabpanel" aria-labelledby="pills-in-tab">
            <form id="formIn" name="formIn" method="POST" autocomplete="off" action="Front.php" onsubmit="">
              <div class="modal-body">
                  <div class="form-group row">
                    <label for="staticCodeIn" class="col-sm-2 col-form-label">Guest ID</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control-plaintext" name="staticCodeIn" id="staticCodeIn" value="<?php echo $code; ?>"></input>
                    </div>
                  </div>             
                <div class="form-group row">
                  <label for="inputNamaIn" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputNamaIn" id="inputNamaIn" placeholder="Visitor name" value="<?php echo $name; ?>" required></input>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPhoneInS" class="col-sm-2 col-form-label" style="font-size: 15px">Phone Number</label>
                  <div class="col-sm-10">
                    <input type="tel" class="form-control" placeholder="Visitor phone number" id="inputPhoneInS" name="inputPhoneInS" value="<?php echo $phone; ?>"></input>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmailIn" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmailIn" name="inputEmailIn" placeholder="Visitor email address" value="<?php echo $email; ?>" required></input>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputCompanyIn" class="col-sm-2 col-form-label">Company</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputCompanyIn" name="inputCompanyIn" placeholder="Name of your company" value="<?php echo $company ?>" required></input>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputLocInS" class="col-sm-2 col-form-label">Location</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="inputLocInS" name="inputLocInS">
                      <option value="" <?php if (!isset($loc)) echo 'selected="true"';?>>--Please Choose One--</option>
                      <option value="Batam" <?php if (isset($loc) && $loc=="Batam") echo 'selected="true"';?>>Batam</option>
                      <option value="Cikarang" <?php if (isset($loc) && $loc=="Cikarang") echo 'selected="true"';?>>Cikarang</option>
                      <option value="Pel" <?php if (isset($loc) && $loc=="Pel") echo 'selected="true"';?>>Pel</option>
                      <option value="Pem" <?php if (isset($loc) && $loc=="Pem") echo 'selected="true"';?>>Pem</option>
                      <option value="Sensor" <?php if (isset($loc) && $loc=="Sensor") echo 'selected="true"';?>>Sensor</option>
                      <option value="Surabaya" <?php if (isset($loc) && $loc=="Surabaya") echo 'selected="true"';?>>Surabaya</option>
                      <option value="Trafo" <?php if (isset($loc) && $loc=="Trafo") echo 'selected="true"';?>>Trafo</option>
                      <option value="Ventura" <?php if (isset($loc) && $loc=="Ventura") echo 'selected="true"';?>>Ventura</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputTujuanIn" class="col-sm-2 col-form-label">Tujuan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTujuanIn" name="inputTujuanIn" placeholder="person you want to visit" value="<?php echo $tujuan ?>" required></input>
                  </div>  
                </div>
                <div class="form-group row">
                  <label for="KeperluanIn" class="col-sm-2 col-form-label">Keperluan</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="KeperluanIn" name="KeperluanIn" placeholder="Purpose of your visit" required><?php echo $keperluan ?></textarea>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button id="submitIn" type="submit" name="submitIn" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Verify Single End -->
  <!-- Modal Verify Group -->
  <div class="modal fade" id="modal7" tabindex="-1" role="dialog" aria-labelledby="modal7CenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <nav class="nav nav-pills nav-fill w-100" id="pills-tabIn" role="tablist">
            <a class="nav-item nav-link active" id="pills-in-tab" data-toggle="pill" href="#pills-in" role="tab" aria-controls="pills-in" aria-selected="true">Check In</a>
          </nav>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="tab-content" id="pills-tabcontent">
          <div class="tab-pane fade show active" id="pills-in" role="tabpanel" aria-labelledby="pills-in-tab">
            <form id="formInG" name="formInG" method="POST" autocomplete="off" action="Front.php" onsubmit="">
              <div class="modal-body">
                  <div class="form-group row">
                    <label for="staticCodeInG" class="col-sm-2 col-form-label">Group ID</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control-plaintext" name="staticCodeInG" id="staticCodeInG" value="<?php echo $code; ?>"></input>
                    </div>
                  </div>
                <div class="form-group row">
                  <label for="inputNamaInG" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputNamaInG" id="inputNamaInG" placeholder="Visitor name" value="<?php echo $vname; ?>" required></input>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPhoneInG" class="col-sm-2 col-form-label" style="font-size: 15px">Phone Number</label>
                  <div class="col-sm-10">
                    <input type="tel" class="form-control" id="inputPhoneInG" value="<?php echo $phone; ?>" name="inputPhoneInG"></input>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmailInG" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmailInG" name="inputEmailInG" placeholder="Visitor email address" value="<?php echo $email; ?>" required></input>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputGroupG" class="col-sm-2 col-form-label">Group</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="inputGroupG" id="inputGroupG" placeholder="Name of your group" value="<?php echo $name; ?>" required></input>
                  </div>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" name="inputGroupPersonG" id="inputGroupPersonG" placeholder="Visitor Count" value="<?php echo $count; ?>" required></input>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputCompanyInG" class="col-sm-2 col-form-label">Company</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputCompanyInG" name="inputCompanyInG" placeholder="Name of your company" value="<?php echo $company ?>" required></input>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputLocInG" class="col-sm-2 col-form-label">Location</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="inputLocInG" name="inputLocInG">
                      <option value="" <?php if (!isset($loc)) echo 'selected="true"';?>>--Please Choose One--</option>
                      <option value="Batam" <?php if (isset($loc) && $loc=="Batam") echo 'selected="true"';?>>Batam</option>
                      <option value="Cikarang" <?php if (isset($loc) && $loc=="Cikarang") echo 'selected="true"';?>>Cikarang</option>
                      <option value="Pel" <?php if (isset($loc) && $loc=="Pel") echo 'selected="true"';?>>Pel</option>
                      <option value="Pem" <?php if (isset($loc) && $loc=="Pem") echo 'selected="true"';?>>Pem</option>
                      <option value="Sensor" <?php if (isset($loc) && $loc=="Sensor") echo 'selected="true"';?>>Sensor</option>
                      <option value="Surabaya" <?php if (isset($loc) && $loc=="Surabaya") echo 'selected="true"';?>>Surabaya</option>
                      <option value="Trafo" <?php if (isset($loc) && $loc=="Trafo") echo 'selected="true"';?>>Trafo</option>
                      <option value="Ventura" <?php if (isset($loc) && $loc=="Ventura") echo 'selected="true"';?>>Ventura</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputTujuanInG" class="col-sm-2 col-form-label">Tujuan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTujuanInG" name="inputTujuanInG" placeholder="Person you want to visit" value="<?php echo $tujuan; ?>" required></input>
                  </div>  
                </div>
                <div class="form-group row">
                  <label for="KeperluanInG" class="col-sm-2 col-form-label">Keperluan</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="KeperluanInG" name="KeperluanInG" placeholder="Purpose of your visit" required><?php echo $keperluan; ?></textarea>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button id="submitInG" type="submit" name="submitInG" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Verify Group End -->
  <!-- Modal Check In -->
	<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2CenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
        <div class="modal-header text-center">
          <nav class="nav nav-pills nav-fill w-100" id="pills-tab" role="tablist">
            <a class="nav-item nav-link active" id="pills-single-tab" data-toggle="pill" href="#pills-single" role="tab" aria-controls="pills-single" aria-selected="true">Single</a>
      			<a class="nav-item nav-link" id="pills-group-tab" data-toggle="pill" href="#pills-group" role="tab" aria-controls="pills-group" aria-selected="false">Group</a>
    			</nav>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
      		</button>
        </div>
        <!-- Tab Single -->
		    <div class="tab-content" id="pills-tabcontent">
        	<div class="tab-pane fade show active" id="pills-single" role="tabpanel" aria-labelledby="pills-single-tab">
	       		<form id="formSingle" name="formSingle" method="POST" autocomplete="off" action="Front.php" onsubmit="">
            	<div class="modal-body">
        	        <div class="form-group row">
            	      <label for="staticCodeS" class="col-sm-2 col-form-label">Guest ID</label>
                	  <div class="col-sm-1">
                    	<input type="text" readonly class="form-control-plaintext mx-sm-1" name="staticCodeS" id="staticCodeS" aria-describedby="reminder" value="<?php echo $Code; ?>"></input>
                    </div>
                    <small id="reminder" class="text-muted col-form-label" style="position: absolute; left: 200px; top: 20px;">
                      <h1 style="font-size: 12px; top: 50px; color: #F4170C">*Please remember your Guest ID</h1>
                    </small>
          				</div>
    	          <div class="form-group row">
        	        <label for="inputNamaS" class="col-sm-2 col-form-label" style="font-size: 15px">Name*</label>
            	    <div class="col-sm-10">
              			<input type="text" class="form-control" name="inputNamaS" id="inputNamaS" placeholder="Visitor name" required></input>
          				</div>
              	</div>
                <div class="form-group row">
                  <label for="inputPhoneS" class="col-sm-2 col-form-label" style="font-size: 15px">Phone Number</label>
                  <div class="col-sm-10">
                    <input type="tel" class="form-control" id="inputPhoneS" name="inputPhoneS"></input>
                  </div>
                </div>
                <div class="form-group row">
        					<label for="inputEmailS" class="col-sm-2 col-form-label">Email*</label>
                	<div class="col-sm-10">
          					<input type="email" class="form-control" id="inputEmailS" name="inputEmailS" placeholder="Visitor email address" required></input>
                  </div>
          			</div>
          			<div class="form-group row">
        					<label for="inputCompanyS" class="col-sm-2 col-form-label">Company*</label>
                  <div class="col-sm-10">
                   	<input type="text" class="form-control" id="inputCompanyS" name="inputCompanyS" placeholder="Name of your company" required></input>
                  </div>
          			</div>
                <div class="form-group row">
                  <label for="inputLocS" class="col-sm-2 col-form-label">Location</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="inputLocS" name="inputLocS">
                      <option value="">--Please Choose One--</option>
                      <option value="Batam">Batam</option>
                      <option value="Cikarang">Cikarang</option>
                      <option value="Pel">Pel</option>
                      <option value="Pem">Pem</option>
                      <option value="Sensor">Sensor</option>
                      <option value="Surabaya">Surabaya</option>
                      <option value="Trafo">Trafo</option>
                      <option value="Ventura">Ventura</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputTujuanS" class="col-sm-2 col-form-label">Person to visit*</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTujuanS" name="inputTujuanS" placeholder="Person you want to visit" required></input>
						    	</div>  
                </div>
                <div class="form-group row">
                  <label for="KeperluanS" class="col-sm-2 col-form-label">Purpose of visit*</label>
                  <div class="col-sm-10">
            				<textarea class="form-control" id="KeperluanS" name="KeperluanS" placeholder="Purpose of your visit" required></textarea>
        					</div>
                </div>
          		</div>
            	<div class="modal-footer">
      					<button id="submitS" type="submit" name="submitS" class="btn btn-primary" onclick="">Submit</button>
            	</div>
      			</form>
          </div>
          <!-- Tab Single End -->
          <!-- Group Tab -->
    			<div class="tab-pane fade" id="pills-group" role="tabpanel" aria-labelledby="pills-group-tab">
            <form id="formGroup" name="formGroup" method="POST" autocomplete="off" action="Front.php" onsubmit="">
            	<div class="modal-body">
                  <div class="form-group row">
	           				<label for="staticCodeG" class="col-sm-2 col-form-label">Group ID</label>
             				<div class="col-sm-1">
        	            <input type="text" readonly class="form-control-plaintext" name="staticCodeG" id="staticCodeG" value="<?php echo $Code; ?>"></input>
            	      </div>
                    <small id="reminder" class="text-muted col-form-label" style="position: absolute; left: 200px; top: 20px;">
                      <h1 style="font-size: 12px; top: 50px; color: #F4170C">*Please remember your Guest ID</h1>
                    </small>
          				</div>
                <div class="form-group row">
        					<label for="inputNamaG" class="col-sm-2 col-form-label">Name*</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="inputNamaG" id="inputNamaG" placeholder="Visitor name" required></input>
	                </div>
    	          </div>
                <div class="form-group row">
                  <label for="inputPhoneG" class="col-sm-2 col-form-label" style="font-size: 15px">Phone Number</label>
                  <div class="col-sm-10">
                    <input type="tel" class="form-control" id="inputPhoneG" name="inputPhoneG"></input>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmailG" class="col-sm-2 col-form-label">Email*</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="inputEmailG" id="inputEmailG" placeholder="Visitor email address" required></input>
                  </div>
	              </div>
        	      <div class="form-group row">
            	    <label for="inputGroup" class="col-sm-2 col-form-label">Group*</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="inputGroup" id="inputGroup" placeholder="Name of your group" required></input>
                  </div>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" name="inputGroupPerson" id="inputGroupPerson" placeholder="Visitor Count" required></input>
                  </div>
                </div>
                <div class="form-group row">
	                <label for="inputCompanyG" class="col-sm-2 col-form-label">Company*</label>
    	            <div class="col-sm-10">
        	          <input type="text" class="form-control" name="inputCompanyG" id="inputCompanyG" placeholder="Name of your company" required></input>
            	    </div>
                </div>
                <div class="form-group row">
                  <label for="inputLocG" class="col-sm-2 col-form-label">Location</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="inputLocG" name="inputLocG">
                      <option value="">--Please Choose One--</option>
                      <option value="Batam">Batam</option>
                      <option value="Cikarang">Cikarang</option>
                      <option value="Pel">Pel</option>
                      <option value="Pem">Pem</option>
                      <option value="Sensor">Sensor</option>
                      <option value="Surabaya">Surabaya</option>
                      <option value="Trafo">Trafo</option>
                      <option value="Ventura">Ventura</option>
                    </select>
                  </div>
                </div>
    	          <div class="form-group row">
        	        <label for="inputTujuanG" class="col-sm-2 col-form-label">Person to visit*</label>
            	    <div class="col-sm-10">
                	  <input type="text" class="form-control" id="inputTujuanG" name="inputTujuanG" placeholder="Person you want to visit" required></input>
                  </div>  
                </div>
                <div class="form-group row">
                  <label for="KeperluanG" class="col-sm-2 col-form-label">Purpose of visit*</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="KeperluanG" name="KeperluanG" placeholder="Purpose of your visit" required></textarea>
                  </div>
                </div>
            	</div>
            	<div class="modal-footer">
              	<button id="submitG" name="submitG" type="submit" class="btn btn-primary">Submit</button>
            	</div>
            </form>
	        </div>
          <!-- Group Tab End -->
        </div>
    	</div>
    </div>
  </div>
  <!-- Modal Check In End -->
  <!-- Notif In -->
  <div class="modal fade" id="modal5" tabindex="-1" role="dialog" aria-labelledby="modal4CenterTitle" aria-hidden="true">
	  <div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="checkOutLabel">Check In</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
          You have checked in to Schneider Electric Indonesia, please exchange your ID card with the access card.
				</div>
				<div class="modal-footer">
          <a type="button" href="" class="btn btn-success" href="Front.php">Done!</a>
				</div>
			</div>
		</div>
	</div>
  <!-- Notif In End -->

  <script src="build/js/intlTelInput.js"></script>
  <script type="text/javascript">
    var input = document.querySelector("#inputPhoneS");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "build/js/utils.js",
    });
  </script>
  <script type="text/javascript">
    var input = document.querySelector("#inputPhoneG");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "build/js/utils.js",
    });
  </script>
  <script type="text/javascript">
    var input = document.querySelector("#inputPhoneInS");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "build/js/utils.js",
    });
  </script>
  <script type="text/javascript">
    var input = document.querySelector("#inputPhoneInG");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "build/js/utils.js",
    });
  </script>
</body>
</html>