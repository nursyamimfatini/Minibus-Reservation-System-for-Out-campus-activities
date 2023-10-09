<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
        body {
            background-image: url("images/yellowbus.jpeg");
            background-size: contain;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
		
        .button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #f44336;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin: 40px;
            font-size: 20px;
        }

        .button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <a href="operator/operator_loginregister.php" class="button">Operator</a>
	<br>
    <a href="driver/driver_loginregister.php" class="button">Driver</a>
</body>
</html>

