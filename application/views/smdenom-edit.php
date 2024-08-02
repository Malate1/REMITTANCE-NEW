<main>
    <div class="container-fluid">
        <h4 class="mt-4">Denomination</h4><br/>

        <!-- <div class="col-xl-6"> -->
        <form method="post" id="edit_sm_denom">
            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" placeholder="id" value="<?php echo $result->denom_id; ?>">
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:150px">
                    <label for="note-1000">Notes</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-1000" id="note-1000" placeholder="1000" value="1000" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <label for="qty-1000">Quantity</label>
                    <input autocomplete="off" min="1" step="1" type="number" class="form-control" style="text-align: center" name="qty-1000" id="qty-1000" value="<?php if($result->qty_1000==0){echo "";}else{echo $result->qty_1000;} ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate1000()">
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <label for="amount-1000">Amount</label>
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-1000" id="hamount-1000" placeholder="0.00" value="<?php echo $result->amt_1000; ?>" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-1000" id="amount-1000" placeholder="0.00" value="<?php echo number_format($result->amt_1000,2); ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:150px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-500" id="note-500" placeholder="500" value="500" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input autocomplete="off" min="1" step="1" type="number" class="form-control" style="text-align: center" name="qty-500" id="qty-500" value="<?php if($result->qty_500==0){echo "";}else{echo $result->qty_500;} ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate500()">
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-500" id="hamount-500" placeholder="0.00" value="<?php echo $result->amt_500; ?>" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-500" id="amount-500" placeholder="0.00" value="<?php echo number_format($result->amt_500,2); ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:150px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-200" id="note-200" placeholder="200" value="200" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input autocomplete="off" min="1" step="1" type="number" class="form-control" style="text-align: center" name="qty-200" id="qty-200" value="<?php if($result->qty_200==0){echo "";}else{echo $result->qty_200;} ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate200()">
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-200" id="hamount-200" placeholder="0.00" value="<?php echo $result->amt_200; ?>" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-200" id="amount-200" placeholder="0.00" value="<?php echo number_format($result->amt_200,2); ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:150px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-100" id="note-100" placeholder="100" value="100" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input autocomplete="off" min="1" step="1" type="number" class="form-control" style="text-align: center" name="qty-100" id="qty-100" value="<?php if($result->qty_100==0){echo "";}else{echo $result->qty_100;} ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate100()">
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-100" id="hamount-100" placeholder="0.00" value="<?php echo $result->amt_100; ?>" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-100" id="amount-100" placeholder="0.00" value="<?php echo number_format($result->amt_100,2); ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:150px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-50" id="note-50" placeholder="50" value="50" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input autocomplete="off" min="1" step="1" type="number" class="form-control" style="text-align: center" name="qty-50" id="qty-50" value="<?php if($result->qty_50==0){echo "";}else{echo $result->qty_50;} ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate50()">
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-50" id="hamount-50" placeholder="0.00" value="<?php echo $result->amt_50; ?>" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-50" id="amount-50" placeholder="0.00" value="<?php echo number_format($result->amt_50,2); ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:150px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-20" id="note-20" placeholder="20" value="20" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input autocomplete="off" min="1" step="1" type="number" class="form-control" style="text-align: center" name="qty-20" id="qty-20" value="<?php if($result->qty_20==0){echo "";}else{echo $result->qty_20;} ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate20()">
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-20" id="hamount-20" placeholder="0.00" value="<?php echo $result->amt_20; ?>" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-20" id="amount-20" placeholder="0.00" value="<?php echo number_format($result->amt_20,2); ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
                    <label for="coins">Total Coins Amount</label>
                    <input type="text" min="0.1" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="coins" id="coins" value="<?php if($result->total_coins==0){echo "";}else{echo number_format($result->total_coins,2);} ?>" oninput="calculatecoins()">
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-4" style="width:275px">
                    <label for="dc">Total DC Amt.</label>
                    <?php if($this->session->userdata('bu')!='OPLAN') { ?>
                        <input autocomplete="off" min="0.1" step="any" type="text" autocomplete="off" class="form-control" style="text-align: center" name="dc" id="dc" value="<?php if($result->total_dc==0){echo "";}else{echo number_format($result->total_dc,2);} ?>" oninput="calculatedc()">
                    <?php }else{ ?>
                        <input autocomplete="off" min="0.1" step="any" type="text" autocomplete="off" class="form-control" style="text-align: center;background-color: white" name="dc" id="dc" value="<?php if($result->total_dc==0){echo "";}else{echo number_format($result->total_dc,2);} ?>" readonly>
                    <?php } ?>
                </div>
                <div class="form-group col-md-2" style="width:275px">
                    <label for="dc_pcs">Pcs.</label>
                    <?php if($this->session->userdata('bu')!='OPLAN') { ?>
                        <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="dc_pcs" id="dc_pcs" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php if($result->dc_pcs==0){echo "";}else{echo $result->dc_pcs;} ?>">
                    <?php }else{ ?>
                        <input type="number" min="1" step="1" class="form-control" style="text-align: center;background-color: white" name="dc_pcs" id="dc_pcs" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php if($result->dc_pcs==0){echo "";}else{echo $result->dc_pcs;} ?>" readonly>
                    <?php } ?>
                </div>
                <div class="form-group col-md-4" style="width:275px">
                    <label for="pdc">Total PDC Amt.</label>
                    <?php if($this->session->userdata('bu')!='OPLAN') { ?>
                        <input autocomplete="off" min="0.1" step="any" type="text" autocomplete="off" class="form-control" style="text-align: center;background-color: white" name="pdc" id="pdc" value="<?php if($result->total_pdc==0){echo "";}else{echo number_format($result->total_pdc,2);} ?>" oninput="calculatepdc()">
                    <?php }else{ ?>
                        <input autocomplete="off" min="0.1" step="any" type="text" autocomplete="off" class="form-control" style="text-align: center;background-color: white" name="pdc" id="pdc" value="<?php if($result->total_pdc==0){echo "";}else{echo number_format($result->total_pdc,2);} ?>" readonly>
                    <?php } ?>
                </div>
                <div class="form-group col-md-2" style="width:275px">
                    <label for="pdc_pcs">Pcs.</label>
                    <?php if($this->session->userdata('bu')!='OPLAN') { ?>
                        <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="pdc_pcs" id="pdc_pcs" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php if($result->pdc_pcs==0){echo "";}else{echo $result->pdc_pcs;} ?>">
                    <?php }else{ ?>
                        <input type="number" min="1" step="1" class="form-control" style="text-align: center;background-color: white" name="pdc_pcs" id="pdc_pcs" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php if($result->pdc_pcs==0){echo "";}else{echo $result->pdc_pcs;} ?>" readonly>
                    <?php } ?>
                </div>
            </div>
            <!-- <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
                    <label for="totalcash">Total Cash Amount</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcash" id="totalcash" placeholder="0.00" autocomplete="off" value="<?php echo number_format($result->total_cash,2); ?>" readonly>
                </div>
            </div> -->

            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <?php if(($this->session->userdata('location')=='LDI' && $this->session->userdata('bu')=='OPLAN') || ($this->session->userdata('location')=='LDI-CDC' && $this->session->userdata('bu')=='OPLAN')) { ?>
                <div class="form-group col-md-6" style="width:550px">
                <label for="totalcash">Total Cash Amount</label>
                    <input type="text" style="text-align: center;background-color: white" class="form-control" name="totalcash" id="totalcash" placeholder="0.00" autocomplete="off" value="<?php echo number_format($result->total_cash,2); ?>" readonly>
                    
                </div>
                
                <div class="form-group col-md-6" style="width:550px">
                <label for="totalcash">Total Cash Amount from MyNet</label>
                   
                    <input type="numeric" style="text-align: center;background-color: white; font-weight: bold;" class="form-control" name="totalcash_ldi" id="totalcash_ldi" placeholder="0.00" oninput="calculatecash()" autocomplete="off" readonly>
                </div>
                <?php } else{ ?>
                    <div class="form-group col-md-12" style="width:550px">
                        <label for="totalcash">Total Cash Amount</label>
                            <input type="text" style="text-align: center;background-color: white" class="form-control" name="totalcash" id="totalcash" placeholder="0.00" autocomplete="off" value="<?php echo number_format($result->total_cash,2); ?>" readonly>
                            
                        </div>
                <?php } ?>
            </div>

            <?php if($this->session->userdata('bu')!='OPLAN') { ?>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
                <label for="totalcash">Total Remittance Amount</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcollection" id="totalcollection" placeholder="0.00" autocomplete="off" value="<?php echo number_format($result->total_collection,2); ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
                    <label for="coins">Total Collection Amount</label>
                    <?php if($this->session->userdata('bu')!='OPLAN') { ?>
                        <input type="text" min="0.0" step="any" class="form-control" style="text-align: center;background-color: white" name="totalremittance" id="totalremittance" autocomplete="off" value="<?php echo number_format($result->total_remittance,2); ?>" required>
                    <?php }else{ ?>
                        <input type="text" min="0.0" step="any" class="form-control" style="text-align: center;background-color: white" name="totalremittance" id="totalremittance" autocomplete="off" value="<?php echo number_format($result->total_remittance,2); ?>" required readonly>
                    <?php } ?>
                </div>
            </div>
            <?php }else{ ?>

            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
                <label for="totalcash">Total Remittance Amount</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcollection" id="totalcollection" placeholder="0.00" autocomplete="off" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px; display: none;">
                <div class="form-group col-md-12" style="width:550px">
                    <label for="coins">Total Accountability Amount</label>
                    <?php if($this->session->userdata('bu')!='OPLAN') { ?>
                        <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="totalremittance" id="totalremittance" required>
                    <?php }else{ ?>
                        <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totalremittance" id="totalremittance" required readonly>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>

            <!-- <?php if($this->session->userdata('bu')!='OPLAN') { ?>
                <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                    <div class="form-group col-md-12" style="width:550px">
                        <label for="coins">Total Returns Amount</label>
                            
                            <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalreturns" id="totalreturns" required readonly>

                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalreturns_no" id="totalreturns_no" required readonly>
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpay_id" id="totalpay_id" required readonly>
                        
                    </div>
                </div>
            <?php }else{ ?>

                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totalreturns" id="totalreturns" value="" required readonly>
                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totalreturns_no" id="totalreturns_no" value="" required readonly>
                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totalpay_id" id="totalpay_id" value="" required readonly>
            <?php } ?> -->

            <input type="hidden" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="date" id="date" autocomplete="off">
            <?php if($this->session->userdata('location')!='LDI') { ?>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
                    <label for="coins">Expenses Amount</label>
                    <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="expenses_amt" value="<?php echo number_format($result->expenses_amt,2); ?>" id="expenses_amt">
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
                <label for="totalcash">Expenses</label>
                <textarea class="form-control" id="expenses" name="expenses" autocomplete="off" rows="3"><?php echo $result->expenses; ?></textarea>
                </div>
            </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Update Denomination</button>
            <a href="<?= base_url('/sm_ledger'); ?>"><input type="button" class="btn btn-secondary" value="Cancel"></a>
            <?php if(($this->session->userdata('location')=='LDI' && $this->session->userdata('bu')=='OPLAN') || ($this->session->userdata('location')=='LDI-CDC' && $this->session->userdata('bu')=='OPLAN')) { ?>
            <button type="button" class="btn btn-warning" style="float: right;font-weight:bold;font-size: 18px" onclick=getcollection("<?php echo $this->session->userdata('id_no'); ?>","<?php echo date('Y-m-d'); ?>")>Get Collection Amount</button>
            <?php } ?>


            <br/><br/>
        </form>
      <!-- </div> -->
  </div>
</main>