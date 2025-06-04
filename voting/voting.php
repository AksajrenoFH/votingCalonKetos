<?php
include("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_calon = $_POST['id_calon'];

    $sql = "INSERT INTO voting (id_calon) VALUES ($id_calon)";

    $hasil = mysqli_query($koneksi, $sql);

    if ($hasil) {
        header("Location: berhasil.php");
    } else {
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Calon Ketua Osis</title>
    <link rel="shortcut icon" href="admin/assets/img/logo-smk-pesat.png" type="image/x-icon">
</head>

<body class="bg-gray-300 min-h-screen flex flex-col items-center justify-center p-6">

    <h1 class="text-3xl font-bold mb-9">Pilih Calon Ketua Osis</h1>

    <form action="" method="post" class="w-full max-w-3xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php
            $no = 1;

            $sql = "SELECT * FROM calon_ketua ORDER BY id_calon ASC";
            $hasil = mysqli_query($koneksi, $sql);

            foreach ($hasil as $data) {

                ?>
                <label class="calon cursor-pointer">
                    <input type="radio" name="id_calon" value="<?= $data['id_calon'] ?>" class="hidden peer" required>
                    <div
                        class="peer-checked:border-blue-500 peer-checked:ring-2 border-2 border-transparent p-4 rounded-xl shadow bg-white hover:shadow-md transition-all">
                        <img src="admin/image.php?id=<?= $data['id_calon'] ?>" alt="Foto Calon <?= $no++?>" class="w-full h-full rounded-lg object-cover">
                        <h2 class="text-center font-semibold my-4 text-3xl"><?= $data['nama']?></h2>
                        <p class="text-gray-700 text-justify" style="text-align-last: center;"><?= $data['visi']?></p>
                    </div>
                </label>
                <?php
            }
            ?>
        </div>

        <div class="text-center mt-8">
            <button class="font-bold rounded-full bg-blue-500 px-5 py-3 transition-all hover:bg-blue-600 text-white active:-translate-y-2">Submit Pilihan</button>
        </div>
    </form>

    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>