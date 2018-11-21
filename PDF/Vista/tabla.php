<?php
require('../fpdf.php');

class PDF extends FPDF
{
function Header()
{
    // Logo
    $this->Image('../logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
	$this->SetTextColor(255,0,0);
    // Movernos a la derecha
    $this->Cell(40);
    // Título
    $this->Cell(100,5,'Centro Colombiano De Estudios Profesionales',0,0,'L');
    // Salto de línea
    $this->Ln(20);
	$this->SetFont('Arial','',14);
}

// Cargar los datos
function cargarDatos($file)
{
    // Leer las líneas del fichero
    $archivo = file($file);
    $datos = array();
    foreach($archivo as $linea)
        $datos[] = explode(';',trim($linea));
    return $datos;
}

// Tabla simple
/*function TablaBasica($titulos, $datos)
{
	$this->SetFont('','',10);
	$this->SetTextColor(0,0,0);
    // Cabecera de titulos
    foreach($titulos as $col)
        $this->Cell(35,7,$col,1);
    $this->Ln();
    
    // Datos
    foreach($datos as $row)
    {
        foreach($row as $col)
            $this->Cell(35,6,$col,1);
        $this->Ln();
    }
}*/

// Una tabla mejorada
/*function TablaMejorada($titulos, $datos)
{
    // Ancho de las columnas
    $w = array(35,60, 60, 35);
	$this->SetFont('','B',14);
    // Cabeceras de titulos
    for($i=0;$i<count($titulos);$i++)
        $this->Cell($w[$i],7,$titulos[$i],1,0,'C');
    $this->Ln();
	 $this->SetFont('','',10);
    // Datos
    foreach($datos as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
        $this->Ln();
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}*/

// Tabla Elegante
function TablaElegante($titulos, $datos)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.4);
    $this->SetFont('','B',14);
    // Cabecera de titulos
    $w = array(25,80, 60, 25);
    for($i=0;$i<count($titulos);$i++)
        $this->Cell($w[$i],7,$titulos[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('','',10);
    // Datos
    $fill = true;
    foreach($datos as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
		$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
}


$pdf = new PDF();
// Títulos de las columnas
$titulos = array('Pais', 'Capital', 'Superficie', 'Habitantes');
// Carga de datos
$datos = $pdf->cargarDatos('../paises.txt');
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
//$pdf->TablaBasica($titulos,$datos);

//$pdf->TablaMejorada($titulos,$datos);

$pdf->TablaElegante($titulos,$datos);
$pdf->Output();
?>