<?php
    require('fpdf/fpdf.php');

    class PDF extends FPDF
    {
        
    }

    $pdf = new PDF();
    $pdf->SetTopMargin(10);
    $pdf->SetAutoPageBreak(TRUE, 15);
    $pdf->AddPage("L","Letter");
    $pdf->SetFont('Times','',8);
    $x = 0;

    $pdf->SetFont('Arial','B',12);
    //$pdf->Cell(250,-5,strtoupper($result3->bu_desc),0,1,'C');
    $pdf->Cell(250,15,"COLLECTION SUMMARY REPORT",0,1,'C');
    if (empty($dateto)) {
        $pdf->Cell(250, -4, "DATE: " . date("F d, Y", strtotime($result)), 0, 1, 'C');
    } else {
        $pdf->Cell(250, -4, "DATE: " . date("F d, Y", strtotime($result)) . " - " . date("F d, Y", strtotime($dateto)), 0, 1, 'C');
    }
    
    

    

    $pdf->Ln('8');
    $pdf->SetFillColor(220,220,220);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B');

    $pdf->SetFont('Arial','B',10);
    $pdf->setx('5');
    $pdf->Cell(35,14,'Salesman',1,0,'C',true);
    $pdf->Cell(25,14,'SRR No.',1,0,'C',true);
    $pdf->Cell(90,7,'Cash Breakdown',1,0,'C',true);
    $pdf->Ln('7');
    $pdf->setx('65');
    $pdf->Cell(15,7,'1000',1,0,'C',true);
    $pdf->Cell(15,7,'500',1,0,'C',true);
    $pdf->Cell(15,7,'200',1,0,'C',true);
    $pdf->Cell(15,7,'100',1,0,'C',true);
    $pdf->Cell(15,7,'50',1,0,'C',true);
    $pdf->Cell(15,7,'20',1,0,'C',true);
    
    $pdf->Ln('-7');
    $pdf->setx('155');
    $pdf->Cell(24,14,'Total Bills',1,0,'C',true);
    $pdf->Cell(24,14,'PDC',1,0,'C',true);
    $pdf->Cell(24,14,'DC',1,0,'C',true);
    $pdf->Cell(17,14,'Coins',1,0,'C',true);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(27,14,'Grand Total',1,0,'C',true);

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','',10);

    $flag = 0;
    $prevBu = null;
    $buCounter = []; 
    $sum_qty_1000 = array();
    $sum_qty_500 = array();
    $sum_qty_200 = array();
    $sum_qty_100 = array();
    $sum_qty_50 = array();
    $sum_qty_20 = array();
    $sum_total_bill = array();
    $sum_total_pdc = array();
    $sum_total_dc = array();
    $sum_total_coins = array();
    $sum_total_collection = array();
    foreach($result1 as $row) {
        if($flag==0){
            $pdf->Ln('14');
            $flag = 1;
        }else{
            $pdf->Ln('8');
        }
        if($row->remarks==""){
            $sm = @$row->last_name;
        }else{
            $rem = explode(" ", $row->remarks);
            $sm = @$row->last_name;
        }

        // Map CVS and 3PS results to respective bu's
        if ($row->bu == 'CVS') {
            $row->bu = 'XTRUCK-NETMAN';
        } elseif ($row->bu == '3PS') {
            $row->bu = 'XTRUCK';
        }

        if(!isset($sum_qty_1000[$row->bu])) {
            $sum_qty_1000[$row->bu] = 0;
            $sum_qty_500[$row->bu] = 0;
            $sum_qty_200[$row->bu] = 0;
            $sum_qty_100[$row->bu] = 0;
            $sum_qty_50[$row->bu] = 0;
            $sum_qty_20[$row->bu] = 0;
            $sum_total_bill[$row->bu] = 0;
            $sum_total_pdc[$row->bu] = 0;
            $sum_total_dc[$row->bu] = 0;
            $sum_total_coins[$row->bu] = 0;
            $sum_total_collection[$row->bu] = 0;

            $buCounter[$row->bu] = 1; // Start counter for this BU
        } else {
            $buCounter[$row->bu]++; // Increment counter for this BU
        }

        $sum_qty_1000[$row->bu] += $row->qty_1000;
        $sum_qty_500[$row->bu] += $row->qty_500;
        $sum_qty_200[$row->bu] += $row->qty_200;
        $sum_qty_100[$row->bu] += $row->qty_100;
        $sum_qty_50[$row->bu] += $row->qty_50;
        $sum_qty_20[$row->bu] += $row->qty_20;
        $sum_total_bill[$row->bu] += $row->total_bill;
        $sum_total_pdc[$row->bu] += $row->total_pdc;
        $sum_total_dc[$row->bu] += $row->total_dc;
        $sum_total_coins[$row->bu] += $row->total_coins;
        $sum_total_collection[$row->bu] += $row->total_collection + $row->total_palawan;

       

        if($row->bu != $prevBu) {

            if($prevBu !== null) {
            printSubtotal($pdf, $prevBu, $sum_qty_1000, $sum_qty_500, $sum_qty_200, $sum_qty_100, $sum_qty_50, $sum_qty_20, $sum_total_bill, $sum_total_pdc, $sum_total_dc, $sum_total_coins, $sum_total_collection);
        }

            if($row->bu == 'XTRUCK-NETMAN') {
                $bu_name = 'XTRUCK-NETMAN-PNB';
            }elseif($row->bu == 'XTRUCK'){
                $bu_name = 'XTRUCK-LDI';
            }else{
                $bu_name = $row->bu;
            }
            $pdf->setx('5');
            $pdf->SetFont('Arial','B',10);

            $pdf->Cell(266,8,$bu_name,1,0,'L',true);
            $pdf->Ln('8');
            $pdf->SetFillColor(255,255,255);
            
            
            
            $prevBu = $row->bu;
        }

       
        $smWithCounter = $buCounter[$row->bu] . ". " . utf8_decode($sm);

        $pdf->setx('5');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(35, 8, $smWithCounter, 1, 0, 'L', true);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(25,8,@$row->manualsrr,1,0,'C',true);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(15,8,$row->qty_1000,1,0,'C',true);
        $pdf->Cell(15,8,$row->qty_500,1,0,'C',true);
        $pdf->Cell(15,8,$row->qty_200,1,0,'C',true);
        $pdf->Cell(15,8,$row->qty_100,1,0,'C',true);
        $pdf->Cell(15,8,$row->qty_50,1,0,'C',true);
        $pdf->Cell(15,8,$row->qty_20,1,0,'C',true);
        $pdf->Cell(24,8,number_format($row->total_bill,2),1,0,'R',true);
        $pdf->Cell(24,8,number_format($row->total_pdc,2),1,0,'R',true);
        $pdf->Cell(24,8,number_format($row->total_dc,2),1,0,'R',true);
        $pdf->Cell(17,8,number_format($row->total_coins,2),1,0,'R',true);
        $pdf->Cell(27,8,number_format($row->total_collection + $row->total_palawan,2),1,0,'R',true);


    }

    $pdf->Ln('8');
    

    
    if($prevBu !== null) {
        printSubtotal($pdf, $prevBu, $sum_qty_1000, $sum_qty_500, $sum_qty_200, $sum_qty_100, $sum_qty_50, $sum_qty_20, $sum_total_bill, $sum_total_pdc, $sum_total_dc, $sum_total_coins, $sum_total_collection);
    }

    function printSubtotal($pdf, $bu, $qty1000, $qty500, $qty200, $qty100, $qty50, $qty20, $totalBill, $totalPdc, $totalDc, $totalCoins, $totalCollection) {
        $pdf->setx('5');
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(35,8,"Total >>>",1,0,'R',true);
        $pdf->Cell(25,8,"",1,0,'C',true);
        $pdf->Cell(15,8,$qty1000[$bu],1,0,'C',true);
        $pdf->Cell(15,8,$qty500[$bu],1,0,'C',true);
        $pdf->Cell(15,8,$qty200[$bu],1,0,'C',true);
        $pdf->Cell(15,8,$qty100[$bu],1,0,'C',true);
        $pdf->Cell(15,8,$qty50[$bu],1,0,'C',true);
        $pdf->Cell(15,8,$qty20[$bu],1,0,'C',true);
        $pdf->Cell(24,8,number_format($totalBill[$bu], 2),1,0,'R',true);
        $pdf->Cell(24,8,number_format($totalPdc[$bu], 2),1,0,'R',true);
        $pdf->Cell(24,8,number_format($totalDc[$bu], 2),1,0,'R',true);
        $pdf->Cell(17,8,number_format($totalCoins[$bu], 2),1,0,'R',true);
        $pdf->Cell(27,8,number_format($totalCollection[$bu], 2),1,0,'R',true);
        $pdf->Ln('8');
    }

    $pdf->SetFillColor(220,220,220);
    $pdf->SetFont('Arial','B',9);
    
    $pdf->setx('5');
    $pdf->Cell(35,8,"Grand Total >>>",1,0,'R',true);
    $pdf->Cell(25,8,"",1,0,'C',true);
    $pdf->Cell(15,8,$result2->qty_1000,1,0,'C',true);
    $pdf->Cell(15,8,$result2->qty_500,1,0,'C',true);
    $pdf->Cell(15,8,$result2->qty_200,1,0,'C',true);
    $pdf->Cell(15,8,$result2->qty_100,1,0,'C',true);
    $pdf->Cell(15,8,$result2->qty_50,1,0,'C',true);
    $pdf->Cell(15,8,$result2->qty_20,1,0,'C',true);
    $pdf->Cell(24,8,number_format($result2->total_bill,2),1,0,'R',true);
    $pdf->Cell(24,8,number_format($result2->total_pdc,2),1,0,'R',true);
    $pdf->Cell(24,8,number_format($result2->total_dc,2),1,0,'R',true);
    $pdf->Cell(17,8,number_format($result2->total_coins,2),1,0,'R',true);
    $pdf->Cell(27,8,number_format($result2->total_collection + @$result2->total_palawan,2),1,0,'R',true);

    

    $pdf->SetFont('Arial','B',10);
    $pdf->Ln('10');
    $pdf->Cell(75,5,"Prepared by:",0,1,'C');
    $pdf->Cell(230,-5,"Noted by:",0,1,'C');
    $pdf->Cell(380,5,"Received by:",0,1,'C');

    $pdf->SetFont('Arial','U',10);
    $pdf->Ln('8');
    $pdf->setx('36');
    $pdf->Cell(75,5,$result3->signature."                  ",0,1,'L');
    $pdf->setx('116');
    $pdf->Cell(230,-5,"                                                      ",0,1,'L');
    $pdf->setx('188');
    $pdf->Cell(380,5,"                                                      ",0,1,'L');

    $pdf->SetFont('Arial','',8);
    $pdf->Ln('-1');
    $pdf->setx('36');
    $pdf->Cell(60,5,"Printed Name & Signature",0,1,'L');
    $pdf->setx('116');
    $pdf->Cell(180,-5,"Sr. Sales Supervisor",0,1,'L');
    $pdf->setx('188');
    $pdf->Cell(290,5,"Printed Name & Signature",0,1,'L');

    $pdf->Ln('-2');
    $pdf->setx('36');
    $pdf->Cell(60,5,$this->session->userdata('location')." - REMITTANCE SECTION",0,1,'L');
    $pdf->setx('116');
    $pdf->Cell(180,-5,strtoupper($result3->bu_desc),0,1,'L');
    $pdf->setx('188');
    $pdf->Cell(290,5,"CORPORATE TREASURY",0,1,'L');

    $pdf->Output();
?>
