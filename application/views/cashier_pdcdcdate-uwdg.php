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
                <div class="form-group col-md-1">
                </div>
                <div class="form-group col-md-5">
                    <label class="radio" style="font-weight: bold">
                            <input type="radio" name="reportradiotype" value="All" checked>
                            All Banks <i style="font-size:10px"></i><br/>
                            <input type="radio" name="reportradiotype" value="OtherBanks">
                            Other Banks <i style="font-size:10px">(All Banks exc. PNB)</i><br/>
                            <input type="radio" name="reportradiotype" value="PNBBanks">
                            PNB Banks <i style="font-size:10px">(All PNB Banks)</i><br/>
                            <input type="radio" name="reportradiotype" value="PerBank">
                            Per Bank <br/>
                            <select class="form-control" name="bank" id="bank" required>
                                <?php foreach($result1 as $row) { ?>
                                    <option value="<?php echo $row->code; ?>"><?php echo $row->code .'-'. $row->name; ?></option>
                                <?php } ?>
                            </select><br/>
                            User Type
                            <select class="form-control" name="utype" id="utype" required>
                                <option value="All">All</option>
                                <option value="Salesman">Salesman</option>
                                <option value="JefeDeViaje">JefeDeViaje</option>
                                <option value="Walk-In">Walk-In</option>
                                <option value="OtherCharges">OtherCharges</option>
                            </select>
                        </label>
                </div>
            </div>
            <div class="form-row" style="float:right">
                <div class="form-group col-md-12">
                    <a href="#" target="_blank"><button class="btn btn-primary" onclick=pdcdc_form_date2()>Generate Report</button></a>
                    <a href="#" target="_blank"><button class="btn btn-success" onclick=pdcdc_excel_date2()>Generate Excel</button></a>
                </div>
            </div>
      </div>
  </div>
</main>