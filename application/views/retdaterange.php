<main>
    <div class="container-fluid">
        <h4 class="mt-4">Return PDC/DC Report</h4><br />
        <div class="col-xl-12" style="width: 100%">
            
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="datefrom">Start Date</label>
                    <input type="date" class="form-control" style="text-align: center;background-color: white"
                        name="datefrom" id="datefrom" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required>
                </div>

                <div class="form-group col-md-3">
                    <label for="dateto">End Date</label>
                    <input type="date" class="form-control" style="text-align: center;background-color: white"
                        name="dateto" id="dateto" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required>
                </div>

                

            </div>
            <div class="form-row">
                <div class="form-group">
                    <?php 
                    if($this->session->userdata('bu')!='OPLAN') { ?>
                        <button type="submit"  class="btn btn-primary" id="oplanButton" onclick="checkreturned()">Generate Report</button>
                    <?php } else { ?>
                        <button type="submit"  class="btn btn-primary" id="oplanButton" onclick="checkreturnedop()">Generate Report</button>
                    <?php } ?>

                    
                </div>
            </div>
        </div>
    </div>

    
</main>