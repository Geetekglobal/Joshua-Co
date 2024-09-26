<?php
include("connect.php");
if(!empty($_SESSION["id"])){
    header("location: home.php");
}
if(isset($_POST["submit"])){
    $email = $_POST["admin_email"];
    $password = $_POST["admin_password"];
    $result = mysqli_query($conn, "SELECT * FROM admins WHERE admin_email = '$email'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0){
        $hasedpassword =$row["admin_password"];
        if(!password_verify($password, $hasedpassword)){
            echo 
            "<script> alert('incorect password'); </script>" ;
        }else{
        $_SESSION["login"] = true;
        $_SESSION["id"] = $row["admin_id"];
        header("location: home.php");
         echo 
        "<script> alert('login sucessfull'); </script>" ;

        }
    }
    else{
        echo 
        "<script> alert('user not found '); </script>" ;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<Style>
  #formbox{
    display:flex;
    justify-content:center;
    align-content:center;
    width:100%
   }
   form{
    max-width: 330px;
    padding: 15px;
    margin: 50px auto;
    background: #2196f3;
    color: #fff;
    padding: 10px;
    border: none !important;
    box-shadow: 0 7px 16px #0a86e9, 0 4px 5px #0a86e9;
    padding-bottom: 50px;
    padding-top: 30px;
    text-align:center;
    padding:15px;
}
input{
  font-size: 18px;
    padding: 10px 10px 10px 5px;
    display: block;
    width: 80%;
    margin:10px;
    border: none;
    background: none;
    border-bottom: 1px solid #757575;
}
button{
  font-size: 18px;
    display: block;
    width: 85%;
    margin:10px;
    padding: 10px;
    }
    h1{
      border-bottom:1px solid white;
    }
</Style>
  <link rel="shortcut icon" href="asset/img/favicon.png">

</head>

<body>
    <div id="formbox">
    <form action="" method="post" autocomplet="off">
      <H1> Admin Login</H1><br>
         <label for="name">Email: </label>
        <input type="admin_email" name= "admin_email" id="email" required value=""><br>
        <label for="password">Password: </label>
        <input type="password" name= "admin_password" id="password" required value=""><br>
        <button type="submit" name="submit"> log in</button><br>

    </form>
    </div>
</body>
</html>