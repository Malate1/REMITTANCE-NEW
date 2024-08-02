<main>
    <div class="container-fluid">
    <h4 class="mt-4">Accountability Report</h4><br/>
        <div class="col-xl-6">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="datenow">Select Date</label>
                    <input type="date" class="form-control" style="text-align: center;background-color: white" name="datenow" id="datenow" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <a href="#" target="_blank"><button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" onclick=account_form_date()>Generate Report</button></a>
                </div>
            </div>
      </div>
  </div>
</main>