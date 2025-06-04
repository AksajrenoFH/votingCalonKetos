<?php
include('../koneksi.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT foto FROM calon_ketua WHERE id_calon = $id";
    $result = $koneksi->query($sql);

    if ($row = $result->fetch_assoc()) {
        $filePath = '../admin/assets/uploads/' . $row['foto'];

        if (file_exists($filePath)) {
            $mime = mime_content_type($filePath);

            header("Content-Type: $mime");
            readfile($filePath);
            exit;
        }

    }
}

header("Content-Type: image/jpeg");
readfile("assets/img/image-.png")
?>