<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pencapaian</title>
    <link rel="stylesheet" href="../bs/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../bs/bootstrap-icons-1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body onload="print()">
    <?php
    require "../config/koneksi.php";
    if (!isset($_GET['kd_kelas'])) {
        die("TIDAK MEMILIKI HAK AKSES");
    }
    $id_kelas = $_GET['kd_kelas'];

    $sql = "SELECT 
            siswa.nis,
            siswa.nama_siswa,
            kelas.kd_kelas,
            kelas.nama_kelas,
            kelas.jml_siswa,
            (SELECT nama_guru FROM guru WHERE kd_guru=kelas.kd_guru) as wali_kelas,
            SUM(((nilai.uas + nilai.uts) / 2)) AS jumlahNilai

            FROM siswa JOIN kelas ON kelas.kd_kelas = siswa.kd_kelas
                    JOIN nilai ON siswa.nis = nilai.nis
                    WHERE kelas.kd_kelas='$id_kelas'

            GROUP BY siswa.nis, siswa.nama_siswa, kelas.nama_kelas, wali_kelas
            ORDER BY jumlahNilai DESC";

    $result = $conn->query($sql);
    if ($result) {
        if ($result->num_rows > 0) {
            $jumlah = 0;
            $no = 0;
            $row = $result->fetch_assoc();
    ?>
            <div class="container">
                <div class="row mb-4">
                    <div class="col mt-5" style="text-align: center;">
                        <h1>LAPORAN RANKING SISWA</h1>
                        <h3>SMK TARUNA BANGSA</h3>
                    </div>
                </div>
                <table class="mt-2">
                    <tr>
                        <td style="width : 45%;">NAMA KELAS</td>
                        <td>:</td>
                        <td style="font-weight:bold"><?php echo $row['nama_kelas'] ?></td>
                    </tr>




                    
                    <tr>
                        <td>WALI KELAS</td>
                        <td>:</td>
                        <td><?php echo $row['wali_kelas'] ?></td>
                    </tr>
                    <tr>
                        <td>JUMLAH SISWA</td>
                        <td>:</td>
                        <td><?php echo $row['jml_siswa'] ?></td>
                    </tr>
                </table>
                <table class="mt-3 table table-bordered table-light border-dark">
                    <thead>
                        <tr>
                            <td class="h5">NO</td>
                            <td class="h5" style="width : 20%;">NIS</td>
                            <td class="h5" style="width : 60%;">NAMA SISWA</td>
                            <td class="h5">RANKING</td>
                            <td class="h5">JUMLAH TOTAL</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row) {
                            $no++;
                            $jumlahNilai = number_format($row['jumlahNilai']);
                            $jumlah += $jumlahNilai;
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td>
                                    <?php echo $row['nis'] ?>
                                </td>
                                <td>
                                    <?php echo $row['nama_siswa'] ?>
                                </td>
                                <td>
                                    Ranking <?php echo $no ?>
                                </td>
                                <td>
                                    <?php echo $jumlahNilai ?>
                                </td>
                            </tr>
                        <?php
                            $walas = $row['wali_kelas'];
                            $row = $result->fetch_assoc();
                        }
                        // rata rata jumlah
                        $hasilnilai = $jumlah / $no;

                        ?>
                    </tbody>
                    <tr>
                        <td colspan="4">Jumlah <br> Rata Rata</td>
                        <td>
                            <?php
                            echo $jumlah . '<br>';
                            echo number_format($hasilnilai);
                            ?>
                        </td>
                    </tr>
                </table>
                <div class="mt-5 container">
                    <div class="col float-start">
                        <h6>Kepala Sekolah</h6>
                        <br>
                        <br>
                        <br>
                        <br>
                        <h6>Dody Suhendar, S.Pd</h6>
                    </div>
                    <div class="col float-end">
                        <h6>Bekasi, <?php echo date('d M Y') ?></h6>
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
            echo "<div class='alert alert-danger'>Data Nilai Belum Ada</div>";
        }
    }
    ?>
</body>
<!-- <script>
    window.print();
</script> -->
<script src="bs/js/bootstrap.min.js"></script>
<script src="bs/js/bootstrap.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
