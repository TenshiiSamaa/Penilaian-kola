<!DOCTYPE html>
<html lang="en">

  <head>
    
  <?php 
  session_start();
  require "config/koneksi.php"; 

 
  
  ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian</title>
    <link rel="icon" href="images/2.jpg">


    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" style type="text/css" href="bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">
        <style>
            #itemmenu ul li a:hover{
                color: #BFA73E;
                font-weight: bold;
            }
        </style>
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		<a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/6.jpg);"></a>
                  
                
	        <ul class="list-unstyled components mb-5">
	          <li class="active">
	            <a href="">Home</a>
	            
                <li>
                    <a href="?menu=siswa">Siswa</a>
                </li>
                <li>
                    <a href="?menu=mapel">Mata Pelajaran</a>
                </li>
                <li>
                    <a href="?menu=nilai">Nilai Siswa</a>
                </li>
                <li>
                    <a href="?menu=kelas">Kelas Siswa</a>
                </li>
                <li>
                    <a href="?menu=guru">Guru</a>
                </li>
                <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Laporan</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                  <li>
                      <a href="?menu=raport">Raport</a>
                  </li>
                  <li>
                      <a href="?menu=nilaitertinggi">Nilai Tertinggi</a>
                  </li>
                  <li>
                      <a href="?menu=nilaimapel">Nilai Mapel</a>
                  </li>
                  <li>
                      <a href="?menu=rangking">Rangking</a>
                  </li>
                </ul>
                <li class="nav-item">
                        <a class="nav-link" href="logout.php" class="btn btn-primary"><i class="bi bi-box-arrow-right"> Logout</i></a>
                    </li>
                </li>
	        </ul>
            
	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                       
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
      

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
                            <li><a class="dropdown-item" href="?menu=nilaimapel">Nilai Mapel</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="?menu=rangking">Rangking</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" class="btn btn-primary"><i class="bi bi-box-arrow-right"> Logout</i></a>
                    </li>
                </ul>
            </div>
          </div>
        </nav>
        
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
                }elseif($_GET['menu']=="nilai-tinggi-criteria"){
                    if(isset($_GET['mod']) && !empty($_GET['mod']) && $_GET['mod'] == 'edit'){

                        if(isset($_GET['kd_mapel'])){
                            include "raport/nilai-tinggi-criteria.php";
                        }else{
                            include "raport/nilai-tinggi-criteria.php";
                        }
                        
                    }else{
                        include "raport/nilai-tinggi-criteria.php";
                    }
                }elseif($_GET['menu']=="cetakrangking"){
                    if(isset($_GET['mod']) && !empty($_GET['mod']) && $_GET['mod'] == 'edit'){

                        if(isset($_GET['kd_kelas'])){
                            include "raport/cetakrangking.php";
                        }else{
                            include "raport/cetakrangking.php";
                        }
                        
                    }else{
                        include "raport/cetakrangking.php";
                    }
                }elseif($_GET['menu']=="nilaimapel"){
                    if(isset($_GET['mod']) && !empty($_GET['mod']) && $_GET['mod'] == 'die'){

                        if(isset($_GET['kd_mapel'])){
                            include "raport/nilaimapel.php";
                        }else{
                            include "raport/nilaimapel.php";
                        }
                        
                    }else{
                        include "raport/nilaimapel.php";
                    }
                }elseif($_GET['menu']=="rangking"){
                    if(isset($_GET['mod']) && !empty($_GET['mod']) && $_GET['mod'] == 'die'){

                        if(isset($_GET['kd_mapel'])){
                            include "raport/rangking.php";
                        }else{
                            include "raport/rangking.php";
                        }
                        
                    }else{
                        include "raport/rangking.php";
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
            <h3 class="">Selamat Datang</h3><br>
            Ini adalah aplikasi penilaian SMK Taruna Bangsa. Untuk 
            menggunakan langkah-langkahnya sebagai berikut :

            <?php //echo $_SESSION['username']; ?>!

            <div class="row justify-content-center">
    </div>

        </p>
            
        <?php

            }

        ?>
      </div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>