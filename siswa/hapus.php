<?php 
require "../config/koneksi.php";

// if(isset($_GET['nis'])){
//     die("Macem Macem Buka");
// }

$nis = $_GET['nis'];

$sql = "DELETE FROM siswa WHERE nis = '$nis'";

$result = $conn->query($sql);
if($result){
    if($conn->affected_rows>0){
        header("location:../index.php?menu=siswa");
    }else{
        die("ada yang tidak beres datanya");
    }

}else{
    die("query salah coyy!" .$conn->error);
}
// if(isset($_GET['nis'])){
//     $nis = $_GET['nis'];
//     $query = "DELETE FROM siswa WHERE nis = '$nis'";

//     $result = $conn->query($query);

//     if ($result) {
//         header("location:../index.php?menu=siswa");
//     } else {
//         echo '<div class="alert alert-danger" role="alert">Gagal Menghubungkan Data. </div>';
//     }

// }else{
//     echo '<div class="alert alert-danger" role="alert">ID data Tidak Diberikan. </div>';
// }
?>