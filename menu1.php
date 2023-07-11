<?php 
include 'connection.php';
session_start();?>
<nav class="navbar navbar-default"style="background-color:#279bc0">
  <div class="container-fluid">
    <div class="navbar-header" style="color: white">
      <a class="nav-link text-left fs-2" style="color: white" href="#"><h1><b>Notes~</b><?php echo($_SESSION['userName']);?></h1></a>
    </div>
    <ul class="nav">
      <li class="active fs-2" ><a style="color: black" href="./login.php">LogIn</a></li>
      <li class="position: relative fs-2" ><a style="color: black" href="../user/registration.php">Register</a></li>
    </ul>
  </div>
</nav>
