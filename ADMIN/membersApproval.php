<?php
require '../connection.php';
include('../session.php');
$query ="SELECT * FROM meminfotbl WHERE memStatus = 'APPROVAL';";   
$result = mysqli_query($conn, $query); 

if (isset($_POST["btnApproved"])) {
    mysqli_query($conn ,"UPDATE meminfotbl SET memStatus = 'APPROVED' WHERE memID = '$memID'");
    echo
        "
        <script>
        alert('MEMBERS UPDATED');
        document.location.href = 'memberManagement.php';
        </script>
        ";
}
if (isset($_POST["btnCancel"])) {
    echo
        "
        <script>
        alert('REJECTED');
        document.location.href = 'memberManagement.php';
        </script>
        ";
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
            <li class="active">
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
        <div class="container-fluid" style="margin: 0;">
            <p style="font-size: 30px;">MEMBER REQUISITION</p>
            <div class="table-responsive" style="margin-top:20px;">
                <table id="employee_data" class="table striped table-fluid" width="100%">
                    <thead style="background:#b4ecf0;">  
                        <tr>  
                            <td>Member ID</td>  
                            <td>Name</td>  
                            <td>Address</td>  
                            <td>Birthday</td>  
                            <td>Chapter</td>
                            <td>Account Type</td>
                            <td>Course</td>
                            <td></td>
                        </tr>  
                    </thead>  
                    <tbody>
                        <?php  
                        while($row = mysqli_fetch_array($result))  
                            {  
                                echo "<tr>";                                    
                                    echo "<td class='align-middle'>"; echo $row["memID"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["memFName"]." ".$row["memLName"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["memAddress"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["memBday"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["memChapter"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["memAccount"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["memCourse"]; echo "</td>";
                                    echo "<td class='align-middle'><a href ='approval.php?memID=$row[memID]'><button class='btn btn-primary'><i class='bi bi-check-circle-fill'></i></a>";"</td>";
                                echo "</tr>";
                            }  
                        ?>  
                    </tbody>
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