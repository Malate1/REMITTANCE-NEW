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
            #importldireturn_submit,
            #importldixtruck_submit,
            #importldixtrucksat_submit,
            #importldixtruckreturn_submit,
            #importldixtrucksminc_submit,
            #importldixtruckpalawan_submit,
            #importldixtruckpalawanoplan_submit,
            #importldixtruckutc_submit,
            #importldibo_submit{
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

            <form method="post" id="importldibo_submit">

                <img id="loading2" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="importTextfileBo" name="submit" value="submit">Get
                    MyNetgosyo Bo Data</button>
            </form>

            <form method="post" id="importldixtruck_submit">

                <img id="loading2" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="importTextfileXtruck" name="submit" value="submit">Get
                    MyNetgosyo Xtruck Data</button>
            </form>

            <form method="post" id="importldixtrucksat_submit">

                <img id="loading2" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="importTextfileXtruckSat" name="submit" value="submit">Get
                    MyNetgosyo Xtruck Satellite Data</button>
            </form>

            <form method="post" id="importldixtruckreturn_submit">

                <img id="loading2" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="importTextfileXtruckReturn" name="submit" value="submit">Get
                    MyNetgosyo Xtruck Returns Data</button>
            </form>

            <form method="post" id="importldixtrucksminc_submit">

                <img id="loading2" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="importTextfileXtruckSmInc" name="submit" value="submit">Get
                    MyNetgosyo Xtruck SM Incentives Data</button>
            </form>

            <form method="post" id="importldixtruckpalawan_submit">

                <img id="loading2" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="importTextfileXtruckPalawan" name="submit" value="submit">Get
                    MyNetgosyo Xtruck Palawan Data</button>
            </form>

            <form method="post" id="importldixtruckpalawanoplan_submit">

                <img id="loading2" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="importTextfileXtruckPalawanOp" name="submit" value="submit">Get
                    MyNetgosyo Oplan Palawan Data</button>
            </form>

            <form method="post" id="importldixtruckutc_submit">

                <img id="loading2" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="importTextfileXtruckUtc" name="submit" value="submit">Get
                    MyNetgosyo Xtruck Under the Cup Data</button>
            </form>

            <button class="btn btn-primary" id="submitBothForms">Get MyNetgosyo Data</button>
            <br><br>
            <!-- <?php if($this->session->userdata('bu')=='XTRUCK'){ ?>
                <button class="btn btn-primary" id="downloadBtn">Download Approved Xtruck Payments</button>
            <?php } ?> -->
            

            <script>
            document.getElementById('submitBothForms').addEventListener('click', function() {
                var form1 = document.getElementById('importldi_submit');
                var form2 = document.getElementById('importldireturn_submit');
                var form3 = document.getElementById('importldixtruck_submit');
                var form4 = document.getElementById('importldixtrucksat_submit');
                var form5 = document.getElementById('importldixtruckreturn_submit');
                var form6 = document.getElementById('importldixtrucksminc_submit');
                var form7 = document.getElementById('importldibo_submit');
                var form8 = document.getElementById('importldixtruckpalawan_submit');
                var form9 = document.getElementById('importldixtruckpalawanoplan_submit');
                var form10 = document.getElementById('importldixtruckutc_submit');

                if (form1 && form1.tagName === 'FORM') {
                    swal({
                        title: "Uploading Oplan Payments Textfile....",
                        type: "info",
                         showConfirmButton: false,

                    });

                
                    setTimeout(function() {
                        form1.dispatchEvent(new Event('submit', {
                            bubbles: true,
                            cancelable: true
                        }));
                    }, 2000); 
                } else {
                    swal({
                        type: 'error',
                        title: 'Form 1 not found or is not a form element.'
                    });
                }

                setTimeout(function() {
                    if (form2 && form2.tagName === 'FORM') {
                        swal({
                        title: "Uploading Oplan Returns Textfile....",
                        type: "info",
                         showConfirmButton: false,

                    });
                        setTimeout(function() {
                            form2.dispatchEvent(new Event('submit', {
                                bubbles: true,
                                cancelable: true
                            }));
                        }, 3000); 
                    } else {
                        swal({
                            type: 'error',
                            title: 'Form 2 not found or is not a form element.'
                        });
                    }
                }, 3000); //  form2


                setTimeout(function() {
                    if (form3 && form3.tagName === 'FORM') {
                        swal({
                        title: "Uploading Extruck CDC Payments Textfile....",
                        type: "info",
                         showConfirmButton: false,

                    });
                        setTimeout(function() {
                            form3.dispatchEvent(new Event('submit', {
                                bubbles: true,
                                cancelable: true
                            }));
                        }, 4000); 
                    } else {
                        swal({
                            type: 'error',
                            title: 'Form 3 not found or is not a form element.'
                        });
                    }
                }, 4000); //  form3

                setTimeout(function() {
                    if (form4 && form4.tagName === 'FORM') {
                        swal({
                            title: "Uploading Extruck Satellite Payments Textfile....",
                            type: "info",
                            showConfirmButton: false,

                        });
                        setTimeout(function() {
                            form4.dispatchEvent(new Event('submit', {
                                bubbles: true,
                                cancelable: true
                            }));
                        }, 5000); 
                    } else {
                        swal({
                            type: 'error',
                            title: 'Form 4 not found or is not a form element.'
                        });
                    }
                }, 5000); //  form4

                setTimeout(function() {
                    if (form5 && form5.tagName === 'FORM') {
                        swal({
                            title: "Uploading Extruck BO/Change Item Textfile....",
                            type: "info",
                            showConfirmButton: false,

                        });
                        setTimeout(function() {
                            form5.dispatchEvent(new Event('submit', {
                                bubbles: true,
                                cancelable: true
                            }));
                        }, 6000); 
                    } else {
                        swal({
                            type: 'error',
                            title: 'Form 5 not found or is not a form element.'
                        });
                    }
                }, 6000); //  form5

                setTimeout(function() {
                    if (form6 && form6.tagName === 'FORM') {
                        swal({
                            title: "Uploading Extruck SM Incentives Textfile....",
                            type: "info",
                            showConfirmButton: false,

                        });
                        setTimeout(function() {
                            form6.dispatchEvent(new Event('submit', {
                                bubbles: true,
                                cancelable: true
                            }));
                        }, 7000); 
                    } else {
                        swal({
                            type: 'error',
                            title: 'Form 6 not found or is not a form element.'
                        });
                    }
                }, 7000); //  form5

                setTimeout(function() {
                    if (form7 && form7.tagName === 'FORM') {
                        swal({
                            title: "Uploading Oplan Bo Textfile....",
                            type: "info",
                            showConfirmButton: false,

                        });
                        setTimeout(function() {
                            form7.dispatchEvent(new Event('submit', {
                                bubbles: true,
                                cancelable: true
                            }));
                        }, 8000); 
                    } else {
                        swal({
                            type: 'error',
                            title: 'Form 7 not found or is not a form element.'
                        });
                    }
                }, 8000); //  form5

                setTimeout(function() {
                    if (form8 && form8.tagName === 'FORM') {
                        swal({
                            title: "Uploading Extruck Palawan Remittance Textfile....",
                            type: "info",
                            showConfirmButton: false,
                        });
                        //addHiddenInput(form8, selectedSalesman);
                        setTimeout(function() {
                            form8.dispatchEvent(new Event('submit', {
                                bubbles: true,
                                cancelable: true
                            }));
                        }, 9000); 
                    }
                }, 9000); //  form8

                setTimeout(function() {
                    if (form10 && form10.tagName === 'FORM') {
                        swal({
                            title: "Uploading Extruck Under the Cup Textfile....",
                            type: "info",
                            showConfirmButton: false,
                        });
                       // addHiddenInput(form10, selectedSalesman);
                        setTimeout(function() {
                            form10.dispatchEvent(new Event('submit', {
                                bubbles: true,
                                cancelable: true
                            }));
                        }, 10000); 
                    }
                }, 10000); //  form10

                setTimeout(function() {
                    if (form9 && form9.tagName === 'FORM') {
                        swal({
                            title: "Uploading Oplan Palawan Remittance Textfile....",
                            type: "info",
                            showConfirmButton: false,
                        });
                        //addHiddenInput(form9, selectedSalesman);
                        setTimeout(function() {
                            form9.dispatchEvent(new Event('submit', {
                                bubbles: true,
                                cancelable: true
                            }));
                        }, 11000); 
                    }
                }, 11000); //  form9


                
            });

            document.getElementById('downloadBtn').addEventListener('click', function() {
            // Make a request to the API endpoint
            fetch('<?php echo base_url("api/get_data"); ?>')
                .then(response => {
                    // Check if the response is successful
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    // Return the response text
                    return response.text();
                })
                .then(data => {
                    // Create a new blob containing the data
                    const blob = new Blob([data], { type: 'text/plain' });
                    // Create a link element
                    const link = document.createElement('a');
                    // Set the href attribute to the URL of the blob
                    link.href = URL.createObjectURL(blob);
                    // Set the download attribute to specify the filename
                    link.download = 'Aris_to_xtruck.txt';
                    // Simulate a click on the link to trigger the download
                    link.click();
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        });

            </script> 


        </div>
    </div>
</main>