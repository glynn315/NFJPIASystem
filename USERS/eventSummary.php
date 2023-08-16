<?php
require '../connection.php';
include('../studentSession.php');
if(isset($_REQUEST["eventID"]))
{
    $eventID=$_REQUEST["eventID"];
    $conn2=mysqli_query($conn ,"SELECT * FROM eventregistrationtable WHERE eventStatus = 'ACTIVE' AND eventID = '$eventID'");
    $row1=mysqli_fetch_array($conn2);

    $query ="SELECT * FROM subeventtable WHERE eventID = '$eventID';";   
    $result = mysqli_query($conn, $query); 

    $query1 ="SELECT * FROM cashbreakdown WHERE eventID = '$eventID';";   
    $result1 = mysqli_query($conn, $query1); 

    $query2 ="SELECT SUM(cashbreakdown.cashAmount) AS CASH FROM cashbreakdown WHERE eventID = '$eventID';";   
    $result2 = mysqli_query($conn, $query2); 
    $row3=mysqli_fetch_array($result2);

    $query3 ="SELECT COUNT(studentinfotable.studentID) AS STUDENT FROM studentinfotable;";   
    $result3 = mysqli_query($conn, $query3); 
    $row4=mysqli_fetch_array($result3);

}


if (isset($_POST["printWaiver"])) {
    require '../vendor/autoload.php';

    $evName=$row1["eventName"];
    // Load the template file and replace the placeholders
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('../upload/waiver.docx');
    $templateProcessor->setValue('{NAME}', $login_Name);
    $templateProcessor->setValue('{EVENT}', $evName);
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h3 class="modal-title">Event Summary</h3>
                </div>
                <table width="90%" class="center">
                    <tr style="height: 40px;">
                        <td width="40%">Event ID</td>
                        <td><?php echo $row1["eventID"] ?></td>
                    </tr>
                    <tr style="height: 40px;">
                        <td width="40%">Event Name</td>
                        <td><?php echo $row1["eventName"] ?></td>
                    </tr>
                    <tr style="height: 40px;">
                        <td>Event Description</td>
                        <td><?php echo $row1["eventDesc"] ?></td>
                    </tr>
                    <tr style="height: 40px;">
                        <td>Event Event Start</td>
                        <td><?php echo $row1["eventDateStart"] ?></td>
                    </tr>
                    <tr style="height: 40px;">
                        <td>Event Event End</td>
                        <td><?php echo $row1["eventDateEnd"] ?></td>
                    </tr>
                    <tr style="height: 40px;">
                        <td>Event Type</td>
                        <td><?php echo $row1["eventType"] ?></td>
                    </tr>
                    <tr style="height: 40px;">
                        <td>Event Theme</td>
                        <td><?php echo $row1["eventTheme"] ?></td>
                    </tr>
                    <tr style="height: 40px;">
                        <td>Event Organizer</td>
                        <td><?php echo $row1["eventOrganizer"] ?></td>
                    </tr>
                    <tr style="height: 40px;">
                        <td>Event Venue</td>
                        <td><?php echo $row1["eventVenue"] ?></td>
                    </tr>
                </table>
                <div class="modal-header">
                    <h3 class="modal-title">Sub Events</h3>
                </div>
                <table class="table table-fluid" width="100%">
                    <thead>  
                        <tr>  
                            <td>#</td>  
                            <td>Sub Event Name</td>  
                            <td>Sub Event Description</td>
                        </tr>  
                    </thead>  
                    <?php  
                    while($row = mysqli_fetch_array($result))  
                        {  
                            echo "<tr>";                                    
                                echo "<td class='align-middle'>"; echo $row["subEventID"]; echo "</td>";
                                echo "<td class='align-middle'>"; echo $row["subEventName"]; echo "</td>";
                                echo "<td class='align-middle'>"; echo $row["subEventDescription"]; echo "</td>";
                            echo "</tr>";
                        }  
                    ?>  
                </table>  
                <div class="modal-header">
                    <h3 class="modal-title">Payment Breakdown</h3>
                </div>
                <table class="table table-fluid" width="100%">
                    <thead>  
                        <tr>  
                            <td>#</td>  
                            <td>Cash Purpose</td>  
                            <td>Cash Amount</td>
                        </tr>  
                    </thead>  
                    <?php  
                    while($row = mysqli_fetch_array($result1))  
                        {  
                            echo "<tr>";                                    
                                echo "<td class='align-middle'>"; echo $row["cashID"]; echo "</td>";
                                echo "<td class='align-middle'>"; echo $row["cashPurpose"]; echo "</td>";
                                echo "<td class='align-middle'>"; echo $row["cashAmount"]; echo "</td>";
                            echo "</tr>";
                        }  
                    ?>  
                </table>
                <table style="margin-left: 10px; margin-bottom:20px;">
                    <tr>
                        <td>Event Registration </td>
                        <td width="10%" align="center"> : </td>
                        <td> <?php echo $row1["eventFree"] ?></td>
                    </tr>
                    <tr>
                        <td>Total Expenses </td>
                        <td width="10%" align="center"> : </td>
                        <td> <?php echo $row3["CASH"]?></td>
                    </tr>
                    <tr>
                        <td>Contingency Budget </td>
                        <td width="10%" align="center"> : </td>
                        <td> <?php echo $row3["CASH"] * .10?></td>
                    </tr>
                    <tr>
                        <td>Expected Participant </td>
                        <td width="10%" align="center"> : </td>
                        <td> <?php echo $row4["STUDENT"]?></td>
                    </tr>
                    <tr>
                        <td>Individual Contribution </td>
                        <td width="10%" align="center"> : </td>
                        <td><?php echo ($row3["CASH"] + ($row3["CASH"] * .10)) / $row4["STUDENT"] + $row1["eventFree"] ?></td>
                    </tr>
                </table>
                <div class="modal-footer">
                    <a href="viewEvents.php"><button class="btn btn-danger">CLOSE</button></a>
                    <form method="POST">
                        <button class="btn btn-primary" name="printWaiver">PRINT WAIVER</button>
                    </form>
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