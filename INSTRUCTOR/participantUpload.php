<?php
require '../connection.php';
include('../session.php');
$query ="SELECT * FROM studentinfotable WHERE schoolID = '$schoolReg';";   
$result = mysqli_query($conn, $query); 

$date = date('Y-m-d');
if (isset($_POST["submitReg"])) {
    $file = $_FILES['t3']['name'];
    $file_loc = $_FILES['t3']['tmp_name'];
    $file_size = $_FILES['t3']['size'];
    $file_type = $_FILES['t3']['type'];
    $folder="../upload/";
    $new_size = $file_size/1024;  
    $new_file_name =$file;
    $final_file=str_replace(' ','-',$new_file_name);
 
    if(move_uploaded_file($file_loc,$folder.$final_file))
    {
        mysqli_query($conn, "INSERT INTO fileUpload VALUES('','$_POST[t1]','$final_file','$date')");
        echo
        "
        <script>
        alert('LIST ADDED SUCCESFULLY');
        document.location.href = '';
        </script>
        ";
    }
    else
    {
        echo "Error.Please try again";
        
    }

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
                    <a class="nav-link" href="calendar.php">Calendar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="paymentinfo.php">Payment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="viewEvents.php">View Events</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="participantUpload.php">Submit Participant</a>
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
            <p style="font-size: 30px;">PARTICIPANT UPLOAD</p>
            <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">UPLOAD PARTICIPANTS LIST</button>
            <div class="table-responsive" style="margin-top:20px;">
                <table id="employee_data" class="table table-fluid" width="100%">
                    <thead>  
                        <tr>  
                            <td>Student ID</td>  
                            <td>Student Name</td>  
                            <td>Student Year</td>
                            <td>Student Course</td>  
                            <td>Date Registration</td>
                            <td>Student Status</td>  
                        </tr>  
                    </thead>  
                    <?php  
                    while($row = mysqli_fetch_array($result))  
                        {  
                            echo "<tr>";                                    
                                echo "<td class='align-middle'>"; echo $row["studentID"]; echo "</td>";
                                echo "<td class='align-middle'>"; echo $row["studentFname"] . ' ' .$row["studentLname"]; echo "</td>";
                                echo "<td class='align-middle'>"; echo $row["studentYear"]; echo "</td>";
                                echo "<td class='align-middle'>"; echo $row["studentCourse"]; echo "</td>";
                                echo "<td class='align-middle'>"; echo $row["studentDateReg"]; echo "</td>";
                                echo "<td class='align-middle'>"; echo $row["studentStatus"]; echo "</td>";
                            echo "</tr>";
                        }  
                    ?>  
                </table>  
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3" style="border-radius: 20px;">
                <p style="font-size:30px;">FORM INFORMATION</p>
                <form method="POST" enctype="multipart/form-data">
                    <table width="100%">
                        <tr>
                            <td width="20%">File Name</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="t1"></td>
                        </tr>
                        <tr>
                            <td width="20%">File</td>
                            <td>:</td>
                            <td><input type="file" class="form-control" name="t3"></td>
                        </tr>
                    </table>
                    <div class="modal-footer mt-3">
                        <button type="submit" class="btn btn-primary" name="submitReg">Save Changes</button>
                        <button type="submit" class="btn btn-danger">Cancel</button>
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
</body>
</html>