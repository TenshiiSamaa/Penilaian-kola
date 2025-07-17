<?php 
require "../config/koneksi.php";

// if(isset($_GET['nis'])){
//     die("Macem Macem Buka");
// }

$kdkelas = $_GET['kd_kelas'];

$sql = "DELETE FROM kelas WHERE kd_kelas = '$kdkelas'";

$result = $conn->query($sql);
if($result){
    if($conn->affected_rows>0){
        header("location:../index.php?menu=kelas");
    }else{
        die("ada yang tidak beres datanya");
    }

}else{
    die("query salah coyy!" .$conn->error);
}

?>