<?php
require 'koneksi.php';
if($_SERVER["REQUEST_METHOD"]=="GET"){
    $id_game = $_GET['id_game'];
    $sql = "DELETE FROM thumbs WHERE id_game = $id_game";
    if($koneksi->query($sql)===TRUE){
        header("Location: index.php");
    }
    else{
        echo "ERROR".$koneksi->error;
    }
}
$koneksi->close();
?>