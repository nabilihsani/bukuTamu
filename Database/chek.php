<?php 
  require_once('db_login.php');
  $db = new mysqli($db_host, $db_username, $db_password, $db_database);
  if ($db->connect_errno) {
    die ("Could not connect to the database: <br />"). $db->connect_errno;
  }

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

  function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if (isset($_POST["verifyIn"])) {
    $idIn = testInput($_POST['inputIdIn']);
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

  if (isset($_POST["submitOut"])) {
    $idOut = testInput($_POST['inputIdOut']); 
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

  if (isset($_POST["submitOutY"])) {
    $idOutY = testInput($_POST['inputIdOutY']);
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

  if (isset($_POST["submitIn"])) {
    $id = testInput($_POST['staticCodeIn']);
    $name = testInput($_POST['inputNamaIn']);
    $telp = testInput($_POST['inputPhoneInS']);
    $company = testInput($_POST['inputCompanyIn']);
    $loc = testInput($_POST['inputLocInS']);
    $email = testInput($_POST['inputEmailIn']);
    $tujuan = testInput($_POST['inputTujuanIn']);
    $keperluan = testInput($_POST['KeperluanIn']);

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

  if (isset($_POST["submitInG"])) {
    $id = testInput($_POST['staticCodeInG']);
    $name = testInput($_POST['inputNamaInG']);
    $phone = testInput($_POST['inputPhoneInG']);
    $company = testInput($_POST['inputCompanyInG']);
    $loc = testInput($_POST['inputLocInG']);
    $group = testInput($_POST['inputGroupG']);
    $groupPerson = testInput($_POST['inputGroupPersonG']);
    $email = testInput($_POST['inputEmailInG']);
    $tujuan = testInput($_POST['inputTujuanInG']);
    $keperluan = testInput($_POST['KeperluanInG']);

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
    $query1 = " INSERT INTO kunjungan (idTamu, Tujuan, Keperluan, Masuk, Status) VALUES('$id', '$tujuan', '$keperluan', CURRENT_TIMESTAMP(), 'Active')";
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
