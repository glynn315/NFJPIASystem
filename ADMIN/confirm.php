<?php
require '../connection.php';
$date = date('Y-m-d');
if(isset($_REQUEST["eventID"]))
{
	$eventID=$_REQUEST["eventID"];
	$conn2=mysqli_query($conn ,"SELECT eventregistrationtable.eventID,eventregistrationtable.eventName,eventregistrationtable.eventDesc,schoolinfotbl.schoolName,eventregistrationtable.eventDateStart,eventregistrationtable.eventDateEnd,eventregistrationtable.eventType,eventregistrationtable.eventFree,eventregistrationtable.eventStatus,eventregistrationtable.eventDateAdded FROM eventregistrationtable INNER JOIN schoolinfotbl ON schoolinfotbl.schoolID = eventregistrationtable.schoolID WHERE eventregistrationtable.eventID = '$eventID'");
	$row1=mysqli_fetch_array($conn2);
}


if (isset($_POST["subApp"])) {
    mysqli_query($conn ,"UPDATE eventregistrationtable SET eventStatus = 'APPROVED' WHERE eventID = '$eventID'");
    echo
        "
        <script>
        alert('EVENT UPDATED');
        document.location.href = 'eventManagement.php';
        </script>
        ";
}
if (isset($_POST["subRej"])) {
    mysqli_query($conn ,"UPDATE eventregistrationtable SET eventStatus = 'REJECT' WHERE eventID = '$eventID'");
    echo
        "
        <script>
        alert('EVENT UPDATED');
        document.location.href = 'eventManagement.php';
        </script>
        ";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CONFIRM</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/nav.css">
</head>
<body>
    <div class="container-fluid p-4 center" style="margin:0;">
        <h1>EVENT INFORMATION</h1>
        <form method="POST">
            <table width="70%">
                <tr>
                    <td width="20%">EVENT ID</td>
                    <td> : </td>
                    <td> <?php echo $row1["eventID"] ?></td>
                </tr>
                <tr>
                    <td>EVENT NAME</td>
                    <td> : </td>
                    <td> <?php echo $row1["eventName"] ?></td>
                </tr>
                <tr>
                    <td>EVENT DESCRIPTION</td>
                    <td> : </td>
                    <td> <?php echo $row1["eventDesc"] ?></td>
                </tr>
                <tr>
                    <td>EVEN START</td>
                    <td> : </td>
                    <td> <?php echo $row1["eventDateStart"] ?></td>
                </tr>
                <tr>
                    <td>EVENT END</td>
                    <td> : </td>
                    <td> <?php echo $row1["eventDateEnd"] ?></td>
                </tr>
                <tr>
                    <td>PARTICIPANT SCHOOL</td>
                    <td> : </td>
                    <td> <?php echo $row1["schoolName"] ?></td>
                </tr>
            </table>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="subApp">APPROVED</button>
                <button type="submit" class="btn btn-danger" name="subRej">REJECT</button>
            </div>
        </form>
    </div>

</body>
</html>


