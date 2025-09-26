<main>
    <div class="container-fluid">
        <h4 class="mt-4">DV SRR Report</h4><br />
        <div class="col-xl-12" style="width: 100%">
            
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="datefrom">Start Date</label>
                    <input type="date" class="form-control" style="text-align: center;background-color: white"
                        name="datefrom" id="datefrom" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required>
                </div>

                <div class="form-group col-md-3">
                    <label for="dateto">End Date</label>
                    <input type="date" class="form-control" style="text-align: center;background-color: white"
                        name="dateto" id="dateto" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required>
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
                    <select class="form-control" name="sm" id="sm" required>
                        <option value="">Select Salesman</option>
                        <!-- <option value="All">Select All Salesman</option> -->
                        <?php foreach($oplan as $row) { ?>
                        <option value="<?php echo $row->id_no; ?>"><?php echo $row->id_no; ?> &#8594;
                            <?php echo $row->full_name; ?></option>
                        <?php } ?>
                    </select>
                    <br />
                </div>

                <div id="xt" class="form-group col-md-3" style="display: none">
                    <label for="sm">Xtruck Salesman</label> <br>
                    <select class="form-control" name="sm_xt" id="sm_xt" required>
                        <!-- <option value="">Select Salesman</option> -->
                        <!-- <option value="All">Select All Salesman</option> -->
                        <?php foreach($xtruck as $row) { ?>
                        <option value="<?php echo $row->id_no; ?>"><?php echo $row->id_no; ?> &#8594; </i>
                            <?php echo $row->full_name; ?></option>
                        <?php } ?>
                    </select>
                    <br />
                </div>

            </div>
            <div class="form-row">
                <div class="form-group">
                    <!-- <a href="#" target="_blank"><button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" onclick=colsum_date()>Generate Report</button></a> -->
                    <!-- <button type="submit" style="display: inline-block;" class="btn btn-primary" id="generateReport"
                        onclick="colsum_date()">Generate Report</button> -->
                    <button type="submit" style="display: inline-block;" class="btn btn-primary" id="oplanButton"
                        onclick="dvsrr_date_op()">Generate OPLAN Report</button>

                    <button type="submit" style="display: none;" class="btn btn-primary" id="xtruckButton"
                        onclick="dvsrr_date_xt()">Generate XTRUCK Report</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function saveSelection() {
            var selectedValue = document.getElementById('loc').value;
            localStorage.setItem('selectedLoc', selectedValue);
        }

        // Restore the selected value from localStorage on page load
        function restoreSelection() {
            var selectedValue = localStorage.getItem('selectedLoc');
            if (selectedValue) {
                document.getElementById('loc').value = selectedValue;
                toggleButton(); // Call the toggleButton function to update the UI
            }
        }

        function toggleButton() {
            var selectedValue = document.getElementById('loc').value;
            var oplanButton = document.getElementById('oplanButton');
            var xtruckButton = document.getElementById('xtruckButton');
            var oplan = document.getElementById('oplan'); // Assuming this is the element for OPLAN
            var xt = document.getElementById('xt');       // Assuming this is the element for XTRUCK

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

        // Attach events
        window.onload = restoreSelection; // Restore selection on page load
        document.getElementById('loc').addEventListener('change', saveSelection); // Save selection on change

    // var sm = document.getElementById('sm').value;
    // var sm_xt = document.getElementById('sm_xt').value;
    // var oplanButton = document.getElementById('oplanButton');
    // var xtruckButton = document.getElementById('xtruckButton');
    // if (!sm) { // Checks if `sm` is null, undefined, or an empty string
    //     oplanButton.disabled = true;
    // } else {
    //     oplanButton.disabled = false;
    // }

    // if (!sm_xt) { // Checks if `sm_xt` is null, undefined, or an empty string
    //     xtruckButton.disabled = true;
    // } else {
    //     xtruckButton.disabled = false;
    // }


    // document.getElementById('sm').addEventListener('change', function() {
    //     var sm = this.value;
    //     oplanButton.disabled = !sm; // Disables if `sm` is empty or null
    // });

    // document.getElementById('sm_xt').addEventListener('change', function() {
    //     var sm_xt = this.value;
    //     xtruckButton.disabled = !sm_xt; // Disables if `sm` is empty or null
    // });


    </script>
</main>