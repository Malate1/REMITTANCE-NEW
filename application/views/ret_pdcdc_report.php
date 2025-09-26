<?php

    require('fpdf/fpdf.php');

    class PDF extends FPDF
    {
        
    }

    $pdf = new PDF();
    $pdf->SetTopMargin(10);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->AddPage("L","Legal");
    $pdf->SetFont('Times','',8);
    $x = 0;

    
    $title = 'PDC & DC';
    

    $pdf->SetFont('Arial','B',12);
    $pdf->setx('20');
    $pdf->Cell(0,-5,$title.' Report',0,1,'L');
    $pdf->setx('20');
    //$pdf->Cell(0,16,date('F d, Y', strtotime($result3)),0,1,'L');
    $pdf->Cell(0, 16, 'Cheque Monitoring as of ' . date('F d, Y', strtotime($result3)) , 0, 1, 'L');


    

    // $pdf->Ln('1');
    $pdf->SetFillColor(220,220,220);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('Arial','B',10);
    

    $pdf->setx('20');
    $pdf->Cell(20,7,'SRR No',1,0,'C',true);
    $pdf->Cell(25,7,'Collect Date',1,0,'C',true);
    $pdf->Cell(25,7,'Check Date',1,0,'C',true);
    $pdf->Cell(20,7,'No. of Days',1,0,'C',true);
    $pdf->Cell(11,7,'Type',1,0,'C',true);
    $pdf->Cell(40,7,'Salesman',1,0,'C',true);
    $pdf->Cell(30,7,'Account No.',1,0,'C',true);
    $pdf->Cell(53,7,'Account Name',1,0,'C',true);
    
    $pdf->Cell(22,7,'Bank',1,0,'C',true);
    $pdf->Cell(22,7,'Check No.',1,0,'C',true);
    $pdf->Cell(25,7,'Amount',1,0,'C',true);
    $pdf->Cell(15,7,'Status',1,0,'C',true);

    $total=0;
    $flag = 0;

    $pdf->SetFillColor(255,255,255);
    $pdf->SetFont('Arial','',9);


    // $pdf->Ln(); // Add a line break
    // $pdf->SetFont('Arial', 'B', 12);
    // $pdf->Cell(0, 10, 'OPLAN', 0, 0, 'C'); // Add label 'OPLAN' centered
    // $pdf->SetFont('Arial', '', 10);
    // foreach($result4 as $row) {
    //     $total=$total + $row->pay_amount;
    //     if($row->check_type == 'Post Dated Check'){
    //         $type = 'PDC';
    //     }else{
    //         $type = 'DC';
    //     }
    //     $flag = 1;
    //     $pdf->Ln('7');
    //     $pdf->setx('20');
    //     $pdf->Cell(25,7,$row->pay_date,1,0,'C',true);
    //     $pdf->Cell(25,7,$row->due_date,1,0,'C',true);
    //     $pdf->Cell(20,7,$row->nodays,1,0,'C',true);
    //     $pdf->Cell(11,7,$type,1,0,'C',true);
    //     $pdf->Cell(40,7,$row->full_name,1,0,'L',true);
    //     $pdf->Cell(30,7,$row->acc_no,1,0,'C',true);
    //     $pdf->Cell(53,7,$row->acc_name,1,0,'L',true);
    //     $pdf->Cell(53,7,$row->name,1,0,'L',true);
    //     $pdf->Cell(17,7,$row->check_bank,1,0,'C',true);
    //     $pdf->Cell(22,7,$row->check_no,1,0,'C',true);
    //     $pdf->Cell(25,7,number_format($row->pay_amount,2),1,0,'R',true);
    // }
    
    $pdf->SetFont('Arial', '', 9);
    foreach($result5 as $row) {
        $total=$total + $row->pay_amount;
        if($row->check_type == 'Post Dated'){
            $type = 'PDC';
        }else{
            $type = 'DC';
        }

        if(@$row->status5 == 'Returned Old'){
            $stat = 'Old';
        }elseif(@$row->status5 == 'Returned'){
            $stat = 'Old';
        }
        else{
            $stat = 'New';
        }

        if($row->check_bank == 'METRO BANK'){
            $bank = 'MB';
        }elseif($row->check_bank == 'WEALTHBANK'){
            $bank = 'WB';
        }elseif($row->check_bank == 'PS BANK'){
            $bank = 'PSB';
        }elseif($row->check_bank == 'EASTWEST'){
            $bank = 'EW';
        }else{
            $bank = $row->check_bank;
        }
        $flag = 1;
        $pdf->Ln('7');
        $pdf->setx('20');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(20,7,$row->denom_id,1,0,'L',true);
        $pdf->Cell(25,7,$row->pay_date,1,0,'C',true);
        $pdf->Cell(25,7,$row->due_date,1,0,'C',true);
        $pdf->Cell(20,7,$row->nodays,1,0,'C',true);
        $pdf->Cell(11,7,$type,1,0,'C',true);
        $pdf->Cell(40,7,$row->full_name,1,0,'L',true);
        $pdf->Cell(30,7,$row->acc_no,1,0,'C',true);
        $pdf->Cell(53,7,$row->acc_name,1,0,'L',true);
        
        $pdf->Cell(22,7,$bank,1,0,'C',true);
        $pdf->Cell(22,7,$row->check_no,1,0,'C',true);
        $pdf->Cell(25,7,number_format($row->pay_amount,2),1,0,'R',true);
        $pdf->Cell(15,7,$stat,1,0,'C',true);
    }

    if($flag==0) {
        $pdf->Ln('7');
        $pdf->setx('20');
        $pdf->Cell(319,7,"No data available in table",1,0,'C',true);
    }

    $pdf->SetFillColor(220,220,220);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('Arial','B',10);

    $pdf->Ln('7');
    $pdf->setx('20');
    $pdf->Cell(286,7,"Total >>>",1,0,'R',true);
    $pdf->Cell(22,7,number_format($total,2),1,0,'R',true);

    $pdf->Output();
?>