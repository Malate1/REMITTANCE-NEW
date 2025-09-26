<main>


    <div class="container-fluid">
        <h4 class="mt-4">Salesman Incentives</h4><br/>
        <div class="col-md-12" style="width: 100%">

            

            

               
            
           
                <div class="form-row"  >
                    <!-- <div class="form-group col-md-3">
                        <label for="datenow">Start Date</label>
                        <input type="date" class="form-control" style="text-align: center;background-color: white" name="datenow" id="datenow" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="datenow">End Date</label>
                        <input type="date" class="form-control" style="text-align: center;background-color: white" name="datenow2" id="datenow2" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required>
                    </div> -->

                    <div id="xt" class="form-group col-md-3" >
                        <label for="sm">XTRUCK Salesman</label>
                        <select class="form-control" name="sm" id="sm" required>
                            <!-- <option value="">Select Salesman</option> -->
                            <option value="All">All Salesman</option>
                            <?php foreach($xtruck as $row) { ?>
                                
                                <option value="<?php echo $row->id_no; ?>"><?php echo $row->id_no; ?> &#8594; </i> <?php echo $row->full_name; ?></option>
                            <?php } ?>
                        </select>
                        <br/>
                    </div>

                </div>
            
            
            <div class="form-row">
                <div class="form-group col-md-5">
                
                    <button type="submit"  class="btn btn-primary" id="xtruckButton" onclick="cashiersm_form_date_xt_inc()">Generate</button>
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
                console.log(selectedValue);
            }
            var smdiv = document.getElementById('perSm');
            var sidiv = document.getElementById('perSi');
            var xtruckButton = document.getElementById('xtruckButton');
            var xtruckButtonRef = document.getElementById('xtruckButtonRef');

            if (selectedValue === 'persm') {
                xtruckButton.style.display = 'inline-block';
                xtruckButtonRef.style.display = 'none';
                smdiv.style.display = 'flex';
                sidiv.style.display = 'none';
            } else if (selectedValue === 'persi') {
                xtruckButton.style.display = 'none';
                xtruckButtonRef.style.display = 'inline-block';
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