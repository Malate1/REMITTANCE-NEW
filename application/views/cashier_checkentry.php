<main>
    <div class="float-container">
        <h4 class="mt-4">Payments (SRR No. <?php echo $result3; ?>)</h4>
        <div class="float-child">
        <form method="post" id="submit_sm_payment">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="code">Code</label>
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="userid" id="userid" autocomplete="off" value="<?php echo $result->user_id ?>" required>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="code" id="code" autocomplete="off" required>
                </div>
                <div class="form-group col-md-7">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="name" id="name" autocomplete="off" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="name"></label>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-toggle="modal" data-controls-modal="#customerModal" data-backdrop="static" data-keyboard="false" data-target="#customerModal" id="btncustomer" onclick=customer_masterfile()>Select Customer</button>
                </div>
            </div>
            <div class="form-row">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="check" id="DC" value="DC" required>
                    <label class="form-check-label" for="DC">Dated Check (DC)</label>
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="check" id="PDC" value="PDC" required>
                    <label class="form-check-label" for="PDC">Post Dated Check (PDC)</label>
                </div>
            </div><br/>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="checkno">Check No.</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="checkno" id="checkno" autocomplete="off" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="duedate">Check Date</label>
                    <input type="date" class="form-control" style="text-align: center;background-color: white" name="duedate" id="duedate" autocomplete="off" onblur="TDate()" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="accnum">Account Number</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" onblur="accountname(this.value)" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="accname">Account Name</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="accname" id="accname" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="bank">Bank</label>
                    <select class="form-control" name="bank" id="bank" required>
                        <option></option>
                        <?php foreach($result1 as $row) { ?>
                            <option value="<?php echo $row->code; ?>"><?php echo $row->code .'-'. $row->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="amount">Check Amount</label>
                    <input type="text" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" required>
                </div>
            </div>
            <input type="hidden" class="form-control" value="<?php echo $result->total_dc; ?>" style="text-align: center;background-color: white" name="dcamt" id="dcamt" autocomplete="off">
            <input type="hidden" class="form-control" value="<?php echo $result->total_pdc; ?>" style="text-align: center;background-color: white" name="pdcamt" id="pdcamt" autocomplete="off">
            <input type="hidden" value="<?php echo $result2; ?>" class="form-control" name="date" id="date" autocomplete="off">
            <input type="hidden" value="<?php echo $result3; ?>" class="form-control" name="denomid" id="denomid" autocomplete="off">
            <a onclick=backpage()><input type="button" style="float: right" class="btn btn-secondary" value="Cancel"></a>
            <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Payment</button>
        </form>
        </div>
        <div class="float-child">
            <h4 class="mt-4">Salesman Denomination Details</h4><br/>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Salesman Name: </label>
                </div>
                <div class="form-group col-md-8">
                    <label style="font-weight: bold"><?php echo $result->full_name; ?></label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Total Cash: </label>
                </div>
                <div class="form-group col-md-8">
                    <label style="font-weight: bold">₱ <?php echo number_format($result->total_cash,2); ?></label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Salesman DC: </label>
                </div>
                <div class="form-group col-md-3">
                    <label style="font-weight: bold">₱ <?php echo number_format($result->total_dc,2); ?></label>
                </div>
                <div class="form-group col-md-1">
                    <label>Pcs.: </label>
                </div>
                <div class="form-group col-md-3">
                    <label style="font-weight: bold"><?php echo $result->dc_pcs; ?></label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Salesman PDC: </label>
                </div>
                <div class="form-group col-md-3">
                    <label style="font-weight: bold">₱ <?php echo number_format($result->total_pdc,2); ?></label>
                </div>
                <div class="form-group col-md-1">
                    <label>Pcs.: </label>
                </div>
                <div class="form-group col-md-3">
                    <label style="font-weight: bold"><?php echo $result->pdc_pcs; ?></label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Cashier DC: </label>
                </div>
                <div class="form-group col-md-3">
                    <label style="font-weight: bold">₱ <?php echo number_format($result->cashier_dc,2); ?></label>
                </div>
                <div class="form-group col-md-1">
                    <label>Pcs.: </label>
                </div>
                <div class="form-group col-md-3">
                    <label style="font-weight: bold"><?php echo $result->cashier_dcpcs; ?></label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Cashier PDC: </label>
                </div>
                <div class="form-group col-md-3">
                    <label style="font-weight: bold">₱ <?php echo number_format($result->cashier_pdc,2); ?></label>
                </div>
                <div class="form-group col-md-1">
                    <label>Pcs.: </label>
                </div>
                <div class="form-group col-md-3">
                    <label style="font-weight: bold"><?php echo $result->cashier_pdcpcs; ?></label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Total Collection: </label>
                </div>
                <div class="form-group col-md-3">
                    <label style="font-weight: bold">₱ <?php echo number_format($result->total_collection,2); ?></label>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Payment check(s) of salesman - <b style="font-size: 20px"><?php echo $result->full_name; ?> (SRR No. <?php echo $result3; ?>)</b>
                on <b style="font-size: 20px"><?php echo date("F d, Y", strtotime($result2)); ?></b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table sm_checks compact" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>Code</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Check No.</th>
                                <th>Check Date</th>
                                <th>Bank</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($results as $row2) { ?>
                            <tr>
                                <td><?php echo $row2['cus_code']; ?></td>
                                <td><?php echo $row2['name']; ?></td>
                                <td align="center"><?php echo $row2['type']; ?></td>
                                <td align="center"><?php echo $row2['check_no']; ?></td>
                                <td align="center"><?php echo $row2['due_date']; ?></td>
                                <td align="center"><?php echo $row2['bank']; ?></td>
                                <td align="right"><?php echo number_format($row2['amount'],2); ?></td>
                            <?php 
                            if($row2['pay_date']==date('Y-m-d')) {
                             echo '<td align="center">';
                            //  if($row2['status']=="") {
                            echo '<a title="Edit Check" style="color: green;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick=edit_sm_check('.$row2['payment_id'].')><i class="fas fa-pen fa-lg"></i></a>&nbsp;&nbsp;';
                            //   } 
                            echo '<a title="View Check" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewCasherPaymentModal" onclick=viewcashierpayment_content('.$row2['payment_id'].')><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;';
                            //  if($row2['status']=="") { 
                            if($this->session->userdata('id_no') == '01000018832'){
                                     echo '<a title="Delete Check2" style="color: red;cursor: pointer" onclick="deletecashier_content(' . $row2['payment_id'] . ', \'' . $result3 . '\')"><i class="fas fa-trash fa-lg"></i></a>';
                                  }
                            //   } 
                            echo '</td>';
                              } 
                            else 
                            { 
                            echo '<td align="center">';
                                  echo '<a title="Edit Check" style="color: green;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick=edit_sm_check('.$row2['payment_id'].')><i class="fas fa-pen fa-lg"></i></a>&nbsp;&nbsp;';
                                  echo '<a title="View Check" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewCasherPaymentModal" onclick=viewcashierpayment_content('.$row2['payment_id'].')><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;';
                                  if($this->session->userdata('id_no') == '01000018832'){
                                     echo '<a title="Delete Check2" style="color: red;cursor: pointer" onclick="deletecashier_content(' . $row2['payment_id'] . ', \'' . $result3 . '\')"><i class="fas fa-trash fa-lg"></i></a>';
                                  }
                                 
                            echo '</td>'; 
                            } 
                            echo '</tr>'; 
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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
                            <div class="table-responsive customermasterfile">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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

<!-- <script type="text/javascript">
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("duedate")[0].setAttribute('min', today);

    function TDate() {
    var UserDate = document.getElementById("duedate").value;
    var duedate = document.getElementById("duedate");
    var ToDate = new Date();
    var ttoday = new Date();

    ToDate.setDate(ttoday.getDate()-1);
    
    if (new Date(UserDate).getTime() < ToDate.getTime()) {
        alert("The Date must be Bigger or Equal to today date");
        duedate.value = "";
        return false;
    }
    return true;}
</script> -->