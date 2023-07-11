<?php include '../connection.php';

include '../header.php';
include '../menu.php';
session_start();?>
<?php
    if(!isset($_SESSION['userName'])){
        header('Location:login.php');
    }?>
<section class="container mt-5">
<div class="row justify-content-md-center">
<table  class="table table-striped table-condensed" id="tblData">
    <thead>
        <tr>
            <th colspan="5"><h1 style="text-align:center">Users List</h1></th>
        </tr>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Mobile No.</th>
            <th>EmailID</th>
            <th>Created</th>
       </tr>
    </thead>
    <?php
     $users = array();
?>
    <tbody>
       <?php $results=array();
           $query="SELECT id, name, mobile_no,email,created_at from notes_user";
           //$query="SELECT * from notes_user where name='testUser' and password='abc@123'";
           $data = mysqli_query($conn,$query);
           if (mysqli_num_rows($data) > 0) { 
           while ($row =  mysqli_fetch_assoc($data))
            {   
               $results[]=$row;
            }
        }
                foreach ($results as $result){
      ?>
        <tr>
            <td><?php echo $result['id']; ?></td>
            <td><?php echo $result['name']; ?></td>
            <td><?php echo $result['mobile_no']; ?></td>
            <td><?php echo $result['email']; ?></td>
            <td><?php echo $result['created_at']; ?></td>
        </tr>

      <?php 
           } 
           
      ?>
      </div>
        </section>