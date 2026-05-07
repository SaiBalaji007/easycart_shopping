<?php
include 'main.php';


$message = "";
$toastClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    $stmt = $conn->prepare("SELECT password FROM userdata WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_password);
        $stmt->fetch();

        if ($password === $db_password) {
            $message = "Login successful";
            $toastClass = "bg-success";
            
            session_start();
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Incorrect password";
            $toastClass = "bg-danger";
        }
    } else {
        $message = "Email not found";
        $toastClass = "bg-warning";
    }

    $stmt->close();
    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url("https://t3.ftcdn.net/jpg/04/27/00/82/360_F_427008286_oy2mbXUpD0yXUKAUyf1TQ4zfMnFQeYrJ.jpg") no-repeat;
            background-size: cover;
            background-position: center;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px 100px;
            display: flex;
            align-items: center;
            z-index: 99;
        }

        .logo img {
            height: 40px;
        }

        nav {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        .loginbutton {
            padding: 10px 20px;
            background-color: #fff;
            color: #8f78a8;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .loginbutton:hover {
            background-color: #7e68a0;
            color: white;
        }

        .wrapper {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 8px;
            width: 300px;
        }

        .form-box {
            display: flex;
            flex-direction: column;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .input-box {
            position: relative;
            margin-bottom: 20px;
        }

        .input-box input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        .input-box input:focus {
            border-color: #8f78a8;
        }

        .input-box label {
            position: absolute;
            top: 12px;
            left: 40px;
            font-size: 16px;
            color: #888;
            transition: 0.3s ease;
        }

        .input-box input:focus + label,
        .input-box input:not(:placeholder-shown) + label {
            top: -8px;
            left: 40px;
            font-size: 12px;
            color: #8f78a8;
        }

        .input-box .icon {
            position: absolute;
            top: 12px;
            left: 15px;
            color: #888;
        }
    </style>
</head>
<body>

<header>
    <a class="logo" href="#">
        <img src="C:\Users\balaj\OneDrive\Pictures\newlogo.png" alt="Logo">
    </a>
    <nav class="navigation">
        <a href="http://localhost/DBW%20project/mainhome.html">Home</a>
        <button class="loginbutton">Login</button>
    </nav>
</header>

<div class="wrapper">
    <div class="form-box">
        <h2>Login</h2>
        <form action="" method="post">
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="mail-outline"></ion-icon>
                </span>
                <input type="email" name="email" required placeholder="Email">
                <label>Email</label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                </span>
                <input type="password" name="password" required placeholder="Password">
                <label>Password</label>
            </div>
            <button type="submit" class="loginbutton">Login</button>
            <div class="remember-forgot">
                <label><input type="checkbox" name="remember">
                Remember me</label>
                <a href="forgot_password.php">Forgot Password?</a>
            </div>
            <div class="login-register">
                <p>Don't have an account? <a href="newreg.php" class="register-link">Register</a></p>
            </div>
        </form>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl, { delay: 3000 });
    });
    toastList.forEach(toast => toast.show());
</script>

</body>
</html>
