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
    <td>'.$db->escape_string($a).'</td>
    <td>'.$db->escape_string($b).'</td>
    <td>'.$db->escape_string($c).'</td>
    </tr>'
 ?>
<?php 
    }
    $db->close();
 ?>
