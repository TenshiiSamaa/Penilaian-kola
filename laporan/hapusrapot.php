<?php
require "../config/koneksi.php";

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $query = "DELETE FROM siswa WHERE nis = '$nis'";
    $result = $con->query($query);

    if ($result) {
        if ($con->affected_rows > 0) {
            header("Location: ../index.php?menu=rapot");
        } else {
            echo '<div class="alert alert-danger" role="alert">Gagal menghapus data.</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Gagal menghapus data.</div>';
    }
} else {
    echo '<div class="alert alert-danger" role="alert">ID data tidak diberikan.</div>';
}
