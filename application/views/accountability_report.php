<title>ARIS Remittance</title>
<link href="<?php echo base_url(); ?>assets/css/fixedColumns.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/bg.png">
<link href="<?php echo base_url(); ?>assets/css/styles2.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/sweetalert.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
<script src="<?php echo base_url(); ?>assets/js/all.min.js" crossorigin="anonymous"></script>
<style>
    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<br/>
<main>
<div class="container-fluid">
    <!-- <div class="col-xl-8"> -->
        <h5><?php echo $this->session->userdata('location'); ?> - Accountability Report</h5>
        <h5><?php echo date("F d, Y",strtotime($result)); ?></h5>
        <table class="table table-bordered compact">
            <thead>
                <tr>
                    <th rowspan="2" style="vertical-align:middle"><center>Salesman Name</center></th>
                    <th rowspan="2" style="vertical-align:middle"><center>Total Amount to be Collected</center></th>
                    <th rowspan="2" style="vertical-align:middle"><center>75% Required Collection</center></th>
                    <th colspan="4"><center>Total Amount Collected</center></th>
                    <th rowspan="2" style="vertical-align:middle"><center>Variance</center></th>
                </tr>
                <tr>
                    <th><center>PDC</center></th>
                    <th><center>DC</center></th>
                    <th><center>Cash</center></th>
                    <th><center>Total</center></th>
                </tr>
            </thead>
            <tbody>
                <?php $flag = 0; foreach($result1 as $row) { $flag = 1; ?>
                <tr>
                    <td><?php echo $row->full_name; ?></td>
                    <td align="right"><?php echo number_format($row->amount,2); ?></td>
                    <td align="right"><?php echo number_format($row->collect,2) ?></td>
                    <td align="right"><?php echo number_format($row->total_pdc,2); ?></td>
                    <td align="right"><?php echo number_format($row->total_dc,2); ?></td>
                    <td align="right"><?php echo number_format($row->total_cash,2); ?></td>
                    <td align="right"><?php echo number_format($row->total_collection,2); ?></td>
                    <td align="right"><?php echo number_format($row->variance,2); ?></td>
                </tr>
                <?php } if($flag==0) { ?>
                    <tr>
                        <td colspan="7"><center>No data available in table</center></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button class="btn btn-primary no-print" style="float: right" id="printbutton" onclick="window.print()"><i class="fas fa-print"></i>&nbsp;&nbsp;Print Report</button>
    <!-- </div> -->
</div>
</main>