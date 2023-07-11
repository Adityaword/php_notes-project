<?php include './connection.php';

include './header.php';
include './menu1.php';
?>
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
        <div class=" justify-content-md-center">
            <form class="col-sm-12 bg-white p-5 rounded shadow">
            <table  class="table table-striped table-condensed" id="tblData">
    <thead>
        <tr>
            <th colspan="6"><h1 style="text-align:center">Notes</h1>
        </tr>
        <tr>
            <th style="width:5%">Sr No.</th>
            <th style="width:15%">Title</th>
            <th style="width:40%">Note</th>
            <th style="width:20%">User Name</th>
            <th  style="width:10%; text-align:center">Created On</th>
            <th  style="width:10%; text-align:center">Status</th>
       </tr>
    </thead>
    <tbody>
    <?php $results=array();
                    $query="SELECT *  from notes LIMIT $start_from, $limit";
                    $data=mysqli_query($conn,$query);
                    if (mysqli_num_rows($data) > 0) { 
                        while ($row =  mysqli_fetch_assoc($data))
                         {   
                            $results[]=$row;
                            
                         }
                        }$count=0;
                        foreach ($results as $result){$count++;
                            ?>
                              <tr>
                                  <td><?php echo $count ?></td>
                                  <td><?php echo $result['title']; ?></td>
                                  <td><?php echo $result['notes']; ?></td>
                                  <td><?php echo $result['name']; ?></td>
                                  <td><?php echo date('d-m-Y',strtotime($result['created_at'])); ?></td>
                                  <td>
                                    <?php
                                    if($result==1)
                                    echo 'Active';
                                    else
                                    echo 'In-active';?>
                                  </td>
                              </tr>   
        
                   <?php } ?>
                   <tr>
                    <td colspan="5">
                    <ul class="pagination">
      <?php  
        $sql = "SELECT COUNT(*) FROM notes";  
        $rs_result = mysqli_query($conn,$sql);  //echo("Hello");
        $row = mysqli_fetch_row($rs_result);  
        $total_records = $row[0];  
          
        // Number of pages required.
        $total_pages = ceil($total_records / $limit);  
        $pagLink = "";   
        for ($i=1; $i<=$total_pages; $i++) {
            if ($i==$pn) {
                $pagLink .= "<li class='page-item active'><a class='text-dark' href='dashboard.php.php?page="
                                                  .$i."'>".$i."</a></li>";
            }            
            else  {
                $pagLink .= "<li><a href='dashboard.php?page=".$i."'>
                                                  ".$i."</a></li>";  
            }
          };  
          echo $pagLink;  
        ?>
        </ul></td>
        </tr>
        </table>
            </form>
        </div>
    </section>
</body>
</html>