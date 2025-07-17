<?php

    if(isset($_GET['mod']) && isset($_GET['kd_mapel'])){

        $kdmapel = $_GET['kd_mapel'];
        
        $sql = "SELECT * FROM mapel WHERE kd_mapel='$kdmapel'";

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
    <h4 class="border-bottom border-primary border-3">Update Mapel</h4>
    <form method="post" action="mapel/update.php">
            <div class="container">
                <label class="form-label mt-2" for="kd_mapel">Kode Mapel</label>
                <input class="form-control" value="<?php echo $row['kd_mapel']; ?>" type="text" id="kd_mapel" name="kd_mapel" placeholder="Masukan Kode Mapel">
            </div>
            <div class="container">
                <label class="form-label mt-2" for="nama_mapel">Nama Mapel</label>
                <input class="form-control" value="<?php echo $row['nama_mapel']; ?>" type="text" id="nama_mapel" name="nama_mapel" placeholder="Masukan Nama Mapel">
            </div>

            <div class="container">
                <label class="form-label mt-2" for="jp">Jam Pelajaran</label>
                <input class="form-control" value="<?php echo $row['jp']; ?>" type="text" id="jp" name="jp" placeholder="Masukan Jam Pelajaran">
            </div>
           
        <div class="d-flex btn-group mt-4 " >
            <a href="?menu=mapel" class="btn btn-warning">Batal</a>
            <input class="btn btn-success" type="submit"  name="submit" value="Simpan">
        </div>
    </form>
</div>

                    
                

  