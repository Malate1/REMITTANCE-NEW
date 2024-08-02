<main>
    <div class="container-fluid">
    <h4 class="mt-4">PDC and DC Report</h4><br/>
        <div class="col-xl-6">
            <div class="form-row">
                <div class="form-group col-md-5">
                <label for="datenow">Start Date</label>
                    <input type="date" class="form-control" style="text-align: center;background-color: white" name="datenow1" id="datenow1" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required>
                    <label for="datenow">End Date</label>
                    <input type="date" class="form-control" style="text-align: center;background-color: white" name="datenow" id="datenow" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required>
                    <label class="radio" style="font-weight: bold">
                        <input type="radio" name="reportradio" value="PDC">
                        PDC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="reportradio" value="DC">
                        DC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="reportradio" value="BOTH" checked>
                        Both
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <a href="#" target="_blank"><button class="btn btn-primary" onclick=pdcdc_form_date()>Generate Report</button></a>
                    <a href="#" target="_blank"><button class="btn btn-success" onclick=pdcdc_excel_date()>Generate Excel</button></a>
                </div>
            </div>
      </div>
  </div>
</main>