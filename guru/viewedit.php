<?php

    if(isset($_GET['mod']) && isset($_GET['kd_guru'])){

        $kdguru = $_GET['kd_guru'];
        
        $sql = "SELECT * FROM guru WHERE kd_guru='$kdguru'";

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
    <h4 class="border-bottom border-primary border-3">Update Guru</h4>
    <form method="post" action="guru/update.php">
            <div class="container">
                <label class="form-label mt-2" for="kd_guru">Kode Guru</label>
                <input class="form-control" value="<?php echo $row['kd_guru']; ?>" type="text" id="kd_guru" name="kd_guru" placeholder="Masukan Kode Guru">
            </div>
            <div class="container">
                <label class="form-label mt-2" for="nama_guru">Nama Guru</label>
                <input class="form-control" value="<?php echo $row['nama_guru']; ?>" type="text" id="nama_guru" name="nama_guru" placeholder="Masukan Nama Guru">
            </div>

            <div class="container">
                <label class="form-label mt-2" for="pendidikan_guru">Pendidikan Guru</label>
                <input class="form-control" value="<?php echo $row['pendidikan_guru']; ?>" type="text" id="pendidikan_guru" name="pendidikan_guru" placeholder="Masukan Pendidikan Guru">
            </div>
            
            
            <div class="d-flex btn-group mt-4 " >
            <a href="?menu=mapel" class="btn btn-warning">Batal</a>
            <input class="btn btn-success" type="submit"  name="submit" value="Simpan">
        </div>
    </form>
</div>

                    
                

  