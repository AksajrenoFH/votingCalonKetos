<?php

include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //ambil inputan dari form 
    $id_calon = $_POST["id_calon"];

    // sql tambah data     tbl       kolom          nama var
    $sql = "INSERT INTO voting (id_calon) VALUES ('$id_calon')";

    // eksekusi
    $simpan = mysqli_query($koneksi, $sql);

    if ($simpan) {
        header(header: "Location: tes.php");
        // atau boleh pakai sweat alert, lihat contoh di siswa $berhasil = true;
    } else {
    }
}

?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Voting Ketua OSIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-6">
    <h1 class="text-2xl font-bold mb-6">Pilih Ketua OSIS</h1>

    <form action="" method="POST" class="w-full max-w-3xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <?php
            $no = 1;
            //sql
            $sql = "select * from calon_ketua order by id_calon DESC";

            //eksekusi
            $hasil = mysqli_query($koneksi, $sql);

            //tampilkan dgn perulangan
            foreach ($hasil as $data) {
            ?>

                <label class="calon">
                    <!-- class="hidden peer" supaya radio button nya disembunyikan -->
                    <input type="radio" name="id_calon" value="<?= $data['id_calon'] ?>" class="hidden peer" required>
                    <div class="peer-checked:border-blue-500 peer-checked:ring-2 border-2 border-transparent p-4 rounded-xl shadow bg-white hover:shadow-md transition-all">
                        <img src="images/calon1.jpg" alt="Calon 1" class="w-full h-48 object-cover rounded-lg mb-4">
                        <h2 class="text-xl font-semibold mb-1"><?= $data['nama'] ?></h2>
                        <p class="text-gray-600 text-sm"><?= $data['visi'] ?>.</p>
                    </div>
                </label>

            <?php } ?>

        </div>

        <!-- Tombol Submit -->
        <div class="mt-6 text-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-xl shadow">
                Submit Pilihan
            </button>
        </div>
    </form>
</body>

</html>