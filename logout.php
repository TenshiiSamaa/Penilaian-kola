<?php
    session_start();
    session_destroy();
?>

<script>
   window.alert('Anda Berhasil Logout!');
    window.location.href='login.php';
</script>