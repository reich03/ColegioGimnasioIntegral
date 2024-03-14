<?php
class F_PDF extends FPDF
{

//Cabecera de p�gina
function Header()
{
	$empresa	=	new Empresa();
	$empresa_main		=	$empresa->find_first("estado = 'A'");
	if($empresa_main->logo!=""){
		$img = str_replace("%2F", "/", "public/img/$empresa_main->logo"); 
		$this->Image($img,150,5,50,10);
	}

	if($empresa_main->logo2!=""){
		$img = str_replace("%2F", "/", "public/img/$empresa_main->logo2"); 
		$this->Image($img,15,5,50,8);
	}
	$this->SetFont('Arial','',11);
	//$this->SetFont('Arial','',11);
    //Movernos a la derecha
    $this->Cell(55);
	$this->SetTextColor(0);
   // $this->Cell(20,5,'Programa de auditor�as: Centros de cultivos');
    //Salto de l�nea
    $this->Ln(3);
    $this->SetFont('Arial','',8);
    $this->SetX(0);
   	$this->SetTextColor( 13,176,255);
    $this->Cell(200,3,'____________________________________________________________________________________________________________________________________');
    $this->Ln();
}

//Pie de p�gina
function Footer()
{
	$empresa	=	new Empresa();
	$datos		=	$empresa->find_first("estado = 'A'");
    //Posici�n: a 1,5 cm del final
     $this->SetY(-15);
    $this->SetTextColor( 13,176,255);
    $this->SetX(0);
    $this->SetFont('Arial','',8);
     $this->Cell(200,3,'____________________________________________________________________________________________________________________________________');
     $this->Ln();
     $this->SetX(0);
     $this->SetFont('Arial','B',8);
     $this->SetFillColor(13, 176, 255);
     $this->SetTextColor(255,255,255); 
     $this->Cell(20,5,$this->PageNo(), 0, 0, 'R', 1);
     $this->SetFont('Arial','',8);
     $this->SetTextColor(0);
     $this->Cell(170,5,"$datos->direccion � Puerto Montt / Chile � Tel�fono $datos->telefono1 � $datos->observaciones",0,0,'C');

}
}
?>