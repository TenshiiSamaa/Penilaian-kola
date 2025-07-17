<?php

    require "../config/koneksi.php";

    // if(empty($_POST['nis'])){
    //     die("nis kosong. <a href='#' 
    //     onclick='history.back()'>Kembali</a>");
    // }
    // if(empty($_POST['nama'])){
    //     die("nama kosong. <a href='#' 
    //     onclick='history.back()'>Kembali</a>");
    // }
    // if(empty($_POST['jk']) || $_POST['jk']==-1 ){
    //     die("jenis kelamin kosong. <a href='#' 
    //     onclick='history.back()'>Kembali</a>");
    // }
    // if(empty($_POST['alamat'])){
    //     die("alamat kosong. <a href='#' 
    //     onclick='history.back()'>Kembali</a>");
    // }
    // if(empty($_POST['kelas'])){
    //     die("kelas kosong. <a href='#' 
    //     onclick='history.back()'>Kembali</a>");
    // }
    
    $kolom = array("NIS","NAMA SISWA","JENIS KELAMIN","ALAMAT","KODE KELAS");

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



    $nis = strip_tags($_POST['nis']);
    $nama = strip_tags($_POST['nama']);
    $jk = strip_tags($_POST['jk']);
    $alamat = strip_tags($_POST['alamat']);
    $kdkelas = strip_tags($_POST['kd_kelas']);

    //fungsi namanya is query
    if(!is_numeric($nis)){
        $nisnumeric = false;
        $adaerror[] = "NIS Harus diisi nomor/numerik!";
        
    }

    if(is_numeric($nama)){
        $adaerror[] = "Nama tidak boleh ";
    }

    if(strlen($nis)!=9){
        $adaerror[] = "Panjang Nis tidak sesuai";
    }

    if(strlen($nama)<3){
        $adaerror[] = "Kurang Panjang? Hub. 0826256";
    }

    if(count($adakosong)>0 || count($adaerror)){

        // kita mengirimkan data menggunakan session
        // karena ngirim array
        // variable $_SESSION[]
        ob_start();
        session_start();

        $_SESSION['error_kosong']   = $adakosong;
        $_SESSION['error_aja']      = $adaerror;

        header("location:../index.php?menu=siswa");
        die();
    }

    $sql = "INSERT INTO siswa(nis, nama_siswa, jk_siswa, alamat_siswa, kd_kelas) VALUES('$nis','$nama','$jk','$alamat','$kdkelas')";

    $result = $conn->query($sql);

    if(!$result){
        die("Ada Kesalahan Query : ".$conn->error);
    }

    if($conn->affected_rows){
        header("location:../index.php?menu=siswa");
    }



?>