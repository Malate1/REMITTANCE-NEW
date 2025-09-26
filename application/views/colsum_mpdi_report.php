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
    $pdf->Cell(250,15,"MPDI COLLECTION SUMMARY REPORT",0,1,'C');
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
    $pdf->SetX(20); 
    if ($sm != 'All') {
        $pdf->Cell(40,14,'Date',1,0,'C',true);
    } else {
        $pdf->Cell(40,14,'Salesman',1,0,'C',true);
    }

    $pdf->Cell(18,14,'SRR No.',1,0,'C',true);
    $pdf->Cell(90,7,'Remittance Breakdown',1,0,'C',true); 
    $pdf->Ln(7);

    $pdf->SetX(78); 
    $pdf->Cell(22,7,'Cash',1,0,'C',true); 
    $pdf->Cell(22,7,'PDC',1,0,'C',true); 
    $pdf->Cell(22,7,'DC',1,0,'C',true); 
    $pdf->Cell(24,7,'Remittance',1,0,'C',true); 
    $pdf->Ln(-7);
    $pdf->SetX(168); 
    $pdf->Cell(26,14,'Palawan',1,0,'C',true);
    $pdf->Cell(30,14,'Accountability',1,0,'C',true);
    $pdf->Cell(30,14,'Variance',1,0,'C',true); 

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','',10);


    $flag = 0;
    $overall_total = 0.00;
    $prev_manualsrr = null;
    $subtotal_cash = $subtotal_pdc = $subtotal_dc = $subtotal_remit = $subtotal_palawan = $subtotal_coll = $subtotal_var = 0.00;
    foreach($result1 as $row) {

        
        $this->db->select('pay_type, check_type, SUM(appr_amount) AS total_appr');
        $this->db->from('remittance_ldi.payments_satellite');
        $this->db->where('sm_code', $row->sm_code);
        $this->db->where('denom_id', $row->denom_id);
        $this->db->group_by(array('pay_type', 'check_type'));
        $satellite_result = $this->db->get()->result();

        foreach ($satellite_result as $sat) {
            if ($sat->pay_type == 'Cash') {
                $row->cash_total -= $sat->total_appr;
            } elseif ($sat->pay_type == 'Cheque') {
                if ($sat->check_type == 'Post Dated') {
                    $row->PDC -= $sat->total_appr;
                } else {
                    $row->DC -= $sat->total_appr;
                }
            }
        }

        
        $this->db->select('SUM(pay_amount) AS palawan_total');
        $this->db->from('remittance_ldi.payments_palawan');
        $this->db->where('sm_code', $row->sm_code);
        $this->db->where('denom_id', $row->denom_id);
        $palawan_total = $this->db->get()->row()->palawan_total;

       
        $palawan_total = isset($palawan_total) ? $palawan_total : 0;
        
        $row->palawan_total = $palawan_total;
        
        if($flag == 0) {
            $pdf->Ln(14);
            $flag = 1;
        } else {
            $pdf->Ln(8);
        }

        // Calculate totals
        $total = $row->cash_total + $row->PDC + $row->DC;
        
        $pdf->SetX(20);
        $pdf->SetFont('Arial', '', 8);

        
        // Get the main sm_code (id_no) from users using user_id from denomination
        $this->db->select('id_no');
        $this->db->from('remittance_ldi.users');
        $this->db->where('user_id', $row->user_id);
        $main_sm = $this->db->get()->row();

        // Get total_secondary from payments_xtruck
        $query = $this->db->query('SELECT IFNULL(SUM(net_amount), 0.00) AS total_secondary, 
            IFNULL(SUM(cash_amount), 0) AS cash_total_S,
            IFNULL(SUM(CASE WHEN check_type = "Post Dated" THEN check_amount ELSE 0 END), 0) AS PDC_S,
            IFNULL(SUM(CASE WHEN check_type = "Dated" THEN check_amount ELSE 0 END), 0) AS DC_S
            FROM remittance_ldi.payments_xtruck 
            WHERE sm_code = "' . $row->sm_code2 . '" AND denom_id = "' . $row->denom_id . '"');
        $result = $query->row();

        // Get total_satsecondary from payments_satellite
        $query_sat = $this->db->query('SELECT IFNULL(SUM(appr_amount), 0.00) AS total_satsecondary 
            FROM remittance_ldi.payments_satellite 
            WHERE sm_code = "' . $row->sm_code2 . '" AND denom_id = "' . $row->denom_id . '"');
        $result_sat = $query_sat->row();

        // Calculate net secondary total
        $total_secondary = (float) $result->total_secondary - (float) $result_sat->total_satsecondary;
        $adjusted_cash = $row->cash_total - $palawan_total;
        
        // Decide adjustment logic
        if ($main_sm && $row->sm_code == $main_sm->id_no) {
            // This is the main salesman: deduct secondary from total
            $adjusted_remit = $row->total_remittance + $row->total_palawan - $total_secondary;
            $adjusted_coll = $row->total_collection + $row->total_palawan - $total_secondary;
            $variance = $adjusted_coll - $adjusted_remit + $row->sm_inc;

            $PDC    = $row->total_pdc - $result->PDC_S;
            $DC     = $row->total_dc - $result->DC_S;
            $cash   = $row->total_cash - $result->cash_total_S + $variance;
            // var_dump($row->total_cash);
            // var_dump($result->cash_total_S);
            if($variance > 0){
                $adjusted_cash = $adjusted_cash + $variance;
            }

            $sm_type = 'M';
        } else {
            // This is the secondary: display only the secondary amount
            $adjusted_remit = $total;
            $adjusted_coll = $total;

            $PDC    = $row->PDC;
            $DC     = $row->DC;
            $cash   = $row->cash_total;
            $sm_type = 'S';

            $variance = $adjusted_coll - $adjusted_remit;
        }

        // SUBTOTAL PRINTING WHEN manualsrr CHANGES
        if ($sm == 'All' && $prev_manualsrr !== null && $prev_manualsrr !== $row->manualsrr) {
            $pdf->SetX(20);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(58, 8, 'Subtotal' , 1, 0, 'L', true);
            $pdf->Cell(22, 8, number_format($subtotal_cash, 2), 1, 0, 'R', true);
            $pdf->Cell(22, 8, number_format($subtotal_pdc, 2), 1, 0, 'R', true);
            $pdf->Cell(22, 8, number_format($subtotal_dc, 2), 1, 0, 'R', true);
            $pdf->Cell(24, 8, number_format($subtotal_coll, 2), 1, 0, 'R', true);
            $pdf->Cell(26, 8, number_format($subtotal_palawan, 2), 1, 0, 'R', true);
            $pdf->Cell(30, 8, number_format($subtotal_remit, 2), 1, 0, 'R', true);
            $pdf->Cell(30, 8, number_format($subtotal_var, 2), 1, 0, 'R', true);
            $pdf->Ln(8);
            $subtotal_cash = $subtotal_pdc = $subtotal_dc = $subtotal_remit = $subtotal_palawan = $subtotal_coll = $subtotal_var = 0.00;
        }



        // Display Date or Salesman Name based on condition
        if ($sm != 'All') {
            $pdf->Cell(40, 8, date("F d, Y", strtotime($row->date_added)), 1, 0, 'L', true);
        } else {
            $pdf->SetX(20);
            
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(40, 8, $row->sm_code . ' - ' . $sm_type . ' - ' . $row->last_name, 1, 0, 'L', true);
            

        }
        
        // Content cells aligned with header columns
        $pdf->Cell(18, 8, $row->manualsrr, 1, 0, 'C', true);
        if($row->cash_total)                          // SRR No.
        $pdf->Cell(22, 8, number_format($cash, 2), 1, 0, 'R', true);      // Cash
        $pdf->Cell(22, 8, number_format($PDC, 2), 1, 0, 'R', true);       // PDC
        $pdf->Cell(22, 8, number_format($DC, 2), 1, 0, 'R', true);        // DC
        $pdf->Cell(24, 8, number_format($adjusted_coll, 2), 1, 0, 'R', true); // Total
        $pdf->Cell(26, 8, number_format($row->palawan_total, 2), 1, 0, 'R', true); 
        $pdf->Cell(30, 8, number_format($adjusted_remit, 2), 1, 0, 'R', true); 
        $pdf->Cell(30, 8, number_format($variance, 2), 1, 0, 'R', true);
        $overall_total += $adjusted_remit;

        // Subtotal accumulation
        if ($sm == 'All') {
            $subtotal_cash    += $cash;
            $subtotal_pdc     += $PDC;
            $subtotal_dc      += $DC;
            $subtotal_coll    += $adjusted_coll;
            $subtotal_remit   += $adjusted_remit;
            $subtotal_palawan += $row->palawan_total;
            $subtotal_var     += $variance;
        }

        $prev_manualsrr = $row->manualsrr;
    }

    // Print last subtotal group
    if ($sm == 'All' && $prev_manualsrr !== null) {
        
        $pdf->Ln(8);
        $pdf->SetX(20);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(58, 8, 'Subtotal' , 1, 0, 'L', true);
        $pdf->Cell(22, 8, number_format($subtotal_cash, 2), 1, 0, 'R', true);
        $pdf->Cell(22, 8, number_format($subtotal_pdc, 2), 1, 0, 'R', true);
        $pdf->Cell(22, 8, number_format($subtotal_dc, 2), 1, 0, 'R', true);
        $pdf->Cell(24, 8, number_format($subtotal_coll, 2), 1, 0, 'R', true);
        $pdf->Cell(26, 8, number_format($subtotal_palawan, 2), 1, 0, 'R', true);
        $pdf->Cell(30, 8, number_format($subtotal_remit, 2), 1, 0, 'R', true);
        $pdf->Cell(30, 8, number_format($subtotal_var, 2), 1, 0, 'R', true);
        $pdf->Ln(8);
    }
    
    // Grand Total Row
    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(240, 15, "Grand Total: " . number_format($overall_total, 2), 0, 0, 'R');

    $pdf->Output();
?>
