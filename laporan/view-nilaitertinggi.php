<div class="container-fluid">
    <div style="text-align: center; margin-left: 300px;">
        <div class=" h4 border-bottom border-3 border-primary mb-5">
            <h1><b>Data Siswa</b></h1>
        </div>
        <div class="d-flex w-25 mb-4" style="margin-left: 90px;">
            <div class="col">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?menu=nilaitertinggi" method="POST">
                    <div class="input-group">
                        <!-- class filter -->
                        <select class="form-select" name="filterKelas">
                            <option value="-1">Filter Kelas</option>
                            <?php
                            $sqlkelas = "SELECT * FROM kelas";
                            $resultkelas = $con->query($sqlkelas);
                            if ($resultkelas) {
                                while ($rowkelas = $resultkelas->fetch_object()) {
                                    $selectedkelas = isset($_POST['filterKelas']) && $_POST['filterKelas'] == $rowkelas->id ? "selected" : "";
                                    echo "<option $selectedkelas value='$rowkelas->id'>$rowkelas->nama_kelas</option>";
                                }
                            }
                            ?>
                        </select>
                        <select name="filterMapel" class="form-select">
                            <option value="-1">Filter Mata Pelajaran</option>
                            <?php
                            $sqlmapel = "SELECT * FROM mapel";
                            $resultmapel = $con->query($sqlmapel);

                            if ($resultmapel) {
                                while ($rowMapel = $resultmapel->fetch_object()) {
                                    $selectedMapel = isset($_POST['filterMapel']) && $_POST['filterMapel'] == $rowMapel->kd_mapel ? "selected" : "";
                                    echo "<option $selectedMapel value='$rowMapel->kd_mapel'>$rowMapel->kd_mapel - $rowMapel->nama_mapel</option>";
                                }
                            }
                            ?>
                        </select>
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$kriteria = "";
$hasilFilter = false;

if (isset($_POST['filterKelas']) && $_POST['filterKelas'] >= 0) {
    $filterkelas = $_POST['filterKelas'];
    $kriteria .= "siswa.id='$filterkelas'";
    $hasilFilter = true;
}

if (isset($_POST['filterMapel']) && $_POST['filterMapel'] >= 0) {
    $filterMapel = $_POST['filterMapel'];
    $kriteria .= ($hasilFilter ? " AND " : "") . "nilai1.kd_mapel='$filterMapel'";
    $hasilFilter = true;
}

if ($hasilFilter) {
    $kriteria = "WHERE $kriteria";
}

$sqlsemuaNilai = "SELECT siswa.nis, siswa.nama_siswa, kelas.nama_kelas, mapel.nama_mapel, nilai1.uts as max_uts, nilai1.uas as max_uas,
                    ((nilai1.uas + nilai1.uts)/2) as max_nilai_akhir 
                    FROM nilai1
                     JOIN siswa ON nilai1.nis_siswa = siswa.nis
                     JOIN mapel ON nilai1.kd_mapel = mapel.kd_mapel
                     JOIN kelas ON siswa.id = kelas.id
                     $kriteria
                     GROUP BY siswa.nis, siswa.nama_siswa, mapel.nama_mapel
                     ORDER BY max_nilai_akhir DESC";

$resultsemuaNilai = $con->query($sqlsemuaNilai);
?>

<table class="table table-striped w-75" style="margin-left: 400px;">
    <thead>
        <tr>
            <th>No.</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Nilai Tertinggi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($resultsemuaNilai && $resultsemuaNilai->num_rows > 0) {
            $no = 0;
            while ($rowsemuaNilai = $resultsemuaNilai->fetch_assoc()) {
                $no++;
        ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $rowsemuaNilai['nis']; ?></td>
                    <td><?php echo $rowsemuaNilai['nama_siswa']; ?></td>
                    <td><?php echo $rowsemuaNilai['nama_kelas']; ?></td>
                    <td><?php echo $rowsemuaNilai['nama_mapel']; ?></td>
                    <td><?php echo number_format($rowsemuaNilai['max_nilai_akhir']); ?></td>
                </tr>
        <?php
            }
        } else {
            echo "<tr>
                    <td colspan='6'>Data Belum Ada Bozzzz..</td>
            </tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="13" style="text-align: center;">
                &copy; <i>Copyright 2023</i> | <i>Designed by <b>Rafli Alghafar</b></i>
            </td>
        </tr>
    </tfoot>
</table>