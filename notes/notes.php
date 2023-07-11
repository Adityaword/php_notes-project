<?php include '../connection.php';

include '../header.php';
include '../menu.php';
session_start();?>

<!-- code for the session -->

<?php
    if(!isset($_SESSION['userName'])){
        header('Location: /login.php');
    }
    $headerUserName="";
    $GLOBALS['headerUserName']=$_SESSION['userName'];?>

    <!-- code for pagination -->
<?php
$limit=5;

if (isset($_GET["page"])) { 
    $pageno  = $_GET["page"]; 
  } 
  else { 
    $pageno=1; 
  };

  $start_from = ($pageno-1) * $limit;  

?>

<section class="container mt-5">
   
<div class="row justify-content-md-center">
<div class="form-group " style="text-align:center">
<form method = "POST">
<table class="table-condensed">
    <tr>
    <div class="mb-3" style="text-align: left;">
<td style="width:15%; text-align:center"><label class="form-label">Title Search</label></td>
<td style="width:20%"><input type="search" name="title_search" class="form-control" placeholder="Enter Keywords..."></td>
</div>

<div class="mb-3" style="text-align: left;">
<td style="width:15%; text-align:center"><label class="form-label">Notes Search</label></td>
<td style="width:20%"><input type="search" name="notes_search" class="form-control" placeholder="Enter Keywords..."></td>
</div>
<tr>
    <div class="mb-3" style="text-align: left;">
<td style="width:15%; text-align:center"><label class="form-label">From</label></td>
<td style="width:20%"><input type="date" name="from_dt" class="form-control" ></td>
</div>

<div class="mb-3" style="text-align: left;">
<td style="width:15%; text-align:center"><label class="form-label">To</label></td>
<td style="width:20%"><input type="date" name="to_dt" class="form-control" ></td>
</div>
<td style="width:20%">
<input class="btn btn-success" style="text-align: right;" type="submit" value="search" class="form-control">
</td>
</tr>
</table>
</form>
</div>
<table  class="table table-striped table-condensed" id="tblData">
    <thead>
        <tr>
            <th colspan="6"><h1 style="text-align:center"><a href="./notes.php" style="text-decoration:none">Note Lists</a></h1>
            <h1 style="text-align:right"><?php echo("Hii"."~".$headerUserName);?></h1></th>
        </tr>
        <tr>
            <th style="width:10%">Notes ID</th>
            <th style="width:20%">Title</th>
            <th style="width:50%">Note</th>
            <th  style="width:10%; text-align:center">Created On</th>
            <th  colspan="3" style="width:10%; text-align:center">Action</th>
       </tr>
    </thead>
  
    <tbody>
       <?php $results=array();
                $user_id=$_SESSION['userId'];   
                $title=$_POST['title_search'];
                $notes=$_POST['notes_search'];
                $from=$_POST['from_dt'];
                $to=$_POST['to_dt'];

                if(isset($_POST['title_search'])){
                      
                       
                  $query="SELECT * from notes where user_id='$user_id' AND created_at BETWEEN '$from 00:00:00' AND '$to 23:59:59';";
                  $data=mysqli_query($conn,$query);
                  if (mysqli_num_rows($data) > 0) { 
                      while ($row =  mysqli_fetch_assoc($data))
                       {   
                          $results[]=$row;
                          
                       }
                   }else{?>
                    <tr>
                      <td colspan="6" style="text-align:center; color:red"><?php echo "<h1 >NO RECORD FOUND.</h1>";?></td>
                   </tr>
                   <?php }?>
                  <?php foreach ($results as $result){
                      ?>
                        <tr>
                            <td><?php echo $result['id']; ?></td>
                            <td><?php echo $result['title']; ?></td>
                            <td><?php echo $result['notes']; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($result['created_at'])); ?></td>
                            <td><a class="btn btn-success" href="../notes/add.php?id=<?php echo $result['id']; ?>" >
                            <i class="fa fa-wrench" title="Update"></i></a></td>
                            <td><a class="btn btn-danger" href="../notes/delete.php?id=<?php echo $result['id']; ?>"
                            onclick="return confirm('Are you sure?')"><i class="fa fa-trash" title="Delete"></i></a></td>
                        </tr>   
  <?php } ?>
     
                  <?php }else if(isset($_POST['title_search'])){
                      
                       
                $query="SELECT * from notes where id='$user_id' 'title LIKE '$title%' OR notes LIKE '$notes%'";
                $data=mysqli_query($conn,$query);
                if (mysqli_num_rows($data) > 0) { 
                    while ($row =  mysqli_fetch_assoc($data))
                     {   
                        $results[]=$row;
                        
                     }
                 }else{?>
                  <tr>
                    <td colspan="6" style="text-align:center; color:red"><?php echo "<h1 >NO RECORD FOUND.</h1>";?></td>
                 </tr>
                 <?php echo "NOt Found";}?>
                <?php foreach ($results as $result){
                    ?>
                      <tr>
                          <td><?php echo $result['id']; ?></td>
                          <td><?php echo $result['title']; ?></td>
                          <td><?php echo $result['notes']; ?></td>
                          <td><?php echo date('d-m-Y',strtotime($result['created_at'])); ?></td>
                          <td><a class="btn btn-success" href="../notes/add.php?id=<?php echo $result['id']; ?>" >
                          <i class="fa fa-wrench" title="Update"></i></a></td>
                          <td><a class="btn btn-danger" href="../notes/delete.php?id=<?php echo $result['id']; ?>"
                          onclick="return confirm('Are you sure?')"><i class="fa fa-trash" title="Delete"></i></a></td>
                      </tr>   

           <?php } 
           } 
        
        else {
           $query="SELECT notes.id,notes.title,notes.created_at,notes.notes,notes_user.name 
           FROM notes INNER JOIN notes_user ON notes.user_id = notes_user.id where notes.user_id=$user_id LIMIT $start_from, $limit";
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
            <td><?php echo $result['title']; ?></td>
            <td><?php echo $result['notes']; ?></td>
            <td><?php echo date('d-m-Y',strtotime($result['created_at'])); ?></td>
            <td><a class="btn btn-success" href="../notes/add.php?id=<?php echo $result['id']; ?>" >
            <i class="fa fa-wrench" title="Update"></i></a></td>
            <td><a class="btn btn-danger" href="../notes/delete.php?id=<?php echo $result['id']; ?>"
            onclick="return confirm('Are you sure?')"><i class="fa fa-trash" title="Delete"></i></a></td>
        </tr>      
      <?php 
           } }
           
      ?>
      <tr>
        <td colspan='6'>
        <ul class="pagination">
      <?php  
        $sql = "SELECT COUNT(*) FROM notes where user_id='$user_id'";  
        $rs_result = mysqli_query($conn,$sql);  //echo("Hello");
        $row = mysqli_fetch_row($rs_result);  
        $total_records = $row[0];  
          
        // Number of pages required.
        $total_pages = ceil($total_records / $limit);  
        $pagLink = "";   
        for ($i=1; $i<=$total_pages; $i++) {
            if ($i==$pn) {
                $pagLink .= "<li class='list-group-item'><a class='text-dark' href='notes.php?page="
                                                  .$i."'>".$i."</a></li>";
            }            
            else  {
                $pagLink .= "<li><a href='notes.php?page=".$i."'>
                                                  ".$i."</a></li>";  
            }
          };  
          echo $pagLink;  
        ?>
        </ul>
        </td>
          </tr>
      </tbody>
        </table>
                             
      </div>
        </section>
