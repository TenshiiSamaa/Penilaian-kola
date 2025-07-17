<?php
 
    if(isset($_SESSION['error_kosong']) && isset($_SESSION['error_aja'])){
        if(count($_SESSION['error_kosong'])>0){
            
            foreach($_SESSION['error_kosong'] as $value){
                echo "<div class='alert alert-warning'>
                    kosong $value !
                </div>";
            }
        
        }

        if(count($_SESSION['error_aja'])>0){
            foreach($_SESSION['error_aja'] as $value){
                echo "<div class='alert alert-warning'>
                     $value 
                </div>";
            }
        }

    }
    
    session_destroy();

    echo "<br>";
    
    if(isset($_GET['flag'])){
        $flag = $_GET['flag'];
        echo "<div class='alert alert-info'>
                <button type='button' data-bs-dismiss=alert class='close' arial-label='close'>
                    <i class='bi bi-x-lg'></i>
                </button>
                $flag
            </div>";
    }
    
    // if(isset($_GET['nis']) && $_GET['nis'] == "false"){

    // echo "<div class='alert alert-warning'>
    //     NIS harus di isi dengan NOMOR
    //     </div>";
    //}

?>

<div class="container-fluid mt-3 ">
    <span class="h5">Data Siswa</span>
    <a class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#formInput" href="#"><span class="bi bi-person-plus-fill"> Tambah Data</span></a>
    <table class="table table-striped border border-default border-5 mt-3">
        <thead>
            <tr align="center">
                <th>No.</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Jenis Kelamin</th>
                <th>Alamat Siswa</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php

                $sql = "SELECT kelas.kd_kelas,kelas.nama_kelas,
                                siswa.nis,siswa.nama_siswa,siswa.jk_siswa,siswa.alamat_siswa 
                            FROM kelas JOIN siswa ON kelas.kd_kelas=siswa.kd_kelas";

                $result = $conn->query($sql);
                if(!$result){
                    die ("Query gagal : ".$conn->error);
                }
                
                if($result->num_rows>0){
                    $no=0;
                    while ($row=$result->fetch_assoc()){
                        $no++;

            ?>
            <tr align="center">
                <td><?php echo $no; ?></td>
                <td><?php echo $row['nis']; ?></td>
                <td><?php echo $row['nama_siswa']; ?></td>
                <td><?php echo $row['jk_siswa'] == "Perempuan" ? "Perempuan" :"Laki-Laki"; ?></td>
                <td><?php echo $row['alamat_siswa']; ?></td>
                <td><?php echo $row['nama_kelas']; ?></td>
                <td>
                <a href="#" class="" data-bs-toggle="modal" data-bs-target="#tambah-<?php echo $row['nis']; ?>"><i class="bi bi-pencil-square"></i></a>
                <a href="#" class="" data-bs-toggle="modal" data-bs-target="#hapus-<?php echo $row['nis']; ?>"><i class="bi bi-trash-fill"></i></a>

                    <div id="hapus-<?php echo $row['nis']; ?>" class="modal fade">
                        <form method="get" action="siswa/hapus.php" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Hapus Data
                                </div>
                                <div class="modal-body">
                                    Yakin Mau Hapus Data ini ? <b><?php echo $row['nama_siswa']; ?></b>
                                </div>
                                <div class="modal-footer">
                                        <input type="hidden" name="nis" value="<?php echo $row['nis']; ?>">
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-warning btn-sm">
                                            Tidak
                                        </button>
                                        <button class="btn btn-sm btn-danger" type="submit">
                                            Yakin
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                       
                    
                    <div id="tambah-<?php echo $row['nis']; ?>" class="modal fade">
                    <form method="post" action="siswa/update.php" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title h5">Form Edit siswa</div>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                    
                                        <<label class="form-label mt-2 float-start" for="nis">NIS</label>
                                        <input class="form-control" value="<?php echo $row['nis']; ?>" type="text" name="nis" id="nis" placeholder="Masukan NIS Anda">

                                        <label class="form-label mt-2 float-start" for="nama">Nama Siswa</label>
                                        <input class="form-control" value="<?php echo $row['nama_siswa']; ?>" type="text" name="nama" id="nama" placeholder="Masukan Nama Siswa Anda">

                                        <label class="form-label mt-2 float-start" for="jk">Jenis kelamin</label>
                                        <select class="form-select" name="jk" id="jk">

                                            <?php
                                                if($row['jk_siswa'] == "Laki-Laki"){
                                                    echo '<option value="Laki-Laki" selected>Laki-Laki</option>
                                                    <option value="Perempuan">Perempuan</option>';
                                                }else{
                                                    echo '<option value="Perempuan" selected>Perempuan</option>
                                                    <option value="Laki-Laki">Laki-Laki</option>';
                                                }
                                            ?>

                                            
                                        </select>

                                        <label class="form-label mt-2 float-start"  for="alamat">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat Lengkap"><?php echo $row['alamat_siswa']; ?></textarea>

                    
                                        <label class="form-label mt-2 float-start" for="kd_kelas">Nama Kelas :</label>
                                        <select id="kd_kelas" name="kd_kelas" class="form-select" >
                                                <option value="<?= $row['kd_kelas'] ?>"><?= $row['nama_kelas'] ?></option>
                    
                                            <?php
                                            $query = $conn->query("SELECT * FROM kelas");
                                            foreach ($query as $data) {
                                                if ($seleksimapel == $data['kd_kelas']) {

                                            ?>
                                                    <option selected value="<?= $data['kd_kelas'] ?>"><?= $data['nama_kelas'] ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?= $data['kd_kelas'] ?>"><?= $data['nama_kelas'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                            </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input class="btn btn-warning" type="reset" name="submit" data-bs-dismiss="modal" value="batal">
                                    <input class="btn btn-success" type="submit"  name="submit" value="Simpan">
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                </td>
            </tr>
            <?php
                    }

                }else{
                    echo "<tr>
                            <td colspan='7'>
                                Data Bellum Ada
                            </td>";
                }

                

            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" align="center">hoyolab@hoyoverse.com</td>
            </tr>
        </tfoot>
    </table>
</div>
<div id="formInput" class="modal fade" data-bs-backdrop="static" id="modalinput" tabindex="-1" data-bs-backdrop="static" aria-hidden="false" >
    <form method="post" action="siswa/store.php">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title h5">Form Input Siswa</div>
                </div>
                <div class="modal-body">
                    <div class="container">

                        <label class="form-label" for="nis">NIS</label>
                        <input class="form-control" type="text" name="nis" id="nis" placeholder="Masukan NIS Anda">

                        <label class="form-label mt-2" for="nama">Nama Siswa</label>
                        <input class="form-control" type="text" name="nama" id="nama" placeholder="Masukan Nama Siswa Anda">

                        <label class="form-label mt-2" for="jk">Jenis kelamin</label>
                        <select class="form-select" name="jk" id="jk">
                            <option value="-1">Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>

                        <label class="form-label mt-2" for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat Lengkap"></textarea>

                        <label class="form-label mt-2 float-start" for="kd_kelas">Nama Kelas </label>
                        <select id="kd_kelas" name="kd_kelas" class="form-select" >
                                <option value="-1">Pilih Nama Kelas...</option>
                                <?php
                                $query = $conn->query("SELECT * FROM kelas");
                                foreach ($query as $data) {
                                    if ($seleksimapel == $data['kd_kelas']) {

                                ?>
                                        <option selected value="<?= $data['kd_kelas'] ?>"><?= $data['nama_kelas'] ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?= $data['kd_kelas'] ?>"><?= $data['nama_kelas'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <input class="btn btn-warning" type="reset" name="submit" data-bs-dismiss="modal" value="batal">
                    <input class="btn btn-success" type="submit"  name="submit" value="Simpan">
                </div>

            </div>
        </div>
    </form>
</div>