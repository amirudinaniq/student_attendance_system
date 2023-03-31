<?php 
  include('../functions.php');


  if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}
$IdKelas=$_SESSION['user']['idKelas'];
$id=$_SESSION['user']['idGuru'];
if (isset($_POST['search'])) {
$valueToSearch=$_POST['valueToSearch'];
  $results= mysqli_query($db, "SELECT g.idPelajar, g.nama, g.alamat, namaKelas, g.notelefon, s.Status, s.Tarikh, s.Sebab from kelas k, pelajar g, guru j, kehadiran s where k.idKelas=g.idKelas and k.idKelas=j.idKelas and k.idKelas=s.idKelas and g.idPelajar=s.idPelajar and idGuru='$id' and CONCAT(g.idPelajar, g.nama, g.alamat, namaKelas, s.Status, s.Sebab, s.Tarikh) LIKE '%".$valueToSearch."%' group by Tarikh, idPelajar");
  
}else{
  $results = mysqli_query($db, "SELECT g.idPelajar, g.nama, g.alamat, namaKelas, s.Tarikh, s.Status, s.idKelas, s.Sebab from kelas k, pelajar g, guru j, kehadiran s where k.idKelas=g.idKelas and k.idKelas=j.idKelas and k.idKelas=s.idKelas and g.idPelajar=s.idPelajar and idGuru='$id' group by s.Tarikh, idPelajar"); 
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
    <title>Attendances - Details Students</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
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
              <div class="d-flex order-lg-2 ml-auto" >
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
                    <a href="./students.php" class="nav-link"><i class="fe fe-check-square"></i>Students</a>
                  </li>
                  <li class="nav-item">
                    <a href="./attendance.php" class="nav-link active"><i class="fe fe-file-text"></i>Attendance</a>
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
                    <span id="message_operation"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
                <div class="card">
                <form class="card" action="attendance.php" method="post">
                  <div class="card-header">
                    <h3 class="card-title">Students Details</h3>
                  <div class="col-md-10" align="right">
                    <button type="button" id="add_button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#formModal">Add Attendance</button>
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
                        <th>Students ID</th>
                        <th>Students Name</th>
                        <th>Status</th>
                        <th>Reasons</th>
                        <th>Date</th>
                        <th>Class Name</th>
                        <th colspan="2">Action</th>
                      </tr>
                    </thead>
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                      <tr>
                        <td><a class="text-inherit"><?php echo $row['idPelajar']; ?></a></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['Status']; ?></td>
                        <td><?php echo $row['Sebab']; ?></td>
                        <td><?php echo $row['Tarikh']; ?></td>
                        <td><?php echo $row['namaKelas']; ?></td>
                        <td>
                          <a href="updateStudentsAttendances.php?editAttendancesId=<?php echo $row['idPelajar']; ?>&editAttendancesDate=<?php echo $row['Tarikh']; ?>" class="btn btn-secondary btn-sm" >Edit</a>
                          <a href="../functions.php?delStudentsAttendancesID=<?php echo $row['idKelas']; ?>&delStudentsAttendancesDate=<?php echo $row['Tarikh']; ?>" class="btn btn-secondary btn-sm" onclick="return confirm('Are you sure?')" >Delete</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php 
    $results = mysqli_query($db, "SELECT idPelajar, g.nama, g.alamat, namaKelas, g.notelefon, g.idKelas from kelas k, pelajar g, guru j where k.idKelas=g.idKelas and k.idKelas=j.idKelas and idGuru='$id' group by idPelajar"); 
    ?>
<div class="modal" id="formModal" role="dialog">
  <div class="modal-dialog">
    <form method="post" id="attendance_form" onsubmit="return validate(this);">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLable">Attendance Take</h4>
          <button type="button" class="close" data-dismiss="modal">
           <span class="sr-only">Close</span>
          </button>
        </div>
          <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Classroom teachers <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <?php
                $kelas=$_SESSION['user']['nama'];
                echo '<label>'.$kelas.'</label>';
                ?>
                <label class="form-label"><?php echo display_error(); ?></label>
              </div>
            </div>

          </div>
          <div class="container">
            <div class="row">
              <label class="col-md-4 text-right">Attendance Date <span class="text-danger">*</span></label>
              <div class="col-md-5">
                <input type="text" name="Tarikh" id="attendance_date" class="form-control" readonly required="Date is required" />
              </div>
            </div>
            <script src="../assets/js/jquery.min.js"></script>
            <script src="../assets/js/bootstrap-datepicker.js"></script>
            <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#attendance_date').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });  
            
            });
        </script>
          </div>
          <div class="form-group" id="student_details">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Reason</th>
                  </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_array($results)) 
                  {
                    ?>
                  <tr>
                    <td> <?php echo $row['idPelajar']; ?></td>
                    <input type="hidden" name="idPelajar[]" value="<?php echo $row['idPelajar']; ?>" />
                    <td> <?php echo $row['nama']; ?> </td>
                      <label>
                    <td>
                      <input type="radio"  name="Status<?php echo $row['idPelajar']; ?>" id="name" checked value="Present" />
                      </label>
                    </td>
                    <td>
                      <label>
                      <input type="radio" name="Status<?php echo $row['idPelajar']; ?>"  id="formReason" value="Absent" /></label>
                    </td>
                    <td>
                      <div class="form-group">
                      <select name="Sebab<?php echo $row['idPelajar']; ?>" id="Sebab" class="form-control">
                        <option value="">Select Reasons</option>
                        <option value="Medical Certificate">Medical Certificate</option>
                        <option value="Representating School">Representating School</option>
                      </select>
                    </div>
                </tr>
                <?php
                } ?>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="action" id="action" value="Add" />
          <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add" />
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        </div>
  </div>
</form>
</div>
</div>
    <footer class="footer">
      <div class="container">
        <div class="row align-items-center flex-row-reverse">
          <div class="col-auto ml-lg-auto">
          <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
            Copyright © 2019 <a href=".">Tabler</a>. Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a> All rights reserved.
          </div>
        </div>
      </div>
</footer>
<script type="text/javascript">

  function validate() {
    return [
        document.form.Tarikh

    ].every(validateDate)
}

function validateDate(Tarikh)
{
    if (Tarikh.value.trim() == "") {
        alert("Please enter a Date");
        Tarikh.focus();
        return false;
    }
    return true;       
}
  function SubmiAttendanceForm(){
    $.ajax({
      url:'attendance.php',
      method:"POST",
      data:$(this).serialize()
      success:function()
    })
  };


</script>
</body> 
</html>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>