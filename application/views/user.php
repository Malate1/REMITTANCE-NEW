<main>
    <div class="container-fluid">
        <h4 class="mt-4">User</h4>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal" onclick=adduser_content()>
            <i class="fas fa-user-circle"></i>&nbsp;&nbsp;Add User
        </button><br/><br/>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                User List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover compact" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>BU</th>
                                <th>Location</th>
                                <th>User Type</th>
                                <th>ID No.</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $row) { ?>
                            <tr>
                            <td><?php echo $row->full_name; ?></td>
                            <td><?php echo $row->username; ?></td>
                            <td><?php echo $row->bu; ?></td>
                            <td><?php echo $row->location; ?></td>
                            <td><?php echo $row->type; ?></td>
                            <td><?php echo $row->id_no; ?></td>
                            <td><?php echo $row->status; ?></td>
                            <td align="center">
                            <a title="Modify User" style="color: green;cursor: pointer" data-toggle="modal" data-target="#editUserModal" onclick=edituser_content(<?php echo $row->user_id; ?>)><i class="fas fa-pen"></i></a>&nbsp;&nbsp;
                            <a title="Delete User" style="color: red;cursor: pointer" onclick=deleteuser_content(<?php echo $row->user_id; ?>)><i class="fas fa-trash"></i></a>&nbsp;&nbsp;
                            <a title="Reset Password" style="color: orange;cursor: pointer" onclick=resetuser_content(<?php echo $row->user_id; ?>)><i class="fas fa-recycle"></i></a>
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

<div id="addUserModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add User</h4>
        </div>
        <div class="modal-body">
            <form method="post" id="user_submit">
                <div id="adduser_content"></div>
            </form>
        </div>
        </div>

    </div>
</div>

<div id="editUserModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modify User</h4>
        </div>
        <div class="modal-body">
            <form method="post" id="user_edit">
                <div id="edituser_content"></div>
            </form>
        </div>
        </div>

    </div>
</div>