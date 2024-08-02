<main>
    <div class="container-fluid">
        <h4 class="mt-4">Import Accountability Textfile</h4><br/>
        <div class="col-xl-4">
            <form method="post" id="import_submit">
                <!-- <p>Select Date</p> -->
                <!-- <div class="custom-file mb-3">
                    <input type="date" class="form-control" style="text-align: center;background-color: white" name="datenow" id="datenow" autocomplete="off" required>
                </div> -->
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="customFile" name="filenames" onchange="checkFile(this)" required>
                    <label class="custom-file-label" for="customFile">Choose Textfile</label>
                </div>
                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif" style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" style="float: right" type="submit" id="exportTextfile" name="submit" value="submit">Import Data</button>
            </form>
        </div>
    </div>
</main>