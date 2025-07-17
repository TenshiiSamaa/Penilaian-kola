<?php

    if(isset($_GET['mod']) && isset($_GET['nis'])){

        $nis = $_GET['nis'];
        
        $sql = "SELECT * FROM siswa WHERE nis='$nis'";

        $result = $conn->query($sql);

        if(!$result){
            die("Query ada yang salah!");
        }else{

            if($result->num_rows>0){
                $row = $result->fetch_assoc();
            }else{
                die("Data tidak ditemukan");
            }

        }

    }

?>

<div class="container w-50 border border-primary p-2" style="margin-top: 50px;">
    <h4 class="border-bottom border-primary border-3">Update Siswa</h4>
    <form method="post" action="siswa/update.php">
        <label class="form-label" for="nis">NIS</label>
        <input class="form-control" value="<?php echo $row['nis']; ?>" type="text" name="nis" id="nis" placeholder="Masukan NIS Anda">

        <label class="form-label mt-2" for="nama">Nama Siswa</label>
        <input class="form-control" value="<?php echo $row['nama_siswa']; ?>" type="text" name="nama" id="nama" placeholder="Masukan Nama Anda">

        <label class="form-label mt-2" for="jk">Jenis kelamin</label>
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

        <label class="form-label mt-2"  for="alamat">Alamat</label>
        <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat Lengkap"><?php echo $row['alamat_siswa']; ?></textarea>

        <label class="form-label mt-2" for="kelas">Kelas</label>
        <select class="form-select" id="kelas" name="kelas">
            <option value="-1">Pilih Kelas...</option>
                            
            <?php

                $kelas = array('X RPL-1',"X RPL-2","XI RPL-1","XI RPL-2");
                foreach ($kelas as $value){
                    if($value == $row['kelas_siswa']){
                        echo "<option selected value='$value'>$value</option>";
                    }else{
                        echo "<option value='$value'>$value</option>";
                    }
                }

            ?>

           
        </select>

        <div class="d-flex btn-group mt-4 " >
            <a href="?menu=siswa" class="btn btn-warning">Batal</a>
            <input class="btn btn-success" type="submit"  name="submit" value="Simpan">
        </div>
    </form>
</div>

                    
                

  