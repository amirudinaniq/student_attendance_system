<?php 
  include('../functions.php');

  if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
  }
  ?>
  <?php
  if (isset($_GET['editTeachers'])) {
    $Id  = $_GET['editTeachers'];
    $update=true;
    $record = mysqli_query($db, "SELECT * FROM guru WHERE idGuru='$Id'");
      while($n = mysqli_fetch_array($record)){
        $id = $n['idGuru'];
      $Name = $n['nama'];
      $Add = $n['alamat'];
      $Tel = $n['notelefon'];
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
    <title>Attendances - Updates Students Attendances</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="../assets/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
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
      <div class="flex">
        <div class="mx-auto">
        <div class="my-10 my-md-5">
          <div class="container">
            <div class="row">
              <div class="col-lg-10">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Teachers Account</h3>
                  </div>
                  <div class="card-body">
                    <form method="post" action="updateStudents.php" class="mx-auto">
                      <div class="row">
                        <div class="col-auto">
                          <span class="avatar avatar-xl" style="background-image: url(demo/faces/female/9.jpg)"></span>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label class="form-label">Name</label>
                            <input class="form-control" name="nama" value="<?php echo $Name; ?>" required=""/>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="form-label">ID Teachers</label>
                        <input class="form-control" name="idGuru" value="<?php echo $id; ?>" readonly />
                      </div>
                      <div class="form-group">
                        <label class="form-label">Address</label>
                        <input class="form-control" name="alamat" value="<?php echo $Add; ?>" required=""/>
                      </div>
                      <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input class="form-control" class="form-control" name="notelefon" value="<?php echo $Tel; ?>" required=""/>
                      </div>
                      <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="Password" class="form-control"  name="password_1" value="" />
                      </div>
                      <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input type="Password" class="form-control"  name="password_2" value="" />
                      </div>
                      <div class="form-footer">
                        <input type="hidden" name="idGuru" value="<?php echo $Id; ?>">
                        <label class="form-label"><?php echo display_error(); ?></label>
                      <button class="btn btn-primary btn
                      " type="submit" name="updateTeachersBtn" >Save</button>
                      <a href="teachers.php" class="btn btn-primary ml-auto" >Close</a>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </body>
</html>