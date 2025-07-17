<?php

    include ('config/koneksi.php');

    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->query("SELECT * FROM user
                            WHERE username = '$username' AND password = '$password'");

    if(mysqli_num_rows($query) > 0 ){
        $result = $query->fetch_object();

        $_SESSION['login'] = 'sukses';
        $_SESSION['id_user'] = $result->id_user;
        $_SESSION['nama_user'] = $result->nama_user;
        $_SESSION['role'] = $result->id_role_user;

        ?>
        <script>
            window.alert('Login Berhasil !');
            window.location.href='index.php';
        </script>

        <?php
    }else{

        ?>
        <script>
            window.alert('Akun Salah. Silahkan Login Kembali!');
            window.Location.href='login.php';
            </script>
        <?php
    }
