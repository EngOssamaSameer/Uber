<?php
require('../../pdf/fpdf.php');
$conn = new mysqli('localhost', 'root', '', 'uber');
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}
$select = "select * FROM rents ORDER BY rentId";
$result = $conn->query($select);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(7,10,"ID",1);
$pdf->Cell(15,10,"Price",1);
$pdf->Cell(15,10,"KindID",1);
$pdf->Cell(15,10,"CaseID",1);
$pdf->Cell(35,10,"userName",1);
$pdf->Cell(65,10,"userEmail",1);
$pdf->Cell(15,10,"userId",1);
$pdf->Ln();
while($row = $result->fetch_object()){
  $rentId = $row->rentId;
  $rentPrice = $row->rentPrice;
  $rentKind = $row->rentKind;
  $rentCase = $row->rentCase;
  $rentUserName = $row->rentUserName;
  $rentUserEmail = $row->rentUserEmail;
  $userId = $row->userId;
  $pdf->Cell(7,10,$rentId,1);
  $pdf->Cell(15,10,$rentPrice,1);
  $pdf->Cell(15,10,$rentKind,1);
  $pdf->Cell(15,10,$rentCase,1);
  $pdf->Cell(35,10,$rentUserName,1);
  $pdf->Cell(65,10,$rentUserEmail,1);
  $pdf->Cell(15,10,$userId,1);
  $pdf->Ln();
}
$pdf->Cell(100,10,"Kind 1 refer Car , 2 refer Moto  , and 3 refer Bike",1);
$pdf->Ln();
$pdf->Cell(100,10,"Case 0 refer unrented , and 1 refer rented  ",1);
$pdf->Ln();
$pdf->Cell(100,10,"null in username , email ,and userId refer unrented",1);
$pdf->Ln();
$pdf->Output();
?>
<div class="container" style="padding-top:50px;" >

<form class="form-inline" action="generate.php"method="post" >
<button type="button" class="btn btn-primary" ><i class="fa fa-pdf"  aria-hidden="true"></i><a href="../admin/generate.php">
Generate</button>
</form>
</div>