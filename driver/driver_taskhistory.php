<!DOCTYPE html>
<html>
<head>
    <title>Driver Task History</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Driver Task History</h1>
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
            <th>Photo</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "minibus"; // Replace with your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
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
                $photo = $row['photo']; // Assuming you have a 'photo' column in the 'reservation' table

                echo "<tr>";
                echo "<td>$name</td>";
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

                if (!empty($photo)) {
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($photo) . "' height='100'></td>";
                } else {
                    echo "<td>No photo available</td>";
                }

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='12'>No approved reservations found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <form action="../index.html" method="POST">
    <input type="submit" name="logout" value="Logout">
</form>
</body>
</html>
