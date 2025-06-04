<?php
include("../koneksi.php");

$berhasil = false;
// $error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $visi = $_POST["visi"];

    $namaFile = $_FILES['foto']['name'];
    $tmpFile = $_FILES['foto']['tmp_name'];
    $folder = '../admin/assets/uploads/';

    $namaBaru = uniqid() . '_' . $namaFile;

    if (move_uploaded_file($tmpFile, $folder . $namaBaru)) {
        //sql
        $sql = "INSERT INTO calon_ketua (nama, kelas, visi, foto) VALUES ('$nama', '$kelas','$visi', '$namaBaru')";

        //eksekusi
        $simpan = mysqli_query($koneksi, $sql);

        if ($simpan) {
            $berhasil = true;
        } else {
        }
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
            margin: 0 16px;
        }

        form input {
            border-radius: 8px !important;
            border: 1px solid black !important;
            padding: 4px 8px !important;
            width: calc(160px * 1.618 * 1.618) !important;
        }

        .upload-box {
            width: 100%;
            max-width: 300px;
            height: 300px;
            border: 2px dashed #aaa;
            border-radius: 8px;
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
        }

        .upload-box input[type="file"] {
            display: none;
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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tambah</li>
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
                            <h6>Tambah Admin Dashboard Osis</h6>

                            <form method="post" enctype="multipart/form-data">
                                <div class="row mt-3">
                                    <div class="col-md-8">
                                        <div>
                                            <label for="example-text-input" class="form-control-label">Nama
                                                Lengkap</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Nama Lengkap" name="nama">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div>
                                            <label for="example-text-input" class="form-control-label">Kelas</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Kelas" name="kelas">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div>
                                            <label for="example-text-input" class="form-control-label">Visi</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Visi" name="visi">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div>
                                            <label for="foto" class="form-label">Foto</label>
                                            <div class="upload-box" onclick="document.getElementById('foto').click()">
                                                <img src="assets/img/image-.png" alt="Preview" id="preview">
                                                <input type="file" name="foto" id="foto" accept="image/*"
                                                    onchange="previewFoto(event)">
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary mt-3 w-10">Simpan</button>
                                <a href="calon.php" type="button" name="kembali"
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
                title: "Berhasil Ditambah!",
                text: "Data Berhasil Disimpan!",
                icon: "success",
                button: "OK",
            }).then(() => {
                window.location.href = "calon.php";
            });
        </script>
    <?php endif; ?>
    <!-- foto -->
    <script>
        function previewFoto() {
            const img = document.getElementById('preview');
            const file = event.target.files[0];
            if (file) {
                img.src = URL.createObjectURL(file);
            }
        }
    </script>
</body>

</html>