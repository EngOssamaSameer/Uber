<?php
require('../../pdf/fpdf.php');
$conn = new mysqli('localhost', 'root', '', 'uber');
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}
$select = "select * FROM user ORDER BY userId";
$result = $conn->query($select);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(7,10,"ID",1);
$pdf->Cell(40,10,"Name",1);
$pdf->Cell(70,10,"Email",1);
$pdf->Cell(50,10,"Phone",1);
$pdf->Cell(10,10,"Role",1);
$pdf->Ln();
while($row = $result->fetch_object()){
  $userId = $row->userId;
  $userName = $row->userName;
  $userEmail = $row->userEmail;
  $userPhone = $row->userPhone;
  $userRoleId = $row->userRoleId;
  $pdf->Cell(7,10,$userId,1);
  $pdf->Cell(40,10,$userName,1);
  $pdf->Cell(70,10,$userEmail,1);
  $pdf->Cell(50,10,$userPhone,1);
  $pdf->Cell(10,10,$userRoleId,1);
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