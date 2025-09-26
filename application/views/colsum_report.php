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
    $pdf->Cell(250,-5,strtoupper($result3->bu_desc),0,1,'C');
    $pdf->Cell(250,15,"COLLECTION SUMMARY REPORT",0,1,'C');
    $pdf->Cell(250, -2, "DATE: " . date("F d, Y", strtotime($datefrom)) . " - " . date("F d, Y", strtotime($dateto)), 0, 1, 'C');
    if($sm != 'All') {
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(52, 15, "Salesman:", 0, 0, 'C');
        $pdf->Cell(40, 15, strtoupper(@$full_name->full_name), 0, 1, 'L');
    } else {
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(52, 15, "", 0, 0, 'C');
        $pdf->Cell(40, 15, "", 0, 1, 'L');
    }
    $pdf->Ln(-2);
    $pdf->SetFillColor(220,220,220);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B');

    $pdf->SetFont('Arial','B',10);
    $pdf->SetX(20); // Adjust starting point for table
    if ($sm != 'All') {
        $pdf->Cell(32,14,'Date',1,0,'C',true);
    } else {
        $pdf->Cell(32,14,'Salesman',1,0,'C',true);
    }

    $pdf->Cell(28,14,'SRR No.',1,0,'C',true);
    $pdf->Cell(90,7,'Remittance Breakdown',1,0,'C',true); // Reduced width
    $pdf->Ln(7);

    $pdf->SetX(80); // Adjusted position for sub-headers
    $pdf->Cell(22,7,'Cash',1,0,'C',true); // Reduced width
    $pdf->Cell(22,7,'PDC',1,0,'C',true); // Reduced width
    $pdf->Cell(22,7,'DC',1,0,'C',true); // Reduced width
    $pdf->Cell(24,7,'Remittance',1,0,'C',true); // Reduced width
    $pdf->Ln(-7);
    $pdf->SetX(170); // Adjusted position for next columns
    $pdf->Cell(26,14,'Accountability',1,0,'C',true);
    $pdf->Cell(20,14,'Variance',1,0,'C',true);
    $pdf->Cell(50,14,'Remarks',1,0,'C',true); // Increased width for "Remarks"

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','',10);


    $flag = 0;
    $overall_total = 0.00;
    foreach($result1 as $row) {
        
        if($flag == 0) {
            $pdf->Ln(14);
            $flag = 1;
        } else {
            $pdf->Ln(8);
        }

        // Process the salesman name with remarks if available
        if($row->remarks == "") {
            $sm_name = $row->last_name;
        } else {
            $rem = explode(" ", $row->remarks);
            $sm_name = $row->last_name;
        }

        // Calculate totals
        $total = $row->total_collection + $row->sm_inc;
        $overall_total += $row->total_remittance + $row->total_palawan;

        // Set X position for content alignment
        $pdf->SetX(20);
        $pdf->SetFont('Arial', '', 8);

        // Display Date or Salesman Name based on condition
        if ($sm != 'All') {
            $pdf->Cell(32, 8, date("F d, Y", strtotime($row->date_added)), 1, 0, 'L', true);
        } else {
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(32, 8, $sm_name, 1, 0, 'L', true);
        }

        // Content cells aligned with header columns
        $pdf->Cell(28, 8, @$row->manualsrr, 1, 0, 'C', true);                          // SRR No.
        $pdf->Cell(22, 8, number_format($row->total_cash, 2), 1, 0, 'R', true);      // Cash
        $pdf->Cell(22, 8, number_format($row->total_pdc, 2), 1, 0, 'R', true);       // PDC
        $pdf->Cell(22, 8, number_format($row->total_dc, 2), 1, 0, 'R', true);        // DC
        $pdf->Cell(24, 8, number_format($row->total_collection + $row->total_palawan, 2), 1, 0, 'R', true); // Total
        $pdf->Cell(26, 8, number_format($row->total_remittance + $row->total_palawan, 2), 1, 0, 'R', true); // Collection Amount
        $pdf->Cell(20, 8, number_format($total - $row->total_remittance , 2), 1, 0, 'R', true); // Short(-)/Over(+)
        $pdf->Cell(50, 8, $row->remarks, 1, 0, 'L', true); // Remarks column

    }

    // Grand Total Row
    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(240, 15, "Grand Total: " . number_format($overall_total, 2), 0, 0, 'R');


    // $pdf->SetFont('Arial','B',10);
    // $pdf->Ln('10');
    // $pdf->Cell(75,5,"Prepared by:",0,1,'C');
    // $pdf->Cell(230,-5,"Noted by:",0,1,'C');
    // $pdf->Cell(380,5,"Received by:",0,1,'C');

    // $pdf->SetFont('Arial','U',10);
    // $pdf->Ln('8');
    // $pdf->setx('36');
    // $pdf->Cell(75,5,$result3->signature."                  ",0,1,'L');
    // $pdf->setx('116');
    // $pdf->Cell(230,-5,"                                                      ",0,1,'L');
    // $pdf->setx('188');
    // $pdf->Cell(380,5,"                                                      ",0,1,'L');

    // $pdf->SetFont('Arial','',8);
    // $pdf->Ln('-1');
    // $pdf->setx('36');
    // $pdf->Cell(60,5,"Printed Name & Signature",0,1,'L');
    // $pdf->setx('116');
    // $pdf->Cell(180,-5,"Sr. Sales Supervisor",0,1,'L');
    // $pdf->setx('188');
    // $pdf->Cell(290,5,"Printed Name & Signature",0,1,'L');

    // $pdf->Ln('-2');
    // $pdf->setx('36');
    // $pdf->Cell(60,5,$this->session->userdata('location')." - REMITTANCE SECTION",0,1,'L');
    // $pdf->setx('116');
    // $pdf->Cell(180,-5,strtoupper($result3->bu_desc),0,1,'L');
    // $pdf->setx('188');
    // $pdf->Cell(290,5,"CORPORATE TREASURY",0,1,'L');

    $pdf->Output();
?>
