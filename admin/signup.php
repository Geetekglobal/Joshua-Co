<?php
include ("connect.php");
if(isset($_POST["submit"])){
$name = $_POST["admin_name"];
$email = $_POST["admin_email"];
$password = $_POST["admin_password"];
$confirmpassword = $_POST["confirmpassword"];

$duplicate =mysqli_query($conn, "SELECT * FROM admins WHERE admin_email = '$email'");
if(mysqli_num_rows($duplicate) > 0){
    echo 
    "<script> alert('Email already exist'); </script>" ;

}else{
    if($password == $confirmpassword){
        $hasedpassword = password_hash($password, PASSWORD_BCRYPT);
        $query ="INSERT INTO admins VALUES('','$name','$email','$hasedpassword')";
        mysqli_query($conn,$query);
        echo "<script> alert('sign up completed.')</script>";
         header("location: index.php");
        
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
</head>
<body>
    <h1>sign up</h1>
    <form action="" method="post" autocomplet="off">
        <label for="admin_name">Name: </label>
        <input type="text" name= "admin_name" id="name" required value=""> <br>
        <label for="name">Email: </label>
        <input type="admin_email" name= "admin_email" id="email" required value=""><br>
        <label for="password">Password: </label>
        <input type="password" name= "admin_password" id="password" required value=""><br>
        <label for="confirmpassword">Confrim Password: </label>
        <input type="confirmpassword" name= "confirmpassword" id="confirmpassword" required value=""><br>
        <button type="submit" name="submit"> Sign Up</button><br>
        <a href="login.php">Login</a>
    </form>
</body>
</html>