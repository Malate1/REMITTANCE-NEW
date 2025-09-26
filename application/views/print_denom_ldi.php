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

    $pdf->SetFont('Arial','B',11);
    if($result->bu == 'XTRUCK'){
        $bu = 'XTRUCK-LDI';
    }else{
        $bu = $result->bu;
    }

    if($result->location == 'LDI'){
        $loc = 'HO';
    }elseif($result->location == 'LDI-UDC'){
        $loc = 'UDC';
    }elseif($result->location == 'LDI-CDC'){
        $loc = 'CDC';
    }
    $pdf->Cell(190, -5, $bu . " - " . @$loc . " - Sales Remittance Report", 0, 1, 'C');


    
    $sm = $result->full_name;
    

    $pdf->SetFont('Arial','B',8);
    $pdf->Ln('8');
    $pdf->Cell(42,5,"Sales Representative : ",0,1,'C');
    $pdf->setx('55');
    $pdf->Cell(140,-5,utf8_decode($sm),0,1,'L');
    

    $pdf->Cell(320,5,"SRR No. : ",0,1,'C');
    $pdf->setx('175');
    $pdf->Cell(350,-5,@$result->manualsrr,0,1,'L');

    $pdf->SetFont('Arial','B',8);
    $pdf->Ln('5');
    $pdf->Cell(20,5,"Date : ",0,1,'C');
    $pdf->setx('25');
    $pdf->Cell(70,-5,date("F d, Y",strtotime($result->date_added)),0,1,'L');

    $pdf->SetFont('Arial','B',8);
    $pdf->Ln('0');
    $pdf->Cell(190,15,"COLLECTION BREAKDOWN",0,1,'C');
    $pdf->setY($pdf->GetY() + 8);
    $pdf->setx('140');
    $pdf->Cell(320,-28,"Total Accountability :",0,1,'L');
    $pdf->setx('175');
    // $pdf->Cell(348,25,'1,000,000.00',0,1,'L');
    $pdf->Cell(348,28,number_format($result->total_remittance + @$result->total_palawan,2),0,1,'L');

    

    $pdf->setX('140');
    $pdf->Cell(290, -21, "Total Incentives :", 0, 1, 'L');
    $pdf->setX('175');
    $pdf->Cell(348, 21, number_format($result->sm_inc, 2), 0, 1, 'L');

    

    $deduct = $result->vat + $result->bo;

    $total_amount = $result->total_collection + $result->sm_inc;

    // $rem_amt = $result->total_remittance - $result->total_collection;

    $rem_amt = $total_amount - $result->total_remittance;

    if($result->total_remittance < $total_amount){
    // if($result->total_remittance < $result->total_collection){
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

    $pdf->SetFont('Arial','B',8);
    $pdf->Ln('1');
    $pdf->Cell(20,-30,"Returns : ",0,1,'R');
    $pdf->setx('35');
    $pdf->Cell(90,30,$ret,0,1,'L');

    $pdf->SetFont('Arial','B',8);
    $pdf->Ln('0');
    $pdf->Cell(25,-16,"Remarks : ",0,1,'C');
    $pdf->setx('35');
    $pdf->Cell(90,16,$rem . ' - ' .$result->remarks,0,1,'L');

    $pdf->Ln('-5');
    $pdf->SetFillColor(220,220,220);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B');

    $pdf->setx('15');
    $pdf->Cell(50,5,'Notes',1,0,'C',true);
    $pdf->Cell(60,5,'Quantity',1,0,'C',true);
    $pdf->Cell(69,5,'Amount',1,0,'C',true);

    $pdf->Ln('5');
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

    // $pdf->Ln('5');
    // $pdf->setx('15');
    // $pdf->Cell(50,5,"Total Returns",1,0,'C');
    // $pdf->Cell(60,5,"",1,0,'C');
    // $pdf->Cell(69,5,number_format($result->total_returns,2),1,0,'R');

    // $pdf->Ln('5');
    // $pdf->setx('15');
    // $pdf->Cell(50,5,"Total W/Tax",1,0,'C');
    // $pdf->Cell(60,5,"",1,0,'C');
    // $pdf->Cell(69,5,number_format($result->vat,2),1,0,'R');

    // $pdf->Ln('5');
    // $pdf->setx('15');
    // $pdf->Cell(50,5,"Total B.O",1,0,'C');
    // $pdf->Cell(60,5,"",1,0,'C');
    // $pdf->Cell(69,5,number_format($result->bo,2),1,0,'R');

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
    $pdf->Cell(50,5,"Total Actual Remittance   ",1,0,'C');
    $pdf->Cell(60,5,"",1,0,'C');
    $pdf->Cell(69,5,number_format($result->total_collection,2),1,0,'R');
    // if ($result->bu != 'OPLAN') {
    //     $pdf->Ln('5');
    //     $pdf->setx('15');
    //     $pdf->Cell(50,5,"Total Palawan Remittance   ",1,0,'C');
    //     $pdf->Cell(60,5,"",1,0,'C');
    //     $pdf->Cell(69,5,number_format($result->total_palawan,2),1,0,'R');

    //     $pdf->Ln('5');
    //     $pdf->setx('15');
    //     $pdf->Cell(50,5,"Total Remittance w/ Palawan   ",1,0,'C');
    //     $pdf->Cell(60,5,"",1,0,'C');
    //     $pdf->Cell(69,5,number_format($result->total_collection + @$result->total_palawan,2),1,0,'R');
    // }

    

    if (!empty($result2) || !empty($result3)) {
        
        
        $totalWidth = 190;
        $leftMargin = 10;

        // Calculate the width for the first column (equivalent to 2 columns)
        $firstColumnWidth = (($totalWidth - $leftMargin) / 6) * 2;

        // Calculate the width for the remaining columns (equally divided among 4 columns)
        $columnWidth = (($totalWidth - $leftMargin) - $firstColumnWidth) / 5;
        
        if ($result->bu == 'OPLAN' || $result->bu == 'MAS-LDI' || $result->bu == 'MAS-NETMAN' || $result->bu == 'MAS-MPDI' ) {
            $pdf->Cell(190, 10, "PDC/DC BREAKDOWN", 0, 1, 'C');
            $pdf->SetX(15);
            // Output table headers for $result3
            $pdf->Cell($firstColumnWidth, 7, 'Name', 1, 0, 'C', true);
            $pdf->Cell($columnWidth, 7, 'Due Date', 1, 0, 'C', true);
            $pdf->Cell($columnWidth, 7, 'Bank', 1, 0, 'C', true);
            $pdf->Cell($columnWidth, 7, 'Check No.', 1, 0, 'C', true);
            $pdf->Cell($columnWidth, 7, 'Status', 1, 0, 'C', true);
            $pdf->Cell($columnWidth, 7, 'Amount', 1, 1, 'C', true); // Move to the next line
        
            // Check if $result3 is not empty and output rows
            if (!empty($result3)) {
                foreach ($result3 as $row) {
                    $pdf->SetX(15); 
                    $pdf->SetFont('Arial', '', 6);
                    $pdf->Cell($firstColumnWidth, 7, utf8_decode($row->name), 1, 0, 'C');
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell($columnWidth, 7, $row->due_date, 1, 0, 'C');
                    $pdf->Cell($columnWidth, 7, $row->check_bank, 1, 0, 'C');
                    $pdf->Cell($columnWidth, 7, $row->check_no, 1, 0, 'C');
                    $pdf->Cell($columnWidth, 7, $row->status2, 1, 0, 'C');
                    $pdf->Cell($columnWidth, 7, number_format($row->total, 2), 1, 1, 'C'); // Move to the next line after each row
                }
            } else {
                // Show 'No data available' message if $result3 is empty
                $pdf->SetX(15); 
                $pdf->SetFont('Arial', '', 8);
                $pdf->Cell(180, 7, 'No data available', 1, 0, 'C');
            }
        }else{
            $pdf->Cell(190, 10, "PDC/DC BREAKDOWN", 0, 1, 'C');
            $pdf->SetX(15);
            
            $pdf->Cell($firstColumnWidth, 7, 'Name', 1, 0, 'C', true);
            $pdf->Cell($columnWidth, 7, 'Due Date', 1, 0, 'C', true);
            $pdf->Cell($columnWidth, 7, 'Bank', 1, 0, 'C', true);
            $pdf->Cell($columnWidth, 7, 'Check No.', 1, 0, 'C', true);
            $pdf->Cell($columnWidth, 7, 'Status', 1, 0, 'C', true);
            $pdf->Cell($columnWidth, 7, 'Amount', 1, 1, 'C', true); // Move to the next line

            
            foreach ($result2 as $row) {
                $pdf->SetX(15); 
                $pdf->SetFont('Arial', '', 6);
                $pdf->Cell($firstColumnWidth, 7, $row->name, 1, 0, 'C');
                $pdf->SetFont('Arial', '', 8);
                $pdf->Cell($columnWidth, 7, $row->due_date, 1, 0, 'C');
                $pdf->Cell($columnWidth, 7, $row->bank, 1, 0, 'C');
                $pdf->Cell($columnWidth, 7, $row->check_no, 1, 0, 'C');
                $pdf->Cell($columnWidth, 7, '', 1, 0, 'C');
                $pdf->Cell($columnWidth, 7, number_format($row->amount, 2), 1, 1, 'C'); // Move to the next line after each row
            }
            
            
        }

        
        
    }
    

    



    $pdf->SetFont('Arial','B',8);
    $pdf->Ln('5');
    $pdf->Cell(60,5,"Remitted by:",0,1,'C');
    $pdf->Cell(180,-5,"Checked by:",0,1,'C');
    $pdf->Cell(290,5,"Received by:",0,1,'C');
    $pdf->Ln('-2');
    $pdf->SetFont('Arial','U',8);
    $pdf->Ln('5');
    $pdf->setx('29');
    $pdf->Cell(60,5,utf8_decode($result->full_name)."          ",0,1,'L');
    $pdf->setx('89');
    $pdf->Cell(180,-5,"                                     ",0,1,'L');
    $pdf->setx('144');
    $pdf->Cell(290,5,"                                     ",0,1,'L');

    $pdf->SetFont('Arial','',8);
    $pdf->Ln('-1');
    $pdf->Cell(60,5,"Name/Signature",0,1,'C');
    $pdf->Cell(180,-5,"Name/Signature",0,1,'C');
    $pdf->Cell(290,5,"Name/Signature",0,1,'C');

    $pdf->Output();
?>