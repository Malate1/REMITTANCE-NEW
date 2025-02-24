<main>
    <div class="container-fluid">
        <h4 class="mt-4">Payments</h4>
        <div class="col-xl-6">
        <form method="post" id="edit_cashier_payment">
            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" placeholder="id" value="<?php echo $result->payment_id; ?>">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="code" id="code" placeholder="Code" value="<?php echo $result->cus_code; ?>" readonly>
                </div>
                <div class="form-group col-md-7">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="name" id="name" value="<?php echo $result->name; ?>" readonly>
                </div>
                <div class="form-group col-md-2">
                    <label for="name"></label>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-toggle="modal" data-controls-modal="#customerModal" data-backdrop="static" data-keyboard="false" data-target="#customerModal" onclick=customer_masterfile()>Select Customer</button>
                </div>
            </div>
            <div class="form-row">
                <?php if($result->type=='PDC'){$pdc='checked';}else{$pdc='';} ?>
                <?php if($result->type=='DC'){$dc='checked';}else{$dc='';} ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="check" id="DC" <?php echo $dc; ?> value="DC" required>
                    <label class="form-check-label" for="DC">Dated Check (DC)</label>
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="check" id="PDC" value="PDC" <?php echo $pdc; ?> required>
                    <label class="form-check-label" for="PDC">Post Dated Check (PDC)</label>
                </div>
            </div><br/>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="checkno">Check No.</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="checkno" id="checkno" autocomplete="off" value="<?php echo $result->check_no; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="duedate">Check Date</label>
                    <input type="date" class="form-control" style="text-align: center;background-color: white" name="duedate" id="duedate" autocomplete="off" value="<?php echo $result->due_date; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="accname">Account Name</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="accname" id="accname" autocomplete="off" value="<?php echo $result->acc_name; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="accnum">Account Number</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" autocomplete="off" value="<?php echo $result->acc_num; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="bank">Bank</label>
                    <select class="form-control" name="bank" id="bank" required>
                        <option></option>
                        <?php foreach($result1 as $row) { ?>
                            <?php if($row->code==$result->bank){$select='selected';}else{$select='';} ?>
                            <option value="<?php echo $row->code; ?>" <?php echo $select; ?>><?php echo $row->code .'-'. $row->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="amount">Check Amount</label>
                    <input type="number" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="<?php echo $result->amount; ?>" required>
                </div>
            </div>
            <input type="hidden" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="date" id="date" autocomplete="off">
            <a href="<?= base_url('/cashpaydata'); ?>/<?php echo $result->pay_date; ?>"><input type="button" style="float: right" class="btn btn-secondary" value="Cancel"></a>
            <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Update Payment</button>
        </form>
      </div>
  </div>
</main>

<div id="customerModal" class="modal fade" role="dialog">
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
                            <div class="table-responsive">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("duedate")[0].setAttribute('min', today);
</script>