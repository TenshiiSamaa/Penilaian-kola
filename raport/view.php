<div class="container-fluid mt-3">
    <!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?menu=laporan" method="POST">
        <span class="h3">Data Raport</span>
        <div class="row float-end">
            <div class="col">
                 <select name="carikelas" class="form-select" style="width: 250px;">
                        
                    <option value="-1">Pilih kelas...</option>
                        <?php

                            //$sql = "SELECT * FROM kelas";

                            //$selected = isset($_POST['carimapel'])? "selected" : "";

                            //$result = $conn->query($sql);

                            //if($result){
                                //while($row=$result->fetch_object()){
                                    //if(isset($_POST['carikelas']) && $_POST['carikelas']>0){
                                        //if($_POST['carikelas']==$row->kd_kelas){
                                            echo "<option selected value='$row->kd_kelas'>$row->kd_kelas - $row->nama_kelas</option>";
                                       // }else{
                                            echo "<option value='$row->kd_kelas'>$row->kd_kelas - $row->nama_kelas</option>";
                                        //}
                                            
                                    //}else{
                                      //  echo "<option value='$row->kd_kelas'>$row->kd_kelas - $row->nama_kelas</option>";
                                   // }
                                    
                               // }
                            //}
                           // if(!$result){
                              //  die("Query gagal : " .$conn->error);
                          // }

                        ?>
                </select>
            </div>
               
             <div class="col">
                <button class="btn btn-primary">
                    <span class="bi bi-search"> Cari</span>
                </button>
            </div> 
        </div>
    </form> -->


    <div class="row">
        <div class="col">
            <span class="h3">Cetak Raport</span>
        </div>
        <div class="col">
        <form id="pilKelasForm" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="GET">
            
            <input type="hidden" name="menu" value="<?php echo $_GET['menu']; ?>">

            <select class="form-select" name="pilKelas" onchange="pilKelasForm.submit()" >
                <option value="-1">Pilih Kelas</option>
                <?php
                    $q = "SELECT * FROM kelas";
                    $result = $conn->query($q);
                    if($result){
                        if($result->num_rows>0){
                            while ($row=$result->fetch_object()) {
                                if($_GET['pilKelas']==$row->kd_kelas){
                                    echo "<option selected value='$row->kd_kelas'>$row->nama_kelas</option>";
                                }else{
                                    echo "<option value='$row->kd_kelas'>$row->nama_kelas</option>";
                                }
                                
                            }
                        }
                    }

                ?>
            </select>
        </form>
        </div>
    </div>
    
    

    <table class="table  table-striped">
        <thead>
        <tr align="center">
            <th>No</th>
            <th>NIS</th>
            <th>KELAS</th>
            <th>NAMA</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
                $kdkelas = isset($_GET["pilKelas"]) && $_GET["pilKelas"] !=-1 ? "WHERE siswa.kd_kelas=".$_GET["pilKelas"] : "";

                $q = "SELECT * FROM siswa JOIN kelas ON siswa.kd_kelas=kelas.kd_kelas ".$kdkelas;

                $result = $conn->query($q);
                if($result){
                    $no = 1;
                    if($result->num_rows>0){
                        while($row=$result->fetch_object()){
            ?>
            <tr align="center">
                <td><?php echo $no; ?></td>
                <td><?php echo $row->nis; ?></td>
                <td><?php echo $row->nama_kelas; ?></td>
                <td><?php echo $row->nama_siswa; ?></td>
                <td><a href="raport/viewcetak.php?nis=<?php echo $row->nis; ?>" class="link" target="_BLANK"><span class="bi bi-file-earmark-bar-graph"></span> Cetak Raport</a></td>
            </tr>
            <?php       
                        $no++;
                        


            ?>


        <?php 
                    $no++;
                    }
                }else{
                echo"<tr>
                        <td colspan='5'
                            Data belum ada.....
                        </td>
                    </tr>";
                }
            }else{
                die("query gagal bermasalaha!: ".$conn->error);
            }    
        ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5" align="center">hoyoverse.com</td>
        </tfoot>
        </tr>
    </table>
</div>




                    