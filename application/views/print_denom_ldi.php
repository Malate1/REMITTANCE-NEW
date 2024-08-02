<?php
    require('fpdf/fpdf.php');

    class PDF extends FPDF
    {
        
    }

    $pdf = new PDF();
    $pdf->SetTopMargin(10);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->AddPage("P","Letter");
    $pdf->SetFont('Times','',8);
    $x = 0;

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190,-5,$this->session->userdata('location') . " - Sales Remittance Report",0,1,'C');

    if($result->remarks==""){
        $sm = $result->full_name;
    }else{
        $sm = $result->full_name."/".$result->remarks;
    }

    $pdf->SetFont('Arial','B',11);
    $pdf->Ln('8');
    $pdf->Cell(50,5,"Sales Representative : ",0,1,'C');
    $pdf->setx('55');
    $pdf->Cell(140,-5,$sm,0,1,'L');

    $pdf->Cell(320,5,"No. :",0,1,'C');
    $pdf->setx('175');
    $pdf->Cell(350,-5,$result->denom_id,0,1,'L');

    $pdf->SetFont('Arial','B',11);
    $pdf->Ln('5');
    $pdf->Cell(20,5,"Date : ",0,1,'C');
    $pdf->setx('25');
    $pdf->Cell(70,-5,date("F d, Y",strtotime($result->date_added)),0,1,'L');

    $pdf->SetFont('Arial','B',11);
    $pdf->Ln('0');
    $pdf->Cell(61,25,"COLLECTION BREAKDOWN",0,1,'C');

    $pdf->setx('125');
    $pdf->Cell(290,-25,"Total Accountability :",0,1,'L');
    $pdf->setx('170');
    $pdf->Cell(348,25,number_format($result->total_remittance,2),0,1,'L');

    $deduct = $result->vat + $result->bo;

    $total_amount = $result->total_returns + $result->total_collection - $deduct;

    $rem_amt = $total_amount-$result->total_remittance;

    if($result->total_remittance<$total_amount){
        $rem = 'Over ('.number_format($rem_amt,2).')';
    }elseif($result->total_remittance>$total_amount){
        $rem = 'Short ('.number_format($rem_amt,2).')';
    }else{
        $rem = 'None';
    }

    if($result->total_returns=="0.00"){
        $ret = 'None';
    }else{
        $ret = number_format($result->total_returns,2);
    }

    $pdf->SetFont('Arial','B',11);
    $pdf->Ln('1');
    $pdf->Cell(27,-10,"Returns : ",0,1,'R');
    $pdf->setx('35');
    $pdf->Cell(90,10,$ret,0,1,'L');

    $pdf->SetFont('Arial','B',11);
    $pdf->Ln('0');
    $pdf->Cell(290,-10,"Remarks : ",0,1,'C');
    $pdf->setx('165');
    $pdf->Cell(340,10,$rem,0,1,'L');

    $pdf->Ln('-2');
    $pdf->SetFillColor(220,220,220);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B');

    $pdf->setx('15');
    $pdf->Cell(50,7,'Notes',1,0,'C',true);
    $pdf->Cell(60,7,'Quantity',1,0,'C',true);
    $pdf->Cell(69,7,'Amount',1,0,'C',true);

    $pdf->Ln('7');
    $pdf->setx('15');
    $pdf->Cell(50,5,"1,000",1,0,'C');
    $pdf->Cell(60,5,$result->qty_1000,1,0,'C');
    $pdf->Cell(69,5,number_format($result->amt_1000,2),1,0,'R');

    $pdf->Ln('5');
    $pdf->setx('15');
    $pdf->Cell(50,5,"500",1,0,'C');
    $pdf->Cell(60,5,$result->qty_500,1,0,'C');
    $pdf->Cell(69,5,number_format($result->amt_500,2),1,0,'R');

    $pdf->Ln('5');
    $pdf->setx('15');
    $pdf->Cell(50,5,"200",1,0,'C');
    $pdf->Cell(60,5,$result->qty_200,1,0,'C');
    $pdf->Cell(69,5,number_format($result->amt_200,2),1,0,'R');

    $pdf->Ln('5');
    $pdf->setx('15');
    $pdf->Cell(50,5,"100",1,0,'C');
    $pdf->Cell(60,5,$result->qty_100,1,0,'C');
    $pdf->Cell(69,5,number_format($result->amt_100,2),1,0,'R');

    $pdf->Ln('5');
    $pdf->setx('15');
    $pdf->Cell(50,5,"50",1,0,'C');
    $pdf->Cell(60,5,$result->qty_50,1,0,'C');
    $pdf->Cell(69,5,number_format($result->amt_50,2),1,0,'R');

    $pdf->Ln('5');
    $pdf->setx('15');
    $pdf->Cell(50,5,"20",1,0,'C');
    $pdf->Cell(60,5,$result->qty_20,1,0,'C');
    $pdf->Cell(69,5,number_format($result->amt_20,2),1,0,'R');

    $pdf->Ln('5');
    $pdf->setx('15');
    $pdf->Cell(50,5,"Total Coins",1,0,'C');
    $pdf->Cell(60,5,"",1,0,'C');
    $pdf->Cell(69,5,number_format($result->total_coins,2),1,0,'R');

    $pdf->Ln('5');
    $pdf->setx('15');
    $pdf->Cell(50,5,"Total Cash",1,0,'C');
    $pdf->Cell(60,5,"",1,0,'C');
    $pdf->Cell(69,5,number_format($result->total_cash,2),1,0,'R');

    $pdf->Ln('5');
    $pdf->setx('15');
    $pdf->Cell(50,5,"Total Returns",1,0,'C');
    $pdf->Cell(60,5,"",1,0,'C');
    $pdf->Cell(69,5,number_format($result->total_returns,2),1,0,'R');

    $pdf->Ln('5');
    $pdf->setx('15');
    $pdf->Cell(50,5,"Total W/Tax",1,0,'C');
    $pdf->Cell(60,5,"",1,0,'C');
    $pdf->Cell(69,5,number_format($result->vat,2),1,0,'R');

    $pdf->Ln('5');
    $pdf->setx('15');
    $pdf->Cell(50,5,"Total B.O",1,0,'C');
    $pdf->Cell(60,5,"",1,0,'C');
    $pdf->Cell(69,5,number_format($result->bo,2),1,0,'R');

    $pdf->Ln('5');
    $pdf->setx('15');
    $pdf->Cell(50,5,"Total PDC   ",1,0,'C');
    $pdf->Cell(60,5,$result->pdc_pcs.' pc(s).',1,0,'C');
    $pdf->Cell(69,5,number_format($result->total_pdc,2),1,0,'R');

    $pdf->Ln('5');
    $pdf->setx('15');
    $pdf->Cell(50,5,"Total DC   ",1,0,'C');
    $pdf->Cell(60,5,$result->dc_pcs.' pc(s).',1,0,'C');
    $pdf->Cell(69,5,number_format($result->total_dc,2),1,0,'R');

    $pdf->Ln('5');
    $pdf->setx('15');
    $pdf->Cell(179,5,"Total Remittance :   ".number_format($result->total_collection,2),1,0,'R');

    $pdf->SetFont('Arial','B',10);
    $pdf->Ln('8');
    $pdf->Cell(60,5,"Remitted by:",0,1,'C');
    $pdf->Cell(180,-5,"Checked by:",0,1,'C');
    $pdf->Cell(290,5,"Received by:",0,1,'C');

    $pdf->SetFont('Arial','U',10);
    $pdf->Ln('6');
    $pdf->setx('29');
    $pdf->Cell(60,5,$result->full_name."          ",0,1,'L');
    $pdf->setx('89');
    $pdf->Cell(180,-5,$this->session->userdata('full_name')."          ",0,1,'L');
    $pdf->setx('144');
    $pdf->Cell(290,5,"                                     ",0,1,'L');

    $pdf->SetFont('Arial','',8);
    $pdf->Ln('-1');
    $pdf->Cell(60,5,"Name/Signature",0,1,'C');
    $pdf->Cell(180,-5,"Name/Signature",0,1,'C');
    $pdf->Cell(290,5,"Name/Signature",0,1,'C');

    $pdf->Output();
?>