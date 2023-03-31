<?php 
	session_start();
	include('config.php');
	// variable declaration
	$errors   = array(); 

	//UPDATE PROFILE
	if(isset($_POST['updateProfileBtn'])){
		updateProfile();
	}
	// CREATE STUDENT REPORT
	if(isset($_POST['create_reportStudent'])){
		studentReport();
	}
	// CREATE FULL REPORT
	if(isset($_POST['create_report'])){
		fullReport();
	}
	// call the register() function if register_btn is clicked ADMIN REGISTER
	if (isset($_POST['register_btn'])) {
		register();
	}
	// UPDATE TEACHERS DATA
	if (isset($_POST['updateTeachersBtn'])) {
		teachersUpdate();
	}
	// UPDATE STUDENTS DATA
	if (isset($_POST['updateStudentsBtn'])) {
		studentsUpdate();
	}
	// UPDATE STUDENTS STATUS (ABSENT / PRESENT)
	if(isset($_POST['updatesStudentsAttendance'])){
			$id = $_POST['idPelajar'];
			$Tarikh = $_POST['Tarikh'];
			$Status = $_POST['Status'];
			
			if ($Status == 'Present') {
				mysqli_query($db, "UPDATE kehadiran set Status='$Status', Sebab='' where idPelajar='$id' and Tarikh='$Tarikh'");
				if($_SESSION['user']['user_type'] == "admin"){
					$_SESSION['message'] = "Student updated!"; 
					header('location: attendances.php');
				}
				else{
					$_SESSION['message'] = "Student Attendance updated!"; 
					header('location: attendance.php');
				}
			}else{
				$Sebab = $_POST['Sebab'];
				mysqli_query($db, "UPDATE kehadiran set Status='$Status', Sebab='$Sebab' where idPelajar='$id' and Tarikh='$Tarikh'");
				if($_SESSION['user']['user_type'] == "admin"){
					$_SESSION['message'] = "Student updated!"; 
					header('location: attendances.php');
				}
				else{
					$_SESSION['message'] = "Student Attendance updated!"; 
					header('location: attendance.php');
				}
			}
					
	}
	// DETELE STUDENTS
	if (isset($_GET['delStudents'])) {
	$id = $_GET['delStudents'];
		if(mysqli_query($db, "DELETE from pelajar where idPelajar='$id'"))
		{
			$_SESSION['message'] = "Account deleted!"; 
			header('location: admin/students.php');
		}elseif (!mysqli_query($db, "DELETE pelajar, kehadiran from pelajar INNER JOIN kehadiran where pelajar.idPelajar=kehadiran.idPelajar and pelajar.idPelajar='$id'")){
			echo "<script>alert('Unsuccessfully Delete Account'); </script>";
		}else{
				$_SESSION['message'] = "Account deleted!"; 
			header('location: admin/students.php');
			}
	
	}
	// DELETE STUDENT ATTENDANCE ON SPECIFIC DATE AND SPECIFIC CLASS
	if (isset($_GET['delStudentsAttendancesID'])) { 
		$id = $_GET['delStudentsAttendancesID'];
		$Tarikh =$_GET['delStudentsAttendancesDate'];
		if(!mysqli_query($db, "DELETE from kehadiran where idKelas='$id' and Tarikh='$Tarikh'")){
			echo "<script>alert('Unsuccessfully Delete Account'); </script>";
		}else{
			if($_SESSION['user']['user_type'] == "admin"){
				$_SESSION['message'] = "Student deleted!"; 
				header('location: admin/attendances.php');
			}
			else{
				$_SESSION['message'] = "Student Attendance deleted!"; 
				header('location: user/attendance.php');
			}
		}
		
	}
	// DELETE TEACHERS ROW
	if (isset($_GET['delTeachers'])) {
	$id = $_GET['delTeachers'];
	mysqli_query($db, "DELETE FROM guru WHERE idGuru='$id'");
	$_SESSION['message'] = "Account deleted!"; 
	header('location: admin/teachers.php');
	}

	// call the login() function if register_btn is clicked Teachers LOGIN
	if (isset($_POST['loginTeachers_btn'])) {
		loginTeachers();
	}
	// ADMIN LOGIN BUTTON
	if(isset($_POST['loginAdmin_btn'])){
		loginAdmin();
	}
	// STUDENT FORM BUTTOM
	if (isset($_POST['student_btn'])) {
		student();
	}
	// TEACHERS FORM BUTTON
	if(isset($_POST['teachers_btn'])){
		teachers();
	}
	//LOG OUT
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ../login.php");
	}

	// REGISTER ADMIN FROM REGISTERADMIN.PHP
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
				$query = "INSERT INTO multi_login (username, email, user_type, password) 
						  VALUES('$username', '$email', 'admin', '$password')";
				if(!mysqli_query($db, $query)){
					echo "<script>alert('Unsuccessfully register Account'); </script>";
				}
				else{
				$_SESSION['success']  = "New Admin Account Successfully registered";
				header('location: index.php');
			}
		}
	}

	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM multi_login WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}
	//	ADMIN LOGIN
	function loginAdmin()
	{
		global $db, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM multi_login WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in as Admin !";
					header('location: admin/index.php');		  
				}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	// LOGIN USER
	function loginTeachers(){
		global $db, $errors;

		// grap form values
		$id = e($_POST['idGuru']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($id)) {
			array_push($errors, "ID is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM guru WHERE idGuru='$id' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				$logged_in_user = mysqli_fetch_assoc($results);	  
				{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in as Teacher !";

					header('location: user/index.php');
				}
			}else {
				array_push($errors, "Wrong username/password combination!");
			}
		}
	}
	 // STUDENT FORM from Form-elementsStudents.php
	function student()
	{
		global $db, $errors;

		$Name = e($_POST['fullname']);
		$Id = e($_POST['idstudent']);
		$Add = e($_POST['address']);
		$Class = e($_POST['kelas']);
		$Tel = e($_POST['numberstudent']);
		

		$sql = "insert into pelajar (idPelajar, nama, alamat, notelefon, idKelas) values ('$Id', '$Name', '$Add', '$Tel', '$Class')";

		if (!mysqli_query($db,$sql))
			{
			 echo "<script>alert('Unsuccessfully registered Student!'); </script>";
			}else
			{
			 echo "<script>alert('Successfully registered Student!'); </script>";
			}
	}
	 // TEACHERS FORM from form-elementsTeachers.php
	function teachers()
	{
		global $db, $errors;

		$Name = e($_POST['nama']);
		$Id = e($_POST['idGuru']);
		$Add = e($_POST['alamat']);
		$Tel = e($_POST['notelefon']);
		$Class = e($_POST['kelas']);
		$password_1 = e($_POST['password_1']);
		$password_2 = e($_POST['password_2']);

		if ($password_1 != $password_2) {
			echo "<script>alert('Wrong Password combination'); </script>";
		}else
		{
		$password = md5($password_1);
		$sql = "insert into guru (idGuru, nama, alamat, notelefon, user_type, idKelas, password) values ('$Id', '$Name', '$Add', '$Tel', 'user', '$Class', '$password')";

		if (!mysqli_query($db,$sql))
			{
			 echo "<script>alert('Unsuccessfully registered Teachers!'); </script>";
			}else
			{
			 echo "<script>alert('Successfully registered Teachers!'); </script>";
			}
		}
	}

	//CHECK WHETER THE USER IT IS TEACHERS
	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	//VALIDATE LOGIN TO ADMIN SESSION
	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}
	//Update teachers account from admin
	function teachersUpdate(){
		global $db;
			
			$password_1 = $_POST['password_1'];
			$password_2 = $_POST['password_2'];

			if ($password_1 != $password_2) {
				$_SESSION['message'] = "Wrong Password combination!";
				header('location: teachers.php');
			}else{
				$password = md5($password_1);
				$id = $_POST['idGuru'];
				$Name = $_POST['nama'];
				$Add = $_POST['alamat'];
				$Tel = $_POST['notelefon'];
				mysqli_query($db, "UPDATE guru SET nama='$Name', alamat='$Add', notelefon='$Tel', password='$password' WHERE idGuru='$id'");
				$_SESSION['message'] = "Account Teachers updated!"; 
				header('location: teachers.php');
			}
			
	}
	//Update students account from admin
	function studentsUpdate(){
		global $db;
			$id = $_POST['idPelajar'];
			$Name = $_POST['nama'];
			$Add = $_POST['alamat'];
			$Tel = $_POST['notelefon'];
			mysqli_query($db, "UPDATE pelajar SET nama='$Name', alamat='$Add', notelefon='$Tel' WHERE idPelajar='$id'");
			$_SESSION['message'] = "Account Students updated!"; 
			header('location: students.php');
	}

	// ADD ATTENDANCES STUDENTS
	if(isset($_POST["action"]))
	{
		global $errors;
		if($_POST['action'] == "Add"){
			$Tarikh = $_POST['Tarikh'];
			if (empty($Tarikh)) { 
			echo "<script>alert('Date is required!'); </script>"; 
			}else{
				//CALL FUNCTION submitAttendance with $tarikh Arguments
				submitAttendance($Tarikh);
				echo "<script>alert('Successfully Insert Attendance!'); </script>";
			}	
		}
	}
		
	
	function submitAttendance($Tarikh){
			global $db;
			$idPelajar=$_POST['idPelajar'];
			//RECEIVE VALUE FROM FORM
			for ($count=0; $count < count($idPelajar) ; $count++) { 
			$data =array(
				//COLUMN Name     VALUES
				'idPelajar'		=>$idPelajar[$count],
				'Status'		=>$_POST['Status'.$idPelajar[$count].""],
				'Sebab'			=>$_POST['Sebab'.$idPelajar[$count].""],	
				'Tarikh'		=>$Tarikh,
				'idKelas'		=>$_SESSION['user']['idKelas']

			);
			$placeholders = array_fill(0, count($data), '?');
			$keys = array();
			$values = array();
			foreach ($data as $k => $v) {
				$keys[]=$k;
				$values[]= !empty($v) ? $v : null;
			}	
				$query = "INSERT INTO kehadiran ".
						'('.implode(', ',  $keys).') values '.
						'('.implode(', ',  $placeholders).'); ';

			$stmt = mysqli_prepare($db, $query);

			$params = array();
			foreach ($data as &$value) {
				$params[] = &$value;
			}
			//Bind params
			$types = array(str_repeat('s', count($params)));
			$values = array_merge($types, $params);

			call_user_func_array(array($stmt, 'bind_param'), $values);


			mysqli_execute($stmt);
			}
		}

	function fullReport(){
		global $db;
		$idKelas = $_POST['idKelas'];
		$ToTarikh =$_POST['reportTo_date'];
		$FromTarikh =$_POST['reportFrom_date'];
		$kelas = mysqli_query($db, "SELECT namaKelas from kelas where idKelas='$idKelas'");
		$query = mysqli_query($db, "SELECT idPelajar, nama, k.namaKelas from pelajar p, kelas k where k.idKelas=p.idKelas and p.idKelas='$idKelas'");
		if($FromTarikh != ""){
			if($ToTarikh != ""){
				$sql = mysqli_query($db, "SELECT * from kehadiran WHERE idKelas='$idKelas' and Tarikh between '$FromTarikh' and '$ToTarikh' GROUP by Tarikh");
				require("fpdf182/fpdf.php");
				$pdf = new FPDF('p', 'mm', 'A4');
		
				$pdf->SetFont('Arial', 'B', 14);
				$pdf->AddPage();

				$pdf->cell(40, 10, "Class Report ", 0, 1,'C');
				$pdf->cell(100, 10, "", 0, 1,'C');

				while ($Kelas = mysqli_fetch_array($kelas)) {
					$pdf->cell(40, 10, "Class 																 : ", 0, 0,'L');
					$pdf->cell(20, 10, $Kelas['namaKelas'], 0, 1, 'L');
				}
					$pdf->cell(40, 10, "Date   																 : ", 0, 0,'L');
					$pdf->cell(20, 10, "From ", 0, 0,'L');
					$pdf->cell(20, 10, $FromTarikh, 0, 0, 'L');
					$pdf->cell(30, 10, "to 				", 0, 0,'R');
					$pdf->cell(20, 10, $ToTarikh, 0, 1, 'L');

					$pdf->cell(40, 10, "Total Present 			 : ", 0, 0,'L');
					$countPresent = mysqli_query($db, "SELECT COUNT(Status) from kehadiran k, pelajar p where p.idPelajar=k.idPelajar and k.idKelas='$idKelas' and Status='Present' and Tarikh between '$FromTarikh' and '$ToTarikh' group by k.idKelas");
					while($count = mysqli_fetch_array($countPresent)){
						$pdf->cell(40, 10, $count['COUNT(Status)'], 0, 1,'L');
					}
					$pdf->cell(40, 10, "Total Absent 				 : ", 0, 0,'L');
					$countAbsent = mysqli_query($db, "SELECT COUNT(Status) from kehadiran k, pelajar p where p.idPelajar=k.idPelajar and k.idKelas='$idKelas' and Status='Absent' and Tarikh between '$FromTarikh' and '$ToTarikh' group by k.idKelas");
					while($Count = mysqli_fetch_array($countAbsent)){
						$pdf->cell(40, 10, $Count['COUNT(Status)'], 0, 1,'L');
					}
					$pdf->cell(0, 10, "", 0, 1,'C');
					$pdf->cell(40, 10, "Students Details", 0, 1,'L');
					

					$pdf->cell(20, 10, "ID", 1, 0,'C');
					$pdf->cell(50, 10, "Name", 1, 0,'C');
					$pdf->cell(30, 10, "Status", 1, 0,'C');
					$pdf->cell(60, 10, "Reasons", 1, 0,'C');
					$pdf->cell(30, 10, "Date", 1, 1,'C');
				while ($row = mysqli_fetch_array($sql)) {
					$subsql = mysqli_query($db, "SELECT p.idPelajar, p.nama, j.Status, k.namaKelas, j.Tarikh, j.Sebab from pelajar p, kelas k, kehadiran j where p.idPelajar=j.idPelajar and p.idKelas=k.idKelas and k.idKelas=j.idKelas and j.idKelas='$idKelas' and j.Tarikh='".$row['Tarikh']."' GROUP BY idPelajar");
					while ($subrow = mysqli_fetch_array($subsql)) {
					$pdf->cell(20, 10, $subrow['idPelajar'], 1, 0,'C');
					$pdf->cell(50, 10, $subrow['nama'], 1, 0,'C');
					$pdf->cell(30, 10, $subrow['Status'], 1, 0,'C');
					$pdf->cell(60, 10, $subrow['Sebab'], 1, 0,'C');
					$pdf->cell(30, 10, $subrow['Tarikh'], 1, 1,'C');
					}
				}
				$pdf->output();
			}
		}else
		{
			echo "<script>alert('*Date/Class required!'); </script>";
		}
		
	}

	function studentReport(){
		global $db;
		$idPelajar=$_POST['idPelajar'];
		$ToTarikh =$_POST['reportTo_date'];
		$FromTarikh =$_POST['reportFrom_date'];
		$query = mysqli_query($db, "SELECT idPelajar, nama, k.namaKelas from pelajar p, kelas k where k.idKelas=p.idKelas and idPelajar='$idPelajar'");
		if($FromTarikh != ""){
			if($ToTarikh != ""){
				$sql = mysqli_query($db, "SELECT * from kehadiran WHERE idPelajar='$idPelajar' and Tarikh between '$FromTarikh' and '$ToTarikh' GROUP by Tarikh");
				require("fpdf182/fpdf.php");
				$pdf = new FPDF('p', 'mm', 'A4');

				$pdf->SetFont('Arial', 'B', 14);
				$pdf->AddPage();

				while ($subquery=mysqli_fetch_array($query)) {
					$pdf->cell(40, 10, "Students Report ", 0, 1,'C');
					$pdf->cell(100, 10, "", 0, 1,'C');
					$pdf->cell(40, 10, "Student ID 							 : ", 0, 0,'L');
					$pdf->cell(43, 10, $idPelajar, 0, 1, 'L');
					$pdf->cell(40, 10, "Students Name : ", 0, 0,'L');
					$pdf->cell(60, 10, $subquery['nama'], 0, 1, 'L');
					$pdf->cell(40, 10, "Class 																 : ", 0, 0,'L');
					$pdf->cell(20, 10, $subquery['namaKelas'], 0, 1, 'L');
					$pdf->cell(40, 10, "Date   																 : ", 0, 0,'L');
					$pdf->cell(20, 10, $FromTarikh, 0, 0, 'L');
					$pdf->cell(30, 10, "to 				", 0, 0,'R');
					$pdf->cell(20, 10, $ToTarikh, 0, 1, 'L');
				}
				$pdf->cell(30, 20, "", 0, 1);
				$pdf->cell(30, 10, "Status", 1, 0, 'C');
				$pdf->cell(60, 10, "Reasons", 1, 0, 'C');
				$pdf->cell(30, 10, "Date", 1, 1, 'C');
				
				while ($row = mysqli_fetch_array($sql)) {
					$subsql = mysqli_query($db, "SELECT p.idPelajar, p.nama, j.Status, namaKelas, j.Tarikh, j.Sebab from pelajar p, kelas k, kehadiran j where p.idPelajar=j.idPelajar and k.idKelas=j.idKelas and j.idPelajar='$idPelajar' and j.Tarikh='".$row['Tarikh']."' GROUP BY idPelajar");
					while ($subrow = mysqli_fetch_array($subsql)) {
					$pdf->cell(30, 10, $subrow['Status'], 1, 0,'C');
					$pdf->cell(60, 10, $subrow['Sebab'], 1, 0,'C');
					$pdf->cell(30, 10, $subrow['Tarikh'], 1, 1,'C');
					}	
				}
				$pdf->cell(100, 10, "", 0, 1,'C');
				$pdf->cell(40, 10, "Total Present", 1, 1,'C');
				
				$countPresent = mysqli_query($db, "SELECT COUNT(Status) from kehadiran k, pelajar p where p.idPelajar=k.idPelajar and p.idPelajar='$idPelajar' and Status='Present' and Tarikh between '$FromTarikh' and '$ToTarikh' group by p.idPelajar");
				while($count = mysqli_fetch_array($countPresent)){
					$pdf->cell(40, 10, $count['COUNT(Status)'], 1, 1,'C');
				}
				$pdf->cell(30, 20, "", 0, 1);
				$pdf->cell(40, 10, "Total Absent", 1, 1,'C');
				$countAbsent = mysqli_query($db, "SELECT COUNT(Status) from kehadiran k, pelajar p where p.idPelajar=k.idPelajar and p.idPelajar='$idPelajar' and Status='Absent' and Tarikh between '$FromTarikh' and '$ToTarikh' group by p.idPelajar");
				while($Count = mysqli_fetch_array($countAbsent)){
					$pdf->cell(40, 10, $Count['COUNT(Status)'], 1, 1,'C');
				}
				$pdf->output();
			}
		}else
		{
			echo "<script>alert('*Date/Class required!'); </script>";
		}
	}

	//UPDATE TEACHERS AND ADMIN PROFILE
	function updateProfile(){
		global $db;

		// receive all input values from the form

		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($password_1) || empty($password_2)) {
			echo "<script>alert('Please enter password'); </script>";
		}else if ($password_1 != $password_2) {
			echo "<script>alert('Wrong Password combination'); </script>";
		}else{
			//if true == admin. Update profile admin
			if ($_SESSION['user']['user_type'] == 'admin') {
				$idAdmin = $_SESSION['user']['id'];
				$username    =  e($_POST['username']);
				$email       =  e($_POST['email']);
				$password = md5($password_1);
				if(empty($password)){
					$query = "UPDATE multi_login set username='$username', email='$email' where id='$idAdmin'";
				}else{
					$query = "UPDATE multi_login set username='$username', email='$email', password='$password' where id='$idAdmin'";
				}
				
				if(!mysqli_query($db,$query)){
					echo "<script>alert('Username already Taken!'); </script>";
				}else{
					$_SESSION['success'] = "Admin Profile Account updated!"; 
					header('location: index.php');
				}
			//Update teachers profile
			}else{
				$password = md5($password_1);
				$id = e($_POST['idGuru']);
				$Name = e($_POST['nama']);
				$Add = e($_POST['alamat']);
				$Tel = e($_POST['notelefon']);
				if(!mysqli_query($db, "UPDATE guru SET nama='$Name', alamat='$Add', notelefon='$Tel', password='$password' WHERE idGuru='$id'")){
					echo "<script>alert('Failure updating Profile Teachers!'); </script>";
				}else{
					$_SESSION['success'] = "Teachers Profile Account updated!"; 
					header('location: index.php');
				}
			}
		}
	}

?>
