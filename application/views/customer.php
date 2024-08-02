<main>
    <div class="container-fluid">
        <h4 class="mt-4">Customer</h4><br/>
        <div class="col-xl-5">
        <button type="button" class="btn btn-info btn-sm" style="float: right;margin-left:5px" data-toggle="modal" data-toggle="modal" data-controls-modal="#customerModal" data-backdrop="static" data-keyboard="false" data-target="#customerModal" onclick=customer_masterfile()>View Customer</button>
        <button type="button" class="btn btn-info btn-sm" style="float: right;margin-left:5px" data-toggle="modal" data-toggle="modal" data-controls-modal="#customerModal3" data-backdrop="static" data-keyboard="false" data-target="#customerModal3" onclick=customer_masterfile3()>View CCD Customer</button>
        <!-- <button type="button" class="btn btn-info btn-sm" style="float: right" data-toggle="modal" data-toggle="modal" data-controls-modal="#customerModal4" data-backdrop="static" data-keyboard="false" data-target="#customerModal4" onclick=customer_masterfile4()>View WDG Customer</button> -->
        <br/><br/>
            <form method="post" id="file_submit">
                <!-- <p>Customer Textfile</p> -->
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="customFile" name="filenames" onchange="checkFile(this)" required>
                    <label class="custom-file-label" for="customFile">Choose Textfile</label>
                </div>
                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif" style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" style="float: right" type="submit" id="uploadTextfile" name="submit" value="submit">Upload Textfile</button>
            </form>
            <br/><br/>
            <form method="post" id="submit_customer">
                <div class="form-group">
                    <label for="username">Customer Code</label>
                    <input type="text" class="form-control" name="codes" id="codes" autocomplete="off" placeholder="Customer Code" required>
                </div>
                <div class="form-group">
                    <label for="idno">Customer Name</label>
                    <input type="text" class="form-control" name="names" id="names" autocomplete="off" placeholder="Customer Name" required>
                </div>
                <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save Customer </button>
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

<div id="customerModal3" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">CCD Customer Masterfile</h4>
        </div>
        <div class="modal-body">
            <form method="post" id="user_submit">
                <div id="customer_masterfile">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Select customer to add to your customer masterfile.
                        </div>
                        <div class="card-body">
                            <div class="table-responsive customermasterfile2">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<div id="customerModal4" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">WDG Customer Masterfile</h4>
        </div>
        <div class="modal-body">
            <form method="post" id="user_submit">
                <div id="customer_masterfile">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Select customer to add to your customer masterfile.
                        </div>
                        <div class="card-body">
                            <div class="table-responsive customermasterfile3">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>