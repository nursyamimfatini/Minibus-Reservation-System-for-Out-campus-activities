<?php
	//using session to track user information
	session_start();
	
	
?>
<!DOCTYPE html>
<html>
 
<head>
    <title> Register page</title>
</head>
 
<body>
    <center>
        <?php
 
        // servername => localhost
        // username => root
        // password => empty
        // database name => minibus
        $conn = mysqli_connect("localhost", "root", "", "minibus");
         
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
         
        // Taking all 5 values from the form data(input)
        $driver_ic =  $_POST['driver_ic'];
        $driver_pass = $_POST['driver_pass'];
        $driver_name =  $_POST['driver_name'];
		$driver_address =  $_POST['driver_address'];
        $driver_phonenum = $_POST['driver_phonenum'];
        $driver_minibusnum =  $_POST['driver_minibusnum'];
         
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO driver VALUES ('".$driver_ic."','".$driver_pass."','".$driver_name."', '".$driver_address."', '".$driver_phonenum."', '".$driver_minibusnum."')";
         
		 mysqli_query($conn, $sql);
				header('location: driver_loginregister.php');
				
       if (mysqli_query($conn, $sql)) {
			    echo "Data inserted successfully.";
			    echo "<meta http-equiv=\"refresh\" content=\"2;URL=driver_loginregister.php\"/>";
			 
			} else {
			    echo "Error inserting data: " . mysqli_error($conn);
			}

        // Close connection
        mysqli_close($conn);
        ?>
    </center>
</body>
 
</html>