<main>
    <div class="container-fluid">
        <h4 class="mt-4">Cashier Record (Denomination) <label style="font-size:16px;color: red;font-style: italic">(Previous records cannot be edited or deleted!)</label></h4>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Denomination List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover compact" id="cashier_denom_ledger" width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center">
                                <th>Date</th>
                                <th>1000</th>
                                <th>500</th>
                                <th>200</th>
                                <th>100</th>
                                <th>50</th>
                                <th>20</th>
                                <th>Coins</th>
                                <th>Total Cash</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $row) { ?>
                            <tr style="text-align: right">
                                <td style="text-align: center"><?php echo $row->date_added; ?></td>
                                <td><?php echo number_format($row->amt_1000,2); ?></td>
                                <td><?php echo number_format($row->amt_500,2); ?></td>
                                <td><?php echo number_format($row->amt_200,2); ?></td>
                                <td><?php echo number_format($row->amt_100,2); ?></td>
                                <td><?php echo number_format($row->amt_50,2); ?></td>
                                <td><?php echo number_format($row->amt_20,2); ?></td>
                                <td><?php echo number_format($row->total_coins,2); ?></td>
                                <td><?php echo number_format($row->total_cash,2); ?></td>
                                <td align="center">
                                <?php if($row->date_added==date('Y-m-d') && $row->status=="") { ?>
                                <a title="Modify Denomination" style="color: green;cursor: pointer" href="<?= base_url('/cashierdenom_edit'); ?>/<?php echo $row->denom_id; ?>"><i class="fas fa-pen"></i></a>&nbsp;&nbsp;
                                <a title="View Denomination" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewCashierDenom" onclick=viewcashierdenom_content(<?php echo $row->denom_id; ?>)><i class="fas fa-eye"></i></a>&nbsp;&nbsp;
                                <a title="Delete Denomination" style="color: red;cursor: pointer" onclick=deletedenom_content(<?php echo $row->denom_id; ?>)><i class="fas fa-trash"></i></a>&nbsp;&nbsp;
                                <?php }else{ ?>
                                    <a title="View Denomination" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewCashierDenom" onclick=viewcashierdenom_content(<?php echo $row->denom_id; ?>)><i class="fas fa-eye"></i></a>&nbsp;&nbsp;
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

<div id="viewCashierDenom" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Denomination</h4>
        </div>
        <div class="modal-body">
            <div id="viewcashierdenom_content"></div>
        </div>
        </div>

    </div>
</div>