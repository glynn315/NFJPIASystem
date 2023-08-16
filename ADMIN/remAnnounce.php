<?php
require '../connection.php';
if(isset($_REQUEST["announceID"]))
{
	$announceID=$_REQUEST["announceID"];
	$conn2=mysqli_query($conn ,"SELECT * FROM announceinfo WHERE announceID = '$announceID';");
	$row1=mysqli_fetch_array($conn2);
}
 mysqli_query($conn ,"UPDATE announceinfo SET announceStatus = 'ARCHIVE' WHERE announceID = '$announceID'");
echo
    "
    <script>
    alert('DATA UPDATED');
    document.location.href = 'announcePage.php';
    </script>
    ";
?>