<?php 
  include('../functions.php');

  if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
  }
  ?>
  <?php
  if (isset($_GET['editAttendancesId'])) {
    $Id  = $_GET['editAttendancesId'];
    $Tarikh  = $_GET['editAttendancesDate'];
    $update=true;
    $record = mysqli_query($db, "SELECT pelajar.idPelajar, pelajar.nama, pelajar.alamat, pelajar.notelefon, kehadiran.Sebab FROM pelajar, kehadiran WHERE pelajar.idPelajar=kehadiran.idPelajar and pelajar.idPelajar='$Id' and Tarikh='$Tarikh' group by idPelajar");
      while($n = mysqli_fetch_array($record)){
      $id = $n['idPelajar'];
      $Name = $n['nama'];
      $Add = $n['alamat'];
      $Tel = $n['notelefon'];
      $Reasons = $n['Sebab'];
    }
  }
?>
<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="../demo/logo/student-stock-photo.71e8b7927254.png" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="../demo/logo/student-stock-photo.71e8b7927254.png" />
    <!-- Generated: 2019-04-04 16:55:45 +0200 -->
    <title>Introduction - Documentation - tabler.github.io - a responsive, flat and full featured admin template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="../assets/js/require.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '..'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="../assets/css/dashboard.css" rel="stylesheet" />
    <script src="../assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="../assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="../assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="../assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="../assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="../assets/plugins/input-mask/plugin.js"></script>
    <!-- Datatables Plugin -->
    <script src="../assets/plugins/datatables/plugin.js"></script>
  </head>
  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <img src="../demo/logo/student-stock-photo.71e8b7927254.png" class="h-9" alt="">
              </div>
              
              <form class="card" action="updateStudentsAttendances.php" method="post">
                <div class="card-body p-6">
                  <div class="card-title">Update Students account</div>
                  <label class="form-label"><?php echo display_error(); ?></label>
                  <div class="form-group">
                    <label class="form-label">ID Students</label>
                    <input type="text" class="form-control"name="idPelajar" value="<?php echo $id; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $Name; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label class="form-label">Phone Numbers</label>
                    <input type="text"class="form-control" name="notelefon" value="<?php echo $Tel; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label class="form-label">Reasons</label>
                      <select name="Sebab" id="Sebab" class="form-control">
                        <option value="<?php echo $Reasons; ?>"> <?php echo $Reasons; ?> </option>
                        <option value="MC">Medical Certificate</option>
                        <option value="Representating School">Representating School</option>
                      </select>
                  </div>
                      <input type="radio"  name="Status" id="name" value="Present"/> Present<br>
                      <input type="radio" name="Status"  id="name" value="Absent"/> Absent<br>
                  <div class="form-footer">
                      <input type="hidden" name="idPelajar" value="<?php echo $Id; ?>">
                      <input type="hidden" name="Tarikh" value="<?php echo $Tarikh; ?>">
                      <button class="btn btn-primary ml-auto" type="submit" name="updatesStudentsAttendance"  >Update</button>
                      <a href="attendances.php" class="btn btn-primary ml-auto" >Close</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>