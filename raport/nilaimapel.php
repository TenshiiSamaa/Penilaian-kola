<div>
    <span class="h1">Data Nilai Tertinggi Mapel</span>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?menu=nilaimapel" method="POST" class="mt-3">
        <!-- <a class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#formInputnl" href="#"><span class="bi bi-person-plus-fill"></span> Tambahkan Data</a> -->

       
        <select name="filterKelas" class="form-select w-25 float-start ">
            <option value="-1">Filter Kelas</option>
            <?php
            $sql = "SELECT * FROM kelas";
            // $selected = isset($_POST['filterMapel']) ? "selected":"";
            $result = $conn->query($sql);

            if ($result) {
                while ($row = $result->fetch_object()) {
                    if(isset($_POST['filterKelas']) && $_POST['filterKelas'] > 0){
                        if($_POST['filterKelas'] == $row->kd_kelas){
                            echo "<option selected value='$row->kd_kelas'>$row->kd_kelas - $row->nama_kelas</option>";
                        }else{
                            echo "<option value='$row->kd_kelas'>$row->kd_kelas - $row->nama_kelas</option>";
                        }
                    }else{
                        echo "<option value='$row->kd_kelas'>$row->kd_kelas - $row->nama_kelas</option>";
                    }
                    
                }
            }
            ?>
        </select>
        <button class="btn btn-success float-start ms-2" type="submit"><span></span>Cari</button>
    </form>
    
</div>

    <table class="table table-striped mt-3">
        <thead >
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kelas</th>  
                <th class="text-center">Mata Pelajaran</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
                <?php
                
                    $criteria ="";

                    if(isset($_POST['filterKelas']) && $_POST['filterKelas'] >= 0){
                        $filterKelas = $_POST['filterKelas'];
                        $criteria .= " WHERE siswa.kd_kelas='$filterKelas'";
                    }

                    $sql = "SELECT kelas.kd_kelas, mapel.kd_mapel,mapel.nama_mapel,kelas.nama_kelas
                            FROM mapel
                            JOIN nilai ON mapel.kd_mapel = nilai.kd_mapel
                            JOIN siswa ON nilai.nis = siswa.nis
                            JOIN kelas ON siswa.kd_kelas = kelas.kd_kelas $criteria GROUP BY mapel.kd_mapel, mapel.nama_mapel,kelas.nama_kelas";

                    $result = $conn->query($sql);
                    if (!$result) {
                        die("Query gagal : " . $conn->error);
                    }
                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_object()) {
                            
        
                ?>
                 <tr>
                        <td class="text-center"><?php echo $no; ?></td>
                        <td class="text-center"><?php echo $row->nama_kelas ?></td>
                        <td class="text-center"><?php echo $row->nama_mapel ?></td>
                        <td class="text-center">
                            <a href="?menu=nilai-tinggi-criteria&kd_mapel=<?php echo $row->kd_mapel; ?>&kd_kelas=<?php echo $row->kd_kelas; ?>"><span class="btn btn-danger bi bi-egg-fried"> Lihat Nilai</span></a>
                        </td>
                 </tr>
                 <?php
                 $no++;
                }
            } else {
                echo "<tr>
                        <td colspan='10'>
                            Data Belum Ada
                        </td>
                     </tr>";
            }
            ?>
        </tbody>
        <tfoot>
       
        </tfoot>
    </table>