<main>
    <div class="container-fluid">
        <h4 class="mt-4">Check Clearing</h4>
        <a href="<?php echo base_url('/checkclearingdate'); ?>">
        <button class="btn btn-primary">
            <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back
        </button></a>
        <!-- <a style="cursor: pointer" onclick=print_alldenom('<?php echo $result2; ?>')>
        <button class="btn btn-success" style="float:right;margin-left: 5px">
            <i class="fas fa-print"></i>&nbsp;&nbsp;Print Collection Summary
        </button></a>
        <a style="cursor: pointer" data-toggle="modal" data-target="#viewAllSmDenom" onclick=viewallsmdenom_content('<?php echo $result2; ?>')>
        <button class="btn btn-info" style="float:right">
            <i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;All Salesman Denomination
        </button></a> -->
        <br/><br/>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Checks that are over due or due for the date - <b style="font-size: 20px"><?php echo date("F d, Y",strtotime($result2)); ?></b>.
            </div>
            <div class="card-body">
                <div>
                    <table class="table table-striped table-hover compact" id="check_clear_ledger" width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center">
                                <!-- <th style="min-width: 130px">Customer Name</th> -->
                                <th style="min-width: 77px">Check No.</th>
                                <th style="min-width: 10px">Type</th>
                                <th style="min-width: 70px">Due Date</th>
                                <th style="min-width: 80px">Acc. Name</th>
                                <th style="min-width: 85px">Acc. No.</th>
                                <th style="min-width: 30px">Bank</th>
                                <th style="min-width: 80px">Amount</th>
                                <th style="min-width: 120px"></th>
                                <th style="min-width: 5px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $row) { ?>
                            <tr>
                                <!-- <td><?php echo $row->name; ?></td> -->
                                <td style="text-align: left"><?php echo $row->check_no; ?></td>
                                <td style="text-align: center"><?php echo $row->type; ?></td>
                                <td style="text-align: center"><?php echo $row->due_date; ?></td>
                                <td style="text-align: left"><?php echo $row->acc_name; ?></td>
                                <td style="text-align: left"><?php echo $row->acc_num; ?></td>
                                <td style="text-align: center"><?php echo $row->bank; ?></td>
                                <td style="text-align: right"><?php echo number_format($row->amount,2); ?></td>
                                <td style="text-align: center">
                                    <select style="width:120px" class="form-control" name="status" id="status" value="<?php echo $row->status; ?>" onchange="checkstatus(<?php echo $row->payment_id; ?>,this.value)">
                                        <?php if($row->status=='Cleared'){$select1='selected';}else{$select1='';} ?>
                                        <?php if($row->status=='Bounce'){$select2='selected';}else{$select2='';} ?>
                                        <?php if($row->status=='Redeposit'){$select3='selected';}else{$select3='';} ?>
                                        <option></option>
                                        <option <?php echo $select1; ?>>Cleared</option>
                                        <option <?php echo $select2; ?>>Bounce</option>
                                        <option <?php echo $select3; ?>>Redeposit</option>
                                    </select>
                                </td>
                                <td>
                                    <a title="Remarks" style="color: #A074C4;cursor: pointer" data-toggle="modal" data-target="#checkRemarks" onclick=check_remarks(<?php echo $row->payment_id; ?>)><?php if($row->remarks=="") { echo '<i class="far fa-comment fa-lg"></i>'; }else{ echo '<i class="fas fa-comment"></i>'; } ?></a>&nbsp;&nbsp;
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

<div id="checkRemarks" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Remarks</h4>
        </div>
        <div class="modal-body">
            <form method="post" id="checkremarks_submit">
                <div id="check_remarks"></div>
            </form>
        </div>
        </div>

    </div>
</div>