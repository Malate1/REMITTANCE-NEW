<main>

    <style type="text/css">
        table.dataTable tr th.select-checkbox.selected::after {
    content: "✔";
    margin-top: -11px;
    margin-left: -4px;
    text-align: center;
    text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
}
    </style>
    <div class="container-fluid">
        <h4 class="mt-4">Salesman Check Entry</h4>
        <a href="<?php echo base_url('/remitdate'); ?>">
        <button class="btn btn-primary">
            <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back
        </button></a>
        <?php if($this->session->userdata('location')=='UWDG') { ?>
            <select style="width:14%;float:right;margin-left: 5px" class="form-control" name="utype" id="utype" required>
                <option value="All">All</option>
                <option value="Salesman">Salesman</option>
                <option value="JefeDeViaje">JefeDeViaje</option>
                <option value="Walk-In">Walk-In</option>
                <option value="OtherCharges">OtherCharges</option>
            </select>
            <a style="cursor: pointer" onclick=print_alldenom_uwdg('<?php echo $result2; ?>')>
            <button class="btn btn-success" style="float:right;margin-left: 5px">
                <i class="fas fa-print"></i>&nbsp;&nbsp;Print Collection Summary
            </button></a>
        <?php } else if($this->session->userdata('location') == 'LDI' || $this->session->userdata('location')=='LDI-CDC') { ?>

            <select style="width:14%;float:right;margin-left: 5px" class="form-control" name="loc" id="loc" required>
                <option value="All">All</option>
                <option value="OPLAN">OPLAN</option>
                <option value="HORECA">HORECA</option>
                <option value="FROZEN">FROZEN</option>
                <option value="3PS">3PS</option>
                <option value="CVS">CVS</option>
                <option value="MPDI">MPDI</option>
                <option value="XTRUCK">XTRUCK</option>
            </select>
            <a style="cursor: pointer" onclick=print_alldenom_LDI('<?php echo $result2; ?>')>
             <button class="btn btn-success" style="float:right;margin-left: 5px">
                <i class="fas fa-print"></i>&nbsp;&nbsp;Print Collection Summary LDI
            </button>
            </a>

            <a style="cursor: pointer" onclick=print_alldenom_LDI_cashier('<?php echo $result2; ?>')>
             <button class="btn btn-success" style="float:right;margin-left: 5px">
                <i class="fas fa-print"></i>&nbsp;&nbsp;Print Approved Collection Summary per Cashier
            </button>
            </a>
        <?php } else{ ?>
            <a style="cursor: pointer" onclick=print_alldenom('<?php echo $result2; ?>')>
            <button class="btn btn-success" style="float:right;margin-left: 5px">
                <i class="fas fa-print"></i>&nbsp;&nbsp;Print Collection Summary
            </button></a>
        <?php } ?>
        <a style="cursor: pointer" data-toggle="modal" data-target="#viewAllSmDenom" onclick=viewallsmdenom_content('<?php echo $result2; ?>')>
        <button class="btn btn-info" style="float:right">
            <i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;All Salesman Denomination
        </button></a>
        <a style="cursor: pointer" onclick="refresh()">
        <button title="Refresh" class="btn btn-warning" style="float:right;margin-right: 5px">
            <i class="fas fa-circle-notch"></i>
        </button></a>
        <br/><br/>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Salesman denomination for the date - <b style="font-size: 20px"><?php echo date("F d, Y",strtotime($result2)); ?></b>. Select a record to proceed check entry.
            </div>
            <div class="card-body">
                <!-- <button type="button" id="approveButton">Approve Selected</button> -->

                <button class="btn btn-primary" type="button" id="approveButton" style="margin-bottom: 10px;" >
                    <i class="far fa-thumbs-up"></i>&nbsp;&nbsp;Approve Selected
                </button>

                <div>
                    <table class="table table-striped table-hover compact" id="cashier_sm_ledger" width="100%" cellspacing="0">

                        <thead>
                            <tr style="text-align: center">
                                <th >
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="select-all">
                                        <!-- <input style="text-align: center" class="form-check-input" type="checkbox" id="select-all" name="selected_denom[]" value="<?php echo $row->denom_id; ?>"> -->

                                        <label class="form-check-label" for="select-all">
                                       
                                        </label>
                                    </div>
                                   
                                </th> 

                                <th style="min-width: 70px">SRR No.</th>
                                <th style="min-width: 130px">Salesman Name</th>
                                <th style="min-width: 80px">Total Cash</th>
                                <th style="min-width: 80px">SM DC</th>
                                <th style="min-width: 80px">SM PDC</th>
                                <th style="min-width: 85px">Cashier DC</th>
                                <th style="min-width: 92px">Cashier PDC</th>
                                <th style="min-width: 127px">Total Remittance</th>
                                <th style="min-width: 117px">Total Collection</th>
                                <?php
                               
                                if ($this->session->userdata('location')=='LDI' || $this->session->userdata('location')=='LDI-CDC') { ?>

                                    <th>Total Returns</th>
                                    <th>Total W/Tax</th>
                                    <th>Total B.O</th>
                                
                                <?php } ?>
                                <th style="min-width: 55px">Status</th>
                                <th style="min-width: 150px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $row) { ?>
                            <tr>

                                <td style="text-align: center">
                                    <?php if ($row->status=='Pending' && $row->total_remittance != 0): ?>
                                        <input style="text-align: center" class="form-check-input" type="checkbox" id="select-all-denom" name="selected_denom[]" value="<?php echo $row->denom_id; ?>">
                                        <input type="hidden" class="form-control" style="text-align: center; background-color: white" name="location" id="location" value="<?php echo $this->session->userdata('location'); ?>" readonly>
                                    <?php endif; ?>

                                </td> 

                                <td style="text-align: center"><?php echo $row->denom_id; ?></td>
                                <td><?php echo $row->full_name; ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_cash,2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_dc,2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_pdc,2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->cashier_dc,2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->cashier_pdc,2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_collection,2); ?></td>
                                <td style="text-align: right"><?php echo number_format($row->total_remittance,2); ?></td>
                                <?php
                                
                                if ($this->session->userdata('location')=='LDI' || $this->session->userdata('location')=='LDI-CDC') { ?>

                                    <td style="text-align: right"><?php echo number_format($row->total_returns,2); ?></td>
                                    <td style="text-align: right"><?php echo number_format($row->vat,2); ?></td>
                                    <td style="text-align: right"><?php echo number_format($row->bo,2); ?></td>
                                
                                <?php } ?>
                                <td style="text-align: center"><?php if($row->status=="Pending") { echo "<span class='badge badge-danger'>".$row->status."</span>"; } else { echo "<span class='badge badge-primary'>".$row->status."</span>"; } ?></td>
                                <td align="center">
                                <?php if($row->date_added==date('Y-m-d')) { ?>


                                    <?php if($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC') { ?>
                                        <a title="View Denomination" style="color: black;cursor: pointer" data-toggle="modal" data-target="#viewSmDenom" onclick=viewsmdenom_content('<?php echo $row->denom_id; ?>')><i class="fas fa-dollar-sign fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php }else{ ?>
                                        <a title="View Denomination2" style="color: black;cursor: pointer" data-toggle="modal" data-target="#viewSmDenomLdi" onclick=viewsmdenom_content_ldi('<?php echo $row->denom_id; ?>')><i class="fas fa-dollar-sign fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <!-- <?php if($row->status=='Pending') { ?>
                                        <a title="Enter Total Remittance" style="color: brown;cursor: pointer" data-toggle="modal" data-target="#totalRemittance" onclick=cashier_remittance('<?php echo $row->denom_id; ?>')><?php if($row->total_remittance==0) { echo '<i class="far fa-check-circle fa-lg">'; }else{ echo '<i class="fas fa-check-circle fa-lg"></i>'; } ?></i></a>&nbsp;&nbsp;
                                    <?php } ?> -->
                                    <!-- <?php if($row->status=='Pending') { ?>
                                        <a title="Approve" style="color: #4967B4;cursor: pointer" onclick=approve_sm_denom('<?php echo $row->denom_id; ?>')><i class="far fa-thumbs-up fa-lg"></i></a>&nbsp;&nbsp;
                                    
                                    <?php } ?> -->


                                    <?php if($row->status=='Pending') { ?>

                                        <?php if($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC') { ?>
                                            <a title="Approve" style="color: #4967B4;cursor: pointer" onclick=approve_sm_denom('<?php echo $row->denom_id; ?>')><i class="far fa-thumbs-up fa-lg"></i></a>&nbsp;&nbsp;
                                        <?php }else{ ?>
                                            <a title="Approve2" style="color: #4967B4;cursor: pointer" onclick=approve_sm_denomldi('<?php echo $row->denom_id; ?>')><i class="far fa-thumbs-up fa-lg"></i></a>&nbsp;&nbsp;
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <a title="Disapprove" style="color: red;cursor: pointer" onclick=disapprove_sm_denom('<?php echo $row->denom_id; ?>')><i class="far fa-thumbs-down fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <?php if($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC') { ?>
                                        <a type="hidden" title="Check Entry" style="color: green;cursor: pointer" href="<?= base_url('/checkentry'); ?>/<?php echo $row->denom_id; ?>/<?php echo $row->date_added; ?>/<?php echo $row->user_id; ?>"><i class="fas fa-pen-alt fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <!-- <a title="View Checks" style="color: orange;cursor: pointer" href="<?= base_url('/viewsmchecks'); ?>/<?php echo $row->user_id; ?>/<?php echo $row->date_added; ?>/<?php echo $row->denom_id; ?>"><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp; -->
                                <?php }else{ ?>
                                    <?php if($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC') { ?>
                                        <a title="View Denomination" style="color: black;cursor: pointer" data-toggle="modal" data-target="#viewSmDenom" onclick=viewsmdenom_content('<?php echo $row->denom_id; ?>')><i class="fas fa-dollar-sign fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php }else{ ?>
                                        <a title="View Denomination2" style="color: black;cursor: pointer" data-toggle="modal" data-target="#viewSmDenomLdi" onclick=viewsmdenom_content_ldi('<?php echo $row->denom_id; ?>')><i class="fas fa-dollar-sign fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <!-- <a title="View Checks" style="color: orange;cursor: pointer" href="<?= base_url('/viewsmchecks'); ?>/<?php echo $row->user_id; ?>/<?php echo $row->date_added; ?>/<?php echo $row->denom_id; ?>"><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp; -->
                                    <?php if($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC') { ?>
                                        <a type="hidden" title="Check Entry" style="color: green;cursor: pointer" href="<?= base_url('/checkentry'); ?>/<?php echo $row->denom_id; ?>/<?php echo $row->date_added; ?>/<?php echo $row->user_id; ?>"><i class="fas fa-pen-alt fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php } ?>
                                <?php if($row->status=='Pending') { ?>
                                    <?php if($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC') { ?>
                                            <a title="Approve" style="color: #4967B4;cursor: pointer" onclick=approve_sm_denom('<?php echo $row->denom_id; ?>')><i class="far fa-thumbs-up fa-lg"></i></a>&nbsp;&nbsp;
                                        <?php }else{ ?>
                                            <a title="Approve2" style="color: #4967B4;cursor: pointer" onclick=approve_sm_denomldi('<?php echo $row->denom_id; ?>')><i class="far fa-thumbs-up fa-lg"></i></a>&nbsp;&nbsp;
                                        <?php } ?>
                                <?php }} ?>
                                    <a title="Remarks" style="color: #A074C4;cursor: pointer" data-toggle="modal" data-target="#cashierRemarks" onclick=cashier_remarks('<?php echo $row->denom_id; ?>')><?php if($row->remarks=="") { echo '<i class="far fa-comment fa-lg"></i>'; }else{ echo '<i class="fas fa-comment"></i>'; } ?></a>&nbsp;&nbsp;

                                    <?php if($this->session->userdata('user_id') =='2') { ?>
                                        <a title="Back Date" style="color: #A074C4;cursor: pointer" data-toggle="modal" data-target="#cashierBackdate" onclick=cashier_backdate('<?php echo $row->denom_id; ?>')><i class="fas fa-calendar fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php } ?>

                                    <?php if($row->status=='Approved') { ?>
                                        <?php if($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC') { ?>
                                        <a title="Print" style="color: #17a2b8;cursor: pointer" onclick=print_denom('<?php echo $row->denom_id; ?>')><i class="fas fa-print fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php }else{ ?>
                                        <a title="Print2" style="color: #17a2b8;cursor: pointer" onclick=print_denomldi('<?php echo $row->denom_id; ?>')><i class="fas fa-print fa-lg"></i></a>&nbsp;&nbsp;
                                    <?php } ?>

                                    <?php if($this->session->userdata('location')=='LDI') { ?>
                                    <a title="Upload" style="color: orange;cursor: pointer" onclick=upload_payments('<?php echo $row->denom_id; ?>')><i class="fas fa-upload fa-lg"></i></a>
                                    <?php }} ?>
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

<div id="cashierBackdate" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Back Date</h4>
        </div>
        <div class="modal-body">
            <form method="post" id="backdate_submit">
                <div id="backdate_content"></div>
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
    // Select all checkbox
    $(document).ready(function(){

        $('#approveButton').hide();


        $(document).on('click', '#select-all', function(event) {
            event.stopPropagation();
            
            // Toggle the state of all checkboxes excluding the header checkbox
            $('input[name="selected_denom[]"]').not(this).prop('checked', this.checked);

            updateButtonVisibility();
        });

        // Individual checkbox
        $(document).on('click', 'input[name="selected_denom[]"]', function() {
            if (!$(this).prop("checked")) {
                $('#select-all').prop("checked", false);
            }

            updateButtonVisibility();
        });

        function updateButtonVisibility() {
            var selectedValues = $('input[name="selected_denom[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            // Show or hide the button based on whether there are selected values
            if (selectedValues.length > 0) {
                $('#approveButton').show();
            } else {
                $('#approveButton').hide();
            }

            // Log or use the selected values as needed
            console.log(selectedValues);
        }


        $(document).on('click', '#approveButton', function(){
            
            // Get values of selected items
            var selectedValues = $('input[name="selected_denom[]"]:checked').map(function(){
                return $(this).val();
            }).get();

             var loc = document.getElementById('location').value;    

            if(loc !='LDI' && loc !='LDI-CDC')

                approve_sm_denoms(selectedValues);
            else{
                approve_sm_denomsldi(selectedValues);
            }
        });
        


    });

</script> 
