<?php
require '../connection.php';
require '../vendor/autoload.php';
include('../session.php');

$query ="SELECT * FROM fileUpload;";   
$result = mysqli_query($conn, $query); 
$query1 ="SELECT eventregistrationtable.eventName,badgesinfotable.certFile,badgesinfotable.badgeFile,eventmembershiptable.membershipID,studentinfotable.studentID FROM eventregistrationtable INNER JOIN badgesinfotable ON badgesinfotable.eventID = eventregistrationtable.eventID INNER JOIN eventmembershiptable ON eventmembershiptable.eventID = eventregistrationtable.eventID INNER JOIN studentinfotable ON eventmembershiptable.memID = studentinfotable.studentID;";  
$result1 = mysqli_query($conn, $query1); 

if (isset($_POST["submitReg"])) {
	$file = rand(1000,100000)."-".$_FILES['t3']['name'];
    $file_loc = $_FILES['t3']['tmp_name'];
	$file_size = $_FILES['t3']['size'];
	$file_type = $_FILES['t3']['type'];
	$folder="../upload/";
 	$new_size = $file_size/1024;  
 	$new_file_name = strtolower($file);
 	$final_file=str_replace(' ','-',$new_file_name);
 
 	if(move_uploaded_file($file_loc,$folder.$final_file))
 	{
 		$image = addslashes(file_get_contents($_FILES['t2']['tmp_name']));;
 		mysqli_query($conn, "INSERT INTO badgesinfotable(`certID`, `certFile`, `badgeFile`, `eventID`, `certStatus`) VALUES('','$final_file','$image','3','ACTIVE')");
	  	echo
	    "
	    <script>
	    alert('FORMS ADDED SUCCESFULLY');
	    document.location.href = '';
	    </script>
	    ";
    }
 	else
 	{
	  	echo
	    "
	    <script>
	    alert('File Invalid');
	    document.location.href = '';
	    </script>
	    ";
		
	}
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
	 	 	<li class="active">
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
				  	<a href="../upload/80620-hardware-technologies.docx" download="../upload/80620-hardware-technologies">SAMPLE</a>
		  		</div>
		  	</nav>
			<div class="container-fluid p-3" style="margin:0px;">
				ADMIN / BADGES and CERTIFICATE
			</div>
			<div class="container-fluid p-3" style="margin:0px;">
				<h2>CERTIFICATE and BADGES</h2>
				<form method="POST" enctype="multipart/form-data">
					<table>
						<tr>
	      					<td width="20%">Select Event</td>
	      					<td>:</td>
	      					<td>
	      						<select  class="form-control" name="t1">
		                            <?php
		                            $res=mysqli_query($conn,"SELECT * FROM eventregistrationtable WHERE eventStatus = 'ACTIVE'");
		                            while($row=mysqli_fetch_array($res))
		                            {
		                            ?>
		                                <option value="<?php echo $row['eventID']; ?>"><?php echo $row['eventName']; ?></option>
		                                <?php
		                            }
		                            ?>
		                        </select>
	      					</td>
	      				</tr>
						<tr>
	      					<td width="20%">Certificate File</td>
	      					<td>:</td>
	      					<td><input type="file" class="form-control" name="t3"></td>
	      				</tr>
	      				<tr>
	      					<td width="20%">Badge File</td>
	      					<td>:</td>
	      					<td><input type="file" class="form-control" name="t2"></td>
	      				</tr>
					</table>
					<div class="modal-footer mt-3">
	      				<button type="submit" class="btn btn-primary" name="submitReg">Save Changes</button>
	      			</div>
				</form>
			</div>
			<div class="container-fluid p-3" style="margin:0px;">
				CERTIFICATE and BADGES
	  				<form method="POST">
	  					<table id="employee_data" class="table table-fluid" width="100%">
							<thead>  
								<tr>  
									<td>Event Name</td>  
									<td>Membership ID</td>
									<td>Certificate Uploaded</td>
									<td>Badge Uploaded</td>
								</tr>  
							</thead>  
							<?php  
							while($row = mysqli_fetch_array($result1))  
								{  
									echo "<tr>";									
										echo "<td class='align-middle'>"; echo $row["eventName"]; echo "</td>";
										echo "<td class='align-middle'>"; echo $row["membershipID"]; echo "</td>";
										echo "<td class='align-middle'>"; echo $row["certFile"]; echo "</td>";
										echo "<td><img src='data:image/jpeg;base64,".base64_encode($row["badgeFile"] )."' style='width:50%;height:60px;'/></td>";
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