<?php 
  include 'db_login.php';

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

  $a = filter_input(INPUT_POST, 'submitS');
  if (isset($a)) {
    $id = filter_input(INPUT_POST, 'staticCodeS');
    $name = filter_input(INPUT_POST, 'inputNamaS');
    $telp = filter_input(INPUT_POST, 'inputPhoneS');
    $loc = filter_input(INPUT_POST, 'inputLocS');
    $company = filter_input(INPUT_POST, 'inputCompanyS');
    $email = filter_input(INPUT_POST, 'inputEmailS');
    $tujuan = filter_input(INPUT_POST, 'inputTujuanS');
    $keperluan = filter_input(INPUT_POST, 'KeperluanS');
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
  $a = filter_input(INPUT_POST, 'submitG');    
  if (isset($a)) {
    $id = filter_input(INPUT_POST, 'staticCodeG');
    $name = filter_input(INPUT_POST, 'inputNamaG');
    $telp = filter_input(INPUT_POST, 'inputPhoneG');
    $company = filter_input(INPUT_POST, 'inputCompanyG');
    $loc = filter_input(INPUT_POST, 'inputLocG');
    $group = filter_input(INPUT_POST, 'inputGroup');
    $groupPerson = filter_input(INPUT_POST, 'inputGroupPerson');
    $email = filter_input(INPUT_POST, 'inputEmailG');
    $tujuan = filter_input(INPUT_POST, 'inputTujuanG');
    $keperluan = filter_input(INPUT_POST, 'KeperluanG');
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
