<?php

    require('fpdf/fpdf_pdcdc.php');

    class PDF extends FPDF_PDCDC
    {
        public $title;
        public $dateFrom;
        public $dateTo;
    }

    $pdf = new PDF();
    $pdf->SetTopMargin(10);
    $pdf->SetAutoPageBreak(TRUE, 10);

    $pdf->title = ($result2 == 'BOTH') ? 'PDC & DC' : $result2;
    $pdf->dateFrom = $result3; // Example: '2025-05-01'
    $pdf->dateTo = $result;    // Example: '2025-05-15'
    $pdf->AddPage("L","Legal");
    $pdf->SetFont('Times','',8);

    //$pdf->Header(); // 🔥 Force header rendering on the first page
    $x = 0;

    // if($result2=='BOTH'){
    //     $title = 'PDC & DC';
    // }else{
    //     $title = $result2;
    // }

    // $pdf->SetFont('Arial','B',12);
    // $pdf->setx('20');
    // $pdf->Cell(0,-5,$this->session->userdata('location') . " - ".$title.' Report',0,1,'L');
    // $pdf->setx('20');
    // $pdf->Cell(0,16,date('F d, Y', strtotime($result3))." - ".date('F d, Y', strtotime($result)),0,1,'L');

    // $pdf->Ln('1');
    // $pdf->SetFillColor(220,220,220);
    // $pdf->SetTextColor(0);
    // $pdf->SetDrawColor(0,0,0);
    // $pdf->SetLineWidth(.3);
    // $pdf->SetFont('Arial','B',10);

    // $pdf->setx('20');
    // $pdf->Cell(25,7,'Collect Date',1,0,'C',true);
    // $pdf->Cell(25,7,'Check Date',1,0,'C',true);
    // $pdf->Cell(20,7,'No. of Days',1,0,'C',true);
    // $pdf->Cell(11,7,'Type',1,0,'C',true);
    // $pdf->Cell(40,7,'Salesman',1,0,'C',true);
    // $pdf->Cell(30,7,'Account No.',1,0,'C',true);
    // $pdf->Cell(53,7,'Account Name',1,0,'C',true);
    // $pdf->Cell(53,7,'Customer Name',1,0,'C',true);
    // $pdf->Cell(17,7,'Bank',1,0,'C',true);
    // $pdf->Cell(22,7,'Check No.',1,0,'C',true);
    // $pdf->Cell(25,7,'Amount',1,0,'C',true);

    

    $total=0;
    $flag = 0;
    
    $pdf->SetFillColor(255,255,255);
    $pdf->SetFont('Arial','',10);

        if (!empty($result1)) {
            // $pdf->Ln(7);
            $pdf->setX(20);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(321,7,'OPLAN-Manual',1,0,'L',true);
            foreach($result1 as $row) {
                $total=$total + $row->amount;

                if($row->bank == 'METRO BANK'){
                    $bank = 'MB';
                }elseif($row->bank == 'WEALTHBANK'){
                    $bank = 'WB';
                }elseif($row->bank == 'PS BANK'){
                    $bank = 'PSB';
                }elseif($row->bank == 'EASTWEST'){
                    $bank = 'EW';
                }else{
                    $bank = $row->bank;
                }
                $flag = 1;
                $pdf->Ln('7');
                $pdf->setx('20');
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(25,7,$row->pay_date,1,0,'C',true);
                $pdf->Cell(25,7,$row->due_date,1,0,'C',true);
                $pdf->Cell(20,7,$row->nodays,1,0,'C',true);
                $pdf->Cell(11,7,$row->type,1,0,'C',true);
                // $pdf->SetFont('Arial','',8);
                $pdf->Cell(40,7,$row->full_name,1,0,'L',true);
                
                $pdf->Cell(30,7,$row->acc_num,1,0,'C',true);
                $pdf->Cell(53,7,$row->acc_name,1,0,'L',true);
                $pdf->Cell(53,7,$row->name,1,0,'L',true);
                // $pdf->SetFont('Arial','',10);
                $pdf->Cell(17,7,$bank,1,0,'C',true);
                $pdf->Cell(22,7,$row->check_no,1,0,'C',true);
                $pdf->Cell(25,7,number_format($row->amount,2),1,0,'R',true);
            }
        }

        if (!empty($result4)) {
            // $pdf->Ln(7);
            $pdf->setX(20);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(321,7,'OPLAN',1,0,'L',true);
            foreach($result4 as $row) {
                $total=$total + $row->pay_amount;
                if($row->check_type == 'Post Dated Check'){
                    $type = 'PDC';
                }else{
                    $type = 'DC';
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
                $pdf->Cell(25,7,$row->pay_date,1,0,'C',true);
                $pdf->Cell(25,7,$row->due_date,1,0,'C',true);
                $pdf->Cell(20,7,$row->nodays,1,0,'C',true);
                $pdf->Cell(11,7,$type,1,0,'C',true);
                // $pdf->SetFont('Arial','',8);
                $pdf->Cell(40,7,$row->full_name,1,0,'L',true);
                $pdf->Cell(30,7,$row->acc_no,1,0,'C',true);
                $pdf->Cell(53,7,$row->acc_name,1,0,'L',true);
                $pdf->Cell(53,7,$row->name,1,0,'L',true);
                // $pdf->SetFont('Arial','',10);
                $pdf->Cell(17,7,$bank,1,0,'C',true);
                $pdf->Cell(22,7,$row->check_no,1,0,'C',true);
                $pdf->Cell(25,7,number_format($row->pay_amount,2),1,0,'R',true);
            }
        }
        
        if (!empty($result5)) {
            // $pdf->Ln(7);
            $pdf->setX(20);
            $pdf->SetFont('Arial','B',10);
            // $pdf->Cell(380,7,'XTRUCK',1,0,'C',true);
            $pdf->Cell(321,7,'XTRUCK',1,0,'L',true);
            $pdf->SetFont('Arial', '', 10);
            foreach($result5 as $row) {
                $total=$total + $row->check_amount;
                if($row->check_type == 'Post Dated'){
                    $type = 'PDC';
                } elseif($row->check_type == 'Post Dated S'){
                    $type = 'PDC-S';
                } elseif($row->check_type == 'Dated S'){
                    $type = 'DC-S';
                } else{
                    $type = 'DC';
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
                $pdf->Cell(25,7,$row->pay_date,1,0,'C',true);
                $pdf->Cell(25,7,$row->due_date,1,0,'C',true);
                $pdf->Cell(20,7,$row->nodays,1,0,'C',true);
                $pdf->Cell(11,7,$type,1,0,'C',true);
                // $pdf->SetFont('Arial','',8);
                $pdf->Cell(40,7,$row->full_name,1,0,'L',true);
                $pdf->Cell(30,7,$row->acc_no,1,0,'C',true);
                $pdf->Cell(53,7,$row->acc_name,1,0,'L',true);
                $pdf->Cell(53,7,$row->name,1,0,'L',true);
                // $pdf->SetFont('Arial','',10);
                $pdf->Cell(17,7,$bank,1,0,'C',true);
                $pdf->Cell(22,7,$row->check_no,1,0,'C',true);
                $pdf->Cell(25,7,number_format($row->check_amount,2),1,0,'R',true);
            }
        }

        if($flag==0) {
            $pdf->Ln('7');
            $pdf->setx('20');
            $pdf->Cell(321,7,"No data available in table",1,0,'C',true);
        }

        $pdf->SetFillColor(220,220,220);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','B',10);

        $pdf->Ln(7);
        $pdf->SetX(20);
        $pdf->Cell(296,7,"Total >>>",1,0,'R',true);
        $pdf->Cell(25,7,number_format($total,2),1,0,'R',true);

    


    $pdf->Output();

?>