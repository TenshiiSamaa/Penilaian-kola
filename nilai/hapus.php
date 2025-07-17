<?php 
require "../config/koneksi.php";

// if(isset($_GET['nis'])){
//     die("Macem Macem Buka");
// }

$id = $_GET['id'];

$sql = "DELETE FROM nilai WHERE id = '$id'";

$result = $conn->query($sql);
if($result){
    if($conn->affected_rows>0){
        header("location:../index.php?menu=nilai");
    }else{
        die("ada yang tidak beres datanya");
    }

}else{
    die("query salah coyy!" .$conn->error);
}

?>