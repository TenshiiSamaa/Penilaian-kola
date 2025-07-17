<?php

    if(isset($_POST['siswa']) && isset($_POST['mapel'])){

        $siswa = $_POST['siswa'];
        $mapel = $_POST['mapel'];
        $sql = "INSERT INTO nilai(nis, kd_mapel) VALUES('$siswa','$mapel')";

        // CEL DULU KE TABEL NILAI ADA DATANYA NIS DAN NILAI

        $sqlcek = "SELECT * FROM nilai WHERE nis='$siswa' AND kd_mapel='$mapel'";
        $result = $conn->query($sqlcek);
        if($result->num_rows>0){
            echo "<div class='alert alert-warning'>Data Sudah Ada!</div>";
        }else{
            $simpan = $conn->query($sql);
            if(!$simpan){
                echo "<div class='alert alert-warning'>Penyimpanan bermasalah! : $conn->error</div>";
            }
        }

        

    }
    echo"<br>";
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
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?menu=nilai" method="POST">
        <div class="row float-end">
            <div class="col">
                 <select name="carimapel" class="form-select" style="width: 250px;">
                        
                    <option value="-1">Filter mapel.....</option>
                        <?php

                            $sql = "SELECT * FROM mapel";

                            //$selected = isset($_POST['carimapel'])? "selected" : "";

                            $result = $conn->query($sql);

                            if($result){
                                while($row=$result->fetch_object()){
                                    if(isset($_POST['carimapel']) && $_POST['carimapel']>0){
                                        if($_POST['carimapel']==$row->kd_mapel){
                                            echo "<option selected value='$row->kd_mapel'>$row->kd_mapel - $row->nama_mapel</option>";
                                        }else{
                                            echo "<option value='$row->kd_mapel'>$row->kd_mapel - $row->nama_mapel</option>";
                                        }
                                            
                                    }else{
                                        echo "<option value='$row->kd_mapel'>$row->kd_mapel - $row->nama_mapel</option>";
                                    }
                                    
                                }
                            }
                            if(!$result){
                                die("Query gagal : " .$conn->error);
                           }

                        ?>
                </select>
            </div>
               
             <div class="col">
                <button class="btn btn-primary">
                    <span class="bi bi-search"> Cari</span>
                </button>
            </div> 
        </div>
    </form> 
</div>  

<div class="container-fluid ">
    <form action="<?php $_SERVER['PHP_SELF'];?>?menu=nilai" method="POST">
    
        <span class="h3 col">Data Nilai Siswa</span>
        
        
        <div class="row float-end">
            <div class="col">
                <select name="siswa" class="form-select" style="width: 250px;">
                    <option value="">Pilih siswa.....</option>
                    <?php

                        $sql = "SELECT * FROM siswa";

                        $result = $conn->query($sql);

                        if($result){
                            while($row=$result->fetch_object()){
                                echo "<option value='$row->nis'>
                                    $row->nis - $row->nama_siswa
                                </option>";
                            }
                        }


                    ?>
                </select>    
            </div>
            <div class="col">
            <select name="mapel" class="form-select" style="width: 250px;">
                    <option value="">Pilih mapel.....</option>
                    <?php

                        $sql = "SELECT * FROM mapel";

                        $result = $conn->query($sql);

                        if($result){
                            while($row=$result->fetch_object()){
                                echo "<option value='$row->kd_mapel'>
                                        $row->kd_mapel - $row->nama_mapel
                                    </option>";
                            }
                        }

                    ?>
                </select>    
            </div>
            <div class="col float-end" style="margin-right: 20px;">
                    <button class="btn btn-primary">
                        <span class="bi bi-plus-circle "> Nilai</span>
                    </button>
            </div>
        </div>
    </form>
    
    
    
                    

    <br>
                          
    <!-- <a class="btn btn-dark btn-sm float-end" data-bs-toggle="modal" data-bs-target="#forminput"  href="#">
        <span class="bi bi-person-plus-fill"></span> 
        Tambah Data
    </a> -->
    <table class="table table-striped border border-default border-5 mt-3">
        <thead>
        <tr align="center">
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Kode Mapel</th>
            <th>Nama Mapel</th>
            <th>uts</th>
            <th>uas</th>
            <th>Rata-Rata</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            <?php 

                $criteria = "";
            
                if(isset($_POST['carimapel']) && $_POST['carimapel']>=0){
                    
                    $carimapel = $_POST['carimapel'];
                    $criteria = " WHERE nilai.kd_mapel='$carimapel'";
                }
        
               

                $sql = "SELECT siswa.nis, siswa.nama_siswa, 
                                mapel.kd_mapel, mapel.nama_mapel,   
                                nilai.uts, nilai.uas, nilai.id
                        FROM siswa JOIN nilai ON siswa.nis=nilai.nis JOIN mapel ON mapel.kd_mapel=nilai.kd_mapel ".$criteria;

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
            <td><?php echo $row['nis'];?></td>
            <td><?php echo $row['nama_siswa'];?></td>
            <td><?php echo $row['kd_mapel'];?></td>
            <td><?php echo $row['nama_mapel'];?></td>
            <td><?php echo $row['uts'];?></td>
            <td><?php echo $row['uas'];?></td>
            <td><?php echo ($row['uts'] + $row['uas'])/2;?></td>
            <td>
                
                <a href="#" class="" data-bs-toggle="modal" data-bs-target="#tambah-<?php echo $row['id']; ?>"><i class="bi bi-pencil-square"></i></a>
                <a href="nilai/hapus.php?id=<?php echo $row['id'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus ?');"><i class="bi bi-trash3"></i></a> 
                

                <div id="tambah-<?php echo $row['id']; ?>" class="modal fade">
                    <form method="post" action="nilai/update.php" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title h5">Form Edit nilai uts dan uas</div>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <label class="form-label mt-2 float-start" for="nis">ID Nilai</label>
                                        <input class="form-control" value="<?php echo $row['id']; ?>" type="text" id="id" name="id" placeholder="Masukan nis">

                                        <label class="form-label mt-2 float-start" for="nis">NIS SISWA</label>
                                        <input class="form-control" value="<?php echo $row['nis']; ?>" type="text" id="nis" name="nis" placeholder="Masukan nis">
                                
                                        <label class="form-label mt-2 float-start" for="nama_siswa">Nama Siswa</label>
                                        <input class="form-control" value="<?php echo $row['nama_siswa']; ?>" type="text" id="nama_siswa" name="nama_siswa" placeholder="Masukan Nama Siswa">
                                        
                                        <label class="form-label mt-2 float-start" for="kd_mapel">Kode Mapel</label>
                                        <input class="form-control" value="<?php echo $row['kd_mapel']; ?>" type="text" id="kd_mapel" name="kd_mapel" placeholder="Masukan Kode Mapel">
                                
                                        <label class="form-label mt-2 float-start" for="nama_mapel">Nama Mapel</label>
                                        <input class="form-control" value="<?php echo $row['nama_mapel']; ?>" type="text" id="nama_mapel" name="nama_mapel" placeholder="Masukan Nama Mapel">
                                        
                                        <label class="form-label mt-2 float-start" for="uts">uts</label>
                                        <input class="form-control" value="<?php echo $row['uts']; ?>" type="text" id="uts" name="uts" placeholder="Masukan uts">
                                
                                        <label class="form-label mt-2 float-start" for="uas">uas</label>
                                        <input class="form-control" value="<?php echo $row['uas']; ?>" type="text" id="uas" name="uas" placeholder="Masukan uas">
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
            <td colspan="9" align="center"><a href="#">hoyolab@hoyoverse.com</a></td>
        </tfoot>
        </tr>
    </table>
</div>
