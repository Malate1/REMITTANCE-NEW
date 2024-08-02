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
    $pdf->Cell(250,-4,"DATE: ".date("F d, Y",strtotime($result)),0,1,'C');

    $pdf->Ln('8');
    $pdf->SetFillColor(220,220,220);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B');

    $pdf->SetFont('Arial','B',10);
    $pdf->setx('25');
    $pdf->Cell(45,14,'Salesman',1,0,'C',true);
    $pdf->Cell(18,14,'SRR No.',1,0,'C',true);
    $pdf->Cell(99,7,'Remittance Breakdown',1,0,'C',true);
    $pdf->Ln('7');
    
    $pdf->setx('88');
    $pdf->Cell(24,7,'Cash',1,0,'C',true);
    $pdf->Cell(24,7,'PDC',1,0,'C',true);
    $pdf->Cell(24,7,'DC',1,0,'C',true);
    $pdf->Cell(27,7,'Total',1,0,'C',true);
    $pdf->Ln('-7');
    $pdf->setx('187');
    $pdf->Cell(35,14,'Collection Amount',1,0,'C',true);
    $pdf->Cell(30,14,'Short(-)/Over(+)',1,0,'C',true);

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','',10);

    $flag = 0;
    foreach($result1 as $row) {
        if($flag==0){
            $pdf->Ln('14');
            $flag = 1;
        }else{
            $pdf->Ln('8');
        }
        if($row->remarks==""){
            $sm = $row->full_name;
        }else{
            $rem = explode(" ", $row->remarks);
            $sm = $row->full_name.'/'.$rem[0];
        }
        $pdf->setx('25');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(45,8,$sm,1,0,'L',true);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(18,8,$row->denom_id,1,0,'C',true);
        $pdf->Cell(24,8,number_format($row->total_cash,2),1,0,'R',true);
        $pdf->Cell(24,8,number_format($row->total_pdc,2),1,0,'R',true);
        $pdf->Cell(24,8,number_format($row->total_dc,2),1,0,'R',true);
        $pdf->Cell(27,8,number_format($row->total_collection,2),1,0,'R',true);
        $pdf->Cell(35,8,number_format($row->total_remittance,2),1,0,'R',true);
        $pdf->Cell(30,8,number_format($row->total_collection-$row->total_remittance,2),1,0,'R',true);
    }

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
<!--
<br/>
<main>
<div class="container-fluid">
    <center><h6><?php echo strtoupper($result3->bu_desc); ?></h6></center>
    <center><h6>GROCERY DAILY SUMMARY COLLECTION REPORT</h6></center>
    <center><h6>DATE: <?php echo date("F d, Y",strtotime($result)); ?></h6></center><br/>
    <table class="table table-bordered compact" style="border-color: #000000">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align:middle"><center>Salesman</center></th>
                <th rowspan="2" style="vertical-align:middle"><center>SRR No.</center></th>
                <th colspan="6"><center>Cash Breakdown</center></th>
                <th rowspan="2" style="vertical-align:middle"><center>Total Bills</center></th>
                <th rowspan="2" style="vertical-align:middle" ><center>Post Dated Checks</center></th>
                <th rowspan="2" style="vertical-align:middle"><center>Dated Checks</center></th>
                <th rowspan="2" style="vertical-align:middle"><center>Coins</center></th>
                <th rowspan="2" style="vertical-align:middle"><center>Grand Total</center></th>
            </tr>
            <tr>
                <th><center>1000</center></th>
                <th><center>500</center></th>
                <th><center>200</center></th>
                <th><center>100</center></th>
                <th><center>50</center></th>
                <th><center>20</center></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($result1 as $row) { ?>
                <tr>
                    <td><?php echo $row->full_name; ?></td>
                    <td><center><?php echo $row->denom_id; ?></center></td>
                    <td><center><?php echo $row->qty_1000; ?></center></td>
                    <td><center><?php echo $row->qty_500; ?></center></td>
                    <td><center><?php echo $row->qty_200; ?></center></td>
                    <td><center><?php echo $row->qty_100; ?></center></td>
                    <td><center><?php echo $row->qty_50; ?></center></td>
                    <td><center><?php echo $row->qty_20; ?></center></td>
                    <td style="text-align:right"><?php echo number_format($row->total_bill,2); ?></td>
                    <td style="text-align:right"><?php echo number_format($row->total_pdc,2); ?></td>
                    <td style="text-align:right"><?php echo number_format($row->total_dc,2); ?></td>
                    <td style="text-align:right"><?php echo number_format($row->total_coins,2); ?></td>
                    <td style="text-align:right"><?php echo number_format($row->total_collection,2); ?></td>
                </tr>
            <?php } ?>
                <tr style="font-weight:bold">
                    <td style="text-align:right">Total >>></td>
                    <td></td>
                    <td><center><?php echo $result2->qty_1000; ?></center></td>
                    <td><center><?php echo $result2->qty_500; ?></center></td>
                    <td><center><?php echo $result2->qty_200; ?></center></td>
                    <td><center><?php echo $result2->qty_100; ?></center></td>
                    <td><center><?php echo $result2->qty_50; ?></center></td>
                    <td><center><?php echo $result2->qty_20; ?></center></td>
                    <td style="text-align:right"><?php echo number_format($result2->total_bill,2); ?></td>
                    <td style="text-align:right"><?php echo number_format($result2->total_pdc,2); ?></td>
                    <td style="text-align:right"><?php echo number_format($result2->total_dc,2); ?></td>
                    <td style="text-align:right"><?php echo number_format($result2->total_coins,2); ?></td>
                    <td style="text-align:right"><?php echo number_format($result2->total_collection,2); ?></td>
                </tr>
        </tbody>
    </table>
</div>
<div class="container-fluid">
    <div class="row" style="margin-left:60px">
        <div class="col-md-4">
            <label style="font-weight:bold">Prepared by:</label><br/><br/>
            <label style="font-size:17px;text-decoration:underline">_____<?php echo $result3->signature; ?>_____</label></br>
            <label style="font-size:13px;margin-top:-12px">Printed name & Signature</label><br/>
            <label style="font-size:13px;margin-top:-12px">WDG - REMITTANCE SECTION</label>
        </div>  
        <div class="col-md-4">
            <label style="font-weight:bold">Noted by:</label><br/><br/>
            <label style="font-size:17px">______________________________</label><br/>
            <label style="font-size:13px;margin-top:-12px">Sr. Sales Supervisor</label><br/>
            <label style="font-size:13px;margin-top:-12px">WHOLESALE DISTRIBUTION GROUP</label>
        </div>
        <div class="col-md-4">
            <label style="font-weight:bold">Received by:</label><br/><br/>
            <label style="font-size:17px;">______________________________</label><br/>
            <label style="font-size:13px;margin-top:-12px">Printed name & Signature</label><br/>
            <label style="font-size:13px;margin-top:-12px">CORPORATE TREASURY</label>
        </div>
    </div>
    <button class="btn btn-primary no-print" style="float: right" id="printbutton" onclick="window.print()"><i class="fas fa-print"></i>&nbsp;&nbsp;Print Report</button><br/><br/>
</div>
</main> -->