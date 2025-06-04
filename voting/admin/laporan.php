<?php
session_start();
include('../koneksi.php');
include('includes/header.php');

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}

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
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Laporan</li>
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

    <div class="row mb-4">
        <div class="row d-flex justify-content-between">

            <?php
            include('../koneksi.php');

            $sql_calon = "SELECT * FROM calon_ketua";
            $calon_result = mysqli_query($koneksi, $sql_calon);

            foreach ($calon_result as $calon) {
                $no = 1;

                $id_calon = $calon['id_calon'];
                $nama_calon = $calon['nama'];
                $namaDepan = explode(' ', $nama_calon)[0];

                $sql_vote = "SELECT COUNT(*) as jumlahVote FROM voting WHERE id_calon = $id_calon";
                $vote_result = mysqli_query($koneksi, $sql_vote);
                $jumlah_vote = 0;

                if ($row = mysqli_fetch_assoc($vote_result)) {
                    $jumlah_vote = $row['jumlahVote'];
                }
                ?>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="p-2 ps-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-sm mb-0 text-capitalize">Jumlah Vote <?= $namaDepan ?>
                                    </p>
                                    <h4 class="mb-0"><?= $jumlah_vote ?> Orang</h4>
                                </div>
                                <div
                                    class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">how_to_vote</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>


        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 mb-3">
                    <h5>Laporan Voting</h5>
                    <span class="font-weight-bold ms-1" style="font-size: calc(32px / 1.618 / 1.618);">
                        <?php
                        $sql = "SELECT COUNT(*) as jumlah_pemilih FROM voting";

                        $hasil = mysqli_query($koneksi, $sql);
                        $data = mysqli_fetch_assoc($hasil);

                        echo '<b>' . $data['jumlah_pemilih'] . '</b> Orang Telah Memilih Calon';
                        ?>
                    </span>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2">
                                        Siswa ke-</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Nama Calon yang Dipilih</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Waktu
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                $batas = 10;
                                $halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
                                $halamanAwal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                                $previous = $halaman - 1;
                                $next = $halaman + 1;

                                //sql
                                $sql = "SELECT calon_ketua.nama AS calon, waktu
                                    FROM voting
                                    INNER JOIN calon_ketua ON voting.id_calon = calon_ketua.id_calon
                                    GROUP BY calon_ketua.nama, waktu
                                    ORDER BY waktu DESC;";

                                //eksekusi
                                $hasil = mysqli_query($koneksi, $sql);
                                $jumlahData = mysqli_num_rows($hasil);
                                $totalHalaman = ceil($jumlahData / $batas);

                                $sqlLaporan = "SELECT calon_ketua.nama AS calon, waktu
                                    FROM voting
                                    INNER JOIN calon_ketua ON voting.id_calon = calon_ketua.id_calon
                                    GROUP BY calon_ketua.nama, waktu
                                    ORDER BY waktu DESC
                                    LIMIT $halamanAwal, $batas";
                                $hasilLaporan = mysqli_query($koneksi, $sqlLaporan);
                                $nomor = $halamanAwal + 1;

                                //tampilkan dgn perulangan
                                foreach ($hasilLaporan as $data) {
                                    ?>
                                    <tr>
                                        <td class="align-middle text-center fw-bold p-3">
                                            <?= $no++ ?>
                                        </td>
                                        <td class="fw-medium text-center p-3">
                                            <?= $data['calon'] ?>
                                        </td>
                                        <td class="fw-medium text-center p-3">
                                            <?= $data['waktu'] ?>
                                        </td>

                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" <?php if ($halaman > 1) {
                                        echo "href='?halaman=$previous'";
                                    } ?>>
                                        <i class="material-symbols-rounded opacity-5">chevron_left</i>
                                    </a>
                                </li>
                                <?php
                                for ($x = 1; $x <= $totalHalaman; $x++) {
                                    ?>
                                    <li class="page-item">
                                        <a href="?halaman=<?= $x ?>" class="page-link">
                                            <?= $x ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li class="page-item">
                                    <a class="page-link" <?php if ($halaman < $totalHalaman) {
                                        echo "href='?halaman=$next' ";
                                    } ?>>
                                        <i class="material-symbols-rounded opacity-5">chevron_right</i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>