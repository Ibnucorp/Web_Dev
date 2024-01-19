<?php
require 'koneksi.php';
$pageid = 4;
require 'header.php';
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $id_game = $_GET['id_game'];
        // membuat query ke database untuk menambah data
        $sql = "SELECT * from thumbs where id_game = '$id_game'";
        $result = $koneksi->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
        }else{
            echo"Data tidak ditemukan";
            exit;
        }
    }
?>
<section>
    <div class="container-fluid d-grid justify-content-center" style="padding-right : 6rem; padding-top:5rem;">
        <div class="card mb-3 mt-5 rounded-4 border-1 border-dark-subtle text-center justify-content-center" style="min-width: 720px;" data-bs-theme="dark">
        <div class="row g-0">
            <div class="col-sm-4 text-center ps-5 my-auto">
            <img src="<?=$row['img_path']?>" class="card-img-top m-auto mt-3 rounded-5 border border-2" alt="..." style="min-width:25%;">
                <p class="card-title m-0 " style="font-size:0.8rem;"><?= $row['dev']?></p>
                <h6 class="card-text mb-sm-1"><strong><?= $row['title']?></strong></h6>
            </div>
            <div class="col-sm-8">
                <div class="card-body">
                    <h2 class="card-title m-0 ">Pembayaran</h2>
                    <h6 class="card-text mb-sm-1"><strong><?= $row['title']?></strong></h6>
                    <form action="index.php" method="post">
                        <?php if (!isset($_SESSION['username'])){
                            $tmp = 'Email';
                        }else{
                            $tmp = [$_SESSION['userid'],$_SESSION['email']];
                        }?>
                        <div class="form-group row m-3">
                          <label for="email" class="col-sm-4 col-form-label">Email</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="email" value="<?=$tmp[1]?>" name="email" required>
                          </div>
                        </div>
                        <div class="form-group row m-3">
                          <label for="userid" class="col-sm-4 col-form-label">ID Pengguna</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="userid" value="<?=$tmp[0]?>" name="ingameid" required>
                          </div>
                        </div>
                            <div class="container">
                                <div class="row">                        
                        <?php
                            $sql = "SELECT id,nominal,harga from harga WHERE id_game = '$id_game'";
                            $result = $koneksi->query($sql);
                            if($result->num_rows > 0){
                                $row = $result->fetch_assoc();
                            }else{
                                echo"Data tidak ditemukan";
                                exit;
                            }
                            $i=0;

                            while ($row = $result->fetch_assoc()) {
                                $i++;                           
                        ?>
                                <div class="col-sm-4">
                                    <input type="radio" class="btn-check" name="options" id="option<?=$i?>" autocomplete="off" <?php if($i==1){echo 'checked';} ?> value="<?=$row['id']?>">
                                    <label class="btn btn-outline-primary" for="option<?=$i?>"><i class="fa-regular fa-gem"></i><?=$row['nominal']?></label>
                                    <p class="small m-2">Rp.<?= number_format($row['harga'],0,'.','.');?></p>
                                </div>

                        <?php
                        }
                        ?>
                            </div>
                        </div>
                        <div class="form-group row my-3">
                          <div class="col-sm-12 text-end pe-5">
                            <button type="submit" class="btn btn-primary">Bayar</button>
                          </div>
                        </div>                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
require 'footer.php';
?>