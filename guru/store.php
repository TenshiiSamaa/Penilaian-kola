<?php 
    require "../config/koneksi.php";

    $kolom = array("Kode GURU","NAMA GURU","PENDIDIKAN GURU");

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



    $kdguru = strip_tags($_POST['kd_guru']);
    $namaguru = strip_tags($_POST['nama_guru']);
    $pendidikanguru = strip_tags($_POST['pendidikan_guru']);
   
    

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

        header("location:../index.php?menu=guru");
        die();
    }


    $sql = "INSERT INTO guru(kd_guru,nama_guru,pendidikan_guru) VALUES('$kdguru','$namaguru','$pendidikanguru')";

    $result = $conn->query($sql);

    if(!$result){
        die("Ada Kesalahan : ".$conn->error);
    }

    if($conn->affected_rows){
        header("location:../index.php?menu=guru");
    }

    
?>