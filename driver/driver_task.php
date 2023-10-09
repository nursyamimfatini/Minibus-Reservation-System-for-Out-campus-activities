<?php error_reporting(0); ?> 
<?php
	//using session to track user information
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Driver Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
			background-color: #fdd017;
			background-image: url('yell.jpg');
			background-repeat:no-repeat;
			background-size: 100% 10%;
        }

        h1 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            font-size: 14px; /* Adjust the font size as desired */
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 5px solid #dDD;
            border-radius: 10px;
        }

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #FFFF00;
            border-radius: 5px;
        }

        tr:nth-child(even) {
            background-color: #FEFBBD;
        }
		
        form {
            margin-bottom: 20px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button {
            padding: 10px 20px;
            background-color: #008CBA;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #005B82;
        }

        img.photo {
            border-radius: 10px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            table {
                font-size: 12px;
            }
        }

        @media (max-width: 600px) {
            table {
                font-size: 10px;
            }
        }
		
    h1 {
        text-align: center;
        margin-bottom: 5px;
		padding-top: 50px;
		
    }
a.logout-link {
            color: white;
            text-decoration: none;
        }

        a.logout-link:hover {
            /* Add hover styles if needed */
        }
    </style>
</head>
<body>
    <center><h1>Driver Task</h1></center>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <div style="overflow-x: auto;">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Semester</th>
                    <th>Purpose</th>
                    <th>Passengers</th>
                    <th>Pickup</th>
                    <th>Destination</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Departure Time</th>
                    <th>Pickup Time</th>
                    <th>Date Booked</th>
                    <th>Upload Photo</th>
                    <th>Photo</th>
                </tr>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "minibus";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $id = $_POST['id'];
                    $jum = count($id);
                    for ($i = 0; $i < $jum; $i++) {
                        $photo[$i] = $_FILES['photo']['tmp_name'][$i];
                        $photoName[$i] = $_FILES['photo']['name'][$i];
                        $folder_path = "./photo/";
                        move_uploaded_file($_FILES['photo']['tmp_name'][$i], $folder_path . $photoName[$i]);
                        if ($photoName[$i] <> '') {
                            $insertSql = "UPDATE reservation SET photo='$photoName[$i]' WHERE res_no='$id[$i]'";
                            if ($conn->query($insertSql) === TRUE) {
                                echo "<script>alert('Photo uploaded successfully.');</script>";
                            } else {
                                $errorMessage = "Error uploading photo: " . $conn->error;
                                echo "<script>alert('$errorMessage');</script>";
                            }
                        }
                    }
                }

                $sql = "SELECT * FROM reservation WHERE status='approved'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $semester = $row['semester'];
                        $purpose = $row['purpose'];
                        $passengers = $row['passengers'];
                        $pickup = $row['pickup'];
                        $destination = $row['destination'];
                        $fromdate = $row['fromdate'];
                        $todate = $row['todate'];
                        $departuretime = $row['departuretime'];
                        $pickuptime = $row['pickuptime'];
                        $datebooked = $row['datebooked'];

                        echo "<tr>";
                        echo "<td>$name<input type='hidden' name='id[]' value='" . $row['res_no'] . "'></td>";
                        echo "<td>$semester</td>";
                        echo "<td>$purpose</td>";
                        echo "<td>$passengers</td>";
                        echo "<td>$pickup</td>";
                        echo "<td>$destination</td>";
                        echo "<td>$fromdate</td>";
                        echo "<td>$todate</td>";
                        echo "<td>$departuretime</td>";
                        echo "<td>$pickuptime</td>";
                        echo "<td>$datebooked</td>";
                        echo "<td><input type='file' name='photo[]' onchange='setId(" . $row['res_no'] . ");'></td>";
                        echo '<td><img src="./photo/' . $row['photo'] . '" class="photo" width="115" height="158" /></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No approved reservations found.</td></tr>";
                }

                $conn->close();
                ?>
            </table>
        </div>
        <input type="hidden" name="id_res" id="id_res" value="" />
        <br>
        <center>
            <input type="submit" name="submit" value="Submit">
            
			 <button><a class="logout-link" href="http://localhost/minibusres/index.html">Logout</a></button>
			
        </center>
    </form>

    <script>
        function logout() {
            // Perform logout functionality here
            window.location.href = "http://localhost/minibusres/index.html";
        }

        function setId(resNo) {
            document.getElementById("id_res").value = resNo;
        }
    </script>
</body>
</html>
