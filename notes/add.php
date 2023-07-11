<?php include '../connection.php';

include '../header.php';
include '../menu.php';
include '../footer.php';
session_start();?>
<?php ?>

<section >
<div class="row justify-content-md-center">
    <?php
    if(!isset($_SESSION['userName'])){
        header('Location: /login.php');
    }else{
    $user_name=$_SESSION['userName'];
    $user_id=$_SESSION['userId'];
    // echo ($_SESSION['userName']." ".$_SESSION['userId']);

}

    ?>

<?php 
$results=array();
            $note_id=$_GET['id'];
           $query="SELECT notes,title from notes where id='$note_id'";
           //$query="SELECT * from notes_user where name='testUser' and password='abc@123'";
           $data = mysqli_query($conn,$query);
           
          $count= mysqli_num_rows($data);
            $row =  mysqli_fetch_assoc($data);
         
         
           ?>

<form method = "POST" class="col-md-6 col-sm-12 rounded shadow form-bgcolor" style="background-color: #b583eb">
<h1 class="bg-gradient" style="text-align:left">
<?php if(isset($_GET['id'])){
echo("Update Your Note");
}else{
    echo("Add Your Note");
}?></h1>
    <div class="form-group " style="text-align:center">
    <div class="mb-3" style="text-align: left;">
        <label class="form-label">User Name~</label>
        <label class="form-label" id="user_name">
        <!-- <canvas id="myCanvas" width="30" height="25" style="border:5px solid green"></canvas> -->
        <b><?php echo($user_name); ?></b></label>
</div>
<div class="mb-3" style="text-align: left;">
        <label class="form-label">Title:</label>
        <?php if(isset($_GET['id'])) { ?>
                <input class="form-control" type="text"  name="note_title" value="<?php echo($row['title']);?>" placeholder="Enter Note's Title...." required>
<?php }
else { ?>   
        <input class="form-control" type="text"  name="note_title" placeholder="Enter Note's Title...." required>
        <?php } 
        ?>
</div>
<div class="mb-3" style="text-align: left;">
        <label class="form-label">Note:</label>
        <?php if(isset($_GET['id'])) { ?>
        <textarea id="input" name="note" rows="10" cols="50" class="form-control" values="" placeholder="Add Your Notes...."  required><?php echo($row['notes']);?>
</textarea>
<?php } else {?>
        <textarea id="input" name="note" rows="10" cols="50" class="form-control"  placeholder="Add Your Notes...."  required>
</textarea> <?php } ?>
</div>

<div class="mb-3">
<?php if(isset($_GET['id'])){
               ?><input class="btn btn-success" type="submit" value="Update" id="submit">
<?php }else {
    ?><input class="btn btn-success" type="submit" value="Add" id="submit">

<?php } ?>
        
        <input class="btn btn-danger" type="button" value="Reset" id="reset">
</div>
</div>
</form>
</div>
</section>
<?php 
if(isset($_POST['note'])){
    $title  = $_POST['note_title'];
    $notes  = $_POST['note'];
    if(!isset($_GET['id'])){
    $query = "INSERT INTO notes (user_id,title,notes) VALUES ('$user_id','$title' ,'$notes')";
    mysqli_query($conn, $query);
        echo "<h1 >Values inserted successfully</h1>";
        header("Location: /notes/notes.php");exit;ob_end_flush();
    }else if(isset($_GET['id'])){

        $query = "UPDATE notes
        SET notes = '$notes',title = '$title'
        WHERE id = $note_id;";
        mysqli_query($conn, $query);
            //echo "<h1 >Record Updated successfully</h1>";
            header("Location: /notes/notes.php");exit;ob_end_flush();

    }
    else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
   ?>
<?php
// if(isset($_GET['id'])){
//     $id = validate($_GET['edit']);
//     $condition= ['id' =>$id];
//     $columns= ['id', 'notes','updated_at'];
// }
?>
   <script>
const c = document.getElementById("myCanvas");
const ctx = c.getContext("2d");
ctx.beginPath();
ctx.arc(100, 75, 50, 0, 2 * Math.PI);
ctx.fillStyle = "green";
ctx.fill();
</script> 
<script>
    tinymce.init({
        selector:'#input'
    });
    </script>