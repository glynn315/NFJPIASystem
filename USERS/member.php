<?php
require '../connection.php';
include('../studentSession.php');
$date = date('Y-m-d');
$dateID = date('Ymd');
$random = rand(1,9999);
if(isset($_REQUEST["eventID"]))
{
	$eventID=$_REQUEST["eventID"];
	$conn2=mysqli_query($conn ,"SELECT * FROM eventregistrationtable WHERE eventStatus = 'ACTIVE' AND eventID = '$eventID'");
	$row1=mysqli_fetch_array($conn2);
}
$mem = $login_session;

$Bill=$row1["totalContribution"];
$con1 = mysqli_query($conn , "SELECT * FROM eventmembershiptable WHERE eventID = '$eventID' AND memID = '$mem'");
$count = mysqli_num_rows($con1);

if ($count ==1) {
    echo
    "
    <script>
    alert('Already Joined the Event');
    document.location.href = 'viewEvents.php';
    </script>
    ";
}
else
{
    if ($Bill != "0") {
        $id = 'MEMBERSHIP-'.$dateID.'-'.$random;
        mysqli_query($conn ,"INSERT INTO eventmembershiptable VALUES('$id','$eventID','$mem','$date','PENDING PAYMENT')");
        mysqli_query($conn ,"INSERT INTO paymentinfotable(`memID`, `eventID`, `amountPayment`, `paymentStatus`) VALUES('$mem','$eventID','$Bill','PENDING PAYMENT')");
        echo
        "
        <script>
        alert('PROCEED TO PAYMENT');
        document.location.href = 'viewEvents.php';
        </script>
        ";
    }
    else
    {
        $id = 'MEMBERSHIP-'.$dateID.'-'.$random;
        mysqli_query($conn ,"INSERT INTO eventmembershiptable VALUES('$id','$eventID','$mem','$date','ACTIVE')");
        echo
        "
        <script>
        alert('Membership Sent');
        document.location.href = 'viewEvents.php';
        </script>
        ";
    }
    
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
</body>
</html>


