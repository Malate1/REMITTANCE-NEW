<main>
    
    <div class="container-fluid">
        <h4 class="mt-4">Salesman Returns</h4><br/>
        <div class="col-md-12" style="width: 100%">

            <div class="form-row"> 
                <div class="form-group col-md-3">
                    <!-- <label for="type">Per SM or Per S.I</label>
                    <select class="form-control" name="type" id="type" required onchange="toggleButton2()">
                        <option  value="sm">Per SM</option>
                        
                        <option value="si">Per S.I</option>
                    </select> -->

                    <p>Per SM or Per S.I</p>
                        <input type="radio" id="persm" name="persm" value="persm" onchange="toggleButton2()">
                        <label for="sm">Per SM</label><br>
                        <input type="radio" id="persi" name="persm" value="persi" onchange="toggleButton2()">
                        <label for="si">Per S.I</label><br>
                        
                </div>
            </div>

            

                <div class="form-row" id="perSi" style="display: none"> 
                    <div class="form-group col-md-3">
                        <label for="si">Enter S.I Number</label>
                        <input type="text" class="form-control" style="text-align: center;background-color: white" name="si" id="si" autocomplete="off" required>
                    </div>
                </div>
            
           
                <div class="form-row" id="perSm" >
                    <!-- <div class="form-group col-md-3">
                        <label for="datenow">Select Date</label>
                        <input type="date" class="form-control" style="text-align: center;background-color: white" name="datenow" id="datenow" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required>
                    </div> -->

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
                        <select class="form-control select2" name="sm_xt" id="sm_xt" required>
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
                    <button type="submit" style="display: inline-block;" class="btn btn-primary" id="oplanButton" onclick="cashiersm_form_date_oplan_ret()">Generate OPLAN Returns</button>
                    <button type="submit" style="display: none;" class="btn btn-primary" id="oplanButtonSi" onclick="cashiersm_form_date_oplan_si_ret()">Generate OPLAN Returns by S.I.</button>
                    <button type="submit" style="display: none;" class="btn btn-primary" id="xtruckButton" onclick="cashiersm_form_date_xt_ret()">Generate XTRUCK Returns</button>
                </div>
            </div>
            
        </div>
    </div>
    
    <script>
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
            var smdiv = document.getElementById('perSm');
            var sidiv = document.getElementById('perSi');
            var oplanButton = document.getElementById('oplanButton');
            var oplanButtonSi = document.getElementById('oplanButtonSi');

            if (selectedValue === 'persm') {
                oplanButton.style.display = 'inline-block';
                oplanButtonSi.style.display = 'none';
                smdiv.style.display = 'flex';
                sidiv.style.display = 'none';
            } else if (selectedValue === 'persi') {
                oplanButton.style.display = 'none';
                oplanButtonSi.style.display = 'inline-block';
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