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
    <span class="h5">Data Guru</span>
    <a class="btn btn-dark btn-sm float-end" data-bs-toggle="modal" data-bs-target="#forminput"  href="#">
        <span class="bi bi-person-plus-fill"></span> 
        Tambah Data
    </a>
    <table class="table table-striped border border-default border-5 mt-3">
        <thead>
        <tr align="center">
            <th>No</th>
            <th>Kode Guru</th>
            <th>Nama Guru</th>
            <th>Pendidikan Guru</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT * FROM guru";

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
            <td><?php echo $row['kd_guru'];?></td>
            <td><?php echo $row['nama_guru'];?></td>
            <td><?php echo $row['pendidikan_guru'];?></td>
            
            <td>
                <a href="?menu=guru&mod=edit&kd_guru=<?php echo $row['kd_guru']; ?>"><i class="bi bi-pencil-square"></i></a>
                <a href="guru/hapus.php?kd_guru=<?php echo $row['kd_guru'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus ?');"><i class="bi bi-trash3"></i></a> 
                
                <a href="#" class="" data-bs-toggle="modal" data-bs-target="#hapus-<?php echo $row['kd_guru']; ?>"><i class="bi bi-trash-fill"></i></a>

                <div id="hapus-<?php echo $row['kd_guru']; ?>" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                 Hapus Data
                            </div>
                            <div class="modal-body">
                                Yakin Mau Hapus Data ini ? <b><?php echo $row['nama_guru']; ?></b>
                            </div>
                            <div class="modal-footer">
                                <form method="GET" action="guru/hapus.php" >
                                    <input type="hidden" name="kd_guru" value="<?php echo $row['kd_guru']; ?>">
                                    <input class="btn btn-warning" type="reset" name="submit" data-bs-dismiss="modal" value="batal">
                                    <input class="btn btn-success" type="submit"  name="submit" value="Hapuss">
                                </form>
                            </div>
                        </div>
                    </div>
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
        <form method="POST" action="guru/store.php">
            <div class="modal-header">
                <div class="modal-title h5">Form Input Mapel</div>
            </div>
            <div class="modal-body">
                <div class="container">
                    <label class="form-label mt-2" for="kd_guru">Kode Guru</label>
                    <input class="form-control" type="text" id="kd_guru" name="kd_guru" placeholder="Masukan Kode Guru">
                </div>
                <div class="container">
                    <label class="form-label mt-2" for="nama_guru">Nama Guru</label>
                    <input class="form-control" type="text" id="nama_guru" name="nama_guru" placeholder="Masukan Nama Guru">
                </div>

                <div class="container">
                    <label class="form-label mt-2" for="pendidikan_guru">Pendidikan Guru</label>
                    <select class="form-select" name="pendidikan_guru" id="pendidikan guru">
                            <option value="-1">Pilih Pendidikan Guru</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                            <option value="D1">D1</option>
                            <option value="D2">D2</option>
                            <option value="D3">D3</option>
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