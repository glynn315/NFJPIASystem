<?php
require '../connection.php';
if(isset($_REQUEST["eventID"]))
{
	$eventID=$_REQUEST["eventID"];
	$conn2=mysqli_query($conn ,"SELECT * FROM eventregistrationtable WHERE eventID = '$eventID';");
	$row1=mysqli_fetch_array($conn2);
}
 mysqli_query($conn ,"UPDATE eventregistrationtable SET eventStatus = 'ARCHIVE' WHERE eventID = '$eventID'");
echo
    "
    <script>
    alert('EVENT UPDATED');
    document.location.href = 'eventManagement.php';
    </script>
    ";
?>