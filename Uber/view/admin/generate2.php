<?php
require('../../pdf/fpdf.php');
$conn = new mysqli('localhost', 'root', '', 'uber');
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}
$select = "select * FROM menu ORDER BY menuId";
$result = $conn->query($select);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(7,10,"ID",1);
$pdf->Cell(25,10,"marketID",1);
$pdf->Cell(30,10,"item",1);
$pdf->Cell(20,10,"price",1);
$pdf->Ln();
while($row = $result->fetch_object()){
  $menuId = $row->menuId;
  $marketId = $row->marketId;
  $item = $row->item;
  $price = $row->price;
  $pdf->Cell(7,10,$menuId,1);
  $pdf->Cell(25,10,$marketId,1);
  $pdf->Cell(30,10,$item,1);
  $pdf->Cell(20,10,$price,1);
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