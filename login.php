<?php
session_start();
include "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION["user_id"] = $id;
        header("Location: HomePage.html");
    } else {
        $error = "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato');

        body {
            background-color: #F7DB6A;
            font-family: 'Lato', sans-serif;
        }

        .login-box {
            width: 400px;
            height: 400px;
            margin: 200px auto 0;
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
    <div class="login-box">
        <h2>Login</h2>
        <?php if ($error): ?>
            <div class="error">
                <p><?php echo $error; ?></p>
            </div>
        <?php endif; ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="button">
                <button type="submit">Login</button>
            </div>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>
</html>
