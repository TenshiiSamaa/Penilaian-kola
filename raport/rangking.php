<div class="">
    <span class="h2">Ranking</span>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?menu=rangking" method="POST">
        <div class="row mt-3">
            <div class="col">
            <select class="form-select" name="filterkelas">
                        <option value="-1">Filter Kelas</option>
                        <?php
                        $sqlkelas = "SELECT * FROM kelas";
                        $resultkelas = $conn->query($sqlkelas);

                        if ($resultkelas) {
                            while ($rowkelas = $resultkelas->fetch_object()) {
                                $selectedkelas = isset($_POST['filterkelas']) && $_POST['filterkelas'] == $rowkelas->kd_kelas ? "selected" : "";
                                echo "<option $selectedkelas value='$rowkelas->kd_kelas'> $rowkelas->nama_kelas</option>";
                            }
                        }
                        ?>
                    </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-info btn-sm d-flex mb-3"><span class="bi bi-search m-1">Cari</button>
            </div>
        </div>
    </form>
    <table class="table table-striped mt-2">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Kelas</th>
                <th>Nama Kelas</th>
                <th>Jumlah Siswa</th>
                <th>Wali Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $criteria = "";
            $hasfilter = false;

            if (isset($_POST['filterkelas']) && $_POST['filterkelas'] >= 0) {
                $filterkelas = $_POST['filterkelas'];
                $criteria .= "siswa.kd_kelas='$filterkelas'";
                $hasfilter = true;
            }

             if($hasfilter){
                $criteria = "WHERE $criteria";
             }


            $sql = "SELECT * FROM kelas JOIN guru ON guru.kd_guru = kelas.kd_guru JOIN siswa ON siswa.kd_kelas = kelas.kd_kelas $criteria GROUP BY nama_kelas";
            // $sql = "SELECT * FROM t_kelas";
            $result = $conn->query($sql);
            if ($result) {
                $no = 1;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_object()) {


            ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row->kd_kelas; ?></td>
                            <td><?php echo $row->nama_kelas ?></td>
                            <?php
                            //$q = "SELECT COUNT(*) as jumlah_siswa FROM t_kelas JOIN t_siswa ON t_siswa.kd_kelas=t_kelas.kd_kelas WHERE t_kelas.kd_kelas='" . $row['kd_kelas'] . "'"; 
                            ?>
                            <td><?php echo $row->jml_siswa ?></td>
                            <td><?php echo $row->nama_guru ?></td>
                            
                            <td><a href="raport/cetakrangking.php?kd_kelas=<?php echo $row->kd_kelas ?>" class="link" target="_BLANK"><span class="bi bi-file-earmark-bar-graph"></span> Cetak Rangking</a></td>
                        </tr>
            <?php
                        $no++;
                    }
                } else {
                    echo "<tr>
                            <td colspan='6'>Data belum ada...</td>
                            </tr>";
                }
            } else {
                die("Query gagal : " . $conn->error);
            }

            ?>
        </tbody>

    </table>
</div>

