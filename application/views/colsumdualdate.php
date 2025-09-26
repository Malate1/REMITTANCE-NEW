<main>
    <div class="container-fluid">
        <h4 class="mt-4">Collection Summary Report</h4><br />
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
                        <option value="XTRUCK">XTRUCK-MPDI</option>
                        <option value="MAS-LDI">MAS-LDI</option>
                       
                        
                    </select>
                </div>

                <div class="form-group col-md-3" id="salesman-container" style="display: none;">
                    <label for="sm">Salesman</label> <br>
                    <select class="form-control" name="sm" id="sm" required>
                        <option value="">Select Salesman</option>
                        <option value="All">Select All Salesman</option>
                        <!-- Salesman options will be added here dynamically -->
                    </select>
                </div>


                <!-- <div id="oplan" class="form-group col-md-3" style="display: inline-block">
                    <label for="sm">Oplan Salesman</label>
                    <select class="form-control" name="sm" id="sm" required>
                        <option value="">Select Salesman</option>
                        <option value="All">Select All Salesman</option>
                        <?php foreach($oplan as $row) { ?>
                        <option value="<?php echo $row->id_no; ?>"><?php echo $row->id_no; ?> &#8594;
                            <?php echo $row->full_name; ?></option>
                        <?php } ?>
                    </select>
                    <br />
                </div>

                <div id="xt" class="form-group col-md-3" style="display: none">
                    <label for="sm">Xtruck Salesman</label>
                    <select class="form-control" name="sm_xt" id="sm_xt" required>
                        <option value="">Select Salesman</option>
                        <option value="All">Select All Salesman</option>
                        <?php foreach($xtruck as $row) { ?>
                        <option value="<?php echo $row->id_no; ?>"><?php echo $row->id_no; ?> &#8594; </i>
                            <?php echo $row->full_name; ?></option>
                        <?php } ?>
                    </select>
                    <br />
                </div> -->

            </div>
            <div class="form-row">
                <div class="form-group">
                    <!-- <a href="#" target="_blank"><button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" onclick=colsum_date()>Generate Report</button></a> -->
                    <!-- <button type="submit" style="display: inline-block;" class="btn btn-primary" id="generateReport"
                        onclick="colsum_date()">Generate Report</button> -->
                    <button type="submit" style="display: inline-block;" class="btn btn-primary" id="oplanButton"
                        onclick="colsum_date_mpdi()">Generate MPDI Report</button>

                    <button type="submit" style="display: none;" class="btn btn-primary" id="xtruckButton"
                        onclick="colsum_date_xt()">Generate XTRUCK Report</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    const oplanSalesmen = <?php echo json_encode($oplan); ?>;
    const xtruckSalesmen = <?php echo json_encode($xtruck); ?>;
    const mas_ldiSalesmen = <?php echo json_encode($mas_ldi); ?>;
    const mas_netmanSalesmen = <?php echo json_encode($mas_netman); ?>;
    const horecaSalesmen = <?php echo json_encode($horeca); ?>;
    const frozenSalesmen = <?php echo json_encode($frozen); ?>;
    const mpdiSalesmen = <?php echo json_encode($mpdi); ?>;
    const cvsSalesmen = <?php echo json_encode($cvs); ?>;
    const unilabSalesmen = <?php echo json_encode($unilab); ?>;
    

    function toggleButton() {
        const loc = document.getElementById('loc').value;
        console.log(loc);
        const smDropdown = document.getElementById('sm');
        const salesmanContainer = document.getElementById('salesman-container');
        
        // Clear the previous options
        smDropdown.innerHTML = '<option value="">Select Salesman</option><option value="All">Select All Salesman</option>';

        // Select the right list based on `loc`
        let salesmen = [];
        if (loc === "OPLAN") {
            salesmen = oplanSalesmen;
        } else if (loc === "XTRUCK") {
            salesmen = xtruckSalesmen;
        } else if (loc === "MAS-LDI") {
            salesmen = mas_ldiSalesmen;
        } else if (loc === "MAS-NETMAN") {
            salesmen = mas_netmanSalesmen;
        } else if (loc === "HORECA") {
            salesmen = horecaSalesmen;
        } else if (loc === "FROZEN") {
            salesmen = frozenSalesmen;
        } else if (loc === "MPDI") {
            salesmen = mpdiSalesmen;
        } else if (loc === "CVS") {
            salesmen = cvsSalesmen;
        } else {
            salesmen = unilabSalesmen;
        } 

        // Populate dropdown with the relevant salesmen
        salesmen.forEach(salesman => {
            const option = document.createElement('option');
            option.value = salesman.id_no;
            option.text = `${salesman.id_no} → ${salesman.full_name}`;
            smDropdown.appendChild(option);
        });

        // Show or hide the salesman container based on selection
        salesmanContainer.style.display = salesmen.length ? 'block' : 'none';
    }

    // var sm = document.getElementById('sm').value;
    // var sm_xt = document.getElementById('sm_xt').value;
    // var oplanButton = document.getElementById('oplanButton');
    // var xtruckButton = document.getElementById('xtruckButton');
    // // if (!sm) { // Checks if `sm` is null, undefined, or an empty string
    // //     oplanButton.disabled = true;
    // // } else {
    // //     oplanButton.disabled = false;
    // // }

    // // if (!sm_xt) { // Checks if `sm_xt` is null, undefined, or an empty string
    // //     xtruckButton.disabled = true;
    // // } else {
    // //     xtruckButton.disabled = false;
    // // }


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