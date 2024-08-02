<main>
    <div class="container-fluid">
        <h4 class="mt-4">Bank</h4>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addBankModal" onclick=addbank_content()>
            <i class="fas fa-comment-dollar"></i>&nbsp;&nbsp;Add Bank
        </button><br/><br/>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Bank List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover compact" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Bank Code</th>
                                <th>Bank Name</th>
                                <th>Business Unit</th>
                                <th>Bank Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $row) { ?>
                            <tr>
                            <td><?php echo $row->code; ?></td>
                            <td><?php echo $row->name; ?></td>
                            <td><?php echo $row->bu; ?></td>
                            <td><?php echo $row->bank_type; ?></td>
                            <td align="center">
                            <a title="Modify User" style="color: green;cursor: pointer" data-toggle="modal" data-target="#editBankModal" onclick=editbank_content(<?php echo $row->bank_id; ?>)><i class="fas fa-pen"></i></a>&nbsp;&nbsp;
                            <a title="Delete User" style="color: red;cursor: pointer" onclick=deletebank_content(<?php echo $row->bank_id; ?>)><i class="fas fa-trash"></i></a>&nbsp;&nbsp;
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

<div id="addBankModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Bank</h4>
        </div>
        <div class="modal-body">
            <form method="post" id="bank_submit">
                <div id="addbank_content"></div>
            </form>
        </div>
        </div>

    </div>
</div>

<div id="editBankModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modify Bank</h4>
        </div>
        <div class="modal-body">
            <form method="post" id="bank_edit">
                <div id="editbank_content"></div>
            </form>
        </div>
        </div>

    </div>
</div>