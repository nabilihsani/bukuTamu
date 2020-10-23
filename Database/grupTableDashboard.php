<?php 
    include 'db_login.php';

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
 ?>
    <?= 
        '<tr>
        <td class="d-none">'.$row['visitId'].'</td>'
     ?>
    <?php if ($row['Status'] == 'Booking') { ?>
            <?= '<td>'.$row['grupId'].' (Booking)</td>' ?>
        <?php } else { ?>
            <?= '<td>'.$row['grupId'].'</td>' ?>
        <?php } ?>
    <?=
        '<td>'.$code.'</td>
    	<td>'.$row['grupName'].'</td>
        <td>'.$telp.'</td>
    	<td>'.$row['Company'].'</td>
        <td>'.$loc.'</td>
    	<td>'.$row['visitCount'].'</td>
    	<td>'.$row['Tujuan'].'</td>
    	<td>'.$row['Keperluan'].'</td>
    	<td>'.$dateIn1.'</td>
    	<td>'.$dateOut1.'</td>'
     ?>
     <?php if ($row['Status'] == 'Booking') { ?>
        <?=
            '<td><div class="dropdown show">
                    <a class="btn btn-success dropdown-toggle text-white" type="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" data-toggle="modal" data-target="#inModalG" href="#">Check In</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#DelModalG" href="#">Delete</a>
                    </div>
                </div>'
         ?>
        <?php 
        } else {
            if ($row['Code'] != '') {
         ?> 
            <?=
                '<td><div class="dropdown show">
                    <a class="btn btn-success dropdown-toggle text-white" type="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        
                        <a class="dropdown-item" data-toggle="modal" data-target="#OutModalG" href="#">Check Out</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#DelModalG" href="#">Delete</a>
                    </div>
                </div>'
            ?>
            <?php 
                } else {
             ?>
                <?=
                    '<td><div class="dropdown show">
                        <a class="btn btn-success dropdown-toggle text-white" type="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" data-toggle="modal" data-target="#codeModalG" href="#">Input Card</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#OutModalG" href="#">Check Out</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#DelModalG" href="#">Delete</a>
                        </div>
                    </div>'
                 ?>
            <?php 
                }
            }
             ?>
            
        <?= '</tr>' ?>
<?php 
    }
    $a = filter_input(INPUT_POST, 'submitCodeG');
    if (isset($a)) {
        $code2 = filter_input(INPUT_POST, 'staticCodeInG');
        $code1 = filter_input(INPUT_POST, 'inputCodeG');
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
?>
        <?=
             "<script type='text/javascript'>
            $(document).ready(function() {
            $('#codeModal').modal('hide');
            });
            </script>
            <meta http-equiv='refresh' content='0'>"
         ?>
        <?php } else { ?>
            <?= "<script type='text/javascript'>alert('Wrong Access Card, Please Enter The Correct Access Card!');</script>" ?>
<?php        
        }
    }
    $a = filter_input(INPUT_POST, 'submitOutG');
    if (isset($a)) {
        $code2 = filter_input(INPUT_POST, 'staticCodeG');
        $code1 = filter_input(INPUT_POST, 'staticCodeG1');
        $query2 = "DELETE FROM grupvisit WHERE visitId = '$code2'";
        $result2 = $db->query($query2);
        $query = "DELETE FROM grup WHERE grupId = '$code1'";
        $result = $db->query($query);
 ?>
        <?=
            "<script type='text/javascript'>
            $(document).ready(function() {
            $('#DelModalS').modal('hide');
            });
            </script>
            <meta http-equiv='refresh' content='0'>"
         ?>
<?php
    }
    $a = filter_input(INPUT_POST, 'submitOutG');
    if (isset($a)) {
        $code2 = filter_input(INPUT_POST, 'staticCodeOutG');
        $query2 = "UPDATE grupvisit SET Keluar = CURRENT_TIMESTAMP(), Code = NULL, Status = 'Passive' WHERE visitId = '$code2'";
        $query1 = "UPDATE kartu SET id =  '-', status = 'Available' WHERE Code = (SELECT Code FROM grupvisit WHERE visitId = '$code2')";
        $result = $db->query($query1);
        $result2 = $db->query($query2);
 ?>
        <?=
            "<script type='text/javascript'>
            $(document).ready(function() {
            $('#OutModalS').modal('hide');
            });
            </script>
            <meta http-equiv='refresh' content='0'>"
         ?>
<?php         
    }
    $a = filter_input(INPUT_POST, 'submitInG');
    if (isset($a)) {
        $code2 = filter_input(INPUT_POST, 'staticCodeInG2');
        $code1 = filter_input(INPUT_POST, 'inputCodeInG');
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
 ?>
        <?=    
            "<script type='text/javascript'>
            $(document).ready(function() {
            $('#inModalG').modal('hide');
            });
            </script>
            <meta http-equiv='refresh' content='0'>";
        ?>
        <?php } else { ?>
            <?= "<script type='text/javascript'>alert('Wrong Access Card, Please Enter The Correct Access Card!');</script>" ?>
<?php        
        }
    }

    $db->close();
 ?>
