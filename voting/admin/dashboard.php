<?php
session_start();
include('../koneksi.php');

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}


include('includes/header.php');

$id_admin = $_SESSION['id_admin'];

$sql = "SELECT * FROM admin WHERE id_admin = $id_admin";
$hasil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($hasil);
?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                    <label class="form-label"></label>
                </div>
            </div>
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
                <li class="nav-item d-flex align-items-center justify-content-center gap-3">
                    <p style="padding-top: 15px"><?= $data['username'] ?></p>
                    <a href="profile.php" style="cursor: pointer;" class="nav-link text-body font-weight-bold px-0">
                        <img src="imageAdmin.php?id=<?= $data['id_admin'] ?>"
                            style="width: 30px;cursor: pointer;border-radius: 100px;" alt="Profil Pengguna">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid py-4">
    <div class="row min-vh-80 h-100">
        <div class="col-12">

            <div class="container-fluid py-2">
                <div class="row mb-4">
                    <div class="ms-3">
                        <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
                        <p class="mb-4">
                            Semua informasi tentang Pemilihan Ketua Osis
                        </p>
                    </div>
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 pb-3">
                            <div class="card">
                                <div class="p-2 ps-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <?php
                                            $sql = "SELECT COUNT(*) as calon FROM calon_ketua";

                                            $hasil = mysqli_query($koneksi, $sql);
                                            $data = mysqli_fetch_assoc($hasil);
                                            ?>
                                            <p class="text-sm mb-0 text-capitalize">Jumlah Calon Ketua</p>
                                            <h4 class="mb-0">
                                                <?= $data['calon'] . ' Kandidat' ?>
                                            </h4>
                                        </div>
                                        <div
                                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                            <i class="material-symbols-rounded opacity-10">person</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 pb-3">
                            <div class="card">
                                <div class="p-2 ps-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <?php
                                                $sqlNamaCalon = "SELECT * FROM calon_ketua LIMIT 1";
                                                $calonResult = mysqli_query($koneksi, $sqlNamaCalon);
                                                $dataResult = mysqli_fetch_assoc($calonResult);
                                                ?>
                                                <p class="text-sm mb-0 text-capitalize">Peraih Vote Terbanyak
                                                </p>
                                                <h4 class="mb-0">

                                                    <?= htmlspecialchars($dataResult['nama']) ?>
                                                </h4>
                                            </div>
                                        </div>
                                        <div
                                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                            <i class="material-symbols-rounded opacity-10">crown</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 pb-3">
                            <div class="card">
                                <div class="p-2 ps-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <?php
                                                $sqlNamaCalon = "SELECT * FROM calon_ketua LIMIT 1";
                                                $calonResult = mysqli_query($koneksi, $sqlNamaCalon);

                                                if ($dataResult = mysqli_fetch_assoc($calonResult)) {
                                                    $id_calon = $dataResult['id_calon'];
                                                    $namaLengkap = $dataResult['nama'];
                                                    $nama = explode(' ', $namaLengkap)[0];

                                                    $sqlVote = "SELECT COUNT(*) AS jumlahVote FROM voting WHERE id_calon = $id_calon";
                                                    $voteResult = mysqli_query($koneksi, $sqlVote);
                                                    $jumlahVote = 0;

                                                    if ($row = mysqli_fetch_assoc($voteResult)) {
                                                        $jumlahVote = $row['jumlahVote'];
                                                    }
                                                    ?>
                                                    <p class="text-sm mb-0 text-capitalize">Jumlah Vote
                                                        <?= htmlspecialchars($nama) ?>
                                                    </p>
                                                    <h4 class="mb-0">
                                                        <?= $jumlahVote . ' Orang' ?>
                                                    </h4>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div
                                            class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                            <i class="material-symbols-rounded opacity-10">123</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-8 col-md-6 mb-md-0 mb-4 w-100">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="row">
                                        <div class="col-lg-6 col-7">
                                            <h6>Top Voting Terbanyak</h6>
                                            <p class="text-sm mb-0">
                                                <i class="fa fa-check text-info" aria-hidden="true"></i>
                                                <span class="font-weight-bold ms-1">
                                                    <?php
                                                    $sql = "SELECT COUNT(*) as jumlah_pemilih FROM voting";

                                                    $hasil = mysqli_query($koneksi, $sql);
                                                    $data = mysqli_fetch_assoc($hasil);

                                                    echo '<b>' . $data['jumlah_pemilih'] . '</b> Orang Telah Memilih';
                                                    ?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 pb-2">
                                    <div class="card-body px-0 pt-0 pb-2">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2">
                                                            No</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                                            Foto Calon</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                                            Nama Calon</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Jumlah Voting
                                                        </th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Detail
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $no = 1;


                                                    // Persentase
                                                    $total_sql = "SELECT COUNT(*) AS total FROM voting";
                                                    $total_hasil = mysqli_query($koneksi, $total_sql);

                                                    $total_data = mysqli_fetch_assoc($total_hasil);
                                                    $total_vote = $total_data['total'];

                                                    //sql
                                                    $sql = "SELECT calon_ketua.id_calon, calon_ketua.nama, COUNT(voting.id_calon) AS vote, calon_ketua.foto
                                                        FROM calon_ketua
                                                        LEFT JOIN voting ON calon_ketua.id_calon = voting.id_calon
                                                        GROUP BY calon_ketua.id_calon
                                                        ORDER BY vote DESC";

                                                    //eksekusi
                                                    $hasil = mysqli_query($koneksi, $sql);

                                                    //tampilkan dgn perulangan
                                                    foreach ($hasil as $data) {
                                                        $percent = $total_vote > 0 ? number_format(($data['vote'] / $total_vote) * 100, 2) : 0;
                                                        ?>
                                                        <tr>
                                                            <td class="align-middle text-center fw-bold p-3">
                                                                <?= $no++ ?>
                                                            </td>
                                                            <td class="align-middle text-center fw-bold p-3">
                                                                <img src="image.php?id=<?= $data['id_calon'] ?>"
                                                                    style="width: 100px;" class="card-img">
                                                            </td>
                                                            <td class="fw-medium text-center p-3">
                                                                <?= $data['nama'] ?>
                                                            </td>
                                                            <td class="fw-medium text-center p-3">
                                                                <?= $data['vote'] ?> (<?= $percent . '%' ?>)
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <a href="detailLaporan.php?id_calon=<?= $data['id_calon'] ?>"
                                                                        class="btn bg-gradient-success">Detail
                                                                        Voting</a>
                                                            </td>

                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>