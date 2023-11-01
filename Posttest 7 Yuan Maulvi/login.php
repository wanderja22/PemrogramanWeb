<?php
require 'koneksi.php';

session_start();

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
                $token = bin2hex(random_bytes(16));

                setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/');
                $update_token_query = "UPDATE users SET remember_token=? WHERE username=?";
                $update_token_stmt = mysqli_prepare($koneksi, $update_token_query);
                mysqli_stmt_bind_param($update_token_stmt, "ss", $token, $username);
                mysqli_stmt_execute($update_token_stmt);
                mysqli_stmt_close($update_token_stmt);
            }

            $_SESSION['username'] = $username;
            header("Location: tambah.php");
            exit();
        } else {
            $error_message = 'Password salah';
        }
    } else {
        $error_message = 'Username tidak valid';
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #171a21;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #1b2838;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .logo img {
            width: 200px;
            height: auto;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid #3f87f5;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #1b2838;
            color: white;
        }

        button {
            background-color: #3f87f5;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #305f8c;
        }

        .signup-link {
            color: #3f87f5;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            display: inline-block;
        }

        .notification {
            display: none;
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ff6666;
            color: white;
            padding: 15px;
            border-radius: 5px;
            z-index: 9999;
            animation: fadeIn 0.5s ease-out;
        }

        .show-notification {
            display: block;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="notification <?php echo !empty($error_message) ? 'show-notification' : ''; ?>">
        <?php echo $error_message; ?>
    </div>
    <div class="container">
        <div class="logo">
            <img src="Image/buahlogo.png" alt="Buah Logo">
        </div>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="text" id="username" name="username" placeholder="Username" required><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <a class="signup-link" href="register.php">Create account</a>
    </div>
</body>

</html>