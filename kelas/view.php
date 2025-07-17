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

?>
<div class="container-fluid mt-3">
    <span class="h5">Data Kelas</span>
    <a class="btn btn-dark btn-sm float-end" data-bs-toggle="modal" data-bs-target="#forminput"  href="#">
        <span class="bi bi-person-plus-fill"></span> 
        Tambah Data
    </a>
    <table class="table  table-striped border border-default border-5 mt-3">
        <thead>
        <tr align="center">
            <th>No</th>
            <th>Kode Kelas</th>
            <th>Nama Kelas</th>
            <th>Jumlah Siswa</th>
            <th>Wali Guru</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT guru.kd_guru,guru.nama_guru, 
                                kelas.kd_kelas,kelas.nama_kelas,kelas.jml_siswa
                FROM guru JOIN kelas ON guru.kd_guru=kelas.kd_guru";
                

                
                $result = $conn->query("$sql");
                if(!$result){
                    die("query gagal : ".$conn->error);
                }
                if($result->num_rows>0){
                    $no=0;
                    while($row=$result->fetch_assoc()){
                        $no++;
                
            ?>
        <tr align="center">
            <td><?php echo $no;?></td>
            <td><?php echo $row['kd_kelas'];?></td>
            <td><?php echo $row['nama_kelas'];?></td>
            <td><?php echo $row['jml_siswa'];?></td>
            <td><?php echo $row['nama_guru'];?></td>
            <td>
                
                <a href="#" class="" data-bs-toggle="modal" data-bs-target="#tambah-<?php echo $row['kd_kelas']; ?>"><i class="bi bi-pencil-square"></i></a>
                <a href="#" class="" data-bs-toggle="modal" data-bs-target="#hapus-<?php echo $row['kd_kelas']; ?>"><i class="bi bi-trash-fill"></i></a>

                    <div id="hapus-<?php echo $row['kd_kelas']; ?>" class="modal fade">
                        <form method="get" action="kelas/hapus.php" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Hapus Data
                                </div>
                                <div class="modal-body">
                                    Yakin Mau Hapus Data ini ? <b><?php echo $row['nama_kelas']; ?></b>
                                </div>
                                <div class="modal-footer">
                                        <input type="hidden" name="kd_kelas" value="<?php echo $row['kd_kelas']; ?>">
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
                

                <div id="tambah-<?php echo $row['kd_kelas']; ?>" class="modal fade">
                    <form method="post" action="kelas/update.php" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title h5">Form Edit Kelas</div>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                    
                                        <label class="form-label mt-2 float-start" for="kd_kelas">Kode kelas</label>
                                        <input class="form-control" value="<?php echo $row['kd_kelas']; ?>" type="text" id="kd_kelas" name="kd_kelas" placeholder="Masukan Kode Kelas">
                                
                                        <label class="form-label mt-2 float-start" for="nama_kelas">Nama kelas</label>
                                        <select class="form-select" name="nama_kelas" id="nama_kelas">
                                        <?php



                                            $kelas = array('X RPL-1',"X RPL-2","XI RPL-1","XI RPL-2","XII RPL-1","XII RPL-2","XII RPL-3");
                                            foreach ($kelas as $value){
                                                if($value == $row['nama_kelas']){
                                                    echo "<option selected value='$value'>$value</option>";
                                                }else{
                                                    echo "<option value='$value'>$value</option>";
                                                }
                                            }

                                        ?>
                                        </select>
                                        
                                        <label class="form-label mt-2 float-start" for="jml_siswa">jml siswa</label>
                                        <input class="form-control" value="<?php echo $row['jml_siswa']; ?>" type="text" id="jml_siswa" name="jml_siswa" placeholder="Masukan Jml Siswa">
                                        
                                        <label class="form-label mt-2 float-start" for="kd_guru">Nama Guru :</label>
                                        <select id="kd_guru" name="kd_guru" class="form-select" >
                                        <option value="<?= $row['kd_guru'] ?>"><?= $row['nama_guru'] ?></option>
                
                                        <?php
                                        $query = $conn->query("SELECT * FROM guru");
                                        foreach ($query as $data) {
                                            if ($seleksimapel == $data['kd_guru']) {

                                        ?>
                                                <option selected value="<?= $data['kd_guru'] ?>"><?= $data['nama_guru'] ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?= $data['kd_guru'] ?>"><?= $data['nama_guru'] ?></option>
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
                echo"<tr>
                        <td colspan='5'
                            Data belum ada.....
                        </td>
                    </tr>";
            }
        
        ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="6" align="center">hoyolab@hoyoverse.com</td>
        </tfoot>
        </tr>
    </table>
</div>
<div id="forminput" class="modal fade" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" action="kelas/store.php">
            <div class="modal-header">
                <div class="modal-title h5">Form Input Kelas</div>
            </div>
            <div class="modal-body">
                <div class="container">
                    <label class="form-label mt-2" for="kd_kelas">Kode kelas</label>
                    <input class="form-control" type="text" id="kd_kelas" name="kd_kelas" placeholder="Masukan Kode Kelas">
                </div>
                <div class="container">
                    <label class="form-label mt-2" for="nama_kelas">Nama kelas</label>
                    <select class="form-select" name="nama_kelas" id="nama_kelas">
                            <option value="-1">Pilih Kelas</option>
                            <option value="X RPL-1">X RPL-1</option>
                            <option value="X RPL-2">X RPL-2</option>
                            <option value="XI RPL-1">XI RPL-2</option>
                            <option value="XI RPL-2">XI RPL-2</option>
                            <option value="XII RPL-1">XII RPL-1</option>
                            <option value="XII RPL-2">XII RPL-2</option>
                            <option value="XII RPL-3">XII RPL-3</option>
                    </select>
                </div>

                <div class="container">
                    <label class="form-label mt-2" for="jml_siswa">Jumlah siswa</label>
                    <input class="form-control" type="text" id="jml_siswa" name="jml_siswa" placeholder="Masukan Jumlah Siswa">
                </div>
                <div class="container">
                    <label class="form-label mt-2 float-start" for="kd_guru">Nama Guru :</label>
                        <select id="kd_guru" name="kd_guru" class="form-select" >
                                <option value="-1">Pilih Nama Guru...</option>
                                <?php
                                $query = $conn->query("SELECT * FROM guru");
                                foreach ($query as $data) {
                                    if ($seleksimapel == $data['kd_guru']) {

                                ?>
                                        <option selected value="<?= $data['kd_guru'] ?>"><?= $data['nama_guru'] ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?= $data['kd_guru'] ?>"><?= $data['nama_guru'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                        </select>
                </div>

                <div class="modal-footer">
                    <input class="btn btn-dark" type="submit" name="simpan" value="Simpan">
                    <input class="btn btn-dark" type="reset" value="Batal" data-bs-dismiss="modal"/>
                </div>
                
            </div>
             
        </form>   
        </div>
    </div>
</div>