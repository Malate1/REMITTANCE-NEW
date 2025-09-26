<main>

    <style type="text/css">
        table.dataTable tr th.select-checkbox.selected::after {
            content: "✔";
            margin-top: -11px;
            margin-left: -4px;
            text-align: center;
            text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
        }

        .disabled-link {
            pointer-events: none; /* Prevent clicking */
            opacity: 0.5; /* Dim the appearance */
            text-decoration: none; /* Remove underline */
        }

        .enabled-link {
            pointer-events: auto; /* Allow clicking */
        }

    </style>
    <div class="container-fluid">
        <h4 class="mt-4">Salesman Check Entry</h4>
        <a href="<?php echo base_url('/admindatedenom'); ?>">
        <button class="btn btn-primary">
            <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back
        </button></a>
        
        <a style="cursor: pointer" onclick="refresh()">
        <button title="Refresh" class="btn btn-warning" style="float:right;margin-right: 5px">
            <i class="fas fa-circle-notch"></i>
        </button></a>
        <br/><br/>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                <!-- Salesman denomination for the date - <b style="font-size: 20px"><?php echo date("F d, Y",strtotime($result2)); ?></b>. Select a record to proceed check entry. -->

                <?php if (!empty($row->full_name) && !empty($result2)): ?>
                    Salesman denomination for the date - <b style="font-size: 20px"><?php echo $row->full_name; ?></b>
                    from <b style="font-size: 20px"><?php echo date("F d, Y", strtotime($result2)); ?></b> to <b style="font-size: 20px"><?php echo date("F d, Y", strtotime($result3)); ?></b>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <!-- <button type="button" id="approveButton">Approve Selected</button> -->

                <!-- <button class="btn btn-primary" type="button" id="approveButton" style="margin-bottom: 10px;" >
                    <i class="far fa-thumbs-up"></i>&nbsp;&nbsp;Approve Selected
                </button> -->

                <div>
                    <table class="table table-striped table-hover compact" id="cashier_sm_ledger1" width="100%" cellspacing="0">

                        <thead>
                            <tr style="text-align: center">
                                
                                <th style="min-width: 70px">Remit Date</th>
                                <th style="min-width: 70px">Denom No.</th>
                                <th style="min-width: 70px">Manual SRR No.</th>

                                <th style="min-width: 130px">Salesman Name</th>
                                <th style="min-width: 80px">Total Cash</th>
                                <th style="min-width: 80px">Total Palawan Cash</th>
                                <th style="min-width: 80px">SM DC</th>
                                <th style="min-width: 80px">SM PDC</th>
                                <!-- <th style="min-width: 85px">Cashier DC</th>
                                <th style="min-width: 92px">Cashier PDC</th> -->
                                <th style="min-width: 127px">Total Remittance</th>
                                <th style="min-width: 117px">Total Accountability</th>
                                <th >Total SRR (Manual)</th>
                                <?php
                               
                                if ($this->session->userdata('location')=='LDI' || $this->session->userdata('location')=='LDI-CDC' || $this->session->userdata('location')=='LDI-UDC') { ?>

                                    <th>Total Returns</th>
                                    <th>Total W/Tax</th>
                                    <th>Total B.O</th>
                                
                                <?php } ?>

                                <?php if ($this->session->userdata('bu')=='XTRUCK' || $this->session->userdata('bu')=='XTRUCK-NETMAN' || $this->session->userdata('bu')=='XTRUCK-MPDI') { ?>

                                    <th>SM Incentives</th>
                                   
                                
                                <?php } ?>
                                <th style="min-width: 85px">(+/-)</th>
                                <th style="min-width: 55px">Status</th>
                                <th style="min-width: 200px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $row) { ?>
                            <tr>

                            <td style="text-align: center"><?php echo $row->date_added; ?></td>
                                <td style="text-align: center"><?php echo $row->srr; ?></td>
                                <td style="text-align: center"><?php echo $row->manualsrr; ?></td>
                                <td><?php echo $row->full_name; ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_cash,2); ?></td>
                                <td style="text-align: right"><?php echo number_format(@$row->total_palawan,2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_dc,2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_pdc,2); ?></td>
                                
                                <td style="text-align: right"><?php echo number_format($row->total_collection + $row->total_palawan ,2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_remittance + $row->total_palawan,2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_srr,2); ?></td>
                                <?php
                                
                                if ($this->session->userdata('location')=='LDI' || $this->session->userdata('location')=='LDI-CDC' || $this->session->userdata('location')=='LDI-UDC') { ?>

                                    <td style="text-align: right"><?php echo number_format($row->total_returns,2); ?></td>
                                    <?php if ($row->bu=='XTRUCK' || $row->bu=='XTRUCK-NETMAN' || $row->bu=='XTRUCK-MPDI') { ?>
                                        <td style="text-align: right"><?php echo number_format($row->wtax,2); ?></td>
                                    <?php }else{ ?>
                                        <td style="text-align: right"><?php echo number_format($row->vat,2); ?></td>
                                    <?php } ?>
                                    <td style="text-align: right"><?php echo number_format($row->bo,2); ?></td>
                                    <!-- <td style="text-align: right"><?php echo $row->bu; ?></td> -->
                                
                                <?php } ?>

                                <?php
                                
                                if ($this->session->userdata('bu')=='XTRUCK' || $this->session->userdata('bu')=='XTRUCK-NETMAN' || $this->session->userdata('bu')=='XTRUCK-MPDI') { ?>

                                    <td style="text-align: right"><?php echo number_format($row->sm_inc,2); ?></td>
                                    
                                
                                <?php } ?>

                                <?php
                                $total_amount = $row->total_collection + $row->sm_inc;
                                    
                                $rem_amt = $total_amount - $row->total_remittance;

                                if(floatval($row->total_remittance) < $total_amount){
                                    $rem = 'Over ('.number_format($rem_amt, 2).')';
                                }elseif(floatval($row->total_remittance) > $total_amount){
                                    $rem = 'Short ('.number_format($rem_amt, 2).')';
                                }else{
                                    $rem = 'None';
                                }
                                ?>
                                <td style="text-align: right"><?php echo $rem; ?></td>
                                <td style="text-align: center"><?php if($row->status=="Pending") { echo "<span class='badge badge-danger'>".$row->status."</span>"; } else { echo "<span class='badge badge-primary'>".$row->status."</span>"; } ?></td>
                                <td align="center">
                                <?php if ($row->bu=='XTRUCK' || $row->bu=='XTRUCK-NETMAN' || $row->bu=='XTRUCK-MPDI') { ?>
                                    <?php if ($row->status != "Approved") { ?>
                                        <a data-srr="<?php echo $row->srr; ?>" title="Unfile Denomination" style="color: red;cursor: pointer" onclick=unfile_denom_xt(this)><i class="fas fa-undo"></i></a>&nbsp;&nbsp;
                                    
                                    <?php }else{ ?>
                                        <a data-srr="<?php echo $row->srr; ?>" title="Untag Denomination" style="color: red;cursor: pointer" onclick=untag_denom_xt(this)><i class="fas fa-undo"></i></a>&nbsp;&nbsp;

                                    <?php } ?>

                                    <a data-srr="<?php echo $row->srr; ?>" title="Edit SRR No." style="color: orange;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick="edit_sm_denom_ldi_op(this)"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;
                                <?php }else{ ?>

                                    <?php if ($row->status != "Approved") { ?>
                                        <a data-srr="<?php echo $row->srr; ?>" title="Unfile Denomination" style="color: red;cursor: pointer" onclick=unfile_denom_op(this)><i class="fas fa-undo"></i></a>&nbsp;&nbsp;
                                    <?php }else{ ?>
                                        <a data-srr="<?php echo $row->srr; ?>" title="Untag Denomination" style="color: red;cursor: pointer" onclick=untag_denom_xt(this)><i class="fas fa-undo"></i></a>&nbsp;&nbsp;
                                    <?php } ?>

                                    <a data-srr="<?php echo $row->srr; ?>" title="Edit SRR No." style="color: orange;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick="edit_sm_denom_ldi_op(this)"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;

                                <?php } ?>
                                    
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<div id="editSmCheck" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Manual SRR</h4>
        </div>
        <div class="modal-body">
            <div id="editsm_payment"></div>
        </div>
        </div>

    </div>
</div>

<div id="viewSmChecks" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Salesman Checks</h4>
        </div>
        <div class="modal-body">
            <div id="viewsmchecks_content"></div>
        </div>
        </div>

    </div>
</div>

<div id="viewSmDenom" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Denomination</h4>
        </div>
        <div class="modal-body">
            <div id="viewsmdenom_content"></div>
        </div>
        </div>

    </div>
</div>

<div id="viewSmDenomLdi" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Denomination</h4>
        </div>
        <div class="modal-body">
            <div id="viewsmdenom_content_ldi"></div>
        </div>
        </div>

    </div>
</div>

<div id="viewAllSmDenom" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Salesman Total Denomination</h4>
        </div>
        <div class="modal-body">
            <div id="viewallsmdenom_content"></div>
        </div>
        </div>

    </div>
</div>

<div id="cashierRemarks" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Remarks</h4>
        </div>
        <div class="modal-body">
            <form method="post" id="remarks_submit">
                <div id="remarks_content"></div>
            </form>
        </div>
        </div>

    </div>
</div>



<div id="totalRemittance" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Total Remittance</h4>
        </div>
        <div class="modal-body">
            <form method="post" id="remittance_submit">
                <div id="remittance_content"></div>
            </form>
        </div>
        </div>

    </div>
</div>
 <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

 <script>
$(document).ready(function() {
    $('#cashier_sm_ledger1').DataTable({
        // Optional settings
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        responsive: true ,
        scrollX: true
    });
});
</script>

