<main>
    
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> -->
    <style>
        @media print {
               table td:last-child {display:none}
               table th:last-child {display:none}
            }
    </style>
    
    <div class="container-fluid">
        <h4 class="mt-4">Extruck Salesman Satellite Remittance</h4>
        <a onclick=backpage()>
        <button class="btn btn-primary">
            <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back
        </button></a><br/><br/>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                <?php if (!empty($row->full_name) && !empty($result2)): ?>
                    Satellite Payments of salesman - <b style="font-size: 20px"><?php echo $row->full_name; ?></b>
                    from <b style="font-size: 20px"><?php echo date("F d, Y", strtotime($result2)); ?></b> to <b style="font-size: 20px"><?php echo date("F d, Y", strtotime($result3)); ?></b>
                <?php endif; ?>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table sm_checks compact" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>Date</th>
                                <th>Order No</th>
                                <th>Warehouse</th>
                                <th>Payment Type</th>
                                <th>Ref. No</th>
                                
                                <th> Amount</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $row2) { ?>
                            <tr>
                                <td><?php echo $row2['date_requested']; ?></td>
                                <td><?php echo $row2['order_no']; ?></td>
                                <td><?php echo $row2['warehouse']; ?></td>
                                <td><?php echo $row2['pay_type']; ?></td>
                                <td><?php echo $row2['ref_no']; ?></td>
                                
                                <td><?php echo number_format($row2['appr_amount'], 2); ?></td>
                                
                                
                            
                            <?php 
                           
                                echo '<td align="center">';
                               
                                echo '<a title="Delete Payment" style="color: red;cursor: pointer" onclick=delete_satellite_xt('.$row2['pay_id'].')><i class="fas fa-trash fa-lg"></i></a>&nbsp;&nbsp;';

                                
                            echo '</td>';
                            
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

