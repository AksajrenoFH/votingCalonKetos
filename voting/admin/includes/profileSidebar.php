<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
            target="_blank">
            <img src="assets/img/logo-smk-pesat.png" class="navbar-brand-img" height="26" alt="main_logo">
            <span class="ms-1 text-sm text-dark">SMK Pesat ITXPro</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-dark" href="dashboard.php">
                    <i class="material-symbols-rounded opacity-5">undo</i>
                    <span class="nav-link-text ms-1">Kembali</span>
                </a>
            </li>
            <hr class="horizontal dark mt-0 mb-2">
            <li class="nav-item">
                <a class="nav-link <?= ($currentPage == 'profile.php') ? 'active bg-gradient-dark text-white' : 'text-dark' ?>" href="profile.php">
                    <i class="material-symbols-rounded opacity-5">account_circle</i>
                    <span class="nav-link-text ms-1">Edit Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="logout.php" onclick="return warning()">
                    <i class="material-symbols-rounded opacity-5 text-danger fw-bolder">logout</i>
                    <span class="nav-link-text ms-1 text-danger fw-bolder">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>