<?php
include 'header.php';
if($_SESSION['username'] != 'admin'){
  header("Location:index.php");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $title = $_POST['title'];
    $dev = $_POST['dev'];
    $thumb = $_FILES['thumb']['name'];
    $target_dir = "img/";
    $target_file = $target_dir.basename($thumb);
    $sql = "INSERT INTO thumbs(title,dev,new,img_path) VALUES ('$title','$dev',1,'$target_file')";

        if($koneksi->query($sql)===TRUE){
          $upload = move_uploaded_file($_FILES["thumb"]["tmp_name"], $target_file);
          if($upload){
              header("Location:admin.php");
          }
        }else{
            echo "Error : ".$sql."<br>".$koneksi->error;
        }
  
   $nominal = [$_POST['nominal_1'],$_POST['nominal_2'],$_POST['nominal_3'],$_POST['nominal_4'],$_POST['nominal_5']];
   $harga   = [$_POST['harga_1'],$_POST['harga_2'],$_POST['harga_3'],$_POST['harga_4'],$_POST['harga_5']];
   $sql = "SELECT id_game,title FROM thumbs ORDER BY id_game DESC LIMIT 1";
   $result = $koneksi->query($sql);

   while($row = $result->fetch_assoc()){
    for($i=1;$i<=5;$i++){
      $sql = "INSERT INTO harga(id_game,nominal,harga) values (".$row['id_game'].",".$nominal[$i].",".$harga[$i].")";
      $koneksi->query($sql);
    }
  }
}
?>
<div class="container-fluid row h-100 col-sm-12 mt-5">
    <div class="card card-block w-50 mx-auto my-auto p-3 mt-5 text-center" data-bs-theme="dark">
        <p></p>

        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Upload Game Baru
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
                    <?=$row['id_game']?>
                    <div class="form-group row my-2">
                    <label for="title" class="col-sm-3 col-form-label">Judul Game</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" placeholder="Judul Game" name="title" required>
                      </div>
                    </div>
                    <div class="form-group row my-2">
                      <label for="dev" class="col-sm-3 col-form-label">Developer</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="dev" placeholder="Developer" name="dev" required>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="thumb" class="col-sm-3 col-form-label">Thumbnail</label>
                      <div class="col-sm-9">
                          <input type="file" class="form-control" id="thumb" name="thumb" placeholder="" required>
                          <div class="row ">
                            <p class="opacity-75 small">200 x 200</p>
                          </div>
                      </div>
                    </div>
                    <h2>Top Up</h2>
                    <?php
                      for($i=1;$i<=5;$i++){
                        ?>
                    <div class="form-group row my-2">
                      <label for="nominal<?='_'.$i?>" class="col-sm-3 col-form-label">Nominal<?='_'.$i?></label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="nominal<?='_'.$i?>" placeholder="Nominal<?='_'.$i?>" name="nominal<?='_'.$i?>" required>
                      </div>
                      <label for="harga<?='_'.$i?>" class="col-sm-2 col-form-label">Harga<?='_'.$i?></label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="harga<?='_'.$i?>" placeholder="Harga<?='_'.$i?>" name="harga<?='_'.$i?>" required>
                      </div>              
                    </div>
                      <?php  
                      }
                      ?>            
                    <div class="form-group row mt-4">
                      <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                      </div>
                    </div>
                </form>
            </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Hapus Game
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <?php
                $sql = "SELECT id_game,title,dev,img_path FROM thumbs";
                $result = $koneksi->query($sql);
                while($row = $result->fetch_assoc()){
                ?>
                    <div class="form-group row my-2">
                      <img src="<?=$row['img_path']?>" class="col-sm-3" style="max-width:5rem;">
                      <label for="" class="col-sm-6 col-form-label"><?= $row['title']?></label>
                        <div class="col-sm-3 text-end">
                          <a href="hapus.php?id_game=<?php echo $row['id_game'];?>" class="btn btn-danger btn-sm"
                          onclick ="return confirm('Apakah yakin untuk menghapus?')">Hapus</a>
                        </div>
                    </div>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Upload Berita
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <form action="add-berita.php" method="get">
                    <div class="form-group row my-2">
                      <label for="judul" class="col-sm-3 col-form-label">Headline</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="judul" placeholder="Headline" name="judul" required maxlength="40">
                        </div>
                    </div>
                    <div class="form-group row my-2">
                      <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                          <textarea name="deskripsi" rows="4" cols="45" style="resize: none;" maxlength="50"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label for="image" class="col-sm-3 col-form-label">Thumbnail</label>
                      <div class="col-sm-9">
                          <input type="file" class="form-control" id="image" name="image" placeholder="" required>
                          <div class="row ">
                            <p class="opacity-75 small">683 x 384</p>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row mt-4">
                      <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Hapus Berita
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <?php
                $sql = "SELECT id_berita,judul,img_path FROM tb_berita";
                $result = $koneksi->query($sql);
                while($row = $result->fetch_assoc()){
                ?>
                    <div class="form-group row my-2">
                      <?=$row['id_berita']?>
                      <img src="<?=$row['img_path']?>" class="col-sm-3" style="max-width:5rem;">
                      <label for="" class="col-sm-6 col-form-label"><?= $row['judul']?></label>
                        <div class="col-sm-3 text-end">
                          <a href="hapus-berita.php?id_berita=<?php echo $row['id_berita'];?>" class="btn btn-danger btn-sm"
                          onclick ="return confirm('Apakah yakin untuk menghapus?')">Hapus</a>
                        </div>
                    </div>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>        
    </div>
</div>
<?php
include 'footer.php';
?>