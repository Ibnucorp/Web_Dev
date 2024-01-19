<?php
$server = "localhost";
$username = "root";
$pass = "";
$dbname = "olshop";

$koneksi =  new mysqli($server,$username,$pass,$dbname);

if($koneksi->connect_error){
    die("Connection failed : ".$koneksi->connect_error);
}
SESSION_START();

?>