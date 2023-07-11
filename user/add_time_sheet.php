    <!-- insert query -->
    <?php
        if(!isset($_SESSION['username'])){ 
                header('location:../login.php');
        }
        $uid = $_SESSION['id'];
        $redirect_url="/user/time_sheet.php?source=list";
    if(isset($_POST['submit'])){
        
        // $uid = mysqli_real_escape_string($con , $_POST['user_id']);
                $project = mysqli_real_escape_string($connection , $_POST['projects']);
                $hours = mysqli_real_escape_string($connection , $_POST['hours']);
                $minutes = mysqli_real_escape_string($connection , $_POST['minutes']);
                $details = mysqli_real_escape_string($connection , $_POST['details']);
                $date = mysqli_real_escape_string($connection , $_POST['sheet_date']);

                $query = "INSERT INTO time_sheet_detail (user_id, project,work_hours,work_minutes,task_details,time_sheet_date) 
                VALUE ('$uid', '$project', '$hours','$minutes','$details','$date')";
                
                $data = mysqli_query($connection, $query);
       if($data){
        $message_success = "Record Added Successfully";
        header("Location: " . $redirect_url . "&msg_success=" . $message_success);
        
      }else{
        echo "Database error: " . $pg_last_error($connection);
    }


    }
    
    
    
    ?>




        <form action="" method="post" >
                <table class="table table-borderless">
                        <tr>
                                <td><h3><b>Add Hours</b></h3></td>
                                <td></td>
                        </tr>
                        <tr class="table-primary">
                                <td colspan="2"><b>Projects</b></td>
                        </tr>
                        <tr>
                                        <td colspan="2">
                                                <select class="form-control form-select-lg" name="projects" id="projects" required>
                                                        <option value="0">Select</option>
                                                        <option value="php">Php</option>
                                                        <option value="laravel">Laravel</option>
                                                        <option value="magento">Magento</option>
                                                        <option value="wordpress">Wordpress</option>
                                                        <option value="idle">Idle</option>
                                                </select>
                                        </td>
                        </tr>
                                <tr class="table-primary">
                                        <td colspan="2"><b>Time Consumed</b></td>
                                </tr>
                        <tr>
                                <td><select class="form-control form-select-lg" name="hours" id="hours" required>
                                        <option value="0"><b>Hours</b></option>
                                <?php
                                for($i=1;$i<=24;$i++)
                                {?>
                                <option value="<?php echo($i);?>">
                                <?php echo($i);?>
                                </option>
                                <?php }?>
                                </select>
                                </td>
                                <td>
                                <select class="form-control form-select-lg" name="minutes" id="minutes">
                                        <option value="0"><b>Minutes</b></option>
                                        <?php
                                for($i=0;$i<60;$i+=5)
                                {?>
                                <option value="<?php echo($i);?>">
                                <?php echo($i);?>
                                </option>
                                <?php }?>
                                        </select>
                                </td>
                        </tr>
                        <tr>
                                <td colspan="2"><b>Task Details</b></td>
                        </tr>
                        <tr>
                                <td colspan="2">
                                <textarea type="date" id="exampleFormControlTextarea1" rows="4" class="form-control" name="details" 
                                placeholder="Enter your task details....." required></textarea>
                                </td>
                        </tr>
                        <tr>
                                <td colspan="2">
                                <b>  Date</b>
                                </td>
                        </tr>
                        <tr>
                                <td colspan="2">
                                <input type="date" class="form-control" name="sheet_date" value = "<?php echo date('Y-m-d');?>" required>
                                </td>
                        </tr>
                        <tr>
                                <td colspan="2" style="text-align: center;">
                                <input class="btn btn-success"  type="submit" class="form-control" name="submit" value="Submit" required>
                                <a class="btn btn-danger" href="add_time_sheet.php">Cancel</a>
                                </td>
                        </tr>
                </table>
        </form>