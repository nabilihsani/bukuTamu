<?php 
    include 'db_login.php';
    $query = "SELECT * FROM kartu";
    $result = $db->query($query);
    $numRow = $result->num_rows;
    while ($row = mysqli_fetch_array($result)) {
 ?>
<?=
    '</tr>
    <td>'.$row['Code'].'</td>
    <td>'.$row['id'].'</td>
    <td>'.$row['status'].'</td>
    </tr>'
 ?>
<?php 
    }
    $db->close();
 ?>
