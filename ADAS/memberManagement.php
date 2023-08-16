<?php
require '../connection.php';
include('../session.php');
$query ="SELECT * FROM meminfotbl WHERE memStatus = 'ACTIVE' AND memAccount != 'ADMIN'";  
$result = mysqli_query($conn, $query); 

$date = date('Ymd');
$random = rand(1,9999);
if (isset($_POST["subReg"])) {
	$date = date('Y-m-d');
	$random = rand(1,9999);
    mysqli_query($conn, "INSERT INTO studentinformationtbl VALUES('$_POST[tID]','$_POST[t0]','$_POST[t1]','$_POST[t2]','$_POST[t3]','$_POST[t4]','$_POST[t5]','$_POST[t6]','$date','ACTIVE','$_POST[t7]','$_POST[t8]')");
    	header("location:studentManagement.php");
}
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
	 	 		<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle ml-2"><img src="../IMAGE/a.png" style="width:10px;"> ACTIVE</a>
	 	 		<ul class="collapse list-unstyled" id="pageSubmenu">
	 	 			<li>
	 	 				<a href="adminAccount.php">USER ACCOUNT</a>
	 	 			</li>
	 	 		</ul>
	 	 	</li>
 	 		
 	 		<hr>
 	 		<li>
	 	 		<a href="adminDash.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
	 	 	</li>
			<li class="active">
	 	 		<a href="memberManagement.php"><i class="bi bi-person-lines-fill"></i> Member Management</a>
	 	 	</li>
			<li>
				<a href="eventManagement.php"><i class="bi bi-calendar-event-fill"></i> Event Management</a>
	 	 	</li>
			<li>
	 	 		<a href="paymentManagement.php"><i class="bi bi-cash-stack"></i> Payment Management</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="regSchool.php"><i class="bi bi-bank2"></i> Registered School</a>
	 	 	</li>
			<li>
	 	 		<a href="announcePage.php"><i class="bi bi-megaphone-fill"></i> Announcement</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-file-earmark-post"></i> Reports</a>
	 	 		<ul class="collapse list-unstyled" id="pageSubmenu1">
	 	 			<li>
	 	 				<a href="adminPayroll.php">REPORT 1</a>
	 	 			</li>
	 	 			<li>
	 	 				<a href="adminOvertimeRequest.php">REPORT 2</a>
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
				<p style="font-size: 30px;">MEMBER REQUISITION</p>
				<div class="table-responsive" style="margin-top:20px;">
					<table id="employee_data" class="table table-fluid" width="100%">
						<thead>  
							<tr>  
								<td>Member ID</td>  
								<td>Member Name</td>  
								<td>Account Type</td>
								<td>Course</td>  
								<td>Chapter</td>
								<td>Region</td>  
								<td>Date Register</td>
								<td>Status</td>  
							</tr>  
						</thead>  
						<?php  
						while($row = mysqli_fetch_array($result))  
							{  
								echo "<tr>";									
									echo "<td class='align-middle'>"; echo $row["memID"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["memFName"]." ".$row["memLName"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["memAccount"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["memCourse"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["memChapter"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["memRegion"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["memDateReg"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["memStatus"]; echo "</td>";
								echo "</tr>";
							}  
						?>  
					</table>  
				</div>
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
</body>
</html>