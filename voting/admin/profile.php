<?php
session_start();
include('../koneksi.php');

$berhasil = false;

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}

$id_admin = $_SESSION['id_admin'];

$sql = "SELECT * FROM admin WHERE id_admin = $id_admin";
$hasil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($hasil);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if ($_FILES['profil']['size'] > 0) {
        $foto = addslashes(file_get_contents($_FILES['profil']['tmp_name']));
        $query = "UPDATE admin SET nama_lengkap='$nama', username='$username', password='$password', foto='$foto' WHERE id_admin = $id_admin";
    } else {
        $query = "UPDATE admin SET nama_lengkap='$nama', username='$username', password='$password' WHERE id_admin = $id_admin";
    }

    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        $berhasil = true;
    } else {
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/logo-smk-pesat.png">
    <title>
        SMK Pesat ITXPro
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/material-dashboard.min.css" rel="stylesheet" />
    <style>
        body {
            overflow-x: hidden;
        }

        form {
            padding: 0 16px;
        }

        form input {
            border-radius: 8px;
            border: 1px solid black;
            padding: 4px 8px;
        }

        form input[type="text"] {
            width: 50vw;
        }

        .upload-box {
            width: 100%;
            max-width: 150px;
            height: 150px;
            border: 2px solid #aaa;
            border-radius: 100px;
            cursor: pointer;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9f1;
        }

        .upload-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
            border-radius: 100px;
        }

        .upload-box input[type="file"] {
            display: none;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">

        <?php
        include("includes/profileSidebar.php");
        ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg py-4">


        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Profile</h6>
                        </div>
                        <form method="post" action="profile.php" enctype="multipart/form-data">
                            <div class="card-body px-0 pt-0 pb-2">
                                <!-- Foto Profil -->
                                <div class="row mt-3">
                                    <div class="col-md-8">
                                        <div class="upload-box">
                                            <img src="imageAdmin.php?id=<?= $data['id_admin'] ?>" alt="Profil Pengguna">
                                            <input type="file" name="profil" id="profil" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <!-- Nama Lengkap -->
                                <div class="row mt-3">
                                    <div class="mb-3 col-md-8">
                                        <div>
                                            <label>Nama Lengkap</label><br>
                                            <input type="text" placeholder="Nama Lengkap" name="nama"
                                                value="<?= $data['nama_lengkap'] ?>">
                                        </div>
                                    </div>
                                    <!-- Username -->
                                    <div class="mb-3 col-md-8">
                                        <div>
                                            <label>Username</label><br>
                                            <input type="text" placeholder="Username" name="username"
                                                value="<?= $data['username'] ?>">
                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="mb-3 col-md-8">
                                        <div>
                                            <label>Password</label><br>
                                            <input type="text" placeholder="Password" name="password"
                                                value="<?php ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- Save -->
                                <button type="submit" name="save" class="btn btn-primary mt-3 w-10">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    include('includes/footerSidebar.php');
    ?>