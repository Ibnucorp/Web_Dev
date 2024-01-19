<?php 
    $pageid = 3;
    require ('header.php');
    //Memastikan form methodnya post agar tida diinjeksi
if($_SERVER["REQUEST_METHOD"]=="POST"){
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        if($password != $password2){
          $msg = "Password tidak sesuai";
        }
        else{
          $email = $_POST["email"];
          $username = $_POST["username"];
          $sql ="SELECT email,username FROM users WHERE email ='$email' OR username ='$username'";
          $result = $koneksi->query($sql);
          if($result->num_rows == 0){
            $sql = "INSERT INTO users (email,username,password)
                    VALUES ('$email','$username','$password')";
            if($koneksi->query($sql)===TRUE){
                //agar ketika di submit diarahkan index.php bukan ke proses.php
                header("Location:index.php");
            }else{
                echo "Error : ".$sql."<br>".$koneksi->error;
            }            

          }else{
            $msg = "Email atau Username sudah terdaftar";
          }
        }
    $koneksi->close();
}
?>


<div class="container-fluid row h-100 col-sm-12 mt-5" >
  <div class="card card-block w-50 mx-auto p-3 mt-5 text-center" data-bs-theme="dark">
    <p><?= $msg;?></p>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
        <div class="form-group row my-2">
          <label for="email" class="col-sm-3 col-form-label">Email</label>
          <div class="col-sm-9">
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
          </div>
        </div>
        <div class="form-group row my-2">
          <label for="username" class="col-sm-3 col-form-label">Username</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
          </div>
        </div>
        <div class="form-group row my-2">
          <label for="password" class="col-sm-3 col-form-label">Password</label>
          <div class="col-sm-9">
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
          </div>
        </div>
        <div class="form-group row my-2">
          <label for="password2" class="col-sm-3 col-form-label">Confirm Password</label>
          <div class="col-sm-9">
            <input type="password" class="form-control" id="password2" placeholder="Re-enter Password" name="password2" required>
          </div>
        </div>
        <div class="form-group row mt-4">
          <div class="col">
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
          </div>
        </div>
    </form>
  </div>
</div>
<?php require ('footer.php');?>