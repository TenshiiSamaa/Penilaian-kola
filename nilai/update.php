<?php 
    require "../config/koneksi.php";

    $kolom =  array("ID","NIS","KODE MAPEL","UTS","UAS");

    $kosong = array();

    $i=0;

    foreach($_POST as $value){
        if(empty($value) || $value==-1){
            $kosong[] = $kolom[$i]; 
        }
        $i++;
    }

    $adaerror = array();
    $nisnumeric = true;

    $id = strip_tags($_POST['id']);
    $nis = strip_tags($_POST['nis']) ;
    $kd_mapel = strip_tags($_POST['kd_mapel']) ;
    $uts = strip_tags($_POST['uts']);
    $uas = strip_tags($_POST['uas']);

   
    

    if(count($kosong)>0 || count($adaerror)){
        session_start();

        $_SESSION['error_kosong'] = $kosong ;
        $_SESSION['error_aja'] = $adaerror ;

        header("location:../index.php?menu=nilai");
        die();
    }

   
    $sql = "UPDATE nilai SET uts='$uts',uas='$uas' WHERE id='$id'";
    $result = $conn->query($sql );
    

    if(!$result){
        die("Proses Simpan Error.nih errornya : " .$conn->error);
    }

    if($conn->affected_rows){
        header("location:../index.php?menu=nilai&flag=Data Berhasil disimpan");
    }

    
?>