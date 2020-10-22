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
    <td>'.addslashes($a).'</td>
    <td>'.addslashes($b).'</td>
    <td>'.addslashes($c).'</td>
    </tr>'
 ?>
<?php 
    }
    $db->close();
 ?>
