<main>
    <div class="container-fluid">
        <h4 class="mt-4">Denomination</h4>
        <!-- <div class="col-20"> -->
        <form method="post" id="submit_sm_denom">
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:150px">
                    <label for="note-1000">Notes</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-1000" id="note-1000" placeholder="1000" value="1000" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <label for="qty-1000">Quantity</label>
                    <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="qty-1000" id="qty-1000" onkeypress='return (event.charCode >= 48 && event.charCode <= 57)' oninput="calculate1000()">
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <label for="amount-1000">Amount</label>
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-1000" id="hamount-1000" placeholder="0.00" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-1000" id="amount-1000" placeholder="0.00" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:150px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-500" id="note-500" placeholder="500" value="500" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="qty-500" id="qty-500" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate500()">
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-500" id="hamount-500" placeholder="0.00" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-500" id="amount-500" placeholder="0.00" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:150px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-200" id="note-200" placeholder="200" value="200" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="qty-200" id="qty-200" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate200()">
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-200" id="hamount-200" placeholder="0.00" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-200" id="amount-200" placeholder="0.00" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:150px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-100" id="note-100" placeholder="100" value="100" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="qty-100" id="qty-100" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate100()">
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-100" id="hamount-100" placeholder="0.00" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-100" id="amount-100" placeholder="0.00" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:150px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-50" id="note-50" placeholder="50" value="50" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="qty-50" id="qty-50" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate50()">
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-50" id="hamount-50" placeholder="0.00" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-50" id="amount-50" placeholder="0.00" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:150px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-20" id="note-20" placeholder="20" value="20" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="qty-20" id="qty-20" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate20()">
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-20" id="hamount-20" placeholder="0.00" readonly>
                    <input type="hidden" class="form-control" style="text-align: center; background-color: white" name="location" id="location" value="<?php echo $this->session->userdata('location'); ?>" readonly>
                    <input type="hidden" class="form-control" style="text-align: center; background-color: white" name="bu" id="bu" value="<?php echo $this->session->userdata('bu'); ?>" readonly>

                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-20" id="amount-20" placeholder="0.00" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
                    <label for="coins">Total Coins Amount</label>
                    <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="coins" id="coins" oninput="calculatecoins()">
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-4" style="width:275px">
                    <label for="dc">Total DC Amt.</label>
                    <?php if($this->session->userdata('bu')!='OPLAN') { ?>
                        <input type="text" min="0.1" step="any" class="form-control" autocomplete="off" style="text-align: center" name="dc" id="dc" oninput="calculatedc()">
                    <?php }else{ ?>
                        <input type="text" min="0.1" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="dc" id="dc" readonly>
                    <?php } ?>
                </div>
                <div class="form-group col-md-2" style="width:275px">
                    <label for="dc_pcs">Pcs.</label>
                    <?php if($this->session->userdata('bu')!='OPLAN') { ?>
                        <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="dc_pcs" id="dc_pcs" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    <?php }else{ ?>
                        <input type="number" min="1" step="1" class="form-control" style="text-align: center;background-color: white" name="dc_pcs" id="dc_pcs" onkeypress='return event.charCode >= 48 && event.charCode <= 57' readonly>
                    <?php } ?>
                </div>
                <div class="form-group col-md-4"style="width:275px">
                    <label for="pdc">Total PDC Amt.</label>
                    <?php if($this->session->userdata('bu')!='OPLAN') { ?>
                        <input type="text" min="0.1" step="any" class="form-control" autocomplete="off" style="text-align: center" name="pdc" id="pdc" oninput="calculatepdc()">
                    <?php }else{ ?>
                        <input type="text" min="0.1" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="pdc" id="pdc" readonly>
                    <?php } ?>
                </div>
                <div class="form-group col-md-2" style="width:275px">
                    <label for="pdc_pcs">Pcs.</label>
                    <?php if($this->session->userdata('bu')!='OPLAN') { ?>
                        <input type="number" min="1" step="1" class="form-control" style="text-align: center" name="pdc_pcs" id="pdc_pcs" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    <?php }else{ ?>
                        <input type="number" min="1" step="1" class="form-control" style="text-align: center;background-color: white" name="pdc_pcs" id="pdc_pcs" onkeypress='return event.charCode >= 48 && event.charCode <= 57' readonly>
                    <?php } ?>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <?php if(($this->session->userdata('location')=='LDI' && $this->session->userdata('bu')=='OPLAN') || ($this->session->userdata('location')=='LDI-CDC' && $this->session->userdata('bu')=='OPLAN')) { ?>
                <div class="form-group col-md-6" style="width:550px">
                <label for="totalcash">Total Cash Amount</label>
                    <input type="text" style="text-align: center;background-color: white" class="form-control" name="totalcash" id="totalcash" placeholder="0.00" autocomplete="off" readonly>
                    
                </div>
                
                <div class="form-group col-md-6" style="width:550px">
                <label for="totalcash">Total Cash Amount from MyNet</label>
                   
                    <input type="numeric" style="text-align: center;background-color: white; font-weight: bold;" class="form-control" name="totalcash_ldi" id="totalcash_ldi" placeholder="0.00" oninput="calculatecash()" autocomplete="off" readonly>
                </div>
                <?php } else{ ?>
                    <div class="form-group col-md-12" style="width:550px">
                        <label for="totalcash">Total Cash Amount</label>
                            <input type="text" style="text-align: center;background-color: white" class="form-control" name="totalcash" id="totalcash" placeholder="0.00" autocomplete="off" readonly>
                            
                        </div>
                <?php } ?>
            </div>
            
            <?php if($this->session->userdata('bu')!='OPLAN') { ?>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
                <label for="totalcash">Total Remittance Amount</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcollection" id="totalcollection" placeholder="0.00" autocomplete="off" readonly>
                </div>
            </div>
                <?php if($this->session->userdata('bu')=='HORECA' || $this->session->userdata('bu')=='FROZEN' || $this->session->userdata('bu')=='MPDI' || $this->session->userdata('bu')=='CVS' || $this->session->userdata('bu')=='3PS') { ?>

                    <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px; display: none;">
                        <div class="form-group col-md-12" style="width:550px">
                            <label for="coins">Total Collection Amount</label>
                                
                                <input type="hidden" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: black;" name="totalremittance" id="totalremittance" value="0.00" required>
                        </div>
                    </div>

                <?php }else{ ?>

                    <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px;">
                        <div class="form-group col-md-12" style="width:550px">
                            <label for="coins">Total Collection Amount</label>
                            
                                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="totalremittance" id="totalremittance" required>
                        </div>
                    </div>
                <?php } ?>

            <?php }else{ ?>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
                <label for="totalcash">Total Remittance Amount</label>
                    <input type="numeric" style="text-align: center;background-color: white; font-weight: bold;" class="form-control" name="totalcollection2" id="totalcollection2" placeholder="0.00" autocomplete="off" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px; display: none;">
            <!-- <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px;"> -->
                <div class="form-group col-md-12" style="width:550px">
                    <label for="coins">Total Accountability Amount</label>
                    <?php if($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC') { ?>
                        <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="totalremittance" id="totalremittance" required>
                    <?php }else{ ?>
                        <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; " name="totalremittance" id="totalremittance" required readonly>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>

            <?php if(($this->session->userdata('location')=='LDI' && $this->session->userdata('bu')=='OPLAN') || ($this->session->userdata('location')=='LDI-CDC' && $this->session->userdata('bu')=='OPLAN')) { ?>
                <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                    <div class="form-group col-md-12" style="width:550px">
                        <label for="coins">Total Returns Amount</label>
                            
                            <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalreturns" id="totalreturns" required readonly>

                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalreturns_no" id="totalreturns_no" required readonly>
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpay_id" id="totalpay_id" required readonly>
                        
                    </div>

                    
                </div>
            <?php }else if ($this->session->userdata('bu')=='HORECA' || $this->session->userdata('bu')=='FROZEN' || $this->session->userdata('bu')=='MPDI' || $this->session->userdata('bu')=='CVS' || $this->session->userdata('bu')=='3PS'){ ?>
                <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                    <div class="form-group col-md-12" style="width:550px">
                        <label for="coins">Total Returns Amount</label>
                            
                            <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalreturns" id="totalreturns" oninput="calculatetotal()" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                            <div id="error-message3" style="color: red;"></div>


                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalreturns_no" id="totalreturns_no" required readonly>
                            <input type="hidden" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalpay_id" id="totalpay_id" required readonly>
                        
                    </div>
                </div>
            <?php }else{ ?>

                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totalreturns" id="totalreturns" value="" required readonly>
                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totalreturns_no" id="totalreturns_no" value="" required readonly>
                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totalpay_id" id="totalpay_id" value="" required readonly>
                
            <?php } ?>

            <?php if($this->session->userdata('location')=='LDI' || $this->session->userdata('location')=='LDI-CDC') { ?>
                <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                    <div class="form-group col-md-6" style="width: 550px">
                        <label for="coins">Total W/Tax Amount</label>
                        <input type="text" min="0.1" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totaltax" id="totaltax" oninput="calculatetotal()" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                        <div id="error-message" style="color: red;"></div>
                    </div>


                    <div class="form-group col-md-6" style="width:550px">
                        <label for="coins">Total B.O Amount</label>
                            
                            <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalbo" id="totalbo" oninput="calculatetotal()" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                            <div id="error-message2" style="color: red;"></div>
                    </div>
                </div>
            <?php }else{ ?>
                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totaltax" id="totaltax" value="" required readonly>
                <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold; display: none;" name="totalbo" id="totalbo" value="" required readonly>
            <?php } ?>

            <?php if($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC') { ?>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
                    <label for="coins">Expenses Amount</label>
                    <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white" name="expenses_amt" id="expenses_amt">
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
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
            <button type="submit" class="btn btn-primary" id="saveButton" style="font-size:20px">Save Denomination</button>
            <?php if(($this->session->userdata('location')=='LDI' && $this->session->userdata('bu')=='OPLAN') || ($this->session->userdata('location')=='LDI-CDC' && $this->session->userdata('bu')=='OPLAN')) { ?>
            <button type="button" class="btn btn-warning" style="float: right;font-weight:bold;font-size: 18px" onclick=getcollection("<?php echo $this->session->userdata('id_no'); ?>","<?php echo date('Y-m-d'); ?>")>Get Collection Amount</button>
            <?php } ?>
            <br/><br/>
        </form>
      <!-- </div> -->
  </div>
  <script type="text/javascript">
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

  </script>
</main>