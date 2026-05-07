<?php
include 'main.php';

$message = "";
$toastClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists
    $checkEmailStmt = $conn->prepare("SELECT email FROM userdata WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();

    if ($checkEmailStmt->num_rows > 0) {
        $message = "Email ID already exists";
        $toastClass = "#007bff"; // Primary color
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO userdata (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            $message = "Account created successfully";
            $toastClass = "#28a745"; // Success color
        } else {
            $message = "Error: " . $stmt->error;
            $toastClass = "#dc3545"; // Danger color
        }

        $stmt->close();
    }

    $checkEmailStmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <!-- External CSS -->
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
            <a href="home.html">Home</a>
            <button class="loginbutton">Login</button>
        </nav>
    </header>

    <div class="wrapper">
        <div class="form-box">
            <h2>Create Your Account</h2>
            <?php if ($message): ?>
                <div class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: <?php echo $toastClass; ?>;">
                    <div class="d-flex">
                        <div class="toast-body">
                            <?php echo $message; ?>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>
            <form method="post">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>
                    </span>
                    <input type="text" name="username" required placeholder="Username">
                    <label>Username</label>
                </div>
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
                <button type="submit" class="loginbutton">Create Account</button>
                <div class="login-register">
                    <p>Already have an account? <a href="newlogin.php" class="register-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
