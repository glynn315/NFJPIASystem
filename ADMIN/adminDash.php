<?php
require '../connection.php';
include('../session.php');

include('count.php');


$query1 = "SELECT eventregistrationtable.eventName,COUNT(eventmembershiptable.memID) AS TOTAL FROM eventregistrationtable INNER JOIN eventmembershiptable ON eventregistrationtable.eventID = eventmembershiptable.eventID WHERE eventmembershiptable.membershipStatus = 'ACTIVE' GROUP BY eventregistrationtable.eventName;";
$result1 = mysqli_query($conn, $query1);
$chart_data = '';
while($row1 = mysqli_fetch_array($result1))
{
	$chart_data .= "{ DATE:'".$row1["eventName"]."', TYPE:".$row1["TOTAL"]."}, ";
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

    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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
 	 		<li class="active">
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
				ADMIN / DASHBOARD
			</div>
			<div class="container-fluid p-3 border" style="margin:0px;">
				<div class="card-container" style="border:1px solid transparent;">
					<div class="card bg-primary" style="margin-top:20px;display: inline-block;">
						<div class="card-body">
							<div class="c-head">
								<img src="../IMAGE/group.png" class="card-img" style="opacity: .5;">
							</div>
							<h5 class="card-title">FACULTY COUNT</h5>
							<h6 class="card-subtitle mb-2"><?php echo $count4 ?></h6>
						</div>
						<div style="margin-top:-100px; visibility: hidden;">
							<button class="form-control btn btn-primary">s</button>
						</div>
					</div>
					<div class="card bg-success" style="margin-top:20px;display: inline-block;">
						<div class="card-body">
							<div class="c-head">
								<img src="../IMAGE/calendar.png" class="card-img" style="opacity: .5;">
							</div>
							<h5 class="card-title">EVENT COUNT</h5>
							<h6 class="card-subtitle mb-2"><?php echo $count2 ?></h6>
						</div>
						<div style="margin-top:-100px; visibility:hidden;">
							<button class="form-control btn btn-success">VIEW DETAILS <i class="bi bi-arrow-right-circle"></i></button>
						</div>
					</div>
					<div class="card bg-warning" style="margin-top:20px;display: inline-block;">
						<div class="card-body">
							<div class="c-head">
								<img src="../IMAGE/active-user.png" class="card-img" style="opacity: .5;">
							</div>
							<h5 class="card-title">STUDENT COUNT</h5>
							<h6 class="card-subtitle mb-2"><?php echo $count3 ?></h6>
						</div>
						<div style="margin-top:-100px;visibility: hidden;">
							<a href="membersApproval.php"><button class="form-control btn btn-warning">VIEW DETAILS <i class="bi bi-arrow-right-circle"></i></button></a>
						</div>
					</div>
				</div>
        	</div>
			<div class="container-fluid mt-4" style="margin:0px;">
				<div class="graph float-left rounded" style="width:93%;border:1px solid lightgray;height:500px;">
					<p>DIVISION GRAPH</p>
						<div id="chart">
								
						</div>
					<hr>
				</div>
			</div>
    	</div>
	</div>
<script>
    new Morris.Bar({
        element : 'chart',
        data:[<?php echo $chart_data; ?>],
        xkey:'DATE',
        ykeys:['TYPE'],
        labels:['RELEASED DATA'],
        hideHover:'auto',
        stacked:true
    });
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>