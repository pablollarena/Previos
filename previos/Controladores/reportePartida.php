<?php
include_once ("../pdf/fpdf.php");
include_once ("../Modelos/ReportePrevio.php");
include_once ("../TCPDF/");
include_once ("../Modelos/Persona.php");
include_once ("../Modelos/SobrantesPartida.php");
session_start();
$oRep = new ReportePrevio();
$oSob = new SobrantesPartida();
$sUser = new Persona();
$sRef = $_POST['txtRef'];
$sUser = $_SESSION['sUser'];
$oRep->setSir60(new Sir60Referencias());
$oSob->setReferencia60(new Sir60Referencias());
$oRep->getSir60()->setReferencia($sRef);
$oSob->getReferencia60()->setReferencia($sRef);


$arrPartidas = $oRep->buscarReporteReferencia();
$arrSobrantes = $oSob->buscarObservaciones();

class PDF extends  FPDF{

function ImprovedTabla($header,$header2,$data,$data2){
$w = array(1.5,0.8,1.3,1.3,1.3,1.3,1.3,1.5,1.5,1.5,2,2,9);
$x = array(3,23.3);
//for ($i = 0;$i<count($header);$i++)
//$this->Cell($w[$i],0.8, $header[$i],1,0,'C');

//$this->Ln();
foreach ($data as $row){
    for ($i = 0;$i<count($header);$i++)
        $this->Cell($w[$i],0.8, $header[$i],1,0,'C');

    $this->Ln();
    $this->Cell($w[0],0.7,$row->getSir52()->getNumero(),1,0,'LR');
    $this->Cell($w[1],0.7,$row->getSir52()->getItem(),1,0,'LR');
    $this->Cell($w[2],0.7,$row->getCant(),1,0,'LR');
    $this->Cell($w[3],0.7,$row->getCompleta() == 1 ? 'X' : '',1,0,'LR');
    $this->Cell($w[4],0.7,$row->getFaltante() == 1 ? 'X' : '',1,0,'LR');
    $this->Cell($w[5],0.7,$row->getSobrante() == 1 ? 'X' : '',1,0,'LR');
    $this->Cell($w[6],0.7,$row->getCantidadSobrante() == 1 ? 'X' : '',1,0,'LR');
    $this->Cell($w[7],0.7,$row->getPieza() == 1 ? 'X' : '',1,0,'LR');
    $this->Cell($w[8],0.7,$row->getJuego() == 1 ? 'X' : '',1,0,'LR');
    $this->Cell($w[9],0.7,$row->getOtro() == 1 ? 'X' : '',1,0,'LR');
    $this->Cell($w[10],0.7,utf8_decode($row->getOrigen()),1,0,'LR');
    $this->Cell($w[11],0.7,$row->getPesoAprox(),1,0,'LR');
    $this->MultiCell($w[12],0.3,$row->getObservaciones(),1,1);
    $this->Ln();
    $this->Ln();
    $this->Ln();
    }
//$this->Cell(array_sum($w),0,'','T');

    $this->Ln();
    $this->Ln();
    $this->Ln();
    $this->Ln();

    foreach ($data2 as $vrow)
    {
        for ($j = 0; $j<count($header2);$j++)
            $this->Cell($x[$j],0.8,$header2[$j],1,0,'C');

        $this->Ln();
        $this->Cell($x[0],0.7,$vrow->getNumItem(),1,0,'LR');
        $this->MultiCell($x[1],0.3,$vrow->getObservaciones(),1,1);
        $this->Ln();
        $this->Ln();
    }

}




    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-6);
        // Select Arial italic 8
        $this->SetFont('Arial','I',8);
        // Print current and total page numbers
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }

}


$pdf = new PDF('L', 'cm', 'Letter');

$header = array('Factura','Item','Cant.','COMP','FALT','SOBR','CANTSO','PZA','JGO','OTRO','Origen','Peso Kg.','Observaciones');
$header2 = array('Numero de Item','Observaciones de Partidas Sobrantes');
$data = $arrPartidas;
$data2 = $arrSobrantes;
$pdf->SetFont('Arial','',6.5);
$pdf->AddPage();
$pdf->Image('../images/trimex.png', 0, 0, 5, 0, 'PNG');
$pdf->Cell(0,1,'Reporte de Previo por Facturas y Partidas de la Referencia '.$sRef.'. Reconocedor: '.$sUser->getNomCompleto(),0,1,'C');
$pdf->ImprovedTabla($header,$header2,$data,$data2);
$pdf->Ln();
$pdf->AliasNbPages();
$pdf->Output();
?>