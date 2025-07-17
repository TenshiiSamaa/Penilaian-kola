<?php
    require "../config/koneksi.php";

    $nis = $_GET['nis'];
    
    echo "Yakin mau di hapus $nis : 
        <a href='hapus.php?nis=$nis'>Yes</a>
        <a href='view.php'>No</a>";
?>