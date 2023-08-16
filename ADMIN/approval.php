<?php
require '../connection.php';
if(isset($_REQUEST["memID"]))
{
	$memID=$_REQUEST["memID"];
	$conn2=mysqli_query($conn ,"SELECT * FROM meminfotbl WHERE memID = '$memID';");
	$row1=mysqli_fetch_array($conn2);
}
 mysqli_query($conn ,"UPDATE meminfotbl SET memStatus = 'ACTIVE' WHERE memID = '$memID'");
echo
    "
    <script>
    alert('ACCOUNT UPDATED');
    document.location.href = 'adminDash.php';
    </script>
    ";
?>