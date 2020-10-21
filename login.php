<!DOCTYPE html>
<?php include ("Database/loginValidation.php"); ?>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LOGIN PAGE</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
  <?php if(isset($_GET["session_expired"])) {
    echo '<script type="text/javascript">;
    alert("Your session has expired, please login again");  //not showing an alert box.
    </script>';
  }
   ?>
  <div class="container">
    <div class="card card-login mx-auto mt-5" style="text-align: center; width: 60rem;">
      <div class="card-header">LOGIN</div>
      <div class="card-body">
        <form action="login.php" method="POST" autocomplete="off">
          <div class="form-group <?php echo(!empty($username_err)) ? 'has-error' : ''; ?>">
            <div class="form-label-group">
              <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="required" value="<?php echo $username; ?>">
              <label for="username">Username</label>
              <span class="help-block"><?php echo $username_err; ?></span>
            </div>
          </div>
          <div class="form-group <?php echo(!empty($password_err)) ? 'has-error' : ''; ?>">
            <div class="form-label-group">
              <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="required">
              <label for="password">Password</label>
              <span class="help-block"><?php echo $password_err; ?></span>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" value="">Login</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
