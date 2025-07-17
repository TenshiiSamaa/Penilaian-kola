<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "config/koneksi.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png">
    <title>Penilaian</title>
    

    <link rel="stylesheet" style type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" style type="text/css" href="bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">

    <link rel="stylesheet" style type="text/css" href="bootstrap/css/bootstrap-select.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script type="text/javascript" src="bootstrap/js/bootstrap-select.min.js"></script>

    <style>
        body{
            background-color: whitesmoke;
        }
        .hover-effect:hover{
            color: blue;
            font-weight: bold;
            transition: 0.1s;
        }
    </style>
</head>

<body>
    <nav id="navigasi" class="navbar navbar-expand-lg bg-info-subtle border-bottom border-info border-5" >
        <div class="container-fluid">
            <a href="index.php" class="">
                <img src="img/logo.png" alt="" width="150">   
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#itemmenu" aria-control="itemmenu" aria-expanded="false" aria-label="Buka Menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="itemmenu" class="collapse navbar-collapse justify-content-end" style="margin-right:70px;">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="hover-effect nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="hover-effect nav-link" href="?menu=siswa">Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="hover-effect nav-link" href="?menu=mapel">Mata Pelajaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="hover-effect nav-link" href="?menu=nilai">Nilai Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="hover-effect nav-link" href="?menu=kelas">Kelas Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="hover-effect nav-link" href="?menu=guru">Guru</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Laporan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?menu=raport">Raport</a></li>
                            <li><a class="dropdown-item" href="?menu=nilaitertinggi">Nilai Tertinggi Mapel</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Rangking</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

    </nav>

    <div id="body" class="container" style="height: 750px;">

        <?php

            if(isset($_GET['menu'])){

                if($_GET['menu']=="siswa"){
                    if(isset($_GET['mod']) && !empty($_GET['mod']) && $_GET['mod'] == 'edit'){

                        if(isset($_GET['nis'])){
                            include "siswa/viewedit.php";
                        }else{
                            include "siswa/view.php";
                        }
                        
                    }else{
                        include "siswa/view.php";
                    }

                }elseif($_GET['menu']=="mapel"){
                    if(isset($_GET['mod']) && !empty($_GET['mod']) && $_GET['mod'] == 'edit'){

                        if(isset($_GET['kd_mapel'])){
                            include "mapel/viewedit.php";
                        }else{
                            include "mapel/view.php";
                        }
                        
                    }else{
                        include "mapel/view.php";
                    }
                    
                }elseif($_GET['menu']=="nilai"){
                    if(isset($_GET['mod']) && !empty($_GET['mod']) && $_GET['mod'] == 'edit'){

                        if(isset($_GET['id'])){
                            include "nilai/viewedit.php";
                        }else{
                            include "nilai/view.php";
                        }
                        
                    }else{
                        include "nilai/view.php";
                    }
                }elseif($_GET['menu']=="guru"){
                    if(isset($_GET['mod']) && !empty($_GET['mod']) && $_GET['mod'] == 'edit'){

                        if(isset($_GET['kd_guru'])){
                            include "guru/viewedit.php";
                        }else{
                            include "guru/view.php";
                        }
                        
                    }else{
                        include "guru/view.php";
                    }
                
                }elseif($_GET['menu']=="kelas"){
                    if(isset($_GET['mod']) && !empty($_GET['mod']) && $_GET['mod'] == 'edit'){

                        if(isset($_GET['kd_kelas'])){
                            include "kelas/viewedit.php";
                        }else{
                            include "kelas/view.php";
                        }
                        
                    }else{
                        include "kelas/view.php";
                    }
                }elseif($_GET['menu']=="nilaitertinggi"){
                    if(isset($_GET['mod']) && !empty($_GET['mod']) && $_GET['mod'] == 'edit'){

                        if(isset($_GET['nis'])){
                            include "raport/viewedit.php";
                        }else{
                            include "raport/nilaitertinggi.php";
                        }
                        
                    }else{
                        include "raport/nilaitertinggi.php";
                    }

                }elseif($_GET['menu']=="raport"){
                    if(isset($_GET['mod']) && !empty($_GET['mod']) && $_GET['mod'] == 'edit'){

                        if(isset($_GET['nis'])){
                            include "raport/viewcetak.php";
                        }else{
                            include "raport/view.php";
                        }
                        
                    }else{
                        include "raport/view.php";
                    }

                }else{
                    echo "<H5 class='mt-3 alert alert-danger'>Menu salah!</H5>";
                }

            }else{

        ?>

        <p>
            <h3>Selamat Datang</h3><br>
            Ini adalah aplikasi penilaian SMK Taruna Bangsa. Untuk 
            menggunakan langkah-langkahnya sebagai berikut :
        </p>
            
        <?php

            }

        ?>
    </div>

    <div id>

    </div>

    <!-- <div class="card text-center bg-info-subtle border border-info border-5">
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
    </div> -->

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>