<?php
require('../../pdf/fpdf.php');
$conn = new mysqli('localhost', 'root', '', 'uber');
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}
$select = "select * FROM market ORDER BY marketId";
$result = $conn->query($select);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(7,10,"ID",1);
$pdf->Cell(40,10,"Name",1);
$pdf->Ln();
while($row = $result->fetch_object()){
  $marketId = $row->marketId;
  $marketName = $row->marketName;
  $pdf->Cell(7,10,$marketId,1);
  $pdf->Cell(40,10,$marketName,1);
  $pdf->Ln();
}
$pdf->Output();
?>
<div class="container" style="padding-top:50px;" >

<form class="form-inline" action="generate.php"method="post" >
<button type="button" class="btn btn-primary" ><i class="fa fa-pdf"  aria-hidden="true"></i><a href="../admin/generate.php">
Generate</button>
</form>
</div>