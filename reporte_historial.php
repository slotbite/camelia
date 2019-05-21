<?php

require('fpdf/fpdf.php');
require('conexion.php');
class PDF extends FPDF
{
var $widths;
var $aligns;

function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		
		$this->Rect($x,$y,$w,$h);

//		$this->MultiCell($w,5,$data[$i],0,$a,'true');
		$this->MultiCell($w,5,$data[$i],0,$a);

		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}

function Header()
{

	$this->SetFont('Arial','',16);
	$this->Text(20,14,'CAMELIA CUEROS',0,'C', 0);
	$this->Ln(10);
	$this->SetFont('Arial','',16);
    $this->Cell(0,6,"INFORME DE PROVEEDORES",0,1,'C');
	$this->Ln(10);
    $this->SetFont('Arial','',10);
    $this->Text(20,44,"Fecha: ".date("d/m/Y"). "   Hora: ".date("H:i:s"),0,1);

}

function Footer()
{
/*
	$this->SetY(-15);
	$this->SetFont('Arial','B',8);
	$this->Cell(100,10,'Historial medico',0,0,'L');
*/
}

}

//	$paciente= $_GET['id'];
	$con = new DB;
/*	
	$pacientes = $con->conectar();	
	
	$strConsulta = "SELECT * from pacientes where id_paciente =  '$paciente'";
	
	$pacientes = mysql_query($strConsulta);
	
	$fila = mysql_fetch_array($pacientes);
*/
	$pdf=new PDF('L','mm','Letter');
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(20,20,20);
	$pdf->Ln(10);
/*
    $pdf->SetFont('Arial','',16);
    $pdf->Cell(0,6,"INFORME DE PROVEEDORES",0,1,'C');
	$pdf->Ln(10);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(0,6,"Fecha: ".date("d/m/Y"). "   Hora: ".date("H:i:s"),0,1);
*/
	
	$pdf->Ln(5);
	
	$pdf->SetWidths(array(10, 20, 55, 40, 20,20,20,20,20,20));
	$pdf->SetFont('Arial','B',10);
//	$pdf->SetFillColor(85,107,47);
//    $pdf->SetTextColor(255);
    $pdf->SetTextColor(0);

		for($i=0;$i<1;$i++)
			{
				$pdf->Row(array('COD','RUT','RAZON SOCIAL','NOMBRE FANTASIA','DIRECCION','COMUNA','CIUDAD','FONO','FAX','VENDEDOR'));
			}
	
	$historial = $con->conectar();	
/*
	$strConsulta = "SELECT consultas_medicas.fecha_consulta, consultas_medicas.consultorio, consultas_medicas.diagnostico, medicos.nombre_medico 
	FROM consultas_medicas 
	Inner Join pacientes ON consultas_medicas.id_paciente = pacientes.id_paciente 
	Inner Join medicos ON consultas_medicas.id_medico = medicos.id_medico
	WHERE pacientes.id_paciente = '$paciente'";
*/
	$strConsulta = "Select pro_rutpro,pro_nomfa,pro_rasoc,pro_codpro,pro_direcc,pro_comuna,pro_ciudad,pro_fono,pro_fax,pro_vendedor From cam_proveedores
           Order By pro_codpro"; 
	
	$historial = mysql_query($strConsulta);
	$numfilas = mysql_num_rows($historial);
	
	for ($i=0; $i<$numfilas; $i++)
		{
			$fila = mysql_fetch_array($historial);
			$pdf->SetFont('Arial','',8);
			
			if($i%2 == 1)
			{
//				$pdf->SetFillColor(153,255,153);
    			$pdf->SetTextColor(0);
				$pdf->Row(array($fila['pro_codpro'], $fila['pro_rutpro'], $fila['pro_rasoc'], $fila['pro_nomfa'], $fila['pro_direcc'], $fila['pro_comuna'], $fila['pro_ciudad'], $fila['pro_fono'], $fila['pro_fax'], $fila['pro_vendedor']));
			}
			else
			{
//				$pdf->SetFillColor(102,204,51);
    			$pdf->SetTextColor(0);
//				$pdf->Row(array($fila['fecha_consulta'], $fila['nombre_medico'], $fila['consultorio'], $fila['diagnostico']));
				$pdf->Row(array($fila['pro_codpro'], $fila['pro_rutpro'], $fila['pro_rasoc'], $fila['pro_nomfa'], $fila['pro_direcc'], $fila['pro_comuna'], $fila['pro_ciudad'], $fila['pro_fono'], $fila['pro_fax'], $fila['pro_vendedor']));

			}
		}

$pdf->Output();
?>