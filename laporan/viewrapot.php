<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bs/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bs/icon/bootstrap-icons/font/bootstrap-icons.css">
    <title>RAPORT</title>
</head>

<body style="display: grid;place-items: center;height: 100vh;">
    <?php

    if (!isset($_GET['nis'])) {
        die("TIDAK MEMILIKI HAK AKSES");
    }
    $nis = $_GET['nis'];

    $q = "SELECT siswa.nis, siswa.nama_siswa, kelas.nama_kelas, siswa.jurusan, (SELECT nama_guru FROM guru WHERE kode_guru=kelas.kode_guru) as nama_walas, mapel.nama_mapel, guru.nama_guru, nilai1.nilai_akhir, nilai1.grade FROM siswa JOIN kelas ON siswa.id = kelas.id
                        JOIN nilai1 ON nilai1.nis_siswa=siswa.nis
                        JOIN mapel on mapel.kd_mapel=nilai1.kd_mapel
                        JOIN guru on mapel.kode_guru=guru.kode_guru
                        WHERE siswa.nis='$nis'";

    $result = $con->query($q);
    if ($result) {
        if ($result->num_rows > 0) {
            $no = 1;
            $row = $result->fetch_assoc();
    ?>
            <div class="container">
                <div class="row mb-4">
                    <div class="h4 border-bottom border-3 border-primary mb-5" style="text-align: center;">
                        <h1><b>LAPORAN PENCAPAIAN</b></h1>
                        <h1><b>SMK TARUNA BANGSA</b></h1>
                    </div>
                </div>
                <table>
                    <tr>
                        <td><b>NAMA</b></td>
                        <td>:</td>
                        <td><?php echo $row['nama_siswa'] ?><?php  ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;"><b>NIS</b></td>
                        <td>:</td>
                        <td class="float-start"><?php echo $row['nis'] ?></td>
                    </tr>
                    <tr>
                        <td><b>KELAS</b></td>
                        <td>:</td>
                        <td class="float-start"><?php echo $row['nama_kelas'] ?></td>
                    </tr>
                </table>
                <table class="table table-bordered border-dark">
                    <thead>
                        <tr>
                            <td>
                                <h5>NO</h5>
                            </td>
                            <td>
                                <h5>Mata Pelajaran</h5>
                            </td>
                            <td>
                                <h5>nilai</h5>
                            </td>
                            <td>
                                <h5>grade</h5>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $hasil = $con->query($q);
                        $jumlah = 0;

                        if (!$hasil) {
                            die("masalah : " . $con->error);
                        }
                        if ($hasil->num_rows > 0) {
                            $no = 0;
                            while ($row = $hasil->fetch_array()) {
                                $no++;
                        ?>
                                <tr>
                                    <td>
                                        <?php echo $no; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php echo $row['nama_mapel'] ?><br>
                                        <?php echo "Guru :  " .
                                            $row['nama_guru'] ?>
                                    </td>

                                    <td>
                                        <?php echo $row['nilai_akhir'];
                                        $jumlah += $row['nilai_akhir'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['grade'] ?>
                                    </td>
                                </tr>
                        <?php
                                $walas = $row['nama_walas'];
                            }
                        }
                        ?>
                    </tbody>
                    <tr>
                        <td colspan="2">
                            Jumlah <br> Rata Rata
                        </td>
                        <td>
                            <?php
                            echo $jumlah . '<br>';
                            echo $jumlah / $hasil->num_rows;
                            ?>
                        </td>
                        <td>
                            .
                        </td>
                    </tr>
                </table>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </table>



                <div class="mt-5 container">
                    <div class="col float-start">
                        <h6>Orang Tua/Wali Murid</h6>
                        <br>
                        <br>
                        <br>
                        <br>
                        <p>...........................................</p>
                    </div>
                    <div class="col float-end">
                        <h6>Bekasi, <?php echo date('Y M d') ?></h6>
                        <h6 style="text-align: center;">Wali Kelas</h6>
                        <br>
                        <br>
                        <br>
                        <h6 style="text-align: center;"><?php echo $walas ?></h6>
                    </div>
                </div>
            </div>
    <?php
        } else {
            echo "<div class='alert alert-danger'>Data Nilai Belum Ada Bos</div>";
        }
    }
    ?>
    <script type="text/javascript" src="bs/js/bootstrap.min.js"></script>
</body>
<script>
    window.print();
</script>

</html>