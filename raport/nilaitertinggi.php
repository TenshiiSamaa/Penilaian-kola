<div class=" h4 border-bottom border-3 border-primary mb-5">
            <h1><b>Nilai Tertinggi</b></h1>
        </div>
        <div class="col" style="margin-left: -18px;">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?menu=nilaitertinggi" method="POST">
                    <div class="input-group" style="width: 900px;">
                
                        <!-- class filter -->
                        <select class="form-select" name="filterKelas">
                            <option value="-1">Filter Kelas</option>
                            <?php
                            $sqlkelas = "SELECT * FROM kelas";
                            $resultkelas = $conn->query($sqlkelas);
                            if ($resultkelas) {
                                while ($rowkelas = $resultkelas->fetch_object()) {
                                    $selectedkelas = isset($_POST['filterKelas']) && $_POST['filterKelas'] == $rowkelas->kd_kelas ? "selected" : "";
                                    echo "<option $selectedkelas value='$rowkelas->kd_kelas'>$rowkelas->nama_kelas</option>";
                                }
                            }
                            ?>
                        </select>
                        <select name="filterMapel" class="form-select">
                            <option value="-1">Filter Mata Pelajaran</option>
                            <?php
                            $sqlmapel = "SELECT * FROM mapel";
                            $resultmapel = $conn->query($sqlmapel);

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
<?php
    $kriteria = "";
    $hasilFilter = false;

    if (isset($_POST['filterKelas']) && $_POST['filterKelas'] >= 0) {
        $filterkelas = $_POST['filterKelas'];
        $kriteria .= "siswa.kd_kelas='$filterkelas'";
        $hasilFilter = true;
    }

    if (isset($_POST['filterMapel']) && $_POST['filterMapel'] >= 0) {
        $filterMapel = $_POST['filterMapel'];
        $kriteria .= ($hasilFilter ? " AND " : "") . "nilai.kd_mapel='$filterMapel'";
        $hasilFilter = true;
    }

    if ($hasilFilter) {
        $kriteria = "WHERE $kriteria";
    }

    $sqlsemuaNilai = "SELECT siswa.nis, siswa.nama_siswa, kelas.nama_kelas, mapel.nama_mapel, nilai.uts as max_uts, nilai.uas as max_uas,
                        ((nilai.uas + nilai.uts)/2) as max_nilai_akhir 
                        FROM nilai
                        JOIN siswa ON nilai.nis = siswa.nis
                        JOIN mapel ON nilai.kd_mapel = mapel.kd_mapel
                        JOIN kelas ON siswa.kd_kelas = kelas.kd_kelas
                        $kriteria
                        GROUP BY siswa.nis, siswa.nama_siswa, mapel.nama_mapel
                        ORDER BY max_nilai_akhir DESC";

    $resultsemuaNilai = $conn->query($sqlsemuaNilai);
    ?>
    <br>
    <table class="table table-striped " >
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