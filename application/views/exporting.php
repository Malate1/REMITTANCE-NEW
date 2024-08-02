<main>
    <div class="container-fluid">
        <h4 class="mt-4">Export Checks and Cash</h4><br/>
        <div class="col-xl-4">
            <form method="post" id="export_submit">
                <p>Select Date</p>
                <div class="custom-file mb-3">
                    <input type="date" class="form-control" style="text-align: center;background-color: white" name="datenow" id="datenow" autocomplete="off" required>
                </div>
                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif" style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" style="float: right" type="submit" id="exportTextfile" name="submit" value="submit">Export Data</button>
            </form>
        </div>
    </div>
</main>