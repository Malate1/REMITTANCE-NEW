<main>
    <div class="container-fluid">
        <h4 class="mt-4">Cashier Record (Payments) <label style="font-size:16px;color: red;font-style: italic">(Previous records cannot be edited or deleted!)</label></h4>
        <a href="<?php echo base_url('/cashier_date'); ?>">
        <button class="btn btn-primary">
            <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back
        </button></a><br/><br/>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Payment List for the date - <b style="font-size: 20px"><?php echo date("F d, Y",strtotime($result2)); ?></b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover compact" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center">
                                <th>Code</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Check No.</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $row) { ?>
                            <tr>
                                <td><?php echo $row->cus_code; ?></td>
                                <td><?php echo $row->name; ?></td>
                                <td style="text-align: center"><?php echo $row->type; ?></td>
                                <td style="text-align: center"><?php echo $row->check_no; ?></td>
                                <td style="text-align: right"><?php echo number_format($row->amount,2); ?></td>
                                <td align="center">
                                <?php if($row->pay_date==date('Y-m-d')) { ?>
                                <a title="Modify Denomination" style="color: green;cursor: pointer" href="<?= base_url('/cashieredit'); ?>/<?php echo $row->payment_id; ?>"><i class="fas fa-pen"></i></a>&nbsp;&nbsp;
                                <a title="View Denomination" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewCasherPaymentModal" onclick=viewcashierpayment_content(<?php echo $row->payment_id; ?>)><i class="fas fa-eye"></i></a>&nbsp;&nbsp;
                                <a title="Delete Denomination" style="color: red;cursor: pointer" onclick=deletecashier_content(<?php echo $row->payment_id; ?>)><i class="fas fa-trash"></i></a>&nbsp;&nbsp;
                                <?php }else{ ?>
                                    <a title="View Denomination" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewCasherPaymentModal" onclick=viewcashierpayment_content(<?php echo $row->payment_id; ?>)><i class="fas fa-eye"></i></a>&nbsp;&nbsp;
                                <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

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