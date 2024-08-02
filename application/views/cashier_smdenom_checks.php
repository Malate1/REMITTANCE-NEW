<main>
    <div class="container-fluid">
        <h4 class="mt-4">Salesman Check Entry</h4>
        <a onclick=backpage()>
        <button class="btn btn-primary">
            <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back
        </button></a><br/><br/>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Payment check(s) of salesman - <b style="font-size: 20px"><?php echo $row->full_name; ?> (SRR No. <?php echo $result3; ?>)</b>
                on <b style="font-size: 20px"><?php echo date("F d, Y", strtotime($paydate)); ?></b>
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
                            echo '<a title="Delete Check" style="color: red;cursor: pointer" onclick=deletecashier_content('.$row2['payment_id'].')><i class="fas fa-trash fa-lg"></i></a>';
                            //   } 
                            echo '</td>';
                              } 
                            else 
                            { 
                            echo '<td align="center">';
                                  echo '<a title="Edit Check" style="color: green;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick=edit_sm_check('.$row2['payment_id'].')><i class="fas fa-pen fa-lg"></i></a>&nbsp;&nbsp;';
                                  echo '<a title="View Check" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewCasherPaymentModal" onclick=viewcashierpayment_content('.$row2['payment_id'].')><i class="fas fa-eye fa-lg"></i></a>';
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