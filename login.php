<?php 
include 'connection.php';
session_start();
include 'header.php'
;?>

<?php   
if(isset($_POST['user_name'])&& ($_POST['user_pwd'])){
    
    $user_name = $_POST['user_name'];  
    $user_password = $_POST['user_pwd'];
    
            //to prevent from mysqli injection  
            $username = stripcslashes($username);  
            $password = stripcslashes($password);  
            $username = mysqli_real_escape_string($conn, $username);  
            $password = mysqli_real_escape_string($conn, $password);  


  $sql = "SELECT *from notes_user where 	name= '$user_name' and password = '$user_password'"; 

  $result = mysqli_query($conn, $sql);  

  $count = mysqli_num_rows($result);  
  $data=mysqli_fetch_assoc($result);
  //$user_name = $data('name');
  
  if($count == 1){
    $_SESSION['userId'] = $data['id'];
     $_SESSION['userName'] = $user_name;  
    $_SESSION['login'] = "1";
    header("Location: notes/add.php");exit;ob_end_flush();
    //header("Pragma: no-cache");
    
    echo "<h1><center> Login successful </center></h1>";  
}  
else{  
    echo "<h1> Login failed. Invalid username or password.</h1>";  
} 
}
  ?>
<section class="container mt-5">   
<div class="row justify-content-md-center">
<form method = "POST" class="col-md-6 col-sm-12 rounded shadow form-bgcolor" style="background-color: transparent" action="">
<h1 class="bg-gradient" style="text-align:center;color: black">Log In</h1>
    <div class="login-form" style="text-align:left">
    <div class="mb-3" style="color: black">
        <label class="form-label" >User Name</label>
        <i class="fa fa-user"></i>
       <input type="text" id="user_name" name="user_name" class="input-group" required>
</div>
<div class="mb-3" style="text-align: left; color: black">
        <label class="form-label" style="text-color: white">Password</label>
        <i class="fa-solid fa-lock"></i>
        <input type="password" id="user_pwd" name="user_pwd" class="input-group" required>

<div class="mb-3">
        <input class="btn btn-success" type="submit" value="Login" id="submit">
        <a class="btn btn-primary" href="../user/registration.php" value="New User" id="create_user">Create New User</a>
</div>
</div>
</form>
</div>
</section>
