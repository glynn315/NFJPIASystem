<?php
require '../connection.php';
include('../studentSession.php');

// $query ="SELECT schoolinfotbl.schoolID,eventregistrationtable.eventID,eventregistrationtable.eventName,eventregistrationtable.eventDesc,schoolinfotbl.schoolName,eventregistrationtable.eventDateStart,eventregistrationtable.eventDateEnd,eventregistrationtable.eventType,eventregistrationtable.eventFree,eventregistrationtable.eventStatus,eventregistrationtable.eventDateAdded FROM eventregistrationtable INNER JOIN schoolinfotbl ON schoolinfotbl.schoolID = eventregistrationtable.schoolID WHERE eventregistrationtable.eventStatus = 'APPROVED' AND schoolinfotbl.schoolID = '$schoolReg';";  
$query ="SELECT * FROM eventregistrationtable WHERE eventStatus = 'ACTIVE';";   
$result = mysqli_query($conn, $query); 
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
                <li class="nav-item">
                    <a class="nav-link" href="userDash.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calendar.php">Calendar of Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="paymentinfo.php">Payment</a>
                </li>
                <li class="nav-item active">
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
    <div class="p-2 mt-2 center rounded main-Con">
        <div class="container-fluid p-3" style="margin:0px;">
                <p style="font-size: 30px;">EVENTS MANAGEMENT</p>
                <div class="table-responsive" style="margin-top:20px;">
                    <table id="employee_data" class="table table-fluid" width="100%">
                        <thead>  
                            <tr>  
                                <td>#</td>  
                                <td>Event Name</td>  
                                <td>Event Description</td>
                                <td>Venue</td> 
                                <td>Event Start</td>
                                <td>Event End</td>  
                                <td>Event Type</td>
                                <td>Fee</td>  
                                <td>Request Date</td>
                                <td width="5%"></td>
                            </tr>  
                        </thead>  
                        <?php  
                        while($row = mysqli_fetch_array($result))  
                            {  
                                echo "<tr>";                                    
                                    echo "<td class='align-middle'>"; echo $row["eventID"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["eventName"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["eventDesc"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["eventVenue"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["eventDateStart"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["eventDateEnd"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["eventType"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["eventFree"]; echo "</td>";
                                    echo "<td class='align-middle'>"; echo $row["eventDateAdded"]; echo "</td>";
                                    echo "<td class='align-middle'><a href ='member.php?eventID=$row[eventID]&&memID=$login_session'><button class='btn btn-success mr-2' style='padding:3px; height:30px;'><i class='bi bi-calendar-check-fill'></i></button></a><a href ='eventSummary.php?eventID=$row[eventID]&&memID=$login_session'><button class='btn btn-info' style='padding:3px; height:30px;'><i class='bi bi-file-text-fill'></i></button></a>";"</td>";
                                echo "</tr>";
                            }  
                        ?>  
                    </table>  
                    </div>
                </div>
            </div>
    </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h3 class="modal-title">Event Summary</h3>
                </div>
                
                <table width="90%" class="center">
                    <tr>
                        <td width="40%">Event Name</td>
                        <td><input type="text" id="id1" class="form-control" style="border: none;"></td>
                    </tr>
                    <tr>
                        <td>Event Description</td>
                        <td><input type="text" id="id2" class="form-control" style="border: none;"></td>
                    </tr>
                    <tr>
                        <td>Event Event Start</td>
                        <td><input type="text" id="id3" class="form-control" style="border: none;"></td>
                    </tr>
                    <tr>
                        <td>Event Event End</td>
                        <td><input type="text" id="id4" class="form-control" style="border: none;"></td>
                    </tr>
                    <tr>
                        <td>Event Type</td>
                        <td><input type="text" id="id5" class="form-control" style="border: none;"></td>
                    </tr>
                    <tr>
                        <td>Event Fee</td>
                        <td><input type="text" id="id6" class="form-control" style="border: none;"></td>
                    </tr>
                    <tr>
                        <td>Event Added</td>
                        <td><input type="text" id="id7" class="form-control" style="border: none;"></td>
                    </tr>
                    <tr>
                        <td>Event Venue</td>
                        <td><input type="text" id="id8" class="form-control" style="border: none;"></td>
                    </tr>
                </table>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" class="close" data-dismiss="modal" aria-label="Close">CLOSE</button>
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
<script type="text/javascript">
    var table = document.getElementById('employee_data');     
        for(var i = 1; i < table.rows.length; i++)
        {
            table.rows[i].onclick = function()
            {
                document.getElementById("id1").value = this.cells[1].innerHTML;
                document.getElementById("id2").value = this.cells[2].innerHTML;
                document.getElementById("id3").value = this.cells[4].innerHTML;
                document.getElementById("id4").value = this.cells[5].innerHTML;
                document.getElementById("id5").value = this.cells[6].innerHTML;
                document.getElementById("id6").value = this.cells[7].innerHTML;
                document.getElementById("id7").value = this.cells[8].innerHTML;
                document.getElementById("id8").value = this.cells[3].innerHTML;
            };
        }
</script>
</body>
</html>