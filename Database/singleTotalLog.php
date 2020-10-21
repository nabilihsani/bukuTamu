<?php 
    require_once('db_login.php');
    $db = new mysqli($db_host, $db_username, $db_password, $db_database);
    if ($db->connect_errno) {
        die ("Could not connect to the database: <br />"). $db->connect_errno;
    }
    $query = "SELECT b.*, a.Nama, a.Email, a.Company, a.Lokasi, a.Phone FROM kunjungan AS b INNER JOIN tamu AS a ON a.idTamu = b.idTamu";
    $result = $db->query($query);

    while ($row = mysqli_fetch_array($result)) {
        $dateIn = date_create($row['Masuk']);
        $dateIn1 = date_format($dateIn, 'Y-m-d H:i:s');
        if ($row['Keluar'] != '') {
            $dateOut = date_create($row['Keluar']);
            $dateOut1 = date_format($dateOut, 'Y-m-d H:i:s');
        } else {
            $dateOut1 = '-';
        }
        if ($row['Lokasi'] != '') {
            $loc = $row['Lokasi'];
        } else {
            $loc = '-';
        }
        if ($row['Phone'] != '') {
            $telp = $row['Phone'];
        } else {
            $telp = '-';
        }
        echo '<tr>';
        echo '<td>'.$row['idKunjungan'].'</td>';
        echo '<td>'.$row['idTamu'].'</td>';
        echo '<td>'.$row['Nama'].'</td>';
        echo '<td>'.$telp.'</td>';
        echo '<td>'.$row['Email'].'</td>';
        echo '<td>'.$row['Company'].'</td>';
        echo '<td>'.$loc.'</td>';
        echo '<td>'.$row['Tujuan'].'</td>';
        echo '<td><p>'.$row['Keperluan'].'</p></td>';
        echo '<td>'.$dateIn1.'</td>';
        echo '<td>'.$dateOut1.'</td>';
        echo '</tr>';
    }
    
    $db->close();
 ?>