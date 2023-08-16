<?php
require '../connection.php';
include('../session.php');

include('count.php');
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
				ADMIN / DASHBOARD
			</div>
			<div class="container-fluid p-3 border" style="margin:0px;">
				<div class="card-container" style="border:1px solid transparent;">
					<div class="card bg-primary" style="margin-top:20px;display: inline-block;">
						<div class="card-body">
							<div class="c-head">
								<img src="../IMAGE/group.png" class="card-img" style="opacity: .5;">
							</div>
							<h5 class="card-title">MEMBERS COUNT</h5>
							<h6 class="card-subtitle mb-2"><?php echo $count ?></h6>
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
							<h5 class="card-title">MEMBERS APPROVAL</h5>
							<h6 class="card-subtitle mb-2"><?php echo $count1 ?></h6>
						</div>
						<div style="margin-top:-100px; visibility:hidden;">
							<button class="form-control btn btn-warning" data-toggle="modal" data-target="#exampleModal">VIEW DETAILS <i class="bi bi-arrow-right-circle"></i></button>
						</div>
					</div>
				</div>
        	</div>
			<div class="container-fluid mt-4" style="margin:0px;">
				<div class="graph float-left rounded" style="width:61.5%;border:1px solid lightgray;height:400px;">
					<p>DIVISION GRAPH</p>
					<hr>
				</div>
				<div class="graph float-left ml-4" style="width:30%;border:1px solid lightgray;height:400px;">
					<p>CALENDAR</p>
					<hr>
				</div>
			</div>
    	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-lg" role="document">
	    	<div class="modal-content">
  				<h4 style="font-weight: normal;">ONLINE LIST</h4>
    			<div class="table-responsive" style="margin-top:20px;">
					<table id="employee_data" class="table striped table-fluid" width="100%">
						<thead style="background:#b4ecf0;">  
							<tr>  
								<td>#</td>  
								<td>Name</td>  
								<td>Address</td>  
								<td>Position</td>  
								<td>Job Title</td>
							</tr>  
						</thead>  
						<tbody>
							<?php  
							while($row = mysqli_fetch_array($result6))  
								{  
									echo "<tr>";									
										echo "<td class='align-middle'>"; echo $row["userID"]; echo "</td>";
										echo "<td class='align-middle'>"; echo $row["userFname"]." ".$row["userLname"]; echo "</td>";
										echo "<td class='align-middle'>"; echo $row["userAddress"]; echo "</td>";
										echo "<td class='align-middle'>"; echo $row["userRole"]; echo "</td>";
										echo "<td class='align-middle'>"; echo $row["jobDesc"]; echo "</td>";
									echo "</tr>";
								}  
							?>  
						</tbody>
					</table>  
				</div>
  			</div>
		</div>
	</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>