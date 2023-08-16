<?php
require '../connection.php';
include('../session.php');
if(isset($_REQUEST["eventID"]))
{
    $eventID=$_REQUEST["eventID"];
    $conn2=mysqli_query($conn ,"SELECT * FROM eventregistrationtable WHERE eventID = '$eventID'");
    $row1=mysqli_fetch_array($conn2);
}
$query ="SELECT * FROM subeventtable WHERE eventID = '$eventID';";   
$result = mysqli_query($conn, $query); 

if(isset($_POST["btnSubmit"])) {
	mysqli_query($conn, "INSERT INTO subeventtable VALUES('','$eventID','$_POST[t1]','$_POST[t2]','ACTIVE');");
    echo " <script> alert('ADDED TO SYSTEM'); document.location.href = ''; </script> ";
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
	 	 	<li>
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
				<h3>Event Payment Breakdown</h3>
				<form method="POST">
					<table>
						<tr>
							<td>Event ID </td>
							<td width="10%" align="center"> : </td>
							<td> <?php echo $eventID ?></td>
						</tr>
						<tr>
							<td>Event Name </td>
							<td width="10%" align="center"> : </td>
							<td> <?php echo $row1["eventName"] ?></td>
						</tr>
						<tr>
							<td>Event Theme </td>
							<td width="10%" align="center"> : </td>
							<td> <?php echo $row1["eventDesc"] ?></td>
						</tr>
						<tr>
							<td>Sub Event Name </td>
							<td width="10%" align="center"> : </td>
							<td> <input type="text" placeholder="Sub Event Name" class="form-control" name="t1"></td>
						</tr>
						<tr>
							<td>Sub Event Description </td>
							<td width="10%" align="center"> : </td>
							<td> <input type="text" placeholder="Sub Event Description" class="form-control" name="t2"></td>
						</tr>
						<tr>
							<td></td>
							<td width="10%" align="center"> </td>
							<td><button class="btn btn-primary" style="float:right;" name="btnSubmit">ADD SUB EVENTS</button></td>
						</tr>
					</table>
				</form>
    		</div>
    		<hr>
			<div class="container-fluid p-3" style="margin:0px;">
				<p style="font-size: 20px;margin-top: -30px;">Payment Breakdown</p>
				<div class="table-responsive" style="margin-top:20px;">
					<table id="employee_data" class="table table-fluid" width="100%">
						<thead>  
							<tr>  
								<td>#</td>  
								<td>Sub Event Name</td>  
								<td>Sub Event Description</td>
								<td>Event Status</td>
							</tr>  
						</thead>  
						<?php  
						while($row = mysqli_fetch_array($result))  
							{  
								echo "<tr>";									
									echo "<td class='align-middle'>"; echo $row["subEventID"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["subEventName"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["subEventDescription"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["subEventStatus"]; echo "</td>";
								echo "</tr>";
							}  
						?>  
					</table>  
					</div>
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