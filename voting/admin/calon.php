<?php
session_start();
include('../koneksi.php');
include('includes/header.php');

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM calon_ketua WHERE id_calon = $id";
    $koneksiResult = $koneksi->query($sql);

    if ($ambilData = $koneksiResult->fetch_assoc()) {
        header("Content-Type: image/jpeg");
        echo $ambilData['foto'];
    }

    exit;
}

if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $query = "DELETE FROM calon_ketua WHERE id_calon = '$id_hapus'";
    $queryLaporan = "DELETE FROM voting WHERE id_calon = '$id_hapus'";
    $result = mysqli_query($koneksi, $query);
    $resultLaporan = mysqli_query($koneksi, $queryLaporan);

    if ($result) {
        echo "<script>alert('Data telah berhasil dihapus!'); window.location='calon.php'</script>";
        exit;
    } else {
        echo "<script>alert('Data gagal dihapus!'); window.location='calon.php'</script>";
        exit;
    }

    if ($resultLaporan) {
        echo "<script>alert('Data telah berhasil dihapus!'); window.location='calon.php'</script>";
        exit;
    } else {
        echo "<script>alert('Data gagal dihapus!'); window.location='calon.php'</script>";
        exit;
    }
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
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Calon Ketua</li>
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
                        <img src="imageAdmin.php?id=<?= $data['id_admin'] ?>" style="width: 30px;cursor: pointer;border-radius: 100px;"
                            alt="Profil Pengguna">
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
                <div class="card-header">
                    <a class="btn btn-primary mt-3 w-15" href="tambahCalon.php">+ Tambah</a>
                    <h6>Calon Ketua Osis</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity- text-center">
                                        No</th>
                                    <th
                                        class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Foto</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kelas</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Visi</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        AKSI</th>

                                </tr>
                            </thead>



                            <tbody>
                                <?php
                                $no = 1;
                                //sql
                                $sql = "select * from calon_ketua order by id_calon ASC";

                                //eksekusi
                                $hasil = mysqli_query($koneksi, $sql);

                                //tampilkan dgn perulangan
                                foreach ($hasil as $data) {
                                    ?>
                                    <tr>
                                        <td class="align-middle text-center fw-bold">
                                            <?= $no++ ?>
                                        </td>
                                        <td class="align-middle text-center fw-bold p-3">
                                            <img src="image.php?id=<?= $data['id_calon'] ?>" style="width: 100px;"
                                                class="card-img">
                                        </td>
                                        <td class="fw-medium">
                                            <?= $data['nama'] ?>
                                        </td>
                                        <td class="fw-medium">
                                            <?= $data['kelas'] ?>
                                        </td>
                                        <td class="fw-medium">
                                            <?= substr($data['visi'], 0, 30) . '...' ?>
                                        </td>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="editCalon.php?id_calon=<?= $data['id_calon'] ?>"
                                                    class="btn bg-gradient-success">EDIT</a>
                                                <a href="?hapus=<?= $data['id_calon'] ?>"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                                    class="btn bg-gradient-danger">Hapus</a>

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