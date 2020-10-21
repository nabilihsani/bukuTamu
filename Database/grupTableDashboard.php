<?php 
	require_once('db_login.php');
    $db = new mysqli($db_host, $db_username, $db_password, $db_database);
    if ($db->connect_errno) {
    	die ("Could not connect to the database: <br />"). $db->connect_errno;
    }

    $query = "SELECT b.*, a.grupName, a.Company, a.Lokasi FROM grupvisit AS b INNER JOIN grup AS a ON a.grupId = b.grupId WHERE DATE(Masuk) = CURDATE() OR Status = 'Active' OR Status = 'Booking'";
    $result = $db->query($query);

    while ($row = mysqli_fetch_array($result)) {
         if ($row['Status'] == 'Booking') {
            $dateIn1 = '-';
        } else {
        $dateIn = date_create($row['Masuk']);
        $dateIn1 = date_format($dateIn, 'Y-m-d H:i:s');
            
        }
    	if ($row['Keluar'] != '') {
    		$dateOut = date_create($row['Keluar']);
    		$dateOut1 = date_format($dateOut, 'Y-m-d H:i:s');
    	} else {
    		$dateOut1 = '-';
    	}
        if ($row['Code'] != '') {
            $code = $row['Code'];
        } else {
            $code = '-';
        }
        if ($row['visitPhone'] != '') {
            $telp = $row['visitPhone'];
        } else {
            $telp = '-';
        }
    	if ($row['Lokasi'] != '') {
            $loc = $row['Lokasi'];
        } else {
            $loc = '-';
        }
    	echo '<tr>';
    	echo '<td class="d-none">'.$row['visitId'].'</td>';
    	if ($row['Status'] == 'Booking') {
            echo '<td>'.$row['grupId'].' (Booking)</td>';
        } else {
            echo '<td>'.$row['grupId'].'</td>';
        }
    
        echo '<td>'.$code.'</td>';
    	echo '<td>'.$row['grupName'].'</td>';
        echo '<td>'.$telp.'</td>';
    	echo '<td>'.$row['Company'].'</td>';
        echo '<td>'.$loc.'</td>';  
    	echo '<td>'.$row['visitCount'].'</td>';
    	echo '<td>'.$row['Tujuan'].'</td>';
    	echo '<td>'.$row['Keperluan'].'</td>';
    	echo '<td>'.$dateIn1.'</td>';
    	echo '<td>'.$dateOut1.'</td>';
        if ($row['Status'] == 'Booking') {
            echo '<td><div class="dropdown show">
                    <a class="btn btn-success dropdown-toggle text-white" type="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" data-toggle="modal" data-target="#inModalG" href="#">Check In</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#DelModalG" href="#">Delete</a>
                    </div>
                </div>';
        } else {
            if ($row['Code'] != '') {
                echo '<td><div class="dropdown show">
                    <a class="btn btn-success dropdown-toggle text-white" type="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        
                        <a class="dropdown-item" data-toggle="modal" data-target="#OutModalG" href="#">Check Out</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#DelModalG" href="#">Delete</a>
                    </div>
                </div>';
            } else {
            echo '<td><div class="dropdown show">
                    <a class="btn btn-success dropdown-toggle text-white" type="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" data-toggle="modal" data-target="#codeModalG" href="#">Input Card</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#OutModalG" href="#">Check Out</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#DelModalG" href="#">Delete</a>
                    </div>
                </div>';

            }
        }
        echo '</tr>';
    }
    // function testInput($data) {
    //     $data = trim($data);
    //     $data = stripslashes($data);
    //     $data = htmlspecialchars($data);
    //     return $data;
    // }
    if (isset($_POST["submitCodeG"])) {
        $code2 = testInput($_POST['staticCodeInG']);
        $code1 = testInput($_POST['inputCodeG']); 
        
        $query2 = "SELECT * FROM kartu WHERE Code = '$code1'";
        $result2 = $db->query($query2);
        $numRow = $result2->num_rows;
        while ($row = mysqli_fetch_array($result2)) {
            $status = $row['status'];
        }
        if ($numRow == 1 && $status == 'Available') {
            $query = "UPDATE grupvisit SET Code = '$code1' WHERE visitId = '$code2'";
            $query1 = "UPDATE kartu SET id = (SELECT grupId FROM grupvisit WHERE visitId = '$code2'), status = 'Unavailable' WHERE Code = '$code1'";
            $result = $db->query($query);
            $result1 = $db->query($query1);
            echo "<script type='text/javascript'>
            $(document).ready(function() {
            $('#codeModal').modal('hide');
            });
            </script>";
            echo "<meta http-equiv='refresh' content='0'>";        
        } else {
            echo "<script type='text/javascript'>alert('Wrong Access Card, Please Enter The Correct Access Card!');</script>";
        }
    }
    if (isset($_POST["submitOutG"])) {
        $code2 = testInput($_POST['staticCodeG']);
        $code1 = testInput($_POST['staticCodeG1']);
        $query2 = "DELETE FROM grupvisit WHERE visitId = '$code2'";
        $result2 = $db->query($query2);
        $query = "DELETE FROM grup WHERE grupId = '$code1'";
        $result = $db->query($query);
            echo "<script type='text/javascript'>
            $(document).ready(function() {
            $('#DelModalS').modal('hide');
            });
            </script>";
            echo "<meta http-equiv='refresh' content='0'>";
    }

    if (isset($_POST["submitOutG"])) {
        $code2 = testInput($_POST['staticCodeOutG']);
        $query2 = "UPDATE grupvisit SET Keluar = CURRENT_TIMESTAMP(), Code = NULL, Status = 'Passive' WHERE visitId = '$code2'";
        $query1 = "UPDATE kartu SET id =  '-', status = 'Available' WHERE Code = (SELECT Code FROM grupvisit WHERE visitId = '$code2')";
        $result = $db->query($query1);
        $result2 = $db->query($query2);
            echo "<script type='text/javascript'>
            $(document).ready(function() {
            $('#OutModalS').modal('hide');
            });
            </script>";
            echo "<meta http-equiv='refresh' content='0'>";
    }

    if (isset($_POST["submitInG"])) {
        $code2 = testInput($_POST['staticCodeInG2']);
        $code1 = testInput($_POST['inputCodeInG']);
        $query3 = "SELECT * FROM kartu WHERE Code = '$code1'";
        $result3 = $db->query($query3);
        $numRow = $result3->num_rows;
        while ($row = mysqli_fetch_array($result3)) {
            $status = $row['status'];
        }
        if ($numRow == 1 && $status == 'Available') {
            $query = "UPDATE grupvisit SET Code = '$code1', Masuk = CURRENT_TIMESTAMP(), Status = 'Active' WHERE visitId = '$code2'";
            $query1 = "UPDATE kartu SET id =  (SELECT grupId FROM grupvisit WHERE visitId = '$code2'), status = 'Unavailable' WHERE Code = '$code1'";
            $result = $db->query($query);
            $result1 = $db->query($query1);
            echo "<script type='text/javascript'>
            $(document).ready(function() {
            $('#inModalG').modal('hide');
            });
            </script>";
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "<script type='text/javascript'>alert('Wrong Access Card, Please Enter The Correct Access Card!');</script>";
        }
    }

    $db->close();
 ?>