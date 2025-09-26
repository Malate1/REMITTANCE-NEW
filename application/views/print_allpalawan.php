
<?php
    require('fpdf/fpdf.php');

    class PDF extends FPDF
    {
        
    }

    $pdf = new PDF();
    $pdf->SetTopMargin(10);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->AddPage("L","Letter");
    $pdf->SetFont('Times','',8);
    $x = 0;

    $pdf->SetFont('Arial','B',12);
    //$pdf->Cell(250,-5,strtoupper($result3->bu_desc),0,1,'C');
    $pdf->Cell(250,15,"PALAWAN REMITTANCE MONITORING",0,1,'C');
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
    $pdf->setx('35');
    $pdf->Cell(35,14,'DATE',1,0,'C',true);
    $pdf->Cell(50,14,'SALESMAN',1,0,'C',true);
    $pdf->Cell(40,14,'BU',1,0,'C',true);
    $pdf->Cell(45,14,'REFERENCE NO',1,0,'C',true);
    $pdf->Cell(35,14,'AMOUNT ',1,0,'C',true);
    

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','',10);

    $flag = 0;
    $prevBu = null;
    $buCounter = []; 

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

        if(!isset($sum_total_collection[$row->bu])) {
            
            $sum_total_collection[$row->bu] = 0;

            $buCounter[$row->bu] = 1; // Start counter for this BU
        } else {
            $buCounter[$row->bu]++; // Increment counter for this BU
        }

        $sum_total_collection[$row->bu] += $row->total_pal;

        if($row->bu != $prevBu) {

            if($prevBu !== null) {
            printSubtotal($pdf, $prevBu, $sum_total_collection);
        }

            if($row->bu == 'XTRUCK-NETMAN') {
                $bu_name = 'XTRUCK-NETMAN-PNB';
            }elseif($row->bu == 'XTRUCK'){
                $bu_name = 'XTRUCK-LDI';
            }else{
                $bu_name = $row->bu;
            }
            $pdf->setx('35');
            $pdf->SetFont('Arial','B',10);

            $pdf->Cell(205,8,$bu_name,1,0,'L',true);
            $pdf->Ln('8');
            $pdf->SetFillColor(255,255,255);
            
            $prevBu = $row->bu;
        }

       
        //$smWithCounter = $buCounter[$row->bu] . ". " . $sm;

        $pdf->setx('35');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(35, 8, @$row->date_remitted, 1, 0, 'L', true);
        $pdf->Cell(50,8,$sm,1,0,'C',true);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(40,8,$bu_name,1,0,'C',true);
        $pdf->Cell(45,8,$row->ref_no,1,0,'C',true);
        $pdf->Cell(35,8,number_format($row->total_pal,2),1,0,'R',true);


    }

    $pdf->Ln('8');
    

    
    if($prevBu !== null) {
        printSubtotal($pdf, $prevBu, $sum_total_collection);
    }

    function printSubtotal($pdf, $bu, $totalCollection) {
        $pdf->setx('35');
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(35,8,"Total >>>",1,0,'R',true);
        $pdf->Cell(50,8,"",1,0,'C',true);
        $pdf->Cell(40,8,"",1,0,'C',true);
        $pdf->Cell(45,8,"",1,0,'C',true);
        $pdf->Cell(35,8,number_format($totalCollection[$bu], 2),1,0,'R',true);
        $pdf->Ln('8');
    }

    if($loc == 'all') {
        $pdf->SetFillColor(220,220,220);
        $pdf->SetFont('Arial','B',9);

        $pdf->setx('35');
        $pdf->Cell(35,8,"Grand Total >>>",1,0,'R',true);
        $pdf->Cell(50,8,"",1,0,'C',true);
        $pdf->Cell(40,8,"",1,0,'C',true);
        $pdf->Cell(45,8,"",1,0,'C',true);
        $pdf->Cell(35,8,number_format($result2->total_pal,2),1,0,'R',true);
    }
    
    $pdf->Output();
?>