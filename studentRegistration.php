<?php
require 'connection.php';


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>STUDENT REGISTRATION</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
	<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
</head>
<body>
	<div class="container p-4" style="border:2px solid gray;border-radius: 10px;margin-top: 30px;">
		<form action="" method="GET">
	        <div class="row">
	            <input type="text" name="stud_id" value="<?php if(isset($_GET['stud_id'])){echo $_GET['stud_id'];} ?>" class="form-control" style="width: 80%;" placeholder="ENTER STUDENT ID">
	            <button type="submit" class="btn btn-primary" style="width:20%;">Search</button>
	        </div>
	    </form>
	</div>
	<div class="container row" style="display: block; margin:auto;">
                        	<form name="form1" action="" method="post" enctype="multipart/form-data" style="width: 100%;">
                            <div class="col-md-12">
                                <hr>
                                <?php 
                                    require 'connection.php';
                                    $date = date('Y-m-d');
                                    $REL = "RELEASED";
                                    if(isset($_GET['stud_id']))
                                    {
                                        $stud_id = $_GET['stud_id'];

                                        $query = "SELECT studentinfotable.studentID,studentinfotable.studentFname,studentinfotable.studentLname,schoolinfotbl.schoolName,studentinfotable.studentCourse,studentinfotable.studentYear
											FROM studentinfotable
											INNER JOIN schoolinfotbl
											ON studentinfotable.schoolID = schoolinfotbl.schoolID 
											WHERE studentID = '$stud_id'";
                                        $query_run = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                                                foreach($query_run as $row)
                                                {
                                                    ?>
                                                    <div class="form-group mb-3">
                                                        <label for="">STUDENT ID</label>
                                                        <input type="text" value="<?= $row['studentID']; ?>" name="txtretID" class="form-control" disabled>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">STUDENT NAME</label>
                                                        <input type="text" value="<?= $row['studentFname']. ' ' .$row['studentLname'] ; ?>" class="form-control" disabled>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">SCHOOL</label>
                                                        <input type="text" value="<?= $row['schoolName']; ?>" class="form-control" disabled>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">COURSE</label>
                                                        <input type="text" value="<?= $row['studentCourse']; ?>" class="form-control" disabled>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">YEAR</label>
                                                        <input type="text" value="<?= $row['studentYear']; ?>" class="form-control" disabled>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">Address</label>
                                                        <input type="text" placeholder="" class="form-control" name="cAdd">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">Birthday</label>
                                                        <input type="date" placeholder="" class="form-control" name="c1">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">Contact Number</label>
                                                        <input type="text" placeholder="" class="form-control" name="c2">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">Guardian Contact Number</label>
                                                        <input type="text" placeholder="" class="form-control" name="c4">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">Student Password</label>
                                                        <input type="text" placeholder="" class="form-control" name="c3">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for=""></label>
                                                        <input type="text" placeholder="" class="form-control" value="<?php echo substr(uniqid(),9); ?>" style="font-size: 30px;text-align: center; border:none;" name="cap1">
                                                    </div>
                                                     <div class="form-group mb-3">
                                                        <label for="">CAPTCHA</label>
                                                        <input type="text" placeholder="" class="form-control" name="cap2">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                    	<input type="submit" name="subReg" class="form-control btn btn btn-primary" value="REGISTER">
                                                    </div>
                                                    <?php
                                                }
                                            
                                        }
                                        else
                                        {
                                            echo "ID NOT FOUND";
                                        }

                                    }

                                   
                                ?>
                                

                            </div>
                        </div>
                    </form>
                    </div>



                    <?php
                    if (isset($_POST["subReg"])) {
					    $captcha1 = $_POST['cap1'];
					    $captcha2 = $_POST['cap2'];
						$date = date('Y-m-d');
					    if ($captcha1 != $captcha2) {
					        echo " <script> alert('Registration Unsuccessful'); document.location.href = ''; </script> ";
					    }
					    else if ($captcha1 == $captcha2) {
					    	mysqli_query($conn, "UPDATE studentinfotable SET studentAddress = '$_POST[cAdd]' , studentContact = '$_POST[c2]', studentRegion = 'REGION-12', studentAcc = 'STUDENT', studentPassword = '$_POST[c3]', studentDateReg = '$date', studentStatus = 'REGISTERED', studentBday = '$_POST[c1]',guardianContact = '$_POST[c4]' WHERE studentID = '$stud_id'");
					    	header("location:index.php");
					    }
					}
                    ?>

</body>
</html>