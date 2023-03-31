<?php 
  include('../functions.php');

  if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
  }
  $IdKelas=$_SESSION['user']['idKelas'];
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
    <title>Teachers - Homepage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="../assets/js/require.min.js"></script>
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
      <div class="flex-fill">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
                <img src="../demo/logo/student-stock-photo.71e8b7927254.png" class="header-brand-img" alt="tabler logo">
                <div class="h2">SAS</div>
              <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown">
                  <a href="userProfile.php" class="nav-link pr-0 leading-none">
                    <span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span>
                    <span class="ml-2 d-none d-lg-block">
                      <?php  if (isset($_SESSION['user'])) : ?>
                      <strong><?php echo $_SESSION['user']['idGuru']; ?></strong>

                      <?php $query=mysqli_query($db, "SELECT namaKelas from kelas where idKelas='$IdKelas'");
                      while ($sql = mysqli_fetch_array($query)){ ?>
                      <small>
                      <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
                      <br>
                      <a href="index.php?logout='1'" style="color: red;">logout</a>
                           &nbsp; <a> Class = <?php echo $sql['namaKelas']; ?></a>
                    </small>
                  <?php }?>
                    <?php endif ?>
                    </span>
                  </a>
                </div>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 ml-auto">
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item">
                    <a href="./students.php" class="nav-link"><i class="fe fe-check-square"></i>Students</a>
                  </li>
                  <li class="nav-item">
                    <a href="./attendance.php" class="nav-link"><i class="fe fe-file-text"></i>Attendance</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="page-header">
              <h1 class="page-title">
                Dashboard
              </h1>
            </div>
            <div class="row row-cards">
              <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                  <div class="card-body p-1 text-center">
                    <div class="text-muted mb-4">
                      <?php if (isset($_SESSION['success'])) : ?>
                      <div class="error success" >
                          <h3>
                        <?php 
                       echo $_SESSION['success']; 
                      unset($_SESSION['success']);
                     ?>
                      </h3>
                    </div>
                    <?php endif ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
          <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
            Copyright © 2019 <a href=".">Tabler</a>. Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a> All rights reserved.
          </div>
          </div>
        </div>
      </footer>
    </div>
  </body>
</html>