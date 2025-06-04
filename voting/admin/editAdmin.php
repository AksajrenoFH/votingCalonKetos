<?php
include('../koneksi.php');

$berhasil = false;

$id_admin = $_GET['id_admin'];

$sql = "SELECT * FROM admin WHERE id_admin = '$id_admin'";

$simpan = mysqli_query($koneksi, $sql);

$ambil_data = mysqli_fetch_assoc($simpan);

if (isset($_POST['simpan'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];

    $update = "UPDATE admin SET nama_lengkap='$nama_lengkap', username='$username' WHERE id_admin = '$id_admin'";

    $simpan = mysqli_query($koneksi, $update);

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
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">

    <?php
    include('includes/sidebar.php')
        ?>


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg py-4">

        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit</li>
                    </ol>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <ul class="navbar-nav d-flex align-items-center  justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Edit Data Admin <span style="color: #e91e63;"><?= $ambil_data['nama_lengkap'] ?></span>
                            </h6>

                            <form method="post" enctype="multipart/form-data">
                                <div class="row mt-3">
                                    <div class="col-md-8">
                                        <div>
                                            <label>Nama Lengkap</label><br>
                                            <input type="text" placeholder="Nama Lengkap" name="nama_lengkap"
                                                value="<?= $ambil_data['nama_lengkap'] ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div>
                                            <label>Username</label><br>
                                            <input type="text" placeholder="Username" name="username"
                                                value="<?= $ambil_data['username'] ?>" required>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary mt-3 w-10">Simpan</button>
                                <a href="admin.php" type="button" name="kembali"
                                    class="btn btn-secondary mt-3 w-10">Kembali</a>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Aksajreno
                                FH</a>
                            X RPL
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://github.com/AksajrenoFH" class="nav-link pe-0 text-muted"
                                    target="_blank">About</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    </main>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
    if ($berhasil): ?>
        <script>
            swal({
                title: "Berhasil Diubah!",
                text: "Data Berhasil Disimpan!",
                icon: "success",
                button: "OK",
            }).then(() => {
                window.location.href = "admin.php";
            });
        </script>
    <?php endif; ?>
    <!-- foto -->
    <script>
        const uploadBox = document.querySelector('.upload-box');
        const fileInput = uploadBox.querySelector('input[type="file"]');
        const imgPreview = uploadBox.querySelector('img');

        uploadBox.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    imgPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>