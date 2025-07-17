<?php 
require "../config/koneksi.php";

// if(isset($_GET['nis'])){
//     die("Macem Macem Buka");
// }

$kdguru = $_GET['kd_guru'];

$sql = "DELETE FROM guru WHERE kd_guru = '$kdguru'";

$result = $conn->query($sql);
if($result){
    if($conn->affected_rows>0){
        header("location:../index.php?menu=guru");
    }else{
        die("ada yang tidak beres datanya");
    }

}else{
    die("query salah coyy!" .$conn->error);
}

?>