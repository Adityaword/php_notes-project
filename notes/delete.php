<?php include '../connection.php';
session_start();
include '../header.php';
include '../menu.php';
include '../footer.php'?>

<?php
$note_id=$_GET['id'];
if(isset($note_id)){
$query = "DELETE FROM notes WHERE id='$note_id'"; 
$result = mysqli_query($conn,$query);
echo "<h1 >Record Deleted successfully</h1>";
}
header("Location: /notes/notes.php");exit;ob_end_flush();
exit();
?>