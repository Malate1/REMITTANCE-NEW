<main>
    <div class="container-fluid">
        <h4 class="mt-4">Accountability Record</h4><br/>
        <a onclick=backpage()>
        <button class="btn btn-primary">
            <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back
        </button></a><br/><br/>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Salesman accountability record on - <b style="font-size: 20px"><?php echo date("F d, Y", strtotime($result)); ?></b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table sm_checks compact table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>Salesman Name</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result1 as $row) { ?>
                            <tr>
                                <td><?php echo $row['full_name']; ?></td>
                                <td align="right"><?php echo number_format($row['amount'],2); ?></td>
                                <?php if(date("Y-m-d", strtotime($result))==date('Y-m-d')) { ?>
                                <td align="center"><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editSalesman" onclick=sm_edit(<?php echo $row['account_id']; ?>)>Edit Salesman</button>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#tagCustomer" data-backdrop="static" data-keyboard="false" onclick=cus_tagging('<?php echo $result; ?>',<?php echo $row['user_id']; ?>)>Tag Customer</button></td>
                                <?php }else{ ?>
                                <td align="center"><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#tagCustomer" data-backdrop="static" data-keyboard="false" onclick=cus_tagging('<?php echo $result; ?>',<?php echo $row['user_id']; ?>)>Tag Customer</button></td>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<div id="editSalesman" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Salesman</h4>
        </div>
        <div class="modal-body">
            <form method="post" id="edit_salesman">
                <div id="sm_content"></div>
            </form>
        </div>
        </div>

    </div>
</div>

<div id="tagCustomer" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tag Customer</h4>
        </div>
        <div class="modal-body">
            <form method="post" id="tag_customer">
                <div id="cus_content"></div>
            </form>
        </div>
        </div>

    </div>
</div>