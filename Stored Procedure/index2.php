<?php
//STORED PROCEDURE PHP CODE
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "sqli";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die("Unable to connect");
}

if ($_POST) {
    $uname = $_POST["username"];
    $pass = $_POST["password"];

    // Use the mysqli extension to create a prepared statement
    $stmt = mysqli_prepare($conn, "CALL sp_LoginCheck(?, ?, @login_result)");
    
    // Bind input parameters
    mysqli_stmt_bind_param($stmt, 'ss', $uname, $pass);

    // Execute the stored procedure
    mysqli_stmt_execute($stmt);
    
    // Retrieve the output parameter
    $select = mysqli_query($conn, "SELECT @login_result AS login_result");
    $result = mysqli_fetch_assoc($select);

    if ($result['login_result'] == 1) {
        echo "Welcome, user!";
    } else {
        echo "Incorrect Username/Password";
    }
    
    // Close the statement
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Portal</title>
    <style type="text/css">
        input[type=text], input[type=password] {
            padding: 16px;
            margin: 8px;
            border: 1px solid #f1f1f1;
            letter-spacing: 1px;
            border-radius: 3px;
            width: 240px;
        }
        input[type=submit] {
            margin-left: 8px;
            width: 274px;
            border-radius: 3px;
            border: 1px solid #4285f4;
            background-color: #4285f4;
            padding: 16px;
            color: white;
            font-weight: 600;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action method="POST" autocomplete="off">
        <input type="text" name="username" placeholder="Username" /><br />
        <input type="password" name="password" placeholder="********" /><br />
        <input type="submit" name="login" value="LOGIN" />
    </form>
</body>
</html>