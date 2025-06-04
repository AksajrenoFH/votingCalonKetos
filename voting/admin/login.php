<?php

session_start();
include "../koneksi.php";

if(isset($_SESSION['id_admin'])){
    header("Location: dashboard.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

    $result = mysqli_query($koneksi, $query);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id_admin'] = $row['id_admin'];
        $_SESSION['username'] = $row['username'];
        header('Location: dashboard.php');
    } else {
        $error = "Login Gagal. Username atau Password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="image/png" href="assets/img/logo-smk-pesat.png">
<title>
    Log In | SMK Pesat ITXPro
</title>
</style>

<head>
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            cursor: default;
        }

        body {
            color: rgb(233, 233, 233);
            flex-direction: column-reverse;
            display: flex;
            min-height: 100dvh;
            justify-content: center;
            align-items: center;
            gap: calc(16px * 1.618);
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url(https://t4.ftcdn.net/jpg/06/91/05/19/360_F_691051962_GFhQPOAXABmf7l706q89b2PFh6FnB1kI.jpg);
        }

        .error {
            color: red;
            font-weight: 900;
            text-align: center;
        }

        div {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 400px;
            min-width: 300px;
            background-color: rgba(44, 44, 44, 0.52);
            margin: 0;
            padding: 0;
            border-radius: 16px;
            border: 5px inset grey;
        }

        form {
            margin-top: calc(16px * 1.618 * 1.618);
            display: flex;
            flex-direction: column;
        }

        form span,
        form input {
            border-radius: calc(8px / 1.618);
        }

        form input {
            min-height: 30px;
            min-width: 250px;
            border: 1px solid black;
        }

        form input[type=text],
        form input[type=password] {
            cursor: text;
            padding: 0 10px;
        }

        form input[type=text]:focus,
        form input[type=password]:focus {
            outline: 2px solid rgb(192, 199, 221)
        }

        form input[type=submit] {
            cursor: pointer;
            background-color: rgb(107, 110, 92);
            color: rgb(192, 199, 221);
            font-weight: 900;
            transition: all 200ms ease-in-out;
        }

        form input[type=submit]:hover {
            background-color: rgb(75, 77, 65);
            color: rgb(192, 173, 221);
        }

        form input[type=submit]:active {
            transform: scale(0.95);
        }

        a {
            color: rgb(192, 199, 221);
            font-weight: 700;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php if (!empty($error)): ?>
        <span class="error"><?= $error ?></span>
    <?php endif; ?>
    <div>
        <h1>LOGIN</h1>
        <form method="post">
            <span>Username</span> <br> <input type="text" name="username" required /><br />
            <span>Password</span> <br> <input type="password" name="password" required /><br />
            <input type="submit" value="Login" />
        </form><br>
    </div>
</body>

</html>