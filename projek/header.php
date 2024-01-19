<?php 
include 'koneksi.php';
$judul = ['Platform Top up Game','About Us','Login','Register','Bayar','Hasil Pencarian'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= 'Pinipin - '.$judul[$pageid]?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body style="background-color: #1a1a1a;">


<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark z-3" style="height: 4.5rem;">
  <div class="container-fluid bg-dark">
    <a class="navbar-brand" href="/projek" style="font-size: 30px;"><b style="color : #0D6EFD;";>Pini</b><b>Pin</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 col-md-2">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/projek#topup">Top up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"></a>
        </li>
      </ul>
      <!-- SEARCH BAR -->
      <form class="d-flex col-md-7 mx-auto" role="search" action="search.php" method="get">
        <div class="col me-2 border-1 border-dark-subtle rounded-pill">
          <input class="form-control border-1 border-dark-subtle rounded-pill" type="search" placeholder="Search" aria-label="Search" style="background-color: #212529;color: #ffffff;" name="search">
        </div>
      </form>
      <div class="container col-md-3 text-center d-flex pe-5 justify-content-center text-white">
        <div class="row">
          <?php
          if(isset($_SESSION['username']))
          {
            if($_SESSION['username'] != 'admin'){
          ?>
            <div class="col-md-6">
              <h5>Halo <?=$_SESSION['username']?></h5>
            </div>
          <?php
            }else{
            ?>
            <div class="col-md-6">
                <a class="btn btn-primary" href="admin.php">Admin Menu</a>
            </div>
          <?php
            }
            echo '<div class="col">';
            echo '<a class="btn btn-primary" href="logout.php">log out</a>';
            echo '</div>';
          }else{
          ?>
            <div class="col-md-5 m-auto">
              <a class="btn btn-outline-primary" href="login.php">Login</a>
            </div>
            <div class="col-md-7 m-auto">
              <a class="btn btn-primary" href="register.php">Sign in</a>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</nav>

<section>
  <div class="vh-100 float-end bg-dark d-none d-lg-block position-fixed end-0 z-3 justify-content-center text-center " data-bs-theme="dark" style="width : 5rem ;">
    <div class="container-fluid p-0" >
      <ul class="navbar d-none d-md-block " >
        <li class="mb-3">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon" ></span>
        </button>
      </li>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <li class="nav-item">
          <a href="index.php"class="btn btn-dark rounded-0 w-100 py-4">
            <i class="fas fa-home " style="font-size:1.5rem;"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="#"class="btn btn-dark rounded-0 w-100 py-4">
            <i class="fa-solid fa-circle-info" style="font-size:1.5rem;"></i>
          </a>
        </li>
      </ul>
      </div>
    </div>
  </div>
</section>

