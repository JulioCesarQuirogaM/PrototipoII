<?php
require('../fpdf.php');
require_once '../../Modelo/modeloUnidad.php';


class PDF extends FPDF
{
function Header()
{
    // Logo
    $this->Image('../logo.jpg',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',20);
	$this->SetTextColor(0,0,0);
    // Movernos a la derecha
    $this->Cell(40);
    // Título
    $this->Cell(150,10,'SISTEMA GESTION DE UNIDADES',0,0,'C');
    $this->Ln(20);
    //Subtitulo
    $this->Cell(100,5,'Reporte Unidades',0,0,'L');
    // Salto de línea
    $this->Ln(10);
	$this->SetFont('Arial','',14);
}

// Cargar los datos
function cargarDatos()
{
    // Leer las líneas del fichero
   $apartamento = new Unidad();
$listado = $apartamento->listaUnidad();
return $listado;
}



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
    $w = array(40,40,40,40,40,40);
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
        $this->Cell($w[0],7,utf8_decode($row['unidadres_ID']),'LR',0,'L',$fill);
        $this->Cell($w[1],7,utf8_decode($row['ciudad_Nomb']),'LR',0,'L',$fill);
        $this->Cell($w[2],7,utf8_decode($row['unidadres_Nomb']),'LR',0,'L',$fill);
		$this->Cell($w[3],7,utf8_decode($row['unidadres_Dir']),'LR',0,'L',$fill);
        $this->Cell($w[4],7,utf8_decode($row['unidadres_Tel']),'LR',0,'L',$fill);
        $this->Cell($w[4],7,utf8_decode($row['estado']),'LR',0,'L',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
}


$pdf = new PDF('L','mm','A4');
// Títulos de las columnas
$titulos = array('Codigo', 'Ciudad', 'Residencia', 'Direccion','Telefono','estado');
// Carga de datos
         
$datos = $pdf->cargarDatos();
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
//$pdf->TablaBasica($titulos,$datos);

//$pdf->TablaMejorada($titulos,$datos);

$pdf->TablaElegante($titulos,$datos);
$pdf->Output();
?>