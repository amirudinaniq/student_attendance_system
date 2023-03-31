<?php 
  include('../functions.php');

  if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
  }
  ?>
  <?php
    $username=$_SESSION['user']['username'];
    $update=true;
    $record = mysqli_query($db, "SELECT * FROM multi_login WHERE username='$username'");
      while($n = mysqli_fetch_array($record)){
        $email = $n['email'];
      $user_type = $n['user_type'];
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
    <link rel="icon" href="../favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />
    <!-- Generated: 2019-04-04 16:55:45 +0200 -->
    <title>Administrator Profile</title>
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
              <form class="card" action="adminProfile.php" method="post">
                <div class="card-body p-6">
                  <div class="card-title">Administrator Profile</div>
                  <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" readonly/>
                  </div>
                  <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required=""/>
                  </div>
                  <div class="form-group">
                    <label class="form-label">User Type</label>
                    <input type="text"class="form-control" name="user_type" value="<?php echo $user_type; ?>" readonly/>
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
                      <input type="hidden" name="idPelajar" value="<?php echo $Id; ?>">
                      <button class="btn btn-primary ml-auto" type="submit" name="updateProfileBtn"  >Update</button>
                      <a href="index.php" class="btn btn-primary ml-auto" >Close</a>
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
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>