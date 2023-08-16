<?php
require '../connection.php';
include('../session.php');

if(isset($_REQUEST["paymentID"]))
{
    $paymentID=$_REQUEST["paymentID"];
    $conn2=mysqli_query($conn ,"SELECT eventregistrationtable.eventID,paymentinfotable.payment,paymentinfotable.memID,paymentinfotable.paymentID,meminfotbl.memFName,meminfotbl.memLName,eventregistrationtable.eventName,eventregistrationtable.eventFree,paymentinfotable.amountPayment,paymentinfotable.paymentStatus FROM paymentinfotable INNER JOIN meminfotbl ON paymentinfotable.memID = meminfotbl.memID INNER JOIN eventregistrationtable ON paymentinfotable.eventID = eventregistrationtable.eventID WHERE paymentinfotable.paymentID = '$paymentID'");
    $row1=mysqli_fetch_array($conn2);

    $ID = $row1["memID"];
    $ID1 = $row1["eventID"];
}

if (isset($_POST["btnApproved"])) {
    mysqli_query($conn ,"UPDATE paymentinfotable SET paymentStatus = 'APPROVED' WHERE paymentID = '$paymentID'");
    mysqli_query($conn ,"UPDATE eventmembershiptable SET membershipStatus = 'ACTIVE' WHERE memID = '$ID' AND eventID= '$ID1'");
    echo
        "
        <script>
        alert('EVENT UPDATED');
        document.location.href = 'paymentManagement.php';
        </script>
        ";
}
if (isset($_POST["btnCancel"])) {
    echo
        "
        <script>
        alert('CANCEL PAYMENT');
        document.location.href = 'paymentManagement.php';
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
    <link rel="stylesheet" type="text/css" href="CSS/style.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light border">

    <div class="p-2 mt-2 center rounded main-Con" style="width:70%;">
        <h1 class="p-2" align="center">PAYMENT INFO</h1>
        <form method="POST" enctype="multipart/form-data">
            <table class="m-2 h4" width="100%">
                <tr>
                    <td rowspan="5"><img src="<?php echo"data:image/jpeg;base64,".base64_encode($row1["payment"] )."" ?>" style='width:90%;height:350px;'/></td>
                </tr>
                <tr>
                    <td width="40%">Membership ID   </td>
                    <td> : </td>
                    <td><?php echo $row1["eventName"] ?></td>
                </tr>
                <tr>
                    <td width="40%">Event Name</td>
                    <td> : </td>
                    <td><?php echo $row1["eventName"] ?></td>
                </tr>
                <tr>
                    <td>Amount Payment</td>
                    <td> : </td>
                    <td><?php echo $row1["amountPayment"] ?></td>
                </tr>
                <tr>
                    <td>Amount Payable</td>
                    <td> : </td>
                    <td><?php echo $row1["eventFree"] ?></td>
                </tr>
            </table>
            <hr>
            <button class="btn btn-danger float-right" name="btnCancel">CANCEL</button>
            <button class="btn btn-primary float-right mr-3" name="btnApproved">APPROVED</button>
        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>