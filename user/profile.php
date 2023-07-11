<?php include '../connection.php';

include '../header.php';
include '../menu.php';
session_start();?>
<?php
    if(!isset($_SESSION['userName'])){
        header('Location: /login.php');
    }?>


<section class="container mt-5">
<div class="row justify-content-md-center">
<table  class="table table-striped table-condensed" id="tblData">
    
    <?php
     $users = array();
?>
    <tbody>
       <?php $results=array();
       $userr_id=$_SESSION['userId'];
           $query="SELECT id, name, mobile_no,email,created_at from notes_user where id='$userr_id'";
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
      <thead>
        <tr>
            <th colspan="5">
                <h1 style="text-align:left">Your Profile~<?php echo $result['name']; ?></h1>

        </th>
        </tr>
    </thead>
        <tr>
            <td class="text-center">
                <label class="form-label">User ID</label>
            </td>
            <td class="text-info">
                <?php echo 100+$result['id']; ?>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <label class="form-label">User Name</label>
            </td>
            <td class="text-info">
                <?php echo $result['name']; ?>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <label class="form-label">Contact No.</label>
            </td>
            <td class="text-info">
                <?php echo $result['mobile_no']; ?>
            </td>
        </tr>
            <td class="text-center">
                <label class="form-label">Email Id</label>
            </td>
            <td class="text-info">
                <?php echo $result['email']; ?>
            </td>
        </tr>
        </tr>
            <td class="text-center">
                <label class="form-label">Registration Date</label>
            </td>
            <td class="text-info">
                <?php echo date('d-m-Y',strtotime($result['created_at'])); ?>
            </td>
        </tr>
      <?php 
           } 
           
      ?>
      <tr>
        <td colspan="2" style="text-align:center">
            <button type="button" class="btn btn-primary" onclick="window.location.href='../notes/notes.php';"  >Back</button>
        </td>
        </tr>
                </tbody>
                </table>
      </div>
        </section>