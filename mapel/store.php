<?php 
    require "../config/koneksi.php";

    $kolom = array("Kode MAPEL","NAMA MAPEL","JAM PELAJARAN");

    $adakosong = array();

    $i = 0;
    foreach ($_POST as $value){
        if(empty($value) || $value ==-1 ){

            $adakosong[] = $kolom[$i];
            
            // die("Ada Form Yang Kosong. <a href='#' 
            //     onclick='history.back()'>Kembali</a>");
        }
        $i++; 
    }

    $nisnumeric = true;
    $adaerror = array();



    $kdmapel = strip_tags($_POST['kd_mapel']);
    $namamapel = strip_tags($_POST['nama_mapel']);
    $jp = strip_tags($_POST['jp']);
    $kdguru = strip_tags($_POST['kd_guru']);
    

    //fungsi namanya is query
    

    if(is_numeric($namamapel)){
        $adaerror[] = "Nama tidak boleh Nomor";
    }




    if(count($adakosong)>0 || count($adaerror)){

        // kita mengirimkan data menggunakan session
        // karena ngirim array
        // variable $_SESSION[]
        session_start();

        $_SESSION['error_kosong']   = $adakosong;
        $_SESSION['error_aja']      = $adaerror;

        header("location:../index.php?menu=mapel");
        die();
    }


    $sql = "INSERT INTO mapel(kd_mapel,nama_mapel,jp,kd_guru) VALUES('$kdmapel','$namamapel','$jp','$kdguru')";

    $result = $conn->query($sql);

    if(!$result){
        die("Ada Kesalahan : ".$conn->error);
    }

    if($conn->affected_rows){
        header("location:../index.php?menu=mapel");
    }

    
?>