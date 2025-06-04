<?php
include('../koneksi.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT foto FROM admin WHERE id_admin = $id";
    $result = mysqli_query($koneksi, $sql);
    
    if($result && mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        if(!empty($data['foto'])){
            header("Content-Type: image/jpeg");
            echo $data['foto'];
            exit;
        }
    }
}

header("Content-Type: image/png");
readfile("assets/img/user.png")
?>