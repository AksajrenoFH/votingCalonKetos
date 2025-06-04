<?php
include('includes/header.php');
include('../koneksi.php');

$id_calon = $_GET['id_calon'];

$sql = "SELECT nama FROM calon_ketua WHERE id_calon = $id_calon";
$hasil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($hasil);
?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Detail</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                    <?= $data['nama']?>
                </li>
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
                    <h6>Perolehan Voting <span style="color: #f44335;"><?= $data['nama']?></span></h6>
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
                                //sql
                                $sql = "SELECT calon_ketua.nama AS calon, waktu, calon_ketua.id_calon
                                    FROM voting
                                    INNER JOIN calon_ketua ON voting.id_calon = calon_ketua.id_calon
                                    WHERE calon_ketua.id_calon = $id_calon
                                    GROUP BY calon_ketua.nama, waktu
                                    ORDER BY waktu DESC;";

                                //eksekusi
                                $hasil = mysqli_query($koneksi, $sql);

                                //tampilkan dgn perulangan
                                foreach ($hasil as $data) {
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>