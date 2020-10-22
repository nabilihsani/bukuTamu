<?php 
  include 'db_login.php';

  $sql1 = "SELECT b.idTamu, a.Nama FROM kunjungan AS b INNER JOIN tamu AS a ON a.idTamu = b.idTamu WHERE Status = 'Booking'";
  $re1 = $db->query($sql1);
  $sql1G = "SELECT b.grupId, a.grupName FROM grupvisit AS b INNER JOIN grup AS a ON a.grupId = b.grupId WHERE Status = 'Booking'";
  $re1G = $db->query($sql1G);

  $sql = "SELECT b.idTamu, a.Nama FROM kunjungan AS b INNER JOIN tamu AS a ON a.idTamu = b.idTamu WHERE Status = 'Active'";
  $re = $db->query($sql);
  $sqlG = "SELECT b.grupId, a.grupName FROM grupvisit AS b INNER JOIN grup AS a ON a.grupId = b.grupId WHERE Status = 'Active'";
  $reG = $db->query($sqlG);


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
  if ($numRow == 1) {
    $Code = randomCode($permittedChars, 3);
  }

  $a = filter_input(INPUT_POST, 'verifyIn');
  if (isset($a)) {
    $idIn = filter_input(INPUT_POST, 'inputIdIn');
    $query = "SELECT * FROM kunjungan AS b INNER JOIN tamu AS a ON a.idTamu = b.idTamu WHERE b.idTamu = '$idIn' AND b.Status = 'Booking'";
    $result = $db->query($query);
    $numRow = $result->num_rows;
    if ($numRow == 1) {
      while ($row = $result->fetch_object()) {
        $code = $row->idTamu;
        $name = $row->Nama;
        $loc = $row->Lokasi;
        $email = $row->Email;
        $company = $row->Company;
        $phone = $row->Phone;
        $tujuan = $row->Tujuan;
        $keperluan = $row->Keperluan;
      }
      echo "<script type='text/javascript'>
      $(document).ready(function() {
      $('#modal3').modal('show');
      });
      </script>";
    } else {
      $query = "SELECT * FROM grupvisit AS b INNER JOIN grup AS a ON a.grupId = b.grupId WHERE b.grupId = '$idIn' AND Status = 'Booking'";
      $result = $db->query($query);
      $numRow = $result->num_rows;
      if ($numRow == 1) {
        while ($row = $result->fetch_object()) {
          $vname = $row->visitorName;
          $phone = $row->visitPhone;
          $email = $row->visitorEmail;
          $count = $row->visitCount;
          $code = $row->grupId;
          $name = $row->grupName;
          $company = $row->Company;
          $loc = $row->Lokasi;
          $tujuan = $row->Tujuan;
          $keperluan = $row->Keperluan;
        }
        echo "<script type='text/javascript'>
        $(document).ready(function() {
        $('#modal7').modal('show');
        });
        </script>";
      } else {
        echo "<script type='text/javascript'>
          $(document).ready(function() {
          $('#modal6').modal('show');
          });
          </script>";  
      }
    }
  }
  $a = filter_input(INPUT_POST, 'submitOut');
  if (isset($a)) {
    $idOut = filter_input(INPUT_POST, 'inputIdOut');
    $q2 = "SELECT * FROM tamu WHERE idTamu = '$idOut'";
    $r2 = $db->query($q2);
    $numRow = $r2->num_rows;
    while ($row = $r2->fetch_object()) {
      $name = $row->Nama;
    }  
    if ($numRow > 0) {
      echo "<script type='text/javascript'>
      $(document).ready(function() {
      $('#modal4').modal('show');
      });
      </script>";  
    } 
    else {
      $q2 = "SELECT * FROM grup WHERE grupId = '$idOut'";
      $r2 = $db->query($q2);
      $numRow = $r2->num_rows;  
      while ($row = $r2->fetch_object()) {
        $name = $row->grupName;
      }
      if ($numRow > 0) {
        echo "<script type='text/javascript'>
        $(document).ready(function() {
        $('#modal4').modal('show');
        });
        </script>"; 
      } 
      else {
        echo "<script type='text/javascript'>
        $(document).ready(function() {
        $('#modal6').modal('show');
        });
        </script>";
      }
    }
  }
  $a = filter_input(INPUT_POST, 'submitOutY');
  if (isset($a)) {
    $idOutY = filter_input(INPUT_POST, 'inputIdOutY');
    $q1 = "SELECT * FROM kunjungan WHERE idTamu = '$idOutY'";
    $r1 = $db->query($q1);
    $numRow = $r1->num_rows;
    if ($numRow > 0) {
      $q = "UPDATE kunjungan SET Keluar = CURRENT_TIMESTAMP(), Code = NULL, Status = 'Passive' WHERE idTamu = '$idOutY'";
      $query1 = "UPDATE kartu SET id =  '-', status = 'Available' WHERE Code = (SELECT Code FROM kunjungan WHERE idTamu = '$idOutY')";
      $result = $db->query($query1);
      $r = $db->query($q);
      echo "<script type='text/javascript'>
      $(document).ready(function() {
      $('#modal4').modal('hide');
      });
      </script>";
                  echo "<meta http-equiv='refresh' content='0'>";
    } 
    else {
      $q1 = "SELECT * FROM grupvisit WHERE grupId = '$idOutY'";
      $r1 = $db->query($q1);
      $numRow = $r1->num_rows;
      if ($numRow > 0) {
        $q = "UPDATE grupvisit SET Keluar = CURRENT_TIMESTAMP(), Code = NULL, Status = 'Passive' WHERE grupId = '$idOutY'";
        $query1 = "UPDATE kartu SET id =  '-', status = 'Available' WHERE Code = (SELECT Code FROM grupvisit WHERE grupId = '$idOutY')";
        $result = $db->query($query1);
        $r = $db->query($q);
        echo "<script type='text/javascript'>
        $(document).ready(function() {
        $('#modal4').modal('hide');
        });
        </script>";
                    echo "<meta http-equiv='refresh' content='0'>";

      } 
    }
  }
  $a = filter_input(INPUT_POST, 'submitIn');
  if (isset($a)) {
    $id = filter_input(INPUT_POST, 'staticCodeIn');
    $name = filter_input(INPUT_POST, 'inputNamaIn');
    $telp = filter_input(INPUT_POST, 'inputPhoneInS');
    $company = filter_input(INPUT_POST, 'inputCompanyIn');
    $loc = filter_input(INPUT_POST, 'inputLocInS');
    $email = filter_input(INPUT_POST, 'inputEmailIn');
    $tujuan = filter_input(INPUT_POST, 'inputTujuanIn');
    $keperluan = filter_input(INPUT_POST, 'KeperluanIn');

    $query = "UPDATE tamu SET Phone = '$telp', Company = '$company', Email = '$email', Lokasi = '$loc' WHERE idTamu = '$id'";
    $result = $db->query($query);
    $query1 = " UPDATE kunjungan SET Masuk = CURRENT_TIMESTAMP(), Status = 'Active' WHERE idTamu = '$id'";
    $result1 = $db->query($query1);
    
    echo "<script type='text/javascript'>
    $(document).ready(function() {
    $('#modal5').modal('show');
    });
    </script>";
  }
  $a = filter_input(INPUT_POST, 'submitInG');
  if (isset($a)) {
    $id = filter_input(INPUT_POST, 'staticCodeInG');
    $name = filter_input(INPUT_POST, 'inputNamaInG');
    $phone = filter_input(INPUT_POST, 'inputPhoneInG');
    $company = filter_input(INPUT_POST, 'inputCompanyInG');
    $loc = filter_input(INPUT_POST, 'inputLocInG');
    $group = filter_input(INPUT_POST, 'inputGroupG');
    $groupPerson = filter_input(INPUT_POST, 'inputGroupPersonG');
    $email = filter_input(INPUT_POST, 'inputEmailInG');
    $tujuan = filter_input(INPUT_POST, 'inputTujuanInG');
    $keperluan = filter_input(INPUT_POST, 'KeperluanInG');

    $query = "UPDATE grup SET grupName = '$group', Company = '$company', Lokasi = '$loc' WHERE grupId = '$id'";
    $result = $db->query($query);
    $query1 = " UPDATE grupvisit SET Masuk = CURRENT_TIMESTAMP(), Status = 'Active' WHERE grupId = '$id'";
    $result1 = $db->query($query1);

    echo "<script type='text/javascript'>
    $(document).ready(function() {
    $('#modal5').modal('show');
    });
    </script>";
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
    $query1 = " INSERT INTO kunjungan (idTamu, Tujuan, Keperluan, Masuk, Status) VALUES('$id', '$tujuan', '$keperluan', CURRENT_TIMESTAMP(), 'Active')";
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
    $query1 = " INSERT INTO grupvisit (grupId, visitorName, visitPhone, visitorEmail, visitCount, Tujuan, Keperluan, Masuk, Status) VALUES('$id', '$name', '$telp', '$email', '$groupPerson', '$tujuan', '$keperluan', CURRENT_TIMESTAMP(), 'Active')";
    $result1 = $db->query($query1);

    echo "<script type='text/javascript'>
    $(document).ready(function() {
    $('#modal5').modal('show');
    });
    </script>";
  }

    $db->close();
  ?>
