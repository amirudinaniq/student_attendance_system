<?php 
  include('../functions.php');


  if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}

$id=$_SESSION['user']['idGuru'];
$IdKelas=$_SESSION['user']['idKelas'];
if (isset($_POST['search'])) {
$valueToSearch=$_POST['valueToSearch'];
  $results= mysqli_query($db, "SELECT idPelajar, g.nama, g.alamat, namaKelas, g.notelefon FROM pelajar g, kelas k, guru j WHERE k.idKelas=g.idKelas AND k.idKelas=j.idKelas AND idGuru='$id' and CONCAT(idPelajar, g.nama, g.alamat, namaKelas) LIKE '%".$valueToSearch."%' group by idPelajar");
  
}else{
  $results = mysqli_query($db, "SELECT idPelajar, g.nama, g.alamat, namaKelas, g.notelefon from kelas k, pelajar g, guru j where k.idKelas=g.idKelas and k.idKelas=j.idKelas and idGuru='$id' group by idPelajar"); 
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
    <title>Students - User </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/css/datepicker.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <!-- jQuery library -->
    <script src="../assets/js/require.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '..'
      });
    </script>
    <link rel="stylesheet" href="../assets/css/datepicker.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
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
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item">
                    <a href="./students.php" class="nav-link active"><i class="fe fe-check-square"></i>Students</a>
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
            <div class="row">
              <div class="col-12">
                <div class="row row-cards">
              <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                  <div class="card-body p-1 text-center">
                    <div class="text-muted mb-4">
                      <?php if (isset($_SESSION['message'])) : ?>
                      <div class="msg" >
                          <h3>
                        <?php 
                       echo $_SESSION['message']; 
                      unset($_SESSION['message']);
                     ?>
                      </h3>
                    </div>
                    <?php endif ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
               <div class="col-12">
                <div class="card">
                  <form class="card" action="students.php" method="post">
                  <div class="card-header">
                    <h3 class="card-title">Students Information</h3>
                    <div class="col-md-10" align="right">
                      <button type="button" id="reportStudent_button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#formModal" >Students Report</button>
                  </div>
                  </div>
                          <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <nav class="navbar navbar-light bg-light">
                    <form class="form-inline">
                      <input class="form-control mr-sm-2" type="search" name="valueToSearch" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success my-2 my-sm-0"name="search" value="Filter" type="submit">Search</button>
                    </form>
                  </nav>
                      </div>
                    </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable table table-striped">
                      <thead>
                        <tr>
                          <th class="w-1">No.</th>
                          <th>Name</th>
                          <th>Address</th>
                          <th>Phone Number</th>
                          <th>Class Name</th>
                        </tr>
                      </thead>
                      <?php while ($row = mysqli_fetch_array($results)) { ?>
                      <tbody>
                        <tr>
                          <td><span class="text-muted"><?php echo $row['idPelajar']; ?></span></td>
                          <td><a class="text-inherit" ><?php echo $row['nama']; ?></a></td>
                          <td><?php echo $row['alamat']; ?></td>
                          <td><?php echo $row['notelefon']; ?></td>
                          <td><?php echo $row['namaKelas']; ?></td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </form>
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
</body>
</html>
<div class="modal" id="formModal" role="dialog">
  <div class="modal-dialog">
    <form method="post" id="report_form" action="students.php">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLable">Create Students Report</h4>
          <button type="button" class="close" data-dismiss="modal">
           <span class="sr-only">Close</span>
          </button>
        </div>
          <div class="modal-body">
          <div class="container">
            <div class="form-group">
            <select name="idPelajar" id="idPelajar" class="form-control">
              <option value="">Select Students</option>
                <?php 

                  $query = mysqli_query($db, "SELECT idPelajar, nama from pelajar where idKelas='$IdKelas'");
                  foreach ($query as $pelajar) {
                  echo '<option value="'.$pelajar['idPelajar'].'">'.$pelajar['idPelajar'].'  =  '.$pelajar['nama'].'</option>';
                }
                ?>
            </select>
          </div>
            <div class="row">
              <label class="col-md-4 text-right">From<span class="text-danger">*</span></label>
              <div class="col-md-5">
                <input type="text" name="reportFrom_date" id="reportFrom_date" class="form-control" readonly required="Date is required" />
              </div>
            </div>
              <div class="row">
              <label class="col-md-4 text-right">To<span class="text-danger">*</span></label>
              <div class="col-md-5">
                <input type="text" name="reportTo_date" id="reportTo_date" class="form-control" readonly required="Date is required" />
              </div>
            </div>
            <script src="../assets/js/jquery.min.js"></script>
            <script src="../assets/js/bootstrap-datepicker.js"></script>
            <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#reportFrom_date').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });  
            
            });
            $(document).ready(function () {
                
                $('#reportTo_date').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });  
            
            });
        </script>
          </div>
        </div>

        <div class="modal-footer">
          <input type="submit" name="create_reportStudent" id="create_reportStudent" class="btn btn-success btn-sm" value="Report" />
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        </div>
  </div>
</form>
</div>
</div>
 <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>