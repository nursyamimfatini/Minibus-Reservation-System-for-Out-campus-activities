<?php
	//using session to track user information
	session_start();
	

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<?php 
		include("../conn.php"); 
	?>
</head>
<body>
	<?php
	$driver_ic = $_POST['driver_ic'];
	$driver_pass = $_POST['driver_pass'];

	$query = "SELECT * FROM driver WHERE driver_ic = '" .$driver_ic. "' AND driver_pass  = '" .$driver_pass. "'";

	$result = mysqli_query($conn, $query);
	$checkRow = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);

	if ($checkRow == 0) {
			?>
			<!--informing the user the error has occured-->
			<script>alert("Login failed!\nYour password did not match with IC number or you have not registered");</script>
			<?php
		    echo "<meta http-equiv=\"refresh\" content=\"1;URL=driver_loginregister.php\"/>";
		} else {
			//login success or student
			//forward to the student home page
			echo "<meta http-equiv=\"refresh\" content=\"1;URL=driver_task.php\"/>";

			//pass the user information via session
			$_SESSION["driver_ic"] = $row["driver_ic"];
			$_SESSION["driver_pass"] = $row["driver_pass"];
			$_SESSION["log"] = 1;
		}
	?>
</body>
</html>