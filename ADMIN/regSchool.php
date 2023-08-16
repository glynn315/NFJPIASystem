<?php
require '../connection.php';
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$query ="SELECT * FROM eventregistrationtable WHERE eventStatus = 'ACTIVE';";  
if (isset($_POST["subReg"])) {
	$date = date('Y-m-d');
	$random = rand(1,9999);
    mysqli_query($conn, "INSERT INTO schoolinfotbl VALUES('','$_POST[t1]','$_POST[t2]','$_POST[t4]','$_POST[t3]','$date','ACTIVE')");
    	header("location:regSchool.php");
}
if(isset($_POST['uploadFile']))
{
    $fileName = $_FILES['studentFile']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['studentFile']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        foreach($data as $row)
	        {
	        	if($count > 1)
	            {
				    $StudentID = $row['0'];
		            $StudentLname = $row['3'];
		            $StudentFname = $row['1'];
		            $StudentMname = $row['2'];
		            $StudentYear = $row['4'];
		            $StudentCourse = $row['5'];

		            $sql = "SELECT * FROM studentinfotable WHERE studentID = '$StudentID'";
					$result = mysqli_query($conn,$sql);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
					$count1 = mysqli_num_rows($result);
					if ($count1 == 1) {
						
					}
					else
					{
						$studentQuery1 = "INSERT INTO studentinfotable(`studentID`, `studentLname`, `studentFname`, `studentMname`, `studentYear`, `studentCourse`,`studentStatus`,`schoolID`) VALUES ('$StudentID','$StudentLname','$StudentFname','$StudentMname','$StudentYear','$StudentCourse','NOT REGISTER','$_POST[txtID]');";
				        $result1 = mysqli_query($conn, $studentQuery1);
				        $msg = true;
					}
					
	            }
	            else
	            {
	                $count = "3";
	            }
	        }
        if(isset($msg))
        {
            $_SESSION['message'] = "Successfully Imported";
            header('Location: regSchool.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Imported";
            header('Location:regSchool.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['message'] = "Invalid File";
        header('Location: regSchool.php');
        exit(0);
    }
}
if(isset($_POST['uploadFile2']))
{
    $fileName = $_FILES['studentFile2']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['studentFile2']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

       
        $count = "0";
       	foreach($data as $row)
	        {
	        	if($count > 1)
	            {
				    $msg = true;
	            }
	            else
	            {
	                $count = "1";
	            }
	        }
    	foreach($data as $row)
	        {
	        	if($count > 1)
	            {
	            	$date = date('Y-m-d');
				    $StudentID = $row['0'];
		            $StudentFname = $row['1'];
		            $StudentLname = $row['3'];
		            $sql = "SELECT * FROM meminfotbl WHERE memID = '$StudentID'";
					$result = mysqli_query($conn,$sql);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
					$count1 = mysqli_num_rows($result);
					if ($count1 == 1) {
						
					}
					else
					{
						$studentQuery1 = "INSERT INTO meminfotbl(`memID`, `memFName`, `memLName`,`schoolID`,`memAccount`,`memDateReg`, `memStatus`, `userAccess`) VALUES('$StudentID','$StudentFname','$StudentLname','$_POST[txtID]','FACULTY','$date','NOT REGISTER','true');";
			            $result1 = mysqli_query($conn, $studentQuery1);
			            $msg = true;
			        }
	            }
	            else
	            {
	                $count = "3";
	            }
	        }

        

        if(isset($msg))
        {
            $_SESSION['message'] = "Successfully Imported";
            header('Location: regSchool.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Imported";
            header('Location:regSchool.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['message'] = "Invalid File";
        header('Location: regSchool.php');
        exit(0);
    }
}
include('../session.php');

$query ="SELECT * FROM schoolinfotbl WHERE schoolStatus = 'ACTIVE';";   
$result = mysqli_query($conn, $query); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFJPIA ADMIN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/nav.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
</head>
<body>
<div class="wrapper">
 	<nav id="sidebar">
 	 	<ul class="list-unstyled components">
            <img src="../IMAGE/samp.png" style="width:90%;" class="center">
 	 		<p class="ml-2"><?php echo $login_Name ?></p>
 	 		<li style="margin-top:-9%;">
	 	 		<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" ><img src="../IMAGE/a.png" style="width:10px;"> ACTIVE</a>
	 	 	</li>
 	 		<hr>
 	 		<li>
	 	 		<a href="adminDash.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
	 	 	</li>
			<li>
	 	 		<a href="memberManagement.php"><i class="bi bi-person-lines-fill"></i> Member Management</a>
	 	 	</li>
			<li>
				<a href="eventManagement.php"><i class="bi bi-calendar-event-fill"></i> Event Management</a>
	 	 	</li>
			<li>
	 	 		<a href="paymentManagement.php"><i class="bi bi-cash-stack"></i> Payment Management</a>
	 	 	</li>
	 	 	<li class="active">
	 	 		<a href="regSchool.php"><i class="bi bi-bank2"></i> Registered School</a>
	 	 	</li>
			<li>
	 	 		<a href="announcePage.php"><i class="bi bi-megaphone-fill"></i> Announcement</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="fileUpload.php"><i class="bi bi-box-arrow-in-down"></i> File Upload</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="badgeCert.php"><i class="bi bi-patch-question-fill"></i> Certificate and Badges</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="eventNotif.php"><i class="bi bi-bell-fill"></i> Events Notification</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-file-earmark-post"></i> Reports</a>
	 	 		<ul class="collapse list-unstyled" id="pageSubmenu1">
				  	<li>
	 	 				<a href="listOfpart.php?genPDFFormat=" target="_blank">List of Participants</a>
	 	 			</li>
	 	 			<li>
	 	 				<a href="listOfEvents.php?genPDFFormat=" target="_blank">List of Events</a>
	 	 			</li>
					<li>
	 	 				<a href="listOfPay.php?genPDFFormat=" target="_blank">List of Payments</a>
	 	 			</li>
	 	 		</ul>
	 	 	</li>
	 	</ul>
	 	<ul class="list-unstyled">
	 		<li>
	 	 		<a href="logout.php"><i class="bi bi-box-arrow-left"></i> SIGN OUT</a>
	 	 	</li>
	 	</ul>
	</nav>
    <div id="content">
			<nav class="navbar navbar-expand-lg navbar-dark" style="width:100%;padding: 20px;">
		  		<div class="container-fluid">
				  	NATIONAL FEDERATION OF JUNIOR PHILIPPINE INSTITUTE OF ACCOUNTANT
		  		</div>
		  	</nav>
			<div class="container-fluid p-3" style="margin:0px;">
				ADMIN / SCHOOL PARTNERSHIP
			</div>
			<div class="container-fluid p-3" style="margin:0px;">
				<button type="submit" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">ADD SCHOOL PARTNERSHIP</button>
				<table id="employee_data" class="table table-fluid" width="100%">
						<thead>  
							<tr>  
								<td>#</td>  
								<td>School Name</td>  
								<td>School Address</td>
								<td>School Establish</td>
								<td>Date Registered</td>  
								<td>School Status</td>
								<td width="5%">Action</td>  
							</tr>  
						</thead>  
						<?php  
						while($row = mysqli_fetch_array($result))  
							{  
								echo "<tr>";									
									echo "<td class='align-middle'>"; echo $row["schoolID"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["schoolName"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["schoolAddress"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["schoolEst"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["dateRegistered"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["schoolStatus"]; echo "</td>";
									echo "<td class='align-middle' style='display:inline-flex'><button class='center btn btn-primary ml-2' style='padding:3px; height:30px;' data-toggle='modal' data-target='#exampleModal1'><i class='bi bi-box-arrow-in-down'></i> Upload Student</button><button class='center btn btn-success ml-2' style='padding:3px; height:30px;' data-toggle='modal' data-target='#exampleModal2'><i class='bi bi-box-arrow-in-down'></i> Upload Faculty</button>";"</td>";
								echo "</tr>";
							}  
						?>  
					</table> 
        	</div>
    	</div>
    </div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
  		<form method="POST" enctype="multipart/form-data">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Upload Participant(STUDENT)</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
	      	<div class="modal-body">
	        	
	        		<input type="text" id="txtID" name="txtID" hidden>
	        		<input type="file" name="studentFile" class="form-control">
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        	<button type="submit" class="btn btn-primary" name="uploadFile">Save changes</button>
	      	</div>
    	</div>
    </form>
  	</div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
  		<form method="POST" enctype="multipart/form-data">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Upload Participant(FACULTY)</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
	      	<div class="modal-body">
	        	
	        		<input type="text" id="txtID1" name="txtID" hidden>
	        		<input type="file" name="studentFile2" class="form-control">
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        	<button type="submit" class="btn btn-primary" name="uploadFile2">Save changes</button>
	      	</div>
    	</div>
  	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">SCHOOL PARTNERSHIP</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		
      			<div class="modal-body">
	        		<p style="font-size:20px;">SCHOOL INFO</p>

	        		<p class="mt-3">SCHOOL NAME</p>
	        		<input type="text" placeholder="SCHOOL NAME" name="t1" class="form-control" style="margin-top:-10px;">
	        		<p class="mt-1">SCHOOL ADDRESS</p>
	        		<input type="text" placeholder="SCHOOL ADDRESS" name="t2" class="form-control" style="margin-top:-10px;">
	        		<p class="mt-1">SCHOOL CONTACT</p>
	        		<input type="text" placeholder="SCHOOL CONTACT" name="t4" class="form-control" style="margin-top:-10px;">
	        		<p class="mt-1">DATE ESTABLISHED</p>
	        		<input type="date" class="form-control" name="t3" style="margin-top:-10px;">
	      		</div>
	      		<div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary" name="subReg">Save changes</button>
	      		</div>
      		</form>
    	</div>
  	</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>  
	$(document).ready(function(){  
    $('#employee_data').DataTable();  
 	});  
</script> 
<script type="text/javascript">
    var table = document.getElementById('employee_data');     
        for(var i = 1; i < table.rows.length; i++)
        {
            table.rows[i].onclick = function()
            {
                document.getElementById("txtID").value = this.cells[0].innerHTML;
				document.getElementById("txtID1").value = this.cells[0].innerHTML;
            };
        }
</script>

</body>
</html>