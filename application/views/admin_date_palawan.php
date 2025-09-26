<main>


    <div class="container-fluid">
        <h4 class="mt-4">Salesman Palawan Remittance/s</h4><br/>
        <div class="col-md-12" style="width: 100%">

            <div class="form-row"> 
                <div class="form-group col-md-3">
                    
                    <p>Per SM or Per Referrence No.</p>
                        <input type="radio" id="persm" name="persm" value="persm" onchange="toggleButton2()">
                        <label for="sm">Per SM</label><br>
                        <input type="radio" id="persi" name="persm" value="persi" onchange="toggleButton2()">
                        <label for="si">Per Referrence No. XTRUCK</label><br>
                        <input type="radio" id="persi" name="persm" value="persiop" onchange="toggleButton2()">
                        <label for="si">Per Referrence No. PREBOOKING</label><br>
                        
                </div>
            </div>

            

                <div class="form-row" id="perSi" style="display: none"> 
                    <div class="form-group col-md-3">
                        <label for="ref_no">Enter Referrence No. </label>
                        <input type="text" class="form-control" style="text-align: center;background-color: white" name="ref_no" id="ref_no" autocomplete="off" required>
                    </div>
                </div>
            
           
                <div class="form-row" id="perSm" >
                    <div class="form-group col-md-3">
                        <label for="datenow">Start Date</label>
                        <input type="date" class="form-control" style="text-align: center;background-color: white" name="datenow" id="datenow" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="datenow">End Date</label>
                        <input type="date" class="form-control" style="text-align: center;background-color: white" name="datenow2" id="datenow2" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="type">BU</label>
                        <select class="form-control" name="loc" id="loc" required onchange="toggleButton()">
                            <option value="OPLAN">OPLAN</option>
                            <option value="XTRUCK">XTRUCK</option>
                        </select>
                    </div>

                    <div id="oplan" class="form-group col-md-3" style="display: inline-block">
                        <label for="sm">Oplan Salesman</label>
                        <select class="form-control select2" name="sm" id="sm" required>
                            <!-- <option value="">Select Salesman</option> -->
                            <?php foreach($oplan as $row) { ?>
                                <option value="<?php echo $row->id_no; ?>"><?php echo $row->id_no; ?> &#8594; <?php echo $row->full_name; ?></option>
                            <?php } ?>
                        </select>
                        <br/>
                    </div>

                    <div id="xt" class="form-group col-md-3" style="display: none">
                        <label for="sm">Xtruck Salesman</label> <br>
                        <select class="form-control" name="sm_xt" id="sm_xt" required>
                            <!-- <option value="">Select Salesman</option> -->
                            <?php foreach($xtruck as $row) { ?>
                                <option value="<?php echo $row->id_no; ?>"><?php echo $row->id_no; ?> &#8594; </i> <?php echo $row->full_name; ?></option>
                            <?php } ?>
                        </select>
                        <br/>
                    </div>

                </div>
            
            
            <div class="form-row">
            <div class="form-group col-md-5">
                    <button type="submit" style="display: inline-block;" class="btn btn-primary" id="oplanButton" onclick="cashiersm_form_date_op_palawan()">Generate Palawan Remittance/s PREBOOKING</button>
                    <button type="submit" style="display: none;" class="btn btn-primary" id="oplanButtonRef" onclick="cashiersm_form_date_op_palawan_ref()">Generate Palawan Remittance/s by Ref No PREBOOKING</button>
                    <button type="submit" style="display: none;" class="btn btn-primary" id="xtruckButton" onclick="cashiersm_form_date_xt_palawan()">Generate Palawan Remittance/s XTRUCK</button>
                    <button type="submit" style="display: none;" class="btn btn-primary" id="xtruckButtonRef" onclick="cashiersm_form_date_xt_palawan_ref()">Generate Palawan Remittance/s by Ref No</button>
                </div>
            </div>
            
        </div>
    </div>
    
    <script>
        // function toggleButton() {
        //     var selectedValue = document.getElementById('loc').value;
        //     var oplanButton = document.getElementById('oplanButton');
        //     var xtruckButton = document.getElementById('xtruckButton');                                                                                                                                                                                                        

        //     if (selectedValue === 'OPLAN') {
        //         oplanButton.style.display = 'inline-block';
        //         oplan.style.display = 'inline-block';
        //         xtruckButton.style.display = 'none';
        //         xt.style.display = 'none';
        //     } else if (selectedValue === 'XTRUCK') {
        //         oplanButton.style.display = 'none';
        //         oplan.style.display = 'none'; 
        //         xtruckButton.style.display = 'inline-block';
        //         xt.style.display = 'inline-block';
        //     } else {
        //         oplanButton.style.display = 'inline-block';
        //         xtruckButton.style.display = 'none';
        //         oplan.style.display = 'inline-block';
        //         xt.style.display = 'none';
        //     }
        // }

        function toggleButton() {
            var selectedValue = document.getElementById('loc').value;
            var oplanButton = document.getElementById('oplanButton');
            var xtruckButton = document.getElementById('xtruckButton');                                                                                                                                                                                                        

            if (selectedValue === 'OPLAN') {
                oplanButton.style.display = 'inline-block';
                oplan.style.display = 'inline-block';
                xtruckButton.style.display = 'none';
                xt.style.display = 'none';
            } else if (selectedValue === 'XTRUCK') {
                oplanButton.style.display = 'none';
                oplan.style.display = 'none'; 
                xtruckButton.style.display = 'inline-block';
                xt.style.display = 'inline-block';
            } else {
                oplanButton.style.display = 'inline-block';
                xtruckButton.style.display = 'none';
                oplan.style.display = 'inline-block';
                xt.style.display = 'none';
            }
        }

        function toggleButton2() {
            //var selectedValue = document.getElementById('type').value;

            // Get the selected value from the radio buttons
            var radioValue = document.querySelector('input[name="persm"]:checked');
            if (radioValue) {
                selectedValue = radioValue.value;
            }
            console.log(selectedValue);
            var smdiv = document.getElementById('perSm');
            var sidiv = document.getElementById('perSi');
            var oplanButton = document.getElementById('oplanButton');
            var oplanButtonSi = document.getElementById('oplanButtonRef');
            var xtruckButton = document.getElementById('xtruckButton');
            var xtruckButtonSi = document.getElementById('xtruckButtonRef');

            if (selectedValue === 'persm') {
                oplanButton.style.display = 'inline-block';
                oplanButtonSi.style.display = 'none';
                smdiv.style.display = 'flex';
                sidiv.style.display = 'none';
            } else if (selectedValue === 'persi') {
                xtruckButton.style.display = 'none';
                xtruckButtonSi.style.display = 'inline-block';
                oplanButtonSi.style.display = 'none';
                smdiv.style.display = 'none';
                sidiv.style.display = 'flex';
            }
            else if (selectedValue === 'persiop') {
                oplanButton.style.display = 'none';
                oplanButtonSi.style.display = 'inline-block';
                xtruckButtonSi.style.display = 'none';
                smdiv.style.display = 'none';
                sidiv.style.display = 'flex';
            } else {
                
                smdiv.style.display = 'flex';
                sidiv.style.display = 'none';
            }
        }
    </script>

    

<!-- <script>
    $(document).ready(function() {
        $('#sm').select2({
            placeholder: "Select Salesman",
            allowClear: true
        });
    });
</script> -->

</main>