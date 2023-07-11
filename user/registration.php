<?php include '../connection.php';

include '../header.php';
include '../menu.php';?>


<section class="container mt-5">
<div class="row justify-content-md-center">

<form method = "POST" class="col-md-6 col-sm-12 bg-white rounded shadow" style="background-color: transparent">
<h1 class="text-primary" style="text-align:center">User Registration</h1>
    <div class="form-group " style="text-align:center">
    <div class="row mb-3">
    <div class="col" style=" text-align:center">
        <label class="form-label h4"><b>User Name</b></label>
</div>
<div class="col" style=" text-align:left">
        <input id="name" name="name" type="text" class="form-control"></input>
</div>
</div>
<div class="row mb-3">
<div class="col" style=" text-align:center">
        <label class="form-label h4"><b>Password</b></label>
</div>
<div class="col" style=" text-align:left">
        <input id="pwd" type="text" name="pwd" class="form-control"></b></input>
</div>
</div>

<div class="row mb-3">
<div class="col" style=" text-align:center">
        <label class="form-label h4"><b>Re-Type Password</b></label>
</div>
<div class="col" style=" text-align:left">
        <input id="re-pwd" type="text" class="form-control"></b></input>
</div>
</div>
<div class="row mb-3">
<div class="col" style=" text-align:center">
        <label class="form-label h4"><b>Mobile No.</b></label>
</div>
<div class="col" style=" text-align:left">
        <input id="mob" type="text" name="mob" class="form-control"></input>
</div>
</div>
<div class="row mb-3">
        <div class="col" style=" text-align:center">
        <label class="form-label h4"><b>User Type</b></label>
</div>
        <div class="col" style=" text-align:left">
        <input id="mob" type="text" name="mob" class="form-control"></input>
</div>
</div>
</div>
<div class="row mb-3">
<div class="col" style=" text-align:center">
        <label for="exampleInputEmail1" class="form-label h4"><b>Email-Id</b></label>
</div>
<div class="col" style=" text-align:left">
        <input id="email" type="text" name="email" class="form-control"></input>
</div>
</div>

<div class="mb-3">
<div class="col" style=" text-align:center">
        <input class="btn btn-primary" type="submit" value="Submit" id="submit">
        <input class="btn btn-primary" type="button" value="Reset" id="reset"></div>
</div>
</div>
</form>
</div>
</section>
<?php 
if(isset($_POST['submit'])){
    $newusername   = $_POST['name'];
    $ppassword  = $_POST['pwd'];
    $mobileno = $_POST['mob'];
    $emailid    = $_POST['email'];

    $query = "INSERT INTO notes_user (name, password, mobile_no, email) VALUES ('$newusername', '$ppassword', '$mobileno', '$emailid')";
    if (mysqli_query($conn, $query)) {
        echo "Values inserted successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

   ?>