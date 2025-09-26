<main>
    <style type="text/css">
    table.dataTable tr th.select-checkbox.selected::after {
        content: "✔";
        margin-top: -11px;
        margin-left: -4px;
        text-align: center;
        text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
    }

    .disabled-link {
        pointer-events: none;
        /* Prevent clicking */
        opacity: 0.5;
        /* Dim the appearance */
        text-decoration: none;
        /* Remove underline */
    }

    .enabled-link {
        pointer-events: auto;
        /* Allow clicking */
    }

    /* Responsive table wrapper */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Adjust font sizes for smaller screens */
    @media (max-width: 768px) {
        h4 {
            font-size: 1.5rem;
            /* Smaller heading on mobile */
        }

        .btn {
            font-size: 0.9rem;
            /* Smaller buttons on mobile */
            padding: 5px 10px;
        }

        .form-control {
            font-size: 0.9rem;
            /* Smaller form controls on mobile */
        }

        table th,
        table td {
            font-size: 0.8rem;
            /* Smaller table text on mobile */
        }

        

        



    }
    </style>

    <div class="container-fluid">
        <h4 class="mt-4">Salesman Check Entry</h4>
        <!-- <a href="<?php echo base_url('/remitdate'); ?>">
            <button class="btn btn-primary">
                <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back
            </button>
        </a> -->
        
        <!-- Responsive dropdown and buttons -->
        <div class="row mt-3">
            <div class="col-12 col-md-6 col-lg-4 mb-2">
                <?php if ($this->session->userdata('location') == 'UWDG') { ?>
                <select class="form-control" name="utype" id="utype" required>
                    <option value="All">All</option>
                    <option value="Salesman">Salesman</option>
                    <option value="JefeDeViaje">JefeDeViaje</option>
                    <option value="Walk-In">Walk-In</option>
                    <option value="OtherCharges">OtherCharges</option>
                </select>
                <?php } else if ($this->session->userdata('location') == 'LDI' || $this->session->userdata('location') == 'LDI-CDC' || $this->session->userdata('location') == 'LDI-UDC' || $this->session->userdata('location') == 'LDI-Parallel') { ?>
                <select class="form-control" name="loc" id="loc" required>
                    <option value="All">All</option>
                    <option value="OPLAN">OPLAN</option>
                    <option value="HORECA">HORECA</option>
                    <option value="FROZEN">FROZEN</option>
                    <option value="3PS">3PS</option>
                    <option value="CVS">CVS</option>
                    <option value="MPDI">MPDI</option>
                    <option value="XTRUCK">XTRUCK-LDI</option>
                    <option value="XTRUCK-NETMAN">XTRUCK-NETMAN</option>
                    <option value="XTRUCK-MPDI">XTRUCK-MPDI</option>
                    <option value="XTRUCK-NETMAN-BPI">XTRUCK-NETMAN-BPI</option>
                    <option value="UNILAB">UNILAB</option>
                    <option value="MAS-LDI">MAS-LDI</option>
                    <option value="MAS-NETMAN">MAS-NETMAN</option>
                </select>
                <?php } ?>
            </div>
            <div class="col-12 col-md-6 col-lg-8 text-right mb-2">
                <?php if ($this->session->userdata('location') == 'UWDG') { ?>
                <a style="cursor: pointer" onclick="print_alldenom_dynamic()">
                    <button class="btn btn-success">
                        <i class="fas fa-print"></i>&nbsp;&nbsp;Print Collection Summary
                    </button>
                </a>
                <?php } else if ($this->session->userdata('location') == 'LDI' || $this->session->userdata('location') == 'LDI-CDC' || $this->session->userdata('location') == 'LDI-UDC') { ?>
                <a style="cursor: pointer" onclick="print_alldenom_dynamic()">
                    <button class="btn btn-success">
                        <i class="fas fa-print"></i>&nbsp;&nbsp;Print Collection Summary LDI
                    </button>
                </a>
                <a style="cursor: pointer" onclick="print_alldenom_dynamic()">
                    <button class="btn btn-success">
                        <i class="fas fa-print"></i>&nbsp;&nbsp;Print Approved per Cashier
                    </button>
                </a>
                <?php } else { ?>
                <a style="cursor: pointer" onclick="print_alldenom_dynamic()">
                    <button class="btn btn-success">
                        <i class="fas fa-print"></i>&nbsp;&nbsp;Print Collection Summary
                    </button>
                </a>
                <?php } ?>
                <a style="cursor: pointer" data-toggle="modal" data-target="#viewAllSmDenom"
                onclick="viewallsmdenom_dynamic()">
                    <button class="btn btn-info">
                        <i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;All Salesman Denomination
                    </button>
                </a>
                <a style="cursor: pointer" onclick="refresh()">
                    <button title="Refresh" class="btn btn-warning">
                        <i class="fas fa-circle-notch"></i>
                    </button>
                </a>
            </div>
        </div>

        <br /><br />

        <!-- Responsive card and table -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Salesman denomination for the date - <strong style="font-size: 22px;"><span id="display-date"></span></strong>
            </div>
            <div class="card-body">

                
                <button class="btn btn-primary mb-3" type="button" id="approveButton">
                    <i class="far fa-thumbs-up"></i>&nbsp;&nbsp;Approve Selected
                </button>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="ledger-date"><strong>Select Date:</strong></label>
                        <input type="text" id="ledger-date" class="form-control" value="<?= date('Y-m-d'); ?>">
                    </div>
                </div>

                <!-- Responsive table wrapper -->
                <div class="table-responsive">
                    <!-- <div id="loaderOverlay">
                        <div class="loader-content">
                            <img src="<?= base_url('assets/img/loading.gif') ?>" alt="Loading..." />
                            <div class="loading-text">Loading data, please wait...</div>
                        </div>
                    </div> -->
                    <table class="table table-striped table-hover compact" id="cashier_sm_ledger" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr style="text-align: center">
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="select-all">
                                        <label class="form-check-label" for="select-all"></label>
                                    </div>
                                </th>
                                <th style="min-width: 70px">Denom No.</th>
                                <th style="min-width: 70px">SRR No.</th>
                                <th style="min-width: 130px">Salesman Name</th>
                                <th style="min-width: 80px">Total Cash</th>
                                <th style="min-width: 80px">Total Palawan Cash</th>
                                <th style="min-width: 80px">SM DC</th>
                                <th style="min-width: 80px">SM PDC</th>
                                <th style="min-width: 127px">Actual Remittance</th>
                                <th style="min-width: 127px">Total Remittance w/ Palawan</th>
                                <th style="min-width: 117px">Total Accountability</th>
                                <th style="min-width: 127px">Total Satellite</th>
                                <th>Total SRR (Manual)</th>
                                <?php if ($this->session->userdata('location') == 'LDI' || $this->session->userdata('location') == 'LDI-CDC' || $this->session->userdata('location') == 'LDI-UDC') { ?>
                                <th>Total Returns</th>
                                <th>Total W/Tax</th>
                                <th>Total B.O</th>
                                <?php } ?>
                                <!-- <?php if ($this->session->userdata('bu') == 'XTRUCK' || $this->session->userdata('bu') == 'XTRUCK-NETMAN' || $this->session->userdata('bu') == 'XTRUCK-NETMAN-BPI' || $this->session->userdata('bu') == 'XTRUCK-MPDI') { ?>
                                
                                <?php } ?> -->
                                <th>SM Incentives</th>
                                <th style="min-width: 85px">(+/-)</th>
                                <th style="min-width: 55px">Status</th>
                                <th style="min-width: 250px"></th>
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

<div id="viewSmChecks" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Salesman Checks</h4>
            </div>
            <div class="modal-body">
                <div id="viewsmchecks_content"></div>
            </div>
        </div>

    </div>
</div>

<div id="viewSmDenom" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

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
    <div class="modal-dialog modal-dialog-scrollable">

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

<div id="viewSmChecksLdi" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">


        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Salesman Checks</h4>
            </div>
            <div class="modal-body">
                <div id="viewsmchecks_content_ldi"></div>
            </div>
        </div>

    </div>
</div>

<div id="viewSmPalLdi" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">


        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Salesman Palawan</h4>
            </div>
            <div class="modal-body">
                <div id="viewsmpal_content_ldi"></div>
            </div>
        </div>

    </div>
</div>

<div id="editSmCheck" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Payments</h4>
        </div>
        <div class="modal-body">
            <div id="editsm_payment"></div>
        </div>
        </div>

    </div>
</div>

<div id="viewCashierPaymentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Payments</h4>
        </div>
        <div class="modal-body">
            <div id="viewcashierpayment_content"></div>
        </div>
        </div>

    </div>
</div>

<div id="viewAllSmDenom" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Salesman Total Denomination</h4>
            </div>
            <div class="modal-body">
                <div id="viewallsmdenom_content"></div>
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

<div id="smIncentives" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Salesman Incentives</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="incentives_submit">
                    <div id="incentives_content"></div>
                </form>
            </div>
        </div>

    </div>
</div>

<div id="smIncentivesEdit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Salesman Incentives</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="incentives_edit_submit">
                    <div id="incentives_edit_content"></div>
                </form>
            </div>
        </div>

    </div>
</div>

<div id="totalRemittance" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Total Remittance</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="remittance_submit">
                    <div id="remittance_content"></div>
                </form>
            </div>
        </div>

    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script>
// Select all checkbox
$(document).ready(function() {

    $('#approveButton').hide();


    $(document).on('click', '#select-all', function(event) {
        event.stopPropagation();

        // Toggle the state of all checkboxes excluding the header checkbox
        $('input[name="selected_denom[]"]').not(this).prop('checked', this.checked);

        updateButtonVisibility();
    });

    // Individual checkbox
    $(document).on('click', 'input[name="selected_denom[]"]', function() {
        if (!$(this).prop("checked")) {
            $('#select-all').prop("checked", false);
        }

        updateButtonVisibility();
    });

    function updateButtonVisibility() {
        var selectedValues = $('input[name="selected_denom[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        // Show or hide the button based on whether there are selected values
        if (selectedValues.length > 0) {
            $('#approveButton').show();
        } else {
            $('#approveButton').hide();
        }

        // Log or use the selected values as needed
        console.log(selectedValues);
    }


    $(document).on('click', '#approveButton', function() {

        // Get values of selected items
        var selectedValues = $('input[name="selected_denom[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        var loc = document.getElementById('location').value;

        if (loc != 'LDI' && loc != 'LDI-CDC' && loc != 'LDI-UDC')

            approve_sm_denoms(selectedValues);
        else {
            approve_sm_denomsldi(selectedValues);
        }
    });



});

function print_alldenom_dynamic() {
    let date = document.getElementById('ledger-date').value;
    if (!date) {
        alert('Please select a date first');
        return;
    }

    let location = "<?php echo $this->session->userdata('location'); ?>";

    if (location === 'UWDG') {
        print_alldenom_uwdg(date);
    } else if (location === 'LDI' || location === 'LDI-CDC' || location === 'LDI-UDC') {
        print_alldenom_LDI(date);
    } else {
        print_alldenom(date);
    }
}

function viewallsmdenom_dynamic() {
    let date = document.getElementById('ledger-date').value;
    if (!date) {
        alert('Please select a date first');
        return;
    }

    viewallsmdenom_content(date);
}
</script>