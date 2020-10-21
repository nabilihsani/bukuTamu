<?php 
    require_once('db_login.php');
    $db = new mysqli($db_host, $db_username, $db_password, $db_database);
    if ($db->connect_errno) {
        die ("Could not connect to the database: <br />"). $db->connect_errno;
    }
    $query = "SELECT b.*, a.grupName, a.Company, a.Lokasi FROM grupvisit AS b INNER JOIN grup AS a ON a.grupId = b.grupId WHERE Status = 'Active'";
    $result = $db->query($query);

    while ($row = mysqli_fetch_array($result)) {
        if ($row['Lokasi'] != '') {
            $loc = $row['Lokasi'];
        } else {
            $loc = '-';
        }
        if ($row['visitPhone'] != '') {
            $telp = $row['visitPhone'];
        } else {
            $telp = '-';
        }
        echo '<tr>';
        echo '<td>'.$row['visitId'].'</td>';
        echo '<td>'.$row['grupId'].'</td>';
        echo '<td>'.$row['grupName'].'</td>';
        echo '<td>'.$telp.'</td>';
        echo '<td>'.$row['Company'].'</td>';
        echo '<td>'.$loc.'</td>';
        echo '<td>'.$row['visitCount'].'</td>';
        echo '<td>'.$row['Tujuan'].'</td>';
        echo '<td>'.$row['Keperluan'].'</td>';
        echo '</tr>';
    }
    $db->close();
 ?>