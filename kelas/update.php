<?php 
    require "../config/koneksi.php";

    $kolom = array("Kode SISWA","NAMA SISWA","JUMLAH SISWA", "KODE GURU");

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



    $kdkelas = strip_tags($_POST['kd_kelas']);
    $namakelas = strip_tags($_POST['nama_kelas']);
    $jmlsiswa = strip_tags($_POST['jml_siswa']);
    $kdguru = strip_tags($_POST['kd_guru']);
    

    //fungsi namanya is query
    

    



    if(count($adakosong)>0 || count($adaerror)){

        // kita mengirimkan data menggunakan session
        // karena ngirim array
        // variable $_SESSION[]
        session_start();

        $_SESSION['error_kosong']   = $adakosong;
        $_SESSION['error_aja']      = $adaerror;

        header("location:../index.php?menu=kelas");
        die();
    }


    $sql = "UPDATE kelas SET nama_kelas='$namakelas', jml_siswa='$jmlsiswa',kd_guru='$kdguru' WHERE kd_kelas='$kdkelas' ";

    $result = $conn->query($sql);

    if(!$result){
        die("Ada Kesalahan : ".$conn->error);
    }

    if($conn->affected_rows){
        header("location:../index.php?menu=kelas");
    }

    
?>