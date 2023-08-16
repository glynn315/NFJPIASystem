<?php
require 'connection.php';
session_start();
if(isset($_POST["subLog"])) {
	$myusername = mysqli_real_escape_string($conn,$_POST['uName']);
    $mypassword = mysqli_real_escape_string($conn,$_POST['pWord']);

	$sql = "SELECT * FROM useraccounttable WHERE userName = '$myusername' AND passWord = '$mypassword'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
    $acc = $row["memAccount"];
    $accStatus = $row["memStatus"];
    $sql1 = "SELECT * FROM studentinfotable WHERE studentID = '$myusername' AND studentPassword = '$mypassword'";
    $result1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count1 = mysqli_num_rows($result1);
    $accStatus1 = $row1["studentStatus"];

    
	if($count == 1) 
	{
		if($acc == "ADMIN")
        {
            $_SESSION['login_user'] = $myusername;
            header("location:ADMIN/adminDash.php");
        }
        if($acc == "ADMIN ASSISTANT")
        {
            if ($accStatus == 'ACTIVE') {
                 $_SESSION['login_user'] = $myusername;
                header("location:ADAS/adminDash.php");
            }
            else{
                echo " <script> alert('THE ACCOUNT IS WAITING FOR APPROVAL'); document.location.href = ''; </script> ";
            }
           
        }
        else if($acc == "FACULTY")
        {
            if ($accStatus == 'REGISTERED') {
                $_SESSION['login_user'] = $myusername;
                header("location:INSTRUCTOR/userDash.php");
            }
            else{
                echo " <script> alert('THE ACCOUNT IS WAITING FOR APPROVAL'); document.location.href = ''; </script> ";
            }
            
        }
		
    }
    if($count1 == 1) 
    {
        $_SESSION['login_user'] = $myusername;
        header("location:USERS/userDash.php");
    }
   	else
    {
      	echo " <script> alert('ACCOUNT IS NOT VALID'); document.location.href = ''; </script> ";
    }
}
if (isset($_POST["regStudent"])) {
    header("location:studentRegistration.php");
}
if (isset($_POST["regFaculty"])) {
    header("location:facultyReg.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFJPIA Form</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="style.css">

</head>
<body>
    <!-- <div class="container-fluid" style="padding:10px;">
        <a href="adminAccount.php"><button type="submit" style="padding: 10px; border:none; background: #5bc0de; border-radius: 10px;"><i class="bi bi-person-workspace" style="top: 0; position: none;left: 0;"></i> ADMINISTRATOR LOGIN</button></a>
    </div> -->
    <div class="container-fluid d-inline-flex p-0">
        <div class="" style="width:60%; height:inherit; background: #ffe9b9;">
            <img src="IMAGE/samp.png" style="display: block; margin: auto; width:50%;">
            <form method="POST">
                <div class="form-group center" style="width:90%">
                    <label for="exampleInputEmail1">Member ID</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="MEMBER ID" name="uName">
                </div>
                <div class="form-group center mt-3" style="width:90%">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" placeholder="PASSWORD" class="form-control" id="exampleInputPassword1" name="pWord">
                </div>
                <div class="form-group center mt-3" style="width:90%; text-align: center;">
                    <input type="submit" class="form-control btn btn-primary mb-4" value="LOGIN" name="subLog">
                    <input type="button" value="CREATE ACCOUNT" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg">
                </div>
            </form>
        </div>
        <div class="d-inline-flex border" style="width:100%; height:100vh; overflow-y: scroll;">
            <?php
                if (isset($_POST["regButton"])) {?>
                    <div class="signUp center" style="margin-top:-10px;height: inherit;margin-bottom: 10px; border: none;">
                        <p>SIGN UP</p>
                        <form method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Member ID</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo "MEMBER-".$date."-".$random."";  ?>" name="tID">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="First Name" name="t1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Last Name</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Last Name" name="t2">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Address</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Address" name="t3">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Birthday</label>
                                <input type="date" class="form-control" id="exampleInputPassword1" name="t4">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chapter</label>
                                <select  class="form-control" name="t5">
                                    <?php
                                    $res=mysqli_query($conn,"SELECT * FROM schoolinfotbl WHERE schoolStatus = 'ACTIVE'");
                                    while($row=mysqli_fetch_array($res))
                                    {
                                    ?>
                                        <option value="<?php echo $row['schoolID']; ?>"><?php echo $row['schoolName']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Account Type</label>
                                <select  class="form-control" name="t6">
                                    <option value="PROFESSOR">PROFESSOR</option>
                                    <option value="INSTRUCTOR">INSTRUCTOR</option>
                                    <option value="STUDENT">STUDENT</option>
                                    <option value="ADMIN ASSISTANT">ADMIN ASSISTANT</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Course</label>
                                <select  class="form-control" name="t7">
                                    <option value="BS Accounting">BS Accounting</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" placeholder="PASSWORD" class="form-control" id="exampleInputPassword1" name="t8">
                            </div>
                            <div class="form-group">
                                <input type="text" name="cap1" class="form-control" value="<?php echo substr(uniqid(),9); ?>">
                                <input type="text" placeholder="CAPTCHA" class="form-control" id="exampleInputPassword1" name="cap2">
                            </div>
                             
                            <button type="submit" class="btn btn-primary" name="subReg">Submit Information</button>
                            <button type="submit" class="btn btn-danger" name="">Cancel</button>
                        </form>
                    </div><?php
                        }
                    ?>
        </div>
    </div>
<form method="POST">
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container-fluid d-inline-flex p-3">
                <button type="submit" style="width:100%; height: 70px;" class="mr-2 btn btn-primary" name="regStudent">Register as STUDENT</button>
                <button type="submit" style="width:100%; height: 70px;" class="ml-2 btn btn-primary" name="regFaculty">Register as FACULTY</button></a>
            </div>
        </div>
    </div>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>