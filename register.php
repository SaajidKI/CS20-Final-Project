<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);
    $result = $stmt->execute();

    if ($result) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato');

        body {
            background-color: #F7DB6A;
            font-family: 'Lato', sans-serif;
        }

        .register-box {
            width: 400px;
            height: 450px;
            margin: 150px auto 0;
            padding: 20px;
            background-color: #fff;
            border-radius: 7px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #5A5A5A;
            font-size: 30px;
        }

        input[type="text"],
        input[type="password"] {
            display: block;
            text-align: left;
            padding: 20px 10px 20px 10px;
            width: 100%;
            margin: 25px 0 10px 0;
            background-color: #f2f2f2;
            border-style: none;
            border-radius: 3px;
            font-size: 16px;
        }

        input::placeholder {
            opacity: .8;
            color: gray;
            padding-left: 5px;
        }

        .input {
            padding: 10px 15px 10px 15px;
            margin-right: 18px;
        }

        button[type="submit"] {
            background-color: #7AA874;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 20px;
            padding: 20px 160px 20px 160px;
        }

        button[type="submit"]:hover {
            background-color: #539165;
        }

        .button {
            text-align: center;
            margin-top: 35px;
            margin-left: 3px;
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Register</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="button">
                <button type="submit">Register</button>
            </div>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>
