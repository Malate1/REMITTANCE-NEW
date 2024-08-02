<?php
    if($result2=='BOTH'){
        $title = 'PDC & DC';
    }else{
        $title = $result2;
    }

    $filename = $this->session->userdata('location').' - '.$title.' Report - '.$result3.'-'.$result;	
	header("Cache-Control: public"); 
	header("Content-Type: application/octet-stream");
	header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
	header( "Content-disposition: attachment; filename=".$filename.".xls");
?>
<p style="font-size:24px;font-weight:bold"><?php echo $this->session->userdata('location') . " - ".$title.' Report'; ?></p>
<p style="font-size:15px;font-weight:bold"><?php echo date('F d, Y', strtotime($result3)) . " - ".date('F d, Y', strtotime($result)); ?></p>

<table class="table table-bordered compact">
        <thead>
            <tr>
                <th style="vertical-align:middle"><center>Collect Date</center></th>
                <th style="vertical-align:middle"><center>Check Date</center></th>
                <th style="vertical-align:middle"><center>No. of Days</center></th>
                <th style="vertical-align:middle"><center>Type</center></th>
                <th style="vertical-align:middle"><center>Salesman</center></th>
                <th style="vertical-align:middle"><center>Account Name</center></th>
                <th style="vertical-align:middle"><center>Account No.</center></th>
                <th style="vertical-align:middle"><center>Customer Name</center></th>
                <th style="vertical-align:middle"><center>Bank</center></th>
                <th style="vertical-align:middle"><center>Check No.</center></th>
                <th style="vertical-align:middle"><center>Amount</center></th>
            </tr>
            <tbody>
                <?php $total=0; $flag = 0; foreach($result1 as $row) { $flag = 1; ?>
                    <?php $total=$total + $row->amount; ?>
                <tr>
                    <td><center><?php echo $row->pay_date; ?></center></td>
                    <td><center><?php echo $row->due_date; ?></center></td>
                    <td><center><?php echo $row->nodays; ?></center></td>
                    <td><center><?php echo $row->type; ?></center></td>
                    <td><center><?php echo $row->full_name; ?></center></td>
                    <td><center><?php echo $row->acc_name; ?></center></td>
                    <td><center><?php echo $row->acc_num; ?></center></td>
                    <td><center><?php echo $row->name; ?></center></td>
                    <td><center><?php echo $row->bank; ?></center></td>
                    <td><center><?php echo $row->check_no; ?></center></td>
                    <td align="right"><?php echo number_format($row->amount,2); ?></td>
                </tr>
                <?php } if($flag==0) { ?>
                    <tr>
                        <td colspan="10"><center>No data available in table</center></td>
                    </tr>
                <?php } ?>
            </tbody>
        </thead>
    </table>
<h5>Total >>> <?php echo number_format($total,2); ?></h5>