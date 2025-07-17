<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bs/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../bs/bootstrap-icons-1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    require "../config/koneksi.php";
    if (!isset($_GET['nis'])) {
        die("TIDAK MEMILIKI HAK AKSES");
    }
    $nis = $_GET['nis'];

    $q = "SELECT siswa.nis, siswa.nama_siswa, kelas.nama_kelas, (SELECT nama_guru FROM guru WHERE kd_guru=kelas.kd_guru) as nama_walas, mapel.nama_mapel, guru.nama_guru, nilai.uas, nilai.uts 
    FROM siswa join kelas ON kelas.kd_kelas=siswa.kd_kelas
                        JOIN nilai ON siswa.nis=nilai.nis
                        JOIN mapel ON mapel.kd_mapel=nilai.kd_mapel
                        JOIN guru ON mapel.kd_guru=guru.kd_guru 
                        WHERE siswa.nis='$nis'";

    $result = $conn->query($q);
    if ($result) {
        if ($result->num_rows > 0) {

            $no = 1;
            $row = $result->fetch_assoc();

    ?>
            <div class="container">
            
                <div class="row mb-4">
                    <div class="col mt-5 h4 border-bottom border-3 border-primary" style="text-align: center;">
                        <h1>LAPORAN PENCAPAIAN</h1>
                        <div style="margin-top: -20px;">
                        <h3>SMK TARUNA BANGSA</h3>
                        </div>
                     
                    </div>
                </div>
                <table class="mt-2" >
                    <tr>
                        <td>NAMA </td>
                        <td>:</td>
                        <th><?php echo $row['nama_siswa'] ?><?php  ?></th>
                    </tr>
                    <tr>
                        <td>NIS </td>
                        <td>:</td>
                        <td><?php echo $row['nis'] ?></td>
                    </tr>
                    <tr>
                        <td>KELAS </td>
                        <td>:</td>
                        <td><?php echo $row['nama_kelas'] ?></td>
                    </tr>
                </table>
                <table class="mt-3 table table-bordered table-light border-dark" align="center">
                    <thead>
                        <tr align="center">
                            <td>
                                NO
                            </td>
                            <td>
                                Mata Pelajaran
                            </td>
                            <td>
                                Nilai
                            </td>
                            <td>
                               Grade
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $hasil = $conn->query($q);
                        $jumlah = 0;

                        if (!$hasil) {
                            die("masalah : " . $conn->error);
                        }
                        if ($hasil->num_rows > 0) {
                            $no = 0;
                            while ($row = $hasil->fetch_array()) {
                                $no++;

                                $hasilAkhir = ($row['uts'] + $row['uas']) / 2;
                                $jumlah += $hasilAkhir;
                        ?>
                                <tr >
                                    <td align="center">
                                        <?php echo $no; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['nama_mapel'] ?><br>
                                        <div style="font-size: 12px;">Guru : <?php echo $row['nama_guru'] ?></div>
                                    </td>

                                    <td align="center">
                                        <?php echo $hasilAkhir;
                                        ?>
                                    </td>
                                    <td align="center">
                                    <?php
                                           $grade="F";
                                           if($hasilAkhir >=0 & $hasilAkhir <=40){
                                               $grade="F";
                                           }
                                           if($hasilAkhir >=40 & $hasilAkhir <=55){
                                               $grade="D";
                                           }
                                           if($hasilAkhir >=55 & $hasilAkhir <=75){
                                               $grade="C";
                                           }
                                           if($hasilAkhir >=76 & $hasilAkhir <=90){
                                               $grade="B";
                                           }
                                           if($hasilAkhir >=91 & $hasilAkhir <=100){
                                               $grade="A";
                                           } 
                                              ?>
                                        <?php echo $grade;
                                        ?>
                                    </td>
                                </tr>

                        <?php
                                $walas = $row['nama_guru'];
                            }
                        }
                        ?>
                    </tbody>
                    <tr align="center">
                        <td colspan="2">
                            <b>Jumlah <br> Rata Rata</b>
                        </td>
                        <td>
                            <b><?php
                            echo $jumlah . '<br>';
                            echo number_format($jumlah  / $hasil->num_rows);
                            ?></b>
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
                        <br><br>
                        <br>
                        <h4>..............................</h4>
                    </div>
                    <div class="col float-end">
                        <h6>Bekasi, <?php echo date('Y M d') ?></h6>
                        <h6 style="text-align: center;">Wali Kelas</h6>
                        
                        <img src="ttd.png" alt="" width="150" height="100">
                        <h6 style="text-align: center;"><?php echo $walas ?></h6>
                    </div>
                </div>
            </div>
            
            <!-- <footer style="margin-top: 250px;">
                <center>
                <a href="#" onclick="window.print()"><button class="print btn btn-primary">Print Raport</button></a>
                </center>
            </footer> -->
    <?php
        } else {
            echo "<div class='alert alert-danger'>Data Nilai Belum Ada Bos</div>";
        }
    }
    ?>
</body>
<script>
    window.print()
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>