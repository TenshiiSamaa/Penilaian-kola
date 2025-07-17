
<?php

// if(!isset($_GET['kd_kelas']) || !isset($_GET['kd_mapel'])){
//     die("Akses denied!");
// }

$kd_kelas = $_GET['kd_kelas'];
$kd_mapel = $_GET['kd_mapel'];

$sqlallnilai = "SELECT siswa.nis, siswa.nama_siswa, kelas.nama_kelas, mapel.nama_mapel, nilai.uts as max_uts, nilai.uas as max_uas,((nilai.uts + nilai.uas)/2) as max_nilai_akhir 
FROM nilai 
JOIN siswa on nilai.nis = siswa.nis 
join mapel on nilai.kd_mapel = mapel.kd_mapel 
join kelas on siswa.kd_kelas = kelas.kd_kelas 
WHERE siswa.kd_kelas = '$kd_kelas' AND nilai.kd_mapel = '$kd_mapel'
GROUP BY siswa.nis, siswa.nama_siswa, mapel.nama_mapel 
ORDER BY max_nilai_akhir DESC";

$resultallnilai = $conn->query($sqlallnilai);
?>
<table class="table table-bordered  table-striped">
    <thead class="table table-danger">
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
        if ($resultallnilai && $resultallnilai->num_rows > 0) {
            $no = 0;
            while ($rowallnilai = $resultallnilai->fetch_assoc()) {
                $no++;


        ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $rowallnilai['nis']; ?></td>
                    <td><?php echo $rowallnilai['nama_siswa']; ?></td>
                    <td><?php echo $rowallnilai['nama_kelas']; ?></td>
                    <td><?php echo $rowallnilai['nama_mapel']; ?></td>
                    <td><?php echo number_format($rowallnilai['max_nilai_akhir']); ?></td>
                </tr>

        <?php
            }
        } else {
            echo "<tr><td colspan='6'>Data Belum Ada</td></tr>";
        }

        ?>
    </tbody>
    <tfoot></tfoot>
</table>