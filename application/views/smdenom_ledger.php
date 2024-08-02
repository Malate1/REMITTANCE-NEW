<main>
    <div class="container-fluid">
        <h4 class="mt-4">Salesman Record <label style="font-size:16px;color: red;font-style: italic">(Previous records or has been approved by the cashier cannot be edited or deleted!)</label></h4>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Denomination List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover compact" id="sm_denom_ledger" width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center">
                                <th>Date</th>
                                <!-- <th>1000</th>
                                <th>500</th>
                                <th>200</th>
                                <th>100</th>
                                <th>50</th>
                                <th>20</th>
                                <th>Coins</th> -->
                                <td>SRR No.</td>
                                <th>DC</th>
                                <th>PDC</th>
                                <th>Total Cash</th>
                                <th>Total Remittance</th>
                                
                                <?php
                               
                                if ($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC') { ?>

                                    <th>Total Collection</th>
                                
                                <?php } ?>
                                <?php
                               
                                if ($this->session->userdata('location')=='LDI' || $this->session->userdata('location')=='LDI-CDC') { ?>

                                    <th>Total Returns</th>
                                    <th>Total W/Tax</th>
                                    <th>Total BO</th>
                                
                                <?php } ?>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $row) { ?>
                            <tr style="text-align: right">
                            <td style="text-align: center"><?php echo $row->date_added; ?></td>
                            <!-- <td><?php echo number_format($row->amt_1000,2); ?></td>
                            <td><?php echo number_format($row->amt_500,2); ?></td>
                            <td><?php echo number_format($row->amt_200,2); ?></td>
                            <td><?php echo number_format($row->amt_100,2); ?></td>
                            <td><?php echo number_format($row->amt_50,2); ?></td>
                            <td><?php echo number_format($row->amt_20,2); ?></td>
                            <td><?php echo number_format($row->total_coins,2); ?></td> -->
                            <td style="text-align:center"><?php echo $row->denom_id; ?></td>
                            <td><?php echo number_format($row->total_dc,2); ?></td>
                            <td><?php echo number_format($row->total_pdc,2); ?></td>
                            <td><?php echo number_format($row->total_cash,2); ?></td>
                            <td><?php echo number_format($row->total_collection,2); ?></td>
                            
                            <?php
                               
                                if ($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC') { ?>

                                    <td><?php echo number_format($row->total_remittance,2); ?></td>
                                
                            <?php } ?>
                            <?php
                               
                                if ($this->session->userdata('location')=='LDI' || $this->session->userdata('location')=='LDI-CDC' ) { ?>

                                    <td><?php echo number_format($row->total_returns,2); ?></td>
                                    <td><?php echo number_format($row->vat,2); ?></td>
                                    <td><?php echo number_format($row->bo,2); ?></td>
                                
                            <?php } ?>
                            <td style="text-align: center"><?php if($row->status=="") { echo "<span class='badge badge-danger'>Pending</span>"; } else { echo "<span class='badge badge-primary'>".$row->status."</span>"; } ?></td>
                            <td align="center">
                            <?php if($row->date_added==date('Y-m-d') && $row->status=="") { ?>
                            <a title="Modify Denomination" style="color: green;cursor: pointer" href="<?= base_url('/smdenom_edit'); ?>/<?php echo $row->denom_id; ?>"><i class="fas fa-pen fa-lg"></i></a>&nbsp;&nbsp;

                            <?php if($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-HORECA' && $this->session->userdata('location')!='LDI-FROZEN' && $this->session->userdata('location')!='LDI-MPDI' && $this->session->userdata('location')!='LDI-CVS' && $this->session->userdata('location')!='LDI-3PS') { ?>
                                <a title="View Denomination" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewSmDenom" onclick=viewsmdenom_content("<?php echo $row->denom_id; ?>")><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;

                            <?php }else{ ?>
                                <a title="View Denomination2" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewSmDenomLdi" onclick=viewsmdenom_content_ldi("<?php echo $row->denom_id; ?>")><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;
                            <?php } ?>
                            <a title="Delete Denomination" style="color: red;cursor: pointer" onclick=deletedenom_content("<?php echo $row->denom_id; ?>")><i class="fas fa-trash fa-lg"></i></a>&nbsp;&nbsp;
                            <?php }else{ ?>
                                <?php if($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC') { ?>
                                <a title="View Denomination" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewSmDenom" onclick=viewsmdenom_content("<?php echo $row->denom_id; ?>")><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;

                                <?php }else{ ?>
                                    <a title="View Denomination2" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewSmDenomLdi" onclick=viewsmdenom_content_ldi("<?php echo $row->denom_id; ?>")><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;
                                <?php } ?>
                            <?php } ?>
                            <?php if($row->remarks != "") { ?>
                            <a title="Remarks" style="color: orange;cursor: pointer" data-toggle="modal" data-target="#cashierRemarks" onclick=cashier_remarks2("<?php echo $row->denom_id; ?>")><i class="far fa-comment-dots fa-lg"></i></a>&nbsp;&nbsp;
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

<div id="viewSmDenom" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">

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
    <div class="modal-dialog modal-dialog-scrollable modal-lg">

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