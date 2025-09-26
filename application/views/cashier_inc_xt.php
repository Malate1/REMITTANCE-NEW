<main>
    
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> -->
    <style>
        @media print {
               table td:last-child {display:none}
               table th:last-child {display:none}
            }
    </style>
    
    <div class="container-fluid">
        <h4 class="mt-4">Salesman Incentives</h4>
        <a onclick=backpage()>
        <button class="btn btn-primary">
            <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back
        </button></a><br/><br/>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                <?php if (!empty($row->full_name) && !empty($result2)): ?>
                    Salesman Incentives of salesman - <b style="font-size: 20px"><?php echo $row->full_name; ?></b>
                   
                <?php endif; ?>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table sm_checks compact" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Salesman</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $row2): ?>
                        <tr>
                            <td><?php echo $row2['id_no']; ?> - <?php echo $row2['full_name']; ?></td>
                            <td><?php echo number_format($row2['inc_balance'], 2); ?></td>
                            <td align="center">
                                <!-- Update Button -->
                                <a title="Update" 
                                style="color: orange; cursor: pointer;" 
                                onclick="update_inc_xt('<?php echo $row2['sm_code']; ?>')">
                                    <i class="fas fa-undo fa-lg"></i>
                                </a>&nbsp;&nbsp;

                                <!-- View Incentives Button (opens modal) -->
                                <a title="View Incentives" 
                                style="color: orange; cursor: pointer;" 
                                data-toggle="modal" 
                                data-target="#viewSmIncLdi" 
                                onclick="viewsminc_content_ldi('<?php echo $row2['sm_code']; ?>')">
                                    <i class="fas fa-eye fa-lg"></i>
                                </a>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</main>

<div id="viewSmIncLdi" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">


        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Salesman Incentives</h4>
            </div>
            <div class="modal-body">
                <div id="viewsminc_content_ldi"></div>
            </div>
        </div>

    </div>
</div>

<div id="viewSmIncUsedLdi" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">


        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Salesman Incentives Used</h4>
            </div>
            <div class="modal-body">
                <div id="viewsmincused_content_ldi"></div>
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

