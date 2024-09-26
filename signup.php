<?php
include ("connect.php");
if(isset($_POST["submit"])){
$name = $_POST["user_name"];
$email = $_POST["user_email"];
$password = $_POST["password"];
$confirmpassword = $_POST["confirmpassword"];

$duplicate =mysqli_query($conn, "SELECT * FROM subscribers WHERE user_email = '$email'");
if(mysqli_num_rows($duplicate) > 0){
    echo 
    "<script> alert('Email already exist'); </script>" ;

}else{
    if($password == $confirmpassword){
        $hasedpassword = password_hash($password, PASSWORD_BCRYPT);
        $query ="INSERT INTO subscribers VALUES('','$name','$email','$hasedpassword')";
        mysqli_query($conn, $query);
        echo "<script> alert('sign up completed.')</script>";
        header("Location: dashboard.php");
        exit();
    
        
    }else{
        echo "<script> alert('password does not Match');</script>";
       
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
<body >
    <div class="container my-4 pt-4 ">
    <h1 class= "text-center pt-4">sign up</h1>
    <form class="row g-3 container" action="" method="post" autocomplet="off">
        <div class="col-12">
        <label for="admin_name" class="form-label">Full Name: </label>
        <input type="text" name= "user_name" class="form-control" id="inputEmail4" required value=""> <br>
        </div>
        
        <div class="col-12">
        <label for="inputEmail4" class="form-label" >Email</label>
         <input type="email" name= "user_email" class="form-control" id="inputEmail4" required value="">
        </div>

        <div class="col-md-6">
         <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" class="form-control" name= "password" id="inputPassword4" required value="">
        </div>

        <div class="col-md-6">
         <label for="confirmpassword" class="form-label">Confrim Password</label>
            <input type="confirmpassword" name= "confirmpassword" class="form-control" name= "admin_password" id="inputPassword4" required value="">
        </div>
        <div class="col-12 text-center">
        <button type="submit" name="submit" class="btn btn-primary form-control"> Sign Up</button>
        </div>

        <div class="text-center">
        <a href="login.php">Already have an aaccount, Login</a>
        </div>

    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>