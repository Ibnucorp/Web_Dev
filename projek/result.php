<?php 
$pageid = 5;
include 'header.php';

?>

<section id="topup">
    <div class="container-fluid d-grid justify-content-center" style="padding-right : 6rem; margin-top :5rem;">
        <h1 class="text-white container">Hasil Pencarian<hr style="color : white;"></h1>
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
                echo '<div class="rounded-1" style="position : absolute;right: 25px;top: 10px;font-size :15px; background-color : #0D6EFD; padding : 0px 5px 0px 5px;"><b>New</b></div>';
            }?>
            <img src="<?= $row['img_path']?>" class="card-img-top w-75 m-auto mt-3 rounded-5" alt="<?=$row['title']?>">
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