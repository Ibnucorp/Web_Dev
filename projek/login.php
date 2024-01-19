<?php 
    require ('header.php');
    $pageid = 2;

if($_SERVER["REQUEST_METHOD"]=="POST"){
        $password = $_POST["password"];
        $usermail = $_POST["usermail"];
        $sql ="SELECT * FROM users WHERE email ='$usermail' OR username ='$usermail' AND password ='$password'";
        $result = $koneksi->query($sql);
        if($result->num_rows > 0){
          $row = $result->fetch_assoc();
          $_SESSION['userid']= $row['userid'];
          $_SESSION['username']= $row['username'];
          $_SESSION['email']= $row['email'];
            header("Location:index.php");
        }
        else{
            $msg = 'Email, Username atau Password salah';   
        }
    $koneksi->close();
}
?>
<div class="container-fluid row h-100 col-sm-12 mt-5">
    <div class="card card-block w-50 mx-auto my-auto p-3 mt-5 text-center" data-bs-theme="dark">
      <?php echo (isset($msg))? '<div class="alert alert-danger" role="alert">'.$msg.'</div>':"";?>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <div class="form-group row my-2">
              <label for="Email/Username" class="col-sm-3 col-form-label">Username/Email</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="usermail" placeholder="Username/Email" name="usermail" required>
              </div>
            </div>
            <div class="form-group row my-2">
              <label for="password" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
              </div>
            </div>
            <div class="form-group row mt-4">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary w-100">Login</button>
              </div>
            </div>
        </form>
    </div>
</div>
<?php require ('footer.php');?>