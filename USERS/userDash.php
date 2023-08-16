<?php
require '../connection.php';
include('../studentSession.php');
include('count.php');
$query ="SELECT eventregistrationtable.eventName,badgesinfotable.certFile,badgesinfotable.badgeFile,eventmembershiptable.membershipID,studentinfotable.studentID FROM eventregistrationtable INNER JOIN badgesinfotable ON badgesinfotable.eventID = eventregistrationtable.eventID INNER JOIN eventmembershiptable ON eventmembershiptable.eventID = eventregistrationtable.eventID INNER JOIN studentinfotable ON eventmembershiptable.memID = studentinfotable.studentID WHERE studentinfotable.studentID = '$login_session';";  
$result = mysqli_query($conn, $query); 



$query1 ="SELECT * FROM announceinfo WHERE announceStatus = 'ACTIVE';";  
$result1 = mysqli_query($conn, $query1); 

if (isset($_POST["dlCert"])) {
	$rand = rand(1,99);
	require '../vendor/autoload.php';
	// Load the template file and replace the placeholders
	$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('../upload/77058-samplecert.docx');
	$templateProcessor->setValue('{NAME}', $login_Name);

	// Save the modified document to a temporary file
	$tmpFile = tempnam(sys_get_temp_dir(), 'word');
	$templateProcessor->saveAs($tmpFile);

	// Download the document to the user's browser
	header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
	header('Content-Disposition: attachment; filename="certificate.docx"');
	readfile($tmpFile);

	// Delete the temporary file
	unlink($tmpFile);
}




?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NFJPIA WEBSITE</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">



    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light border">
		<img src="../IMAGE/samp.png" width="50" height="50">
  		<a class="navbar-brand" href="#" style="border-right: 1px solid black;padding-right: 20px;">NFJPIA</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
  		<div class="collapse navbar-collapse">
    		<ul class="navbar-nav">
      			<li class="nav-item active">
        			<a class="nav-link" href="userDash.php">Home <span class="sr-only">(current)</span></a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="calendar.php">Calendar of Events</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="paymentinfo.php">Payment</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="viewEvents.php">View Events</a>
      			</li>
    		</ul>
    		
  		</div>
  		<div>
  			<ul class="navbar-nav">
    			<li class="nav-item dropdown">
		        	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          		Account Settings
		        	</a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          	<a class="dropdown-item" href="#">Account Settings</a>
			          	<div class="dropdown-divider"></div>
			          	<a class="dropdown-item" href="logout.php">Sign Out</a>
			        </div>
		     	</li>
		     	<li class="nav-item">
        			<a class="nav-link" href=""><?php echo $login_Name  ?></a>
      			</li>
    		</ul>
  		</div>
  		
	</nav>
	<div class="d-flex flex-row">
	  		
	</div>
	<div class="p-2 mt-2 center rounded main-Con">
		<div class="d-flex flex-row">
	  		<div class="card d-flex flex-row">
	  			<div class="p-2 font" style="width:70%;">Past Events <br>
	  			<b><?php echo $count1 ?></b>
	  		</div>
	  			<div class="p-2" style="width:30%;"><img src="../IMAGE/calendar.png" class="card-img"></div>
	  		</div>
	  		<div class="card d-flex flex-row">
	  			<div class="p-2 font" style="width:70%;">On-Going Events <br>
	  			<b>0</b>
	  		</div>
	  			<div class="p-2" style="width:30%;"><img src="../IMAGE/calendar.png" class="card-img"></div>
	  		</div>
	  		<div class="card d-flex flex-row">
	  			<div class="p-2 font" style="width:70%;">Future Events <br>
	  			<b><?php echo $count ?></b>
	  		</div>
	  			<div class="p-2" style="width:30%;"><img src="../IMAGE/calendar.png" class="card-img"></div>
	  		</div>
	  		<div class="card d-flex flex-row">
	  			<div class="p-2 font" style="width:70%;">Attended Events <br>
	  			<b><?php echo $count2 ?></b>
	  		</div>
	  			<div class="p-2" style="width:30%;"><img src="../IMAGE/calendar.png" class="card-img"></div>
	  		</div>
			  </div>
	  		<div class="card flex-column" style="width: 50%;background: none;color: black;border: none;">
	  			<div class="p-2 font border">
	  				ANNOUNCEMENTS<br>
	  				<table id="employee" class="table table-fluid" width="100%">
						<thead>  
							<tr>  
								<td>Announce Name</td>  
								<td>Date</td>
							</tr>  
						</thead>  
						<?php  
						while($row = mysqli_fetch_array($result1))  
							{  
								echo "<tr>";									
									echo "<td class='align-middle'>"; echo $row["announceName"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["announceDate"]; echo "</td>";
								echo "</tr>";
							}  
						?>  
					</table> 
	  			</div>
	  			<div class="p-2 font border mt-2">
	  				CERTIFICATE and BADGES
	  				<form method="POST">
	  					<table id="employee_data" class="table table-fluid" width="100%">
							<thead>  
								<tr>  
									<td>Event Name</td>  
									<td>Membership ID</td>
									<td>Certificate Uploaded</td>
									<td>Badge Uploaded</td>
									<td width="7%"></td>  
								</tr>  
							</thead>  
							<?php  
							while($row = mysqli_fetch_array($result))  
								{  
									echo "<tr>";									
										echo "<td class='align-middle'>"; echo $row["eventName"]; echo "</td>";
										echo "<td class='align-middle'>"; echo $row["membershipID"]; echo "</td>";
										echo "<td class='align-middle'>"; echo $row["certFile"]; echo "</td>";
										echo "<td><img src='data:image/jpeg;base64,".base64_encode($row["badgeFile"] )."' style='width:50%;height:60px;'/></td>";
										echo "<td class='align-middle'><button type='submit' class='btn btn-primary' name='dlCert'><i class='bi bi-file-arrow-down-fill'></i></button>";"</td>";
									echo "</tr>";
								}  
							?>  
						</table>
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
</body>
</html>