<main>
    <div class="container-fluid">
        <h4 class="mt-4">Salesman Payments</h4>
        <a onclick=backpage()>
        <button class="btn btn-primary">
            <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back
        </button></a><br/><br/>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                <?php if (!empty($row->full_name) && !empty($result2)): ?>
                    Payments of salesman - <b style="font-size: 20px"><?php echo $row->full_name; ?></b>
                    on <b style="font-size: 20px"><?php echo date("F d, Y", strtotime($result2)); ?></b>
                <?php endif; ?>

            </div>
            <div class="card-body">

                <button class="btn btn-danger mb-3" type="button" id="deleteButton">
                    <i class="far fa-thumbs-up"></i>&nbsp;&nbsp;Delete Selected
                </button>
                <div class="table-responsive">
                <table class="table sm_checks compact" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="select-all">
                                    <label class="form-check-label" for="select-all"></label>
                                </div>
                            </th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Pay Type</th>
                            <th>SI No.</th>
                            <th>Ref. No</th>
                            <th>Amount</th>
                            <th>Tax</th>
                            <?php if($this->session->userdata('username') == 'admin') { ?>
                                <th>Action</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $row2) { ?>
                        <tr>
                            <td style="text-align: center">
                                
                                <input style="text-align: center" class="form-check-input" type="checkbox"
                                    id="select-all-denom" name="selected_payment[]"
                                    value="<?php echo $row2['pay_id']; ?>">
                                <input type="hidden" class="form-control"
                                    style="text-align: center; background-color: white" name="location"
                                    id="location" value="<?php echo $this->session->userdata('location'); ?>"
                                    readonly>
                               
                            </td>
                            <td><?php echo $row2['cus_code']; ?></td>
                            <td><?php echo $row2['name']; ?></td>
                            <td><?php echo $row2['pay_type']; ?></td>
                            <td><?php echo $row2['si_docno']; ?></td>
                            <td><?php echo $row2['ref_no']; ?></td>
                            <td><?php echo number_format($row2['pay_amount'],2); ?></td>
                            <td><?php echo number_format($row2['tax_amount'],2); ?></td>
                            
                            <?php if($this->session->userdata('username') == 'admin') { ?>
                                <td align="center">
                                    <?php
                                        if($row2['pay_type'] == 'CASH') {
                                            echo '<a title="Convert Cash" style="color: green;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick="cash_to_check_op('.$row2['pay_id'].')"><i class="fas fa-pen fa-lg"></i></a>&nbsp;&nbsp;';
                                        } else {
                                            echo '<a title="Edit Check" style="color: orange;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick="edit_sm_check_ldi_op('.$row2['pay_id'].')"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;';
                                            echo '<a title="Convert Check" style="color: red;cursor: pointer" onclick=change_check_op('.$row2['pay_id'].')><i class="fas fa-coins fa-lg"></i></a>&nbsp;&nbsp;';
                                        }

                                        echo '<a title="Delete Payment" style="color: red;cursor: pointer" onclick=delete_check_op('.$row2['pay_id'].')><i class="fas fa-trash fa-lg"></i></a>&nbsp;&nbsp;';
                                        echo '<a title="Move Payment" style="color: orange;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick=pay_to_ret_op('.$row2['pay_id'].')><i class="fas fa-sync-alt fa-lg"></i></a>&nbsp;&nbsp;';
                                        echo '<a title="Add Tax" style="color: skyblue;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick=edit_sm_check_ldi_tax_op('.$row2['pay_id'].')><i class="fas fa-plus fa-lg"></i></a>&nbsp;&nbsp;';
                                        echo '<a title="Minus Tax" style="color: skyblue;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick=edit_sm_check_ldi_tax_op_minus('.$row2['pay_id'].')><i class="fas fa-minus fa-lg"></i></a>&nbsp;&nbsp;';
                                    ?>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>


                </div>
            </div>
        </div>
    </div>
</main>

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

<div id="moveSmCheck" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Payments</h4>
        </div>
        <div class="modal-body">
            <div id="movesm_payment"></div>
        </div>
        </div>

    </div>
</div>

<div id="viewCasherPaymentModal" class="modal fade" role="dialog">
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

<div id="customerModal2" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Customer Masterfile</h4>
        </div>
        <div class="modal-body">
            <form method="post" id="user_submit">
                <div id="customer_masterfile">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Select customer to proceed check input.
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" id="customer2">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script>
// Select all checkbox
$(document).ready(function() {

    $('#deleteButton').hide();


    $(document).on('click', '#select-all', function(event) {
        event.stopPropagation();

        // Toggle the state of all checkboxes excluding the header checkbox
        $('input[name="selected_payment[]"]').not(this).prop('checked', this.checked);

        updateButtonVisibility();
    });

    // Individual checkbox
    $(document).on('click', 'input[name="selected_payment[]"]', function() {
        if (!$(this).prop("checked")) {
            $('#select-all').prop("checked", false);
        }

        updateButtonVisibility();
    });

    function updateButtonVisibility() {
        var selectedValues = $('input[name="selected_payment[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        // Show or hide the button based on whether there are selected values
        if (selectedValues.length > 0) {
            $('#deleteButton').show();
        } else {
            $('#deleteButton').hide();
        }

        // Log or use the selected values as needed
        console.log(selectedValues);
    }


    $(document).on('click', '#deleteButton', function() {

        // Get values of selected items
        var selectedValues = $('input[name="selected_payment[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        console.log(selectedValues);

        delete_sm_payments(selectedValues);
        
    });



});
</script>