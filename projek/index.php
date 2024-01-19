<?php 
$pageid = 0;
include 'header.php';

?>
<hr style="margin-bottom: 4rem;">
<div class="container-fluid " >
    <div id="carouselExampleAutoplaying" class="carousel slide me-5" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php
        $sql = "SELECT * FROM tb_berita";
        $result = $koneksi->query($sql);
        $i=0;
        while($row = $result->fetch_assoc()){
          if($i == 0){
        ?>
        <div class="carousel-item active">
          <div class="container ">
            <div class="row d-flex w-100 p-5">
              <div class="col-md-8 col-sm-8 bg-dark rounded-start-5 p-0" style="min-width:1px;">
                <img class="rounded-start-5 w-100 h-100" src="<?= $row['img_path']?>" alt="">
              </div>
              <div class="col-md-4 col-sm-4 bg-dark rounded-end-5 text-warning ">
                <p class="my-4"><?= $row['tanggal']?></p>
                <h2 class=""><?= $row['judul']?></h2>
                <p class=""><?= $row['deskripsi']?></p>
              </div>
            </div>
          </div>
        </div>
        <?php
          }else{
        ?>
        <div class="carousel-item">
          <div class="container">
            <div class="row d-flex w-100 p-5">
              <div class="col-md-8 col-sm-8 bg-dark rounded-start-5 p-0" style="min-width:1px;">
                <img class="rounded-start-5 w-100 h-100" src="<?= $row['img_path']?>" alt="">
              </div>
              <div class="col-md-4 col-sm-4 bg-dark rounded-end-5 text-warning ">
                <p class="my-4"><?= $row['tanggal']?></p>
                <h2 class=""><?= $row['judul']?></h2>
                <p class=""><?= $row['deskripsi']?></p>
              </div>
            </div>
          </div>
        </div>
        <?php
          }
          $i++;
        }
        ?>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    </div> 
</div>

<section id="topup">
    <div class="container-fluid d-grid justify-content-center" style="padding-right : 6rem;">
        <h1 class="text-white container">Trending<hr style="color : white;"></h1>
        <?php echo $_SESSION['name']?>
    <div class="row justify-content-center">

        <?php
$thumb = "SELECT * FROM thumbs";
$result = $koneksi->query($thumb);
$i = 0;
while($row = $result->fetch_assoc()){
    $i++;
    
    ?>
        <div class="card mx-4 mt-5 rounded-4 border-1 border-dark-subtle text-center justify-content-center col-md-2 col-sm-4 " style="width: 10.5rem; height: 18rem;" data-bs-theme="dark">
            <?php if($row['new']==1){
                echo '<div class="rounded-1" style="position : absolute;right: 10px;top: 10px;font-size :15px; background-color : #0D6EFD; padding : 0px 5px 0px 5px;"><b>New</b></div>';
            }?>
            <img src="<?= $row['img_path']?>" class="card-img-top w-100 h-50 m-auto mt-3 rounded-5" alt="<?=$row['title']?>">
            <div class="card-body px-0">
                <p class="card-title m-0 " style="font-size:0.8rem;"><?= $row['dev']?></p>
                <h6 class="card-text mb-sm-1"><strong><?= $row['title']?></strong></h6>
                <form action="transaksi.php" method="get">
                    <input type="text" name="id_game" id="id_game" class ="form-control d-none" value="<?= $row['id_game'];?>" readonly>
                    <input class="btn btn-outline-primary rounded-5 container-fluid position-absolute bottom-0 translate-middle-x w-75 mb-2" type="submit" value="Top Up">
                </form>
            </div>
        </div>
        <?php
}
?>
</div>
</div>
</section>
<?php
include 'footer.php';
?>