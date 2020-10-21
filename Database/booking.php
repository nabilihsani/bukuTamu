<?php 
  require_once('db_login.php');
  $db = new mysqli($db_host, $db_username, $db_password, $db_database);
  if ($db->connect_errno) {
    die ("Could not connect to the database: <br />"). $db->connect_errno;
  }

  $permittedChars = '0123456789';
  function randomCode($input, $strength) {
    $inputLength = strlen($input);
    $randomCode = 'G';
    for ($i=0; $i < $strength; $i++) { 
      $randomChar = $input[mt_rand(0, $inputLength - 1)];
      $randomCode .= $randomChar;
    }
    return $randomCode;
  }

  $Code = randomCode($permittedChars, 3);
  $query = "SELECT * FROM tamu WHERE idTamu = '$Code'";
  $result = $db->query($query);
  $numRow = $result->num_rows;
  $query1 = "SELECT * FROM grup WHERE grupId = '$Code'";
  $result1 = $db->query($query1);
  $numRow1 = $result->num_rows;
  if ($numRow == 1 && $numRow1 == 1) {
    $Code = randomCode($permittedChars, 3);
  }

  function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if (isset($_POST["submitS"])) {
    $id = testInput($_POST['staticCodeS']);
    $name = testInput($_POST['inputNamaS']);
    $telp = testInput($_POST['inputPhoneS']);
    $loc = testInput($_POST['inputLocS']);
    $company = testInput($_POST['inputCompanyS']);
    $email = testInput($_POST['inputEmailS']);
    $tujuan = testInput($_POST['inputTujuanS']);
    $keperluan = testInput($_POST['KeperluanS']);

    $query = " INSERT INTO tamu (idTamu, Nama, Phone, Email, Company, Lokasi) VALUES('$id', '$name', '$telp', '$email', '$company', '$loc')";
    $result = $db->query($query);
    $query1 = " INSERT INTO kunjungan (idTamu, Tujuan, Keperluan, Status) VALUES('$id', '$tujuan', '$keperluan', 'Booking')";
    $result1 = $db->query($query1);
    
    echo "<script type='text/javascript'>
    $(document).ready(function() {
    $('#modal5').modal('show');
    });
    </script>";
  }
    
  if (isset($_POST["submitG"])) {
    $id = testInput($_POST['staticCodeG']);
    $name = testInput($_POST['inputNamaG']);
    $telp = testInput($_POST['inputPhoneG']);
    $company = testInput($_POST['inputCompanyG']);
    $loc = testInput($_POST['inputLocG']);
    $group = testInput($_POST['inputGroup']);
    $groupPerson = testInput($_POST['inputGroupPerson']);
    $email = testInput($_POST['inputEmailG']);
    $tujuan = testInput($_POST['inputTujuanG']);
    $keperluan = testInput($_POST['KeperluanG']);

    $query = " INSERT INTO grup (grupId, grupName, Company, Lokasi) VALUES('$id', '$group', '$company', '$loc')";
    $result = $db->query($query);
    $query1 = " INSERT INTO grupvisit (grupId, visitorName, visitPhone, visitorEmail, visitCount, Tujuan, Keperluan, Status) VALUES('$id', '$name', '$telp', '$email', '$groupPerson', '$tujuan', '$keperluan', 'Booking')";
    $result1 = $db->query($query1);

    echo "<script type='text/javascript'>
    $(document).ready(function() {
    $('#modal5').modal('show');
    });
    </script>";
  }

    $db->close();
  ?>