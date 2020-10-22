<?php 
    include 'db_login.php';
    $query = "SELECT * FROM kartu";
    $result = $db->query($query);
    $numRow = $result->num_rows;
    while ($row = mysqli_fetch_array($result)) {
        $a = $db->escape_string($row['Code']);
        $b = $db->escape_string($row['id']);
        $c = $db->escape_string($row['status']);
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
