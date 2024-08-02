<main>
    <div class="container-fluid">
        <h4 class="mt-4">Import LDI Textfile</h4><br />
        <div class="col-xl-4">
            <!-- <form method="post" id="importldi_submit">
                
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="customFile" name="filenames" onchange="checkFile(this)" required>
                    <label class="custom-file-label" for="customFile">Choose Textfile</label>
                </div>
                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif" style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" style="float: right" type="submit" id="importTextfile" name="submit" value="submit">Import Data</button>
            </form> -->

            <style>
            #importldi_submit,
            #importldireturn_submit {
                display: none;
            }
            </style>

            <form method="post" id="importldi_submit">

                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="importTextfile" name="submit" value="submit">Get
                    MyNetgosyo Payment Data</button>
            </form>
            <br>
            <form method="post" id="importldireturn_submit">

                <img id="loading2" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="importTextfileReturn" name="submit" value="submit">Get
                    MyNetgosyo Return Data</button>
            </form>

            <button class="btn btn-primary" id="submitBothForms">Get MyNetgosyo Data</button>

            <script>
            document.getElementById('submitBothForms').addEventListener('click', function() {
                var form1 = document.getElementById('importldi_submit');
                var form2 = document.getElementById('importldireturn_submit');

                if (form1 && form1.tagName === 'FORM') {
                    console.log('Submitting Form 1...');
                    form1.dispatchEvent(new Event('submit', {
                        bubbles: true,
                        cancelable: true
                    }));
                } else {
                    console.error('Form 1 not found or is not a form element.');
                }

                if (form2 && form2.tagName === 'FORM') {
                    console.log('Submitting Form 2...');
                    form2.dispatchEvent(new Event('submit', {
                        bubbles: true,
                        cancelable: true
                    }));
                } else {
                    console.error('Form 2 not found or is not a form element.');
                }

                
            });
            </script> 


        </div>
    </div>
</main>