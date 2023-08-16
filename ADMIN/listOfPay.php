<?php
require_once('../tcpdf/tcpdf.php');
require '../connection.php'; 
if (isset($_GET['genPDFFormat'])) {
$date2 = date('Y/m/d');
/**
 * 
 */
class PDF extends TCPDF
{
    public function Header()
    {
    	$date1 = date('F j, Y');
        $imageFile = K_PATH_IMAGES.'samp.png';
        $this->Image($imageFile,87,5,40,'','PNG','','T',false,300,'',false,false,0,false,false,false);
        $this->SetFont('times', 'B',20);
		$this->Ln(40);
		$this->Write(0, 'LIST OF PAYMENTS', '', 0, 'C', true, 0, false, false, 0);
		$this->SetFont('times', '',10);
		$this->Write(0, $date1, '', 0, 'C', true, 0, false, false, 0);
    }

    public function Footer()
    {
        $this->SetY(-25);
        $this->SetFont('times','','5');

        $this->Ln(2);
        $today = date('m/d/Y');
        $this->Cell('55','','               '.$today.'','0','0');
        $this->Ln(2);
        $this->Cell('23','','Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,false,'R',0,'',0,false,'T','M');
        $this->Ln(5);

    }
    
}

// create new PDF document
$pageLayout = array(216, 356); //  or array($height, $width) 
$pdf = new PDF('p', 'mm', $pageLayout, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Daily Request');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('helvetica', '', 14, '', true);



$pdf->AddPage();

$pdf->Ln(35);
$pdf->SetFont('helvetica','', 10, '', true);
$pdf->SetFillColor(177, 220, 250);
$pdf->Cell(30,5,' Student ID',0,0,'L',1);
$pdf->Cell(50,5,' Student Name',0,0,'L',1);
$pdf->Cell(45,5,' Event Name',0,0,'L',1);
$pdf->Cell(35,5,' Amount Payment',0,0,'L',1);
$pdf->Cell(25,5,' Status',0,0,'L',1);

$query1 = "SELECT studentinfotable.studentID,studentinfotable.studentFname,studentinfotable.studentLname,eventregistrationtable.eventName,paymentinfotable.amountPayment,paymentinfotable.paymentStatus FROM paymentinfotable INNER JOIN studentinfotable ON studentinfotable.studentID = paymentinfotable.memID INNER JOIN eventregistrationtable ON eventregistrationtable.eventID = paymentinfotable.eventID WHERE eventregistrationtable.eventStatus = 'ACTIVE';";
$result1 = mysqli_query($conn, $query1); 


$i = 1;
$max = 30;

while($row = mysqli_fetch_array($result1)) {
	$sID = $row['studentID'];
	$sName = $row['studentFname']. ' ' .$row['studentLname'];
	$eName = $row['eventName'];
	$sStart = $row['amountPayment'];
	$sEnd = $row['paymentStatus'];
	

	if (($i%$max) == 0) {
		$i = 1;
        $max = 30;
        $pdf->Ln(8);
        $pdf->SetFont('Times','I',7);
        $pdf->MultiCell(100, 20, 'more entries next page…', 0, '', 1, 0, 25, '', true, 0, false, true, 40, 'T');
        $pdf->AddPage();

		$pdf->Ln(30);
		$pdf->SetFont('helvetica','', 10, '', true);
		$pdf->SetFillColor(177, 220, 250);
		$pdf->Cell(30,5,' Student ID',0,0,'L',1);
		$pdf->Cell(50,5,' Student Name',0,0,'L',1);
		$pdf->Cell(45,5,' Event Name',0,0,'L',1);
		$pdf->Cell(35,5,' Amount Payment',0,0,'L',1);
		$pdf->Cell(25,5,' Status',0,0,'L',1);

	}
	$pdf->Ln(8);
	$pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Times','',9);
    $pdf->Cell(30,5,' '. $sID,0,0,'L',1);
    $pdf->Cell(50,5,' '. $sName,0,0,'L',1);
    $pdf->Cell(45,5,' '. $eName,0,0,'L',1);
    $pdf->Cell(35,5,' '. $sStart,0,0,'L',1);
    $pdf->Cell(25,5,' '. $sEnd,0,0,'L',1);
    $i++;
}









}
$pdf->Output('Daily Request.pdf', 'I');

