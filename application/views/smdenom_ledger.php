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
                                
                                <th>SRR No.</th>
                                <th>DC</th>
                                <th>PDC</th>
                                <th>Total Cash</th>
                                <th>Total Palawan Cash</th>
                                <th>Total Remittance</th>
                                
                                <?php
                               
                                if ($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC' && $this->session->userdata('location')!='LDI-UDC' ) { ?>

                                    <th>Total Collection</th>
                                
                                <?php } ?>
                                <?php
                               
                                if ($this->session->userdata('location')=='LDI' || $this->session->userdata('location')=='LDI-CDC' || $this->session->userdata('location')=='LDI-UDC') { ?>

                                    <th>Total Returns</th>
                                    <!-- <th>Total W/Tax</th> -->
                                    <th>Total BO</th>
                                
                                <?php } ?>
                                <?php if ($this->session->userdata('bu')=='XTRUCK' || $this->session->userdata('bu')=='XTRUCK-NETMAN' || $this->session->userdata('bu')=='XTRUCK-MPDI' || $this->session->userdata('bu')=='XTRUCK-NETMAN-BPI') { ?>

                                    <th>SM Incentives</th>
                                   
                                
                                <?php } ?>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
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