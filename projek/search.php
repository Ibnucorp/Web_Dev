<?php 
$pageid = 5;
include 'header.php';
require 'koneksi.php';

// Periksa apakah parameter pencarian ada dalam URL
if (isset($_GET['search'])) {
    // Dapatkan nilai pencarian dari parameter URL
    $searchTerm = $_GET['search'];

    // Query pencarian di database (misalnya, pada tabel 'produk')
    $sql = "SELECT * FROM thumbs WHERE dev LIKE '%$searchTerm%' OR title LIKE '%$searchTerm%'";
    $result = $koneksi->query($sql);
    $i=0;
    // Tampilkan hasil pencarian
    echo'<section>
    <div class="container-fluid justify-content-center" style="padding-right : 6rem; margin-top :5rem;">';
    if ($result->num_rows > 0) {?>
        <h1 class="text-white container start-0 ms-5">Hasil Pencarian untuk : <?=htmlspecialchars($searchTerm)?><hr style="color : white;"></h1>
        <div class="row justify-content-center">
        <?php
        while ($row = $result->fetch_assoc()) {
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
    } else {
        ?>
        </div>
        <h1 class="text-white container start-0 ms-5">Tidak ada hasil untuk : <?=htmlspecialchars($searchTerm)?><hr style="color : white;"></h1>
        <?php
    }
} else {
    echo "Silakan masukkan kata kunci pencarian.";
}
// Tutup koneksi ke database
$koneksi->close();
?>
</div>
</section>
<?php
include 'footer.php';
?>