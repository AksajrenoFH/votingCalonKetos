<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_osis";

$konek = new mysqli($host, $user, $pass, $db);

if($konek->connect_error){
    die("Koneksi gagal: " . $konek->connect_error);
}

// Faisal
$image1 = addslashes(file_get_contents("admin/assets/img/faisal.JPG"));
$konek->query("UPDATE calon_ketua SET foto = '$image1' WHERE id_calon = 1");

// Faiz
$image2 = addslashes(file_get_contents("admin/assets/img/faiz.jpg"));
$konek->query("UPDATE calon_ketua SET foto = '$image2' WHERE id_calon = 2");

// Glenn
$image3 = addslashes(file_get_contents("admin/assets/img/glenn.jpg"));
$konek->query("UPDATE calon_ketua SET foto = '$image3' WHERE id_calon = 3");

echo "SEMUA foto kandidat sudh berhasil diupdate";
$konek->close();
?>