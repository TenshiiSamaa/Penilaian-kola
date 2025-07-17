<?php 
require "../config/koneksi.php";

// if(isset($_GET['nis'])){
//     die("Macem Macem Buka");
// }

$kdmapel = $_GET['kd_mapel'];

$sql = "DELETE FROM mapel WHERE kd_mapel = '$kdmapel'";

$result = $conn->query($sql);
if($result){
    if($conn->affected_rows>0){
        header("location:../index.php?menu=mapel");
    }else{
        die("ada yang tidak beres datanya");
    }

}else{
    die("query salah coyy!" .$conn->error);
}

?>