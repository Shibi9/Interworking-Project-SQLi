<?php
//PREPARED STATEMENT (with PARAMETERIZED QUERIES)
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "sqli";
$conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
if (!$conn) {
    die("Unable to connect");
}

if ($_POST) {
    $uname = $_POST["username"];
    $pass = $_POST["password"];
    $sql = "SELECT * FROM users WHERE username = :uname AND password = :pass";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':uname', $uname, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
        echo "Welcome, user!";
    } else {
        echo "Incorrect Username/Password";
    }
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
            font-family: Arial, sans-serif;
        }
        input[type=submit] {
            margin-left: 8px;
            width: 274px;
            border-radius: 3px;
            border: 1px solid #FF5733;
            background-color: #FF5733;
            padding: 16px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" /><br>
        <input type="password" name="password" placeholder="********" /><br>
        <input type="submit" name="login" value="LOGIN">
    </form>
</body>
</html>