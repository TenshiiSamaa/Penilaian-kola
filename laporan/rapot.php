<div class="container">
    <?php
    session_start();

    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];


    ?>
        <div class="alert alert-warning">
            <ul>
                <?php
                foreach ($error as $value) {
                    echo "<li> Kolom " . $value . " Kosong </li>";
                }

                ?>
            </ul>
        </div>
    <?php
        session_destroy();
    }
    ?>
    <div class="h4 border-bottom border-3 border-primary mb-5" style="text-align: center; ">
        <h1><b>Data Raport Siswa</b></h1>
    </div>
    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalInput">
        <span class="bi-plus-circle text-light"></span> Tambah Data
    </button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM siswa INNER JOIN kelas ON kelas.id = siswa.id";

            $hasil = $con->query($sql);

            if (!$hasil) {
                die("Ada masalah Query : " . $con->error);
            }
            if ($hasil->num_rows > 0) {
                $no = 0;
                while ($row = $hasil->fetch_array()) {
                    $no++;


            ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['nis']; ?></td>
                        <td><?php echo $row['nama_siswa']; ?></td>
                        <td><?php echo $row['nama_kelas']; ?></td>
                        <td>
                            <a href="?menu=rapot&mod=edit&nis=<?php echo $row['nis']; ?>&print&fullscreen" class="btn btn-outline-success bi bi-printer-fill"> Cetak Raport</a>
                            <!-- <a href="#" class="btn btn-outline-danger bi bi-trash-fill" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row['nis']; ?>"><span></span></a> -->
                            <div class="modal fade" id="modal-<?php echo $row['nis']; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title fs-5" id="exampleModalLabel">Apakah Anda Yakin</h4>
                                        </div>
                                        <div class="modal-body">
                                            Mau Menghapus Data <?php echo $row['nama_siswa']; ?>?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="GET" action="laporan/hapusrapot.php">
                                                <input type="hidden" name="nis" value="<?php echo $row['nis']; ?>" />
                                                <button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary">
                                                    batal
                                                </button>
                                                <button type="submit" class="btn btn-outline-success">Iya</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
            <?php
                }
            } else {
                echo "<tr>
                            <td colspan='6'>
                                Tidak Ada Data ...
                            </td>
                        <?tr";
            }
            ?>
        </tbody>
        <tfoot>
            <tr style="text-align: center; font-family: sans-serif;">
                <td colspan='13'><i>&copy; Copyright 2023 | Designed By <b>Rafli Alghafar</b></i></td>
            </tr>
        </tfoot>
    </table>
</div>
<div class="modal fade" id="modalInput" tabindex="-1" aria-labelledby="modalinput" aria-hidden="true">
    <form method="POST" action="kelas/storekelas.php">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Form Raport Siswa</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="mb-3">
                            <label for="nm_kelas" class="form-label float-start">Nama Kelas</label>
                            <input type="text" class="form-control rounded-5" name="nm_kelas" id="nmKls" placeholder="Isi Nama Kelas Anda">
                        </div>
                        <div class="mb-3">
                            <label for="kapasitas" class="form-label float-start">Kapasitas</label>
                            <input type="text" class="form-control rounded-5" name="kapasitas" id="kapasitas" placeholder="Isi Kapasitas Kelas Anda">
                        </div>
                        <div class="mb-3">
                            <label for="kd_guru" class="form-label float-start">Nama Guru</label>
                            <select name="kd_guru" id="kd_guru" class="form-select rounded-5">
                                <option value="1">--Pilih Guru--</option>
                                <?php
                                $query = $con->query("SELECT * FROM guru");
                                foreach ($query as $data) {
                                    if ($seleksiMapel == $data['kode_guru']) {
                                ?>
                                        <option selected value="<?= $data['kode_guru'] ?>"><?= $data['nama_guru'] ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?= $data['kode_guru'] ?>"><?= $data['nama_guru'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>