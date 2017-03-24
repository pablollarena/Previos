<?php
/**
 * Created by PhpStorm.
 * User: SISTEMAS-PABLO
 * Date: 17/03/2017
 * Time: 02:43 PM
 */
include_once ("../pdf/fpdf.php");
include_once ("../Modelos/Sir76Contenedores.php");
$oRep = new Sir76Contenedores();
$sRef = $_POST['txtRef'];
$oRep->setReferencia60(new Sir60Referencias());
$oRep->getReferencia60()->setReferencia($sRef);

$arrRef = $oRep->buscarContenedoresPorRef2();
class PDF extends FPDF{
    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-6);
        // Select Arial italic 8
        $this->SetFont('Arial','I',8);
        // Print current and total page numbers
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }

    function ImprovedTabla($header,$header2,$header3,$header4,$data){
        $w = array(2,1,1,1.5,1,1.5,1.5,1,1.3,1.3,1.3,1.3,1,1,1);
        $x = array(1,1,1.2,1,1,1,1,1,10.5);
        $y = array(1.2,1.2,1.1,1.2,1.1,1.2,1.2,1.2,1.2,1.1,1.2,1.2,1.2,1.2,1.1,1.1);
        $z = array(1.2,1,1,1,1,0.8,1,1,1.5,9.2);

        foreach ($data as $vRow){
            $this->Cell(0,0.7,'---------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'C');
            $this->Ln();
            for ($i = 0;$i<count($header);$i++)
                $this->Cell($w[$i],0.8, utf8_decode($header[$i]),1,0,'C');

            $this->Ln();
                $this->Cell($w[0],0.7,$vRow->getConten()->getNumeroContenedor(),1,0,'C');
                $this->Cell($w[1],0.7,$vRow->getConten()->getIMO() == 1 ? 'SI' : 'NO',1,0,'LR');
                $this->Cell($w[2],0.7,$vRow->getConten()->getTamaño(),1,0,'LR');
                $this->Cell($w[3],0.7,$vRow->getConten()->getPeso(),1,0,'LR');
                $this->Cell($w[4],0.7,$vRow->getConten()->getTipo(),1,0,'LR');
                $this->Cell($w[5],0.7,$vRow->getConten()->getSelloOrigen(),1,0,'LR');
                $this->Cell($w[6],0.7,$vRow->getConten()->getSelloColocado(),1,0,'LR');
                $this->Cell($w[7],0.7,$vRow->getConten()->getPesoCarga(),1,0,'LR');
                $this->Cell($w[8],0.7,$vRow->getConten()->getCantidadBultos(),1,0,'LR');
                $this->Cell($w[9],0.7,$vRow->getConten()->getBultosDañados(),1,0,'LR');
                $this->Cell($w[10],0.7,$vRow->getConten()->getCantBultDañados(),1,0,'LR');
                $this->Cell($w[11],0.7,$vRow->getConten()->getPalletsMadera() == 1 ? 'X': '',1,0,'LR');
                $this->Cell($w[12],0.7,$vRow->getConten()->getSacos() == 1 ? 'X': '',1,0,'LR');
                $this->Cell($w[13],0.7,$vRow->getConten()->getHuacalesMadera() == 1 ? 'X': '',1,0,'LR');
                $this->Cell($w[14],0.7,$vRow->getConten()->getPalletsPlastico() == 1 ? 'X': '',1,0,'LR');


            $this->Ln();
                $this->Ln();
            for ($j = 0;$j<count($header2);$j++)
                $this->Cell($x[$j],0.8, utf8_decode($header2[$j]),1,0,'C');

                $this->Ln();
            $this->Cell($x[0],0.7,$vRow->getConten()->getSuperBolsas() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($x[1],0.7,$vRow->getConten()->getCajasMadera() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($x[2],0.7,$vRow->getConten()->getCartonada() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($x[3],0.7,$vRow->getConten()->getBidones() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($x[4],0.7,$vRow->getConten()->getRacksMetalicos() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($x[5],0.7,$vRow->getConten()->getCuñetes() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($x[6],0.7,$vRow->getConten()->getCont1000L() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($x[7],0.7,$vRow->getConten()->getGranel() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($x[8],0.7,$vRow->getConten()->getOtros(),1,1);


            $this->Ln();

            for ($k = 0;$k<count($header3);$k++)
                $this->Cell($y[$k],0.8, utf8_decode($header3[$k]),1,0,'C');

            $this->Ln();
            $this->Cell($y[0],0.7,$vRow->getConten()->getAveriasOrigen() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($y[1],0.7,$vRow->getConten()->getAveriasRecinto() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($y[2],0.7,$vRow->getConten()->getFumigado(),1,0,'LR');
            $this->Cell($y[3],0.7,$vRow->getConten()->getRecintoPrevio(),1,0,'LR');
            $this->Cell($y[4],0.7,$vRow->getDaño()->getOrigen()== 1 ? 'X': '',1,0,'LR');
            $this->Cell($y[5],0.7,$vRow->getDaño()->getRecinto() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($y[6],0.7,$vRow->getDaño()->getFrente() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($y[7],0.7,$vRow->getDaño()->getPanelIzq() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($y[8],0.7,$vRow->getDaño()->getPiso() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($y[9],0.7,$vRow->getDaño()->getTecho() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($y[10],0.7,$vRow->getDaño()->getPanelDer() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($y[11],0.7,$vRow->getDaño()->getPuertas() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($y[12],0.7,$vRow->getDaño()->getBarrasPuerta() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($y[13],0.7,$vRow->getDaño()->getSeguros() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($y[14],0.7,$vRow->getDaño()->getAbrazaderas() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($y[15],0.7,$vRow->getDaño()->getLonasBarras() == 1 ? 'X': '',1,0,'LR');
            $this->Ln();
            $this->Ln();

            for ($l = 0;$l<count($header4);$l++)
                $this->Cell($z[$l],0.8, utf8_decode($header4[$l]),1,0,'C');

            $this->Ln();

            $this->Cell($z[0],0.7,$vRow->getMercancia()->getConformeFactura() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($z[1],0.7,$vRow->getMercancia()->getFaltante() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($z[2],0.7,$vRow->getMercancia()->getSobrante() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($z[3],0.7,$vRow->getMercancia()->getCantidad(),1,0,'LR');
            $this->Cell($z[4],0.7,$vRow->getPrevio()->getDesYCon() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($z[5],0.7,$vRow->getPrevio()->getOcular() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($z[6],0.7,$vRow->getPrevio()->getEtiquetado() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($z[7],0.7,$vRow->getPrevio()->getSeparacion() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($z[8],0.7,$vRow->getPrevio()->getRevConAutoridad() == 1 ? 'X': '',1,0,'LR');
            $this->Cell($z[9],0.7,utf8_decode($vRow->getDaño()->getOtros()),1,0,'LR');
            $this->Ln();



            $this->Ln();

        }
        }

}

$pdf = new PDF('P', 'cm', 'Letter');
$header = array('# Contenedor','IMO','Tam','Peso','Tipo','SOrigen','SColocado','PCarga','CantBultos','BDañados','CDañados','PMadera','Sacos','HMadera','PPlastico');
$header2 = array('SBolsas','CMadera','Cartonada','Bidones','RMetal','Cuñetes','C1000L','Granel','Otras Presentaciones');
$header3 = array('AOrigen','ARecinto','Fumi','RPrevio','DOrigen','DRecinto','DFrente','DIzq','DPiso','DTecho','DDer','DPuertas','DBPuertas','DSeguros','DAbraza','DLBarras');
$header4 = array('MCFactura','MFalt','MSobr','MCant','PDyC','POcu','PEtiq','PSep','PRevCAuto','Otros Daños');
$pdf->SetFont('Arial','',6.5);
$pdf->AddPage();
$pdf->Image('../images/trimex.png', 0, 0, 5, 0, 'PNG');
$pdf->Cell(0,1,'Reporte de Reconocimiento de Previo de la Referencia '.$sRef,0,1,'C');
$data = $arrRef;
$pdf->ImprovedTabla($header,$header2, $header3,$header4,$data);
$pdf->AliasNbPages();
$pdf->Output();
?>