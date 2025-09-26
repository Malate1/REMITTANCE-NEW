<main>
    <div class="modal fade" id="managerKeyModal"  role="dialog" >
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Manager's Key</h4>
                </div>
                <div class="modal-body">
                <i><h6 style="color: red; " id="message"></h6></i>
                <p>Please input a cashier before entering the manager's key.</p>

                <input type="password" id="cashierInput" class="form-control" placeholder="Enter Cashier User Name" required>
                    <p>Please enter the manager's key to proceed.</p>
                    <input type="password" id="managerKeyInput" class="form-control" placeholder="Manager Key">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmKey" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <h4 class="mt-4">Denomination</h4>

        <?php
            $location = $this->session->userdata('location');
            $bu = $this->session->userdata('bu');
            $user_id = $this->session->userdata('user_id');
            $id_no = $this->session->userdata('id_no');
        ?>
        
        <form method="post" id="submit_sm_denom">
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-4 col-md-3">
                    <label for="note-1000">Notes</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-1000" id="note-1000" placeholder="1000" value="1000" readonly>
                </div>
                <div class="form-group col-4 col-md-3">
                    <label for="qty-1000">Quantity</label>
                    <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="qty-1000" id="qty-1000" onkeypress='return (event.charCode >= 48 && event.charCode <= 57)' oninput="calculate1000()">
                </div>
                <div class="form-group col-4 col-md-3">
                    <label for="amount-1000">Amount</label>
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-1000" id="hamount-1000" placeholder="0.00" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-1000" id="amount-1000" placeholder="0.00" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-4 col-md-3">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-500" id="note-500" placeholder="500" value="500" readonly>
                </div>
                <div class="form-group col-4 col-md-3">
                    <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="qty-500" id="qty-500" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate500()">
                </div>
                <div class="form-group col-4 col-md-3">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-500" id="hamount-500" placeholder="0.00" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-500" id="amount-500" placeholder="0.00" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-4 col-md-3">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-200" id="note-200" placeholder="200" value="200" readonly>
                </div>
                <div class="form-group col-4 col-md-3">
                    <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="qty-200" id="qty-200" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate200()">
                </div>
                <div class="form-group col-4 col-md-3">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-200" id="hamount-200" placeholder="0.00" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-200" id="amount-200" placeholder="0.00" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-4 col-md-3">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-100" id="note-100" placeholder="100" value="100" readonly>
                </div>
                <div class="form-group col-4 col-md-3">
                    <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="qty-100" id="qty-100" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate100()">
                </div>
                <div class="form-group col-4 col-md-3">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-100" id="hamount-100" placeholder="0.00" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-100" id="amount-100" placeholder="0.00" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-4 col-md-3">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-50" id="note-50" placeholder="50" value="50" readonly>
                </div>
                <div class="form-group col-4 col-md-3">
                    <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="qty-50" id="qty-50" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate50()">
                </div>
                <div class="form-group col-4 col-md-3">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-50" id="hamount-50" placeholder="0.00" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-50" id="amount-50" placeholder="0.00" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-4 col-md-3">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-20" id="note-20" placeholder="20" value="20" readonly>
                </div>
                <div class="form-group col-4 col-md-3">
                    <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="qty-20" id="qty-20" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate20()">
                </div>
                <div class="form-group col-4 col-md-3">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-20" id="hamount-20" placeholder="0.00" readonly>
                    <input type="hidden" class="form-control" style="text-align: center; background-color: white" name="location" id="location" value="<?php echo $location; ?>" readonly>
                    <input type="hidden" class="form-control" style="text-align: center; background-color: white" name="userid" id="userid" value="<?php echo $user_id; ?>" readonly>
                    <input type="hidden" class="form-control" style="text-align: center; background-color: white" name="bu" id="bu" value="<?php echo $bu; ?>" readonly>
                    <input type="hidden" class="form-control" style="text-align: center; background-color: white" name="sm_code" id="sm_code" value="<?php echo $id_no; ?>" readonly>

                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-20" id="amount-20" placeholder="0.00" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-12 col-md-12">
                    <label for="coins">Total Coins Amount</label>
                    <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="coins" id="coins" oninput="calculatecoins()">
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-6 col-md-4">
                    <label for="dc">Total DC Amt.</label>
                    <?php if($bu!='OPLAN' && $bu!='XTRUCK' && $bu!='XTRUCK-NETMAN' && $bu!='XTRUCK-MPDI' && $bu!='XTRUCK-NETMAN-BPI' && $bu!='MAS-LDI' && $bu!='MAS-NETMAN' && $bu!='MAS-MPDI') { ?>
                        <input type="text" min="0.1" step="any" class="form-control" autocomplete="off" style="text-align: center" name="dc" id="dc" oninput="calculatedc()">
                    <?php }else{ ?>
                        <input type="text" min="0.1" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="dc" id="dc" readonly>
                    <?php } ?>
                </div>
                <div class="form-group col-6 col-md-2">
                    <label for="dc_pcs">Pcs.</label>
                    <?php if($bu!='OPLAN' && $bu!='XTRUCK' && $bu!='XTRUCK-NETMAN' && $bu!='XTRUCK-MPDI' && $bu!='XTRUCK-NETMAN-BPI' && $bu!='MAS-LDI' && $bu!='MAS-NETMAN' && $bu!='MAS-MPDI') { ?>
                        <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="dc_pcs" id="dc_pcs" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    <?php }else{ ?>
                        <input type="number" min="1" step="1" class="form-control" style="text-align: center;background-color: white" name="dc_pcs" id="dc_pcs" onkeypress='return event.charCode >= 48 && event.charCode <= 57' readonly>
                    <?php } ?>
                </div>
                <div class="form-group col-6 col-md-4">
                    <label for="pdc">Total PDC Amt.</label>
                    <?php if($bu!='OPLAN' && $bu!='XTRUCK' && $bu!='XTRUCK-NETMAN' && $bu!='XTRUCK-MPDI' && $bu!='XTRUCK-NETMAN-BPI' && $bu!='MAS-LDI' && $bu!='MAS-NETMAN' && $bu!='MAS-MPDI') { ?>
                        <input type="text" min="0.1" step="any" class="form-control" autocomplete="off" style="text-align: center" name="pdc" id="pdc" oninput="calculatepdc()">
                    <?php }else{ ?>
                        <input type="text" min="0.1" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="pdc" id="pdc" readonly>
                    <?php } ?>
                </div>
                <div class="form-group col-6 col-md-2">
                    <label for="pdc_pcs">Pcs.</label>
                    <?php if($bu!='OPLAN' && $bu!='XTRUCK' && $bu!='XTRUCK-NETMAN' && $bu!='XTRUCK-MPDI' && $bu!='XTRUCK-NETMAN-BPI' && $bu!='MAS-LDI' && $bu!='MAS-NETMAN' && $bu!='MAS-MPDI') { ?>
                        <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="pdc_pcs" id="pdc_pcs" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    <?php }else{ ?>
                        <input type="number" min="1" step="1" class="form-control" style="text-align: center;background-color: white" name="pdc_pcs" id="pdc_pcs" onkeypress='return event.charCode >= 48 && event.charCode <= 57' readonly>
                    <?php } ?>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                

                    <?php
                    $validLocations = ['LDI', 'LDI-CDC', 'LDI-UDC', 'LDI-Parallel'];
                    $validBusinessUnits = ['OPLAN', 'XTRUCK', 'XTRUCK-NETMAN', 'XTRUCK-MPDI' , 'XTRUCK-NETMAN-BPI', 'MAS-LDI' , 'MAS-NETMAN' , 'MAS-MPDI'];

                    if (in_array($location, $validLocations) && in_array($bu, $validBusinessUnits)) {
                    ?>
                <div class="form-group col-12 col-md-6">
                <label for="totalcash">Total Cash Amount</label>
                    <input type="text" style="text-align: center;background-color: white" class="form-control" name="totalcash" id="totalcash" placeholder="0.00" autocomplete="off" readonly>
                    
                </div>
                
                <div class="form-group col-12 col-md-6">
                <label for="totalcash">Total Cash Amount from MyNet</label>
                   
                    <input type="numeric" style="text-align: center;background-color: white; font-weight: bold;" class="form-control" name="totalcash_ldi" id="totalcash_ldi" placeholder="0.00" oninput="calculatecash()" autocomplete="off" readonly>
                </div>
                <?php } else{ ?>
                    <div class="form-group col-12 col-md-6">
                        <label for="totalcash">Total Cash Amount</label>
                            <input type="text" style="text-align: center;background-color: white" class="form-control" name="totalcash" id="totalcash" placeholder="0.00" autocomplete="off" readonly>
                            
                        </div>
                <?php } ?>
            </div>
            
            <?php if($bu!='OPLAN' && $bu!='XTRUCK' && $bu!='XTRUCK-NETMAN' && $bu!='XTRUCK-MPDI' && $bu!="XTRUCK-NETMAN-BPI" && $bu!='MAS-LDI' && $bu!='MAS-NETMAN' && $bu!='MAS-MPDI') { ?>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-12 col-md-6">
                <label for="totalcash">Total Remittance Amount</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcollection" id="totalcollection" placeholder="0.00" autocomplete="off" readonly>
                </div>
            </div>
                <?php if($bu=='HORECA' || $bu=='FROZEN' || $bu=='MPDI' || $bu=='CVS' || $bu=='3PS' || $bu=='UNILAB'  ) { ?>

                    <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px; display: none;">
                        <div class="form-group col-12 col-md-6">
                            <label for="coins">Total Collection Amount</label>
                                
                                <input type="hidden" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: black;" name="totalremittance" id="totalremittance" value="0.00" required>
                        </div>
                    </div>

                    <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                        <?php if($bu=='MPDI' ) { ?>
                            <div class="form-group col-12 col-md-6">
                                <label for="totalcash">Total Amount on Manual SRR </label>
                                <input type="numeric" required style="text-align: center;background-color: white; font-weight: bold;" class="form-control" name="totalsrr" id="totalsrr" placeholder="0.00" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                                
                            </div>

                            <div class="form-group col-12 col-md-6">
                                <label for="totalcash">SRR No. (on manual SRR)</label>
                                <input type="number" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="manualsrr" id="manualsrr" required>
                                
                            </div>
                        <?php } ?>
                    </div>

                <?php }else{ ?>

                    <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px;">
                        <div class="form-group col-12 col-md-6">
                            <label for="coins">Total Collection Amount</label>
                            
                                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="totalremittance" id="totalremittance" required>
                        </div>
                    </div>
                <?php } ?>

            <?php }else{ ?>
                <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">

                <?php if($bu=='XTRUCK' || $bu=='XTRUCK-NETMAN' || $bu=='XTRUCK-MPDI' || $bu=='XTRUCK-NETMAN-BPI' || $bu == 'OPLAN' || $bu == 'MAS-LDI' || $bu == 'MAS-NETMAN' || $bu == 'MAS-MPDI') { ?>
                    <div class="form-group col-12 col-md-3">
                        <label for="totalcash">Total Remittance Amount on Manual SRR </label>
                        <input type="numeric" required style="text-align: center;background-color: white; font-weight: bold;" class="form-control" name="totalsrr" id="totalsrr" placeholder="0.00" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                        
                    </div>

                    <div class="form-group col-12 col-md-3">
                        <label for="totalcash">SRR No. (on manual SRR)</label>
                        <input type="number" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="manualsrr" id="manualsrr" required>
                        
                    </div>
                <?php }else{ ?>
                    <div class="form-group col-12 col-md-6">
                        <label for="totalcash">Total Remittance Amount on Manual SRR </label>
                        <input type="numeric" required style="text-align: center;background-color: white; font-weight: bold;" class="form-control" name="totalsrr" id="totalsrr" placeholder="0.00" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                    
                    </div>

                <?php } ?>

                <div class="form-group col-12 col-md-6">
                    <label for="totalcash">Total Remittance Amount on MyNet</label>
                    <input type="numeric" style="text-align: center;background-color: white; font-weight: bold;" class="form-control" name="totalcollection2" id="totalcollection2" placeholder="0.00" autocomplete="off" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px; display: none;">
            <!-- <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px;"> -->
                <div class="form-group col-12 col-md-6">
                    <label for="coins">Total Accountability Amount</label>
                    <?php if($location!='LDI' && $location!='LDI-CDC' && $location!='LDI-UDC') { ?>
                        <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="totalremittance" id="totalremittance" required>
                    <?php }else{ ?>
                        <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; " name="totalremittance" id="totalremittance" required readonly>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>




            
            <?php if(($location=='LDI' && $bu=='OPLAN') || ($location=='LDI-CDC' && $bu=='OPLAN') || ($location=='LDI-UDC' && $bu=='OPLAN') ||
                    ($location=='LDI' && $bu=='MAS-LDI') || ($location=='LDI-CDC' && $bu=='MAS-LDI') || ($location=='LDI-UDC' && $bu=='MAS-LDI') ||
                    ($location=='LDI' && $bu=='MAS-MPDI') || ($location=='LDI-CDC' && $bu=='MAS-MPDI') || ($location=='LDI-UDC' && $bu=='MAS-MPDI') ||
                    ($location=='LDI' && $bu=='MAS-NETMAN') || ($location=='LDI-CDC' && $bu=='MAS-NETMAN') || ($location=='LDI-UDC' && $bu=='MAS-NETMAN')
                    ) { ?>
                <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                    <div class="form-group col-12 col-md-6">
                        <label for="coins">Total Returns Amount</label>
                            
                            <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalreturns" id="totalreturns" required readonly>

                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalreturns_no" id="totalreturns_no" required readonly>
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpay_id" id="totalpay_id" required readonly>
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpaysat_id" id="totalpaysat_id" required readonly>
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpaypal_id" id="totalpaypal_id" required readonly>
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpayutc_id" id="totalpayutc_id" required readonly>
                            
                        
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label for="palawan"> Total Prebooking Palawan Remittance</label>

                        

                        <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpalawan" id="totalpalawan" required readonly>         

                        
                    </div>

                    
                </div>
            <?php }else if ($bu=='HORECA' || $bu=='FROZEN' || $bu=='MPDI' || $bu=='CVS' || $bu=='3PS' || $bu=='UNILAB' ){ ?>
                <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                    <div class="form-group col-12 col-md-6">
                        <label for="coins">Total Returns Amount</label>
                            
                            <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalreturns" id="totalreturns" oninput="calculatetotal()" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                            <div id="error-message3" style="color: red;"></div>


                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalreturns_no" id="totalreturns_no" required readonly>
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpay_id" id="totalpay_id" required readonly>
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpaysat_id" id="totalpaysat_id" required readonly>
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpaypal_id" id="totalpaypal_id" required readonly>
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpayutc_id" id="totalpayutc_id" required readonly>
                        
                    </div>
                    <?php if($bu=='MPDI') { ?>
                        <div class="form-group col-12 col-md-6">
                            <label for="palawan"> Total Palawan Remittance</label>
                                
                                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpalawan" id="totalpalawan"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                            
                        </div>
                    <?php } ?>

                    
                </div>
            <?php }else{ ?>

                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totalreturns" id="totalreturns" value="" required readonly>
                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totalreturns_no" id="totalreturns_no" value="" required readonly>
                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totalpay_id" id="totalpay_id" value="" required readonly>
                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totalpaysat_id" id="totalpaysat_id" value="" required readonly>
                <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpaypal_id" id="totalpaypal_id" required readonly>
                <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpayutc_id" id="totalpayutc_id" required readonly>
                
            <?php } ?>

            <?php if(($location=='LDI' && ($bu !="XTRUCK" && $bu !="XTRUCK-NETMAN" && $bu !="XTRUCK-MPDI" && $bu!="XTRUCK-NETMAN-BPI" )) || ($location=='LDI-CDC' && ($bu !="XTRUCK" && $bu !="XTRUCK-NETMAN" && $bu !="XTRUCK-MPDI" && $bu!="XTRUCK-NETMAN-BPI"  )) || ($location=='LDI-UDC' && ($bu !="XTRUCK" && $bu !="XTRUCK-NETMAN" && $bu !="XTRUCK-MPDI" && $bu!="XTRUCK-NETMAN-BPI" )) ) { ?>
                <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                    
                    <?php if(($location=='LDI' && $bu=='OPLAN') || ($location=='LDI-CDC' && $bu=='OPLAN') || ($location=='LDI-UDC' && $bu=='OPLAN') ||
                    ($location=='LDI' && $bu=='MAS-LDI') || ($location=='LDI-CDC' && $bu=='MAS-LDI') || ($location=='LDI-UDC' && $bu=='MAS-LDI') ||
                    ($location=='LDI' && $bu=='MAS-MPDI') || ($location=='LDI-CDC' && $bu=='MAS-MPDI') || ($location=='LDI-UDC' && $bu=='MAS-MPDI') ||
                    ($location=='LDI' && $bu=='MAS-NETMAN') || ($location=='LDI-CDC' && $bu=='MAS-NETMAN') || ($location=='LDI-UDC' && $bu=='MAS-NETMAN')
                    ) { ?>
                        <div class="form-group col-md-6" style="width: 550px">
                            <label for="coins">Total W/Tax Amount PREBOOKING</label>
                            
                            <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totaltax" id="totaltax" required readonly>
                        </div>

                        <div class="form-group col-md-6" style="width: 550px">
                        <label for="coins">Total B.O Amount PREBOOKING ( Discount:  <span style="color: red; font-style: italic" id="totalbo_disc"></span> | B.O/CM: <span style="color: red; font-style: italic" id="bo_cm"></span>)  </label>
                            
                            <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalbo" id="totalbo" required readonly>
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; " name="totalbo_id" id="totalbo_id" required readonly>
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; " name="totalbo_si" id="totalbo_si" required readonly>
                        </div>
                    <?php } else{ ?>
                        <div class="form-group col-md-6" style="width: 550px">
                            <label for="coins">Total W/Tax Amount</label>
                            <input type="text" min="0.1" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totaltax" id="totaltax" oninput="calculatetotal()" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                            <div id="error-message" style="color: red;"></div>
                        </div>

                        <div class="form-group col-12 col-md-6">
                        <label for="coins">Total B.O Amount</label>
                            
                            <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalbo" id="totalbo" oninput="calculatetotal()" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                            <div id="error-message2" style="color: red;"></div>
                        </div>
                    <?php } ?>


                    
                </div>
            <?php }else{ ?>
                <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                    <div class="form-group col-md-6" style="width:550px; display: none;">
                            <label for="coins">Total B.O/ Change Item Amount</label>
                                
                                <input type="text" style="text-align: center;background-color: white; font-weight: bold;" class="form-control" name="totalbo" id="totalbo" placeholder="0.00" autocomplete="off" readonly>
                                <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; " name="totalbo_id" id="totalbo_id" required readonly>
                                <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; " name="totalbo_si" id="totalbo_si" required readonly>
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label for="coins">Enter Salesman Incentive 
                            <span id="available_incentives" style="color: red; font-size: smaller; font-style: italic;"> </span>
                            <span  style="color: red; font-size: smaller; font-style: italic;"> 
                                <br>Note: Get Incentives before mag input sa denomination
                            </span>
                        </label>

                        <input type="hidden" min="0.0" step="any" placeholder="0.00" class="form-control" autocomplete="off" readonly 
                            style="text-align: center;background-color: white; font-weight: bold;" name="totalincentives" id="totalincentives">

                        <input type="text" min="0.0" step="any" placeholder="0.00" class="form-control" autocomplete="off"  
                            style="text-align: center;background-color: white; font-weight: bold;" name="totalinc" id="totalinc" 
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">          

                        <!-- Checkbox to use all available incentives -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="useAllIncentives">
                            <label class="form-check-label" for="useAllIncentives">
                                Get all incentives
                            </label>
                        </div>
                    </div>

                    <script>
                        document.getElementById('useAllIncentives').addEventListener('change', function() {
                            if (this.checked) {
                                // Use all available incentives
                                document.getElementById('totalinc').value = document.getElementById('totalincentives').value;
                                document.getElementById('totalinc').readOnly = true; // Make input readonly when checked
                            } else {
                                // Allow manual input
                                document.getElementById('totalinc').value = '';
                                document.getElementById('totalinc').readOnly = false; // Allow input when unchecked
                            }
                        });

                        
                    </script>


                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var totalIncentivesInput = document.getElementById('totalincentives');
                            var totalIncInput = document.getElementById('totalinc');
                            var incentiveDisplay = document.getElementById('available_incentives');
                            var avail_inc = totalIncentivesInput.value;
                            console.log(avail_inc);
                            function updateIncentiveDisplay() {
                                
                                
                                var avail_inc2 = parseFloat(avail_inc.replace(/,/g, '')) || 0; // Convert to number
                                incentiveDisplay.textContent = '(Available: ' + avail_inc2.toFixed(2) + ')';

                                if (avail_inc2 === 0) {
                                    totalIncInput.disabled = true;
                                } else {
                                    totalIncInput.disabled = false;
                                }
                            }

                            // Set initial value of totalIncentivesInput to 0.00
                            totalIncentivesInput.value = '0.00';

                            // Initial update when the page loads
                            updateIncentiveDisplay();

                            // If totalincentives value is changed dynamically, update the display
                            //totalIncentivesInput.addEventListener('input', updateIncentiveDisplay);
                        });

                    </script>

                    <script>
                        // Function to monitor quantity inputs and disable the checkbox
                        function monitorQuantities() {
                            // Select all quantity inputs
                            var quantityInputs = document.querySelectorAll('input[id^="qty-"]');
                            var useAllIncentivesCheckbox = document.getElementById('useAllIncentives');

                            quantityInputs.forEach(function(input) {
                                input.addEventListener('input', function() {
                                    // Check if any quantity field has a non-zero value
                                    var anyQuantityEntered = Array.from(quantityInputs).some(function(input) {
                                        return input.value.trim() !== '' && parseInt(input.value) > 0;
                                    });

                                    // Disable the checkbox if any quantity is entered
                                    useAllIncentivesCheckbox.disabled = anyQuantityEntered;
                                });
                            });
                        }

                        // Initialize the monitoring function when the page loads
                        document.addEventListener('DOMContentLoaded', monitorQuantities);
                    </script>
                    <!-- For Monday -->
                    <div class="form-group col-12 col-md-3">
                        <label for="palawan"> Total Palawan Remittances</label>

                        <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpalawan" id="totalpalawan" required readonly>         

                        
                    </div>

                    <div class="form-group col-12 col-md-3">
                        <label for="palawanactual"> Actual Palawan Remittance</label>

                        <input type="text" min="0.0" step="any" class="form-control"  style="text-align: center;background-color: white;" name="totalpalawanactual" id="totalpalawanactual" placeholder="0.00" autocomplete="off" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" >         

                        
                    </div>

                </div>
                <!-- <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totaltax" id="totaltax" value="" required readonly>
                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totalbo" id="totalbo" value="" required readonly> <span style="color: red; font-style: italic;"> ( for viewin)</span> -->
            <?php } ?>

            <!-- <?php if(($location=='LDI' && $bu=='XTRUCK') || ($location=='LDI-CDC' && $bu=='XTRUCK')) { ?>
                <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                    <div class="form-group col-12 col-md-6">
                        <label for="coins">Total B.O/ Change Item Amount</label>
                            
                            
                            <input type="text" style="text-align: center;background-color: white; font-weight: bold;" class="form-control" name="totalbo" id="totalbo" placeholder="0.00" autocomplete="off" readonly>

                          
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalbo_id" id="totalbo_id" required readonly>
                        
                    </div>

                    
                </div>
            <?php }  ?> -->

            <?php if($location!='LDI' && $location!='LDI-CDC' && $location!='LDI-UDC' && $location!='LDI-Parallel') { ?>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-12 col-md-6">
                    <label for="coins">Expenses Amount</label>
                    <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="expenses_amt" id="expenses_amt">
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-12 col-md-6">
                <label for="totalcash">Expenses Details</label>
                <textarea class="form-control" id="expenses" name="expenses" autocomplete="off" rows="3"></textarea>
                </div>
            </div>
            <?php }else{ ?>
                <input type="hidden" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="expenses_amt" id="expenses_amt" value="">
                <input type="hidden" class="form-control" id="expenses" name="expenses" autocomplete="off"  value="">
            <?php } ?>
            <br>
            <input type="hidden" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="date" id="date" autocomplete="off">
            <!-- <button type="submit" class="btn btn-primary" id="saveButton" style="font-size:20px">Save Denomination</button> -->
            <button type="submit" class="btn btn-sm btn-primary" id="saveButton"  
                <?php if (in_array($location, ['LDI', 'LDI-CDC', 'LDI-UDC']) && in_array($bu, ['XTRUCK', 'XTRUCK-NETMAN', 'XTRUCK-NETMAN-BPI'])) { 
                        echo 'disabled'; 
                } ?>>
                Save Denomination
            </button>
            <?php if(($location=='LDI' && $bu=='OPLAN') || ($location=='LDI-CDC' && $bu=='OPLAN') ||
                    ($location=='LDI' && $bu=='MAS-LDI') || ($location=='LDI-CDC' && $bu=='MAS-LDI') ||
                    ($location=='LDI' && $bu=='MAS-MPDI') || ($location=='LDI-CDC' && $bu=='MAS-MPDI') ||
                    ($location=='LDI' && $bu=='MAS-NETMAN') || ($location=='LDI-CDC' && $bu=='MAS-NETMAN')) { ?>
                <button type="button" class="btn btn-sm btn-warning" style="float: right;font-weight:bold;" onclick=getcollection("<?php echo $this->session->userdata('id_no'); ?>","<?php echo date('Y-m-d'); ?>")>Get Collection Amount</button>
            <?php } ?>

      

                <?php
                $validLocations = ['LDI', 'LDI-CDC', 'LDI-UDC', 'LDI-Parallel'];
                $validBusinessUnits = ['XTRUCK', 'XTRUCK-MPDI', 'XTRUCK-NETMAN' , 'XTRUCK-NETMAN-BPI'];

                if (in_array($location, $validLocations) && in_array($bu, $validBusinessUnits)) {
                ?>

                <button type="button" class="btn btn-sm btn-warning " style="float: right;font-weight:bold;" onclick=getcollectionldi("<?php echo $this->session->userdata('id_no'); ?>","<?php echo date('Y-m-d'); ?>")>Get Collection Amount</button>

                <!-- <button type="button" class="btn btn-sm btn-info" style="float: right;font-weight:bold;margin-right:5px;"
                    data-toggle="modal" data-target="#auditedModal">
                    Get Audited Amount
                </button> -->

                
                <div id="auditedModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"> 
                    <div class="modal-dialog">
                        <div class="modal-content">

                            
                            <div class="modal-header">
                                <h4 class="modal-title">Manager Authorization</h4>
                            </div>
                            <div class="modal-body" id="auth-step">
                                <label for="manager_key">Enter Manager's Key:</label>
                                <input type="password" id="manager_key" class="form-control" placeholder="Manager Key">
                            </div>
                            <div class="modal-footer" id="auth-footer">
                                <button type="button" class="btn btn-primary" onclick="validateManagerKey()">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>

                            
                            <div class="modal-body" id="daterange-step" style="display:none;">
                                <label>Start Date & Time:</label>
                                <input type="datetime-local" id="start_date" class="form-control">

                                <label>End Date & Time:</label>
                                <input type="datetime-local" id="end_date" class="form-control">
                            </div>
                            <div class="modal-footer" id="daterange-footer" style="display:none;">
                                <button type="button" class="btn btn-success" onclick="submitAuditedForm()">Get Audited Amount</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>


            <?php } ?>
            <br/><br/>
        </form>
      
    </div>

    <script>
        const startInput = document.getElementById("start_date");
        const endInput   = document.getElementById("end_date");

        // When start date changes → set min for end date
        startInput.addEventListener("change", function() {
            let startDate = this.value;
            endInput.min = startDate;

            // If end date is earlier than start date → correct it
            if (endInput.value && endInput.value < startDate) {
                endInput.value = startDate;
            }
        });

        // When end date changes → set max for start date
        endInput.addEventListener("change", function() {
            let endDate = this.value;
            startInput.max = endDate;

            // If start date is later than end date → correct it
            if (startInput.value && startInput.value > endDate) {
                startInput.value = endDate;
            }
        });
    </script>

    <script type="text/javascript">

        document.getElementById('manualsrr').addEventListener('keydown', function(e) {
            if (['e', 'E', '+', '-'].includes(e.key)) {
            e.preventDefault();
            }
        });

        function validateManagerKey() {
            let key = document.getElementById("manager_key").value;

            if (key === "aris2020") { // 🔑 replace with server-side validation if needed
                // Hide manager key step
                document.getElementById("auth-step").style.display = "none";
                document.getElementById("auth-footer").style.display = "none";

                // Show date range step
                document.getElementById("daterange-step").style.display = "block";
                document.getElementById("daterange-footer").style.display = "block";
            } else {
                //alert("Invalid Manager Key!");
                swal({
                    title: "Invalid Manager Key!",
                    type: "error",
                    showCancelbutton: false
                });
                return;
            }
        }

        function submitAuditedForm() {
            let start = document.getElementById("start_date").value;
            let end = document.getElementById("end_date").value;

            if (!start || !end) {
                //alert("Please select both start and end date/time!");

                swal({
                    title: "Please select both start and end date/time!",
                    type: "error",
                    showCancelbutton: false
                });
                return;
            }

            getcollectionldiaudit("<?php echo $this->session->userdata('id_no'); ?>", start,end);

            $('#auditedModal').modal('hide');
        }

        // // Reset modal every time it closes
        // $('#auditedModal').on('hidden.bs.modal', function () {
        //     // Reset fields
        //     document.getElementById("manager_key").value = "";

        //     // Show manager key step again
        //     document.getElementById("auth-step").style.display = "block";
        //     document.getElementById("auth-footer").style.display = "block";

        //     // Hide daterange form
        //     document.getElementById("daterange-step").style.display = "none";
        //     document.getElementById("daterange-footer").style.display = "none";
        // });
        
        function validateInput() {
            var inputElement = document.getElementById("totaltax");
            var errorMessageElement = document.getElementById("error-message");
            var saveButton = document.getElementById("saveButton");
            var inputValue = inputElement.value;

            // Check if the input contains any invalid characters
            if (/[^0-9.,]/.test(inputValue)) {
                // Display an error message
                errorMessageElement.textContent = "Invalid input. Please enter only numbers, commas, and periods.";
                saveButton.disabled = true;
            } else {
                // Remove the error message if the input is valid
                errorMessageElement.textContent = "";

                // Remove any characters other than numbers, commas, and periods
                var cleanedValue = inputValue.replace(/[^0-9.,]/g, '');

                // Update the input field with the cleaned value
                inputElement.value = cleanedValue;
                saveButton.disabled = false;
            }
        }

        function validateInput2() {
            var inputElement = document.getElementById("totalbo");
            var errorMessageElement = document.getElementById("error-message2");
            var saveButton = document.getElementById("saveButton");
            var inputValue = inputElement.value;

            // Check if the input contains any invalid characters
            if (/[^0-9.,]/.test(inputValue)) {
                // Display an error message
                errorMessageElement.textContent = "Invalid input. Please enter only numbers, commas, and periods.";
                saveButton.disabled = true;

            } else {
                // Remove the error message if the input is valid
                errorMessageElement.textContent = "";

                // Remove any characters other than numbers, commas, and periods
                var cleanedValue = inputValue.replace(/[^0-9.,]/g, '');

                // Update the input field with the cleaned value
                inputElement.value = cleanedValue;
                saveButton.disabled = false;
            }
        }

        function validateInput3() {
            var inputElement = document.getElementById("totalreturns");
            var errorMessageElement = document.getElementById("error-message3");
            var saveButton = document.getElementById("saveButton");
            var inputValue = inputElement.value;

            // Check if the input contains any invalid characters
            if (/[^0-9.,]/.test(inputValue)) {
                // Display an error message
                errorMessageElement.textContent = "Invalid input. Please enter only numbers, commas, and periods.";
                saveButton.disabled = true;

            } else {
                // Remove the error message if the input is valid
                errorMessageElement.textContent = "";

                // Remove any characters other than numbers, commas, and periods
                var cleanedValue = inputValue.replace(/[^0-9.,]/g, '');

                // Update the input field with the cleaned value
                inputElement.value = cleanedValue;
                saveButton.disabled = false;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var incInput = document.getElementById('totalinc');
            var remitInput = document.getElementById('totalcollection2');
            var avail_incentives = document.getElementById('totalincentives');
            var final_cash = document.getElementById('totalcash_ldi');
            var useAllIncentivesCheckbox = document.getElementById('useAllIncentives'); 

            // Variables to store the default values
            var initialRemitValue = remitInput.value;
            var initialFinalCashValue = final_cash.value;

            // Debounce function to delay the execution of the callback
            function debounce(callback, delay) {
                var debounceTimeout;
                return function() {
                    clearTimeout(debounceTimeout);
                    debounceTimeout = setTimeout(callback, delay);
                };
            }

            // Function to handle the input change and update values
            function updateValues() {
                if (remitInput.value === '' && final_cash.value === '') {
                    return; // Exit early if both values are empty
                }

                var bu = document.querySelector("[name='bu']").value;
                var inc = incInput.value;
                var inc2 = parseFloat(inc.replace(/,/g, '')) || 0; // Convert to number
                var avail_inc = avail_incentives.value;
                var avail_inc2 = parseFloat(avail_inc.replace(/,/g, '')) || 0; // Convert to number

                if (inc2 > avail_inc2) {
                    swal({
                        title: "Salesman incentive amount must be within the total available incentives (" + avail_inc + ")",
                        type: "error",
                        showCancelButton: false
                    }, function() {
                        // Reset the specific field after the alert is closed
                        incInput.value = '';
                        remitInput.value = initialRemitValue; // Reset to initial value
                        final_cash.value = initialFinalCashValue; // Reset to initial value
                        getcollectionldi("<?php echo $this->session->userdata('id_no'); ?>","<?php echo date('Y-m-d'); ?>");
                    });
                    return 0;
                }

                if (bu === 'XTRUCK' || bu === 'XTRUCK-NETMAN' || bu === 'XTRUCK-MPDI' || bu === 'XTRUCK-NETMAN-BPI') {
                    var remit = remitInput.value;
                    var remit2 = parseFloat(remit.replace(/,/g, '')) || 0;
                    var finalCashValue = parseFloat(final_cash.value.replace(/,/g, '')) || 0;
                    var finalRemitValue = parseFloat(remitInput.value.replace(/,/g, '')) || 0;

                    finalCashValue -= inc2;
                    finalRemitValue -= inc2;

                    final_cash.value = finalCashValue.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    remitInput.value = finalRemitValue.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            }

            // Debounced version of the updateValues function
            var debouncedUpdateValues = debounce(updateValues, 2000);

            incInput.addEventListener('input', function() {
                useAllIncentivesCheckbox.disabled = true; // Disable the checkbox if the user manually inputs a value
                debouncedUpdateValues(); // Call the debounced update function
            });

            incInput.addEventListener('input', function() {
            if (incInput.value === '') {
                // If the user clears the manual input, reset to the default values
                remitInput.value = initialRemitValue; // Reset to default remit value
                final_cash.value = initialFinalCashValue; // Reset to default final cash value
                getcollectionldi("<?php echo $this->session->userdata('id_no'); ?>","<?php echo date('Y-m-d'); ?>");
                useAllIncentivesCheckbox.disabled = false; // Enable the checkbox again
            } else { 
                useAllIncentivesCheckbox.disabled = true; // Disable the checkbox if the user manually inputs a value
                debouncedUpdateValues(); // Call the debounced update function
            }
            });


            useAllIncentivesCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    incInput.value = avail_incentives.value;
                    incInput.readOnly = true; // Make the input read-only when using all incentives
                } else {
                    incInput.value = '';
                    remitInput.value = initialRemitValue; // Reset to default value instead of emptying
                    final_cash.value = initialFinalCashValue; // Reset to default value instead of emptying
                    incInput.readOnly = false; // Allow manual input when unchecked
                    getcollectionldi("<?php echo $this->session->userdata('id_no'); ?>","<?php echo date('Y-m-d'); ?>");
                }
                updateValues();
            });
        });

    </script>

    <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $("#manualsrr").on("keyup", function () {
                var manualsrr = $(this).val().trim();

                if (manualsrr !== "") {
                    $.ajax({
                        url: "<?= base_url('Cont_Denom/check_manualsrr_exists') ?>",
                        type: "POST",
                        data: { manualsrr: manualsrr },
                        dataType: "json",
                        success: function (response) {
                            if (response.exists) {
                                //alert("The SRR No. is already in use. Please enter a different one.");
                                swal({
                                    title: "The SRR No. is already in use. Please enter a different one!",
                                    type: "error",
                                    showCancelbutton: false
                                });
                                $("#manualsrr").val("").focus();
                            }
                        },
                        error: function () {
                            alert("Error checking SRR No. Please try again.");
                        }
                    });
                }
            });
        });

        document.getElementById("totalpalawanactual").addEventListener("blur", function() {
            function parseNumber(value) {
                return parseFloat(value.replace(/,/g, '')) || 0;
            }

            let totalPalawan = parseNumber(document.getElementById("totalpalawan").value);
            let totalPalawanActual = parseNumber(this.value);

            var saveButton = document.getElementById("saveButton");

            if (totalPalawanActual !== totalPalawan) {
                swal({
                    type: 'error',
                    title: 'Mismatch Detected!',
                    text: 'Actual Palawan Remittance does not match the Total Palawan Remittance.',
                });
                saveButton.disabled = true; // Disable the save button
            }else{
                saveButton.disabled = false; // Enable the save button
            }
        });

        document.getElementById("totalsrr").addEventListener("blur", function() {
            function parseNumber(value) {
                return parseFloat(value.replace(/,/g, '')) || 0;
            }

            let totalCollection = parseNumber(document.getElementById("totalcollection2").value);
            let totalSrr = parseNumber(this.value);

            var saveButton = document.getElementById("saveButton");

            if (totalSrr > totalCollection) {
                swal({
                    type: 'warning',
                    title: 'Warning',
                    text: `The manual SRR amount (${totalSrr.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}) 
                    must not exceed the actual remitted amount (${totalCollection.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}).`,
                });
                saveButton.disabled = true; // Disable the save button
            }else{
                saveButton.disabled = false; // Enable the save button
            }
        });
    </script>
</main>