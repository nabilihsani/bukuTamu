<?php 
    include 'db_login.php';
    $query = "SELECT * FROM kartu";
    $result = $db->query($query);
    $numRow = $result->num_rows;
    while ($row = mysqli_fetch_array($result)) {
        $a = $row['Code'];
        $b = $row['id'];
        $c = $row['status'];
 ?>
<?=
    '</tr>
    <td>'.$a.'</td>
    <td>'.$b.'</td>
    <td>'.$c.'</td>
    </tr>'
 ?>
<?php 
    }
    $db->close();
 ?>
