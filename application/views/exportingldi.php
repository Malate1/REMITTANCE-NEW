<main>
    <div class="container-fluid">
        <h4 class="mt-4">Export LDI Textfile</h4><br />
        <div class="col-xl-4">

        <!-- <?php
phpinfo();
?> -->

            <!-- <form method="post" id="importldi_submit">
                
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="customFile" name="filenames" onchange="checkFile(this)" required>
                    <label class="custom-file-label" for="customFile">Choose Textfile</label>
                </div>
                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif" style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" style="float: right" type="submit" id="importTextfile" name="submit" value="submit">Import Data</button>
            </form> -->

            <style>
            #exportldi_submit,
            #exportldiudc_submit,
            #exportldioverage_submit,
            #exportldiprice_submit,
            #exportldioverageudc_submit,
            #exportldipriceudc_submit,
            #exportldioplanbo_submit,
            #exportldioplanreturn_submit,
            #updateldipayment_submit
            /* #importldixtruck_submit,
            #importldixtrucksat_submit,
            #importldixtruckreturn_submit,
            #importldixtrucksminc_submit,
            #importldibo_submit  */
            {
                display: none;
            }
            </style>

            <form method="post" id="exportldi_submit">

                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="exportTextfile" name="submit" value="submit">Get
                    MyNetgosyo Adjustment Data</button>
            </form>
            <br>
            <form method="post" id="exportldioverage_submit">

                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="exporOverageTextfile" name="submit" value="submit">Get
                    MyNetgosyo Adjustment Data</button>
            </form>
            
            <form method="post" id="exportldiprice_submit">

                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="exportPriceTextfile" name="submit" value="submit">Get
                    MyNetgosyo Adjustment Data</button>
            </form>

            <form method="post" id="exportldioplanbo_submit">

                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="exportOplanBoTextfile" name="submit" value="submit">Get
                    MyNetgosyo Adjustment Data</button>
            </form>

            <form method="post" id="exportldioplanreturn_submit">

                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="exportOplanReturnTextfile" name="submit" value="submit">Get
                    MyNetgosyo Adjustment Data</button>
            </form>
            
            <form method="post" id="exportldiudc_submit">

                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="exportUdcTextfile" name="submit" value="submit">Get
                    MyNetgosyo Adjustment Data</button>
            </form>
           
            <form method="post" id="exportldioverageudc_submit">

                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="exporOverageUdcTextfile" name="submit" value="submit">Get
                    MyNetgosyo Adjustment Data</button>
            </form>
            
            <form method="post" id="exportldipriceudc_submit">

                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="exportPriceUdcTextfile" name="submit" value="submit">Get
                    MyNetgosyo Adjustment Data</button>
            </form>

            <form method="post" id="updateldipayment_submit">

                <img id="loading" src="<?php echo base_url(); ?>\assets\img\loading.gif"
                    style="height: 70px;width: 70px;margin-top: -15px;float: right;display: none">
                <button class="btn btn-primary" type="submit" id="updateXtruckPaymentTextfile" name="submit" value="submit">Get
                    MyNetgosyo Adjustment Data</button>
            </form>
            <br>
            
            <?php if ($this->session->userdata('location') != 'LDI-UDC') { ?>
                <button class="btn btn-primary" id="submitBothForms">Export MyNetgosyo Adjustment Data (HO)</button>
            <?php } else { ?>
                <button class="btn btn-primary" id="submitBothFormsUdc">Export MyNetgosyo Adjustment Data (UDC)</button>
            <?php } ?>
            <br><br>
            
            <script>
            document.getElementById('submitBothForms').addEventListener('click', function() {
                var form1 = document.getElementById('exportldi_submit');
                var form2 = document.getElementById('exportldioverage_submit');
                var form3 = document.getElementById('exportldiprice_submit');
                var form4 = document.getElementById('exportldioplanbo_submit');
                var form5 = document.getElementById('exportldioplanreturn_submit');
                // var form6 = document.getElementById('updateldipayment_submit');
                // var form7 = document.getElementById('importldibo_submit');
                

                if (form1 && form1.tagName === 'FORM') {
                    swal({
                        title: "Exporting Xtruck (HO) Adjustments Textfile....",
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
                        title: "Exporting Xtruck (HO) Overage Textfile....",
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
                        title: "Exporting Xtruck (HO) Price Adjustments Textfile....",
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
                        title: "Exporting OPLAN (HO) Adjustments Textfile....",
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
                        title: "Exporting OPLAN (HO) Return Adjustments Textfile....",
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
                            title: 'Form 4 not found or is not a form element.'
                        });
                    }
                }, 6000); //  form5

                // setTimeout(function() {
                //     if (form6 && form6.tagName === 'FORM') {
                //         swal({
                //         title: "Exporting OPLAN (HO) Return Adjustments Textfile....",
                //         type: "info",
                //          showConfirmButton: false,

                //     });
                //         setTimeout(function() {
                //             form6.dispatchEvent(new Event('submit', {
                //                 bubbles: true,
                //                 cancelable: true
                //             }));
                //         }, 7000); 
                //     } else {
                //         swal({
                //             type: 'error',
                //             title: 'Form 4 not found or is not a form element.'
                //         });
                //     }
                // }, 7000); //  form6

                
            });

            </script> 

            <script>
            document.getElementById('submitBothFormsUdc').addEventListener('click', function() {
                var form1 = document.getElementById('exportldiudc_submit');
                var form2 = document.getElementById('exportldioverageudc_submit');
                var form3 = document.getElementById('exportldipriceudc_submit');
               // var form4 = document.getElementById('updateldipayment_submit');
                // var form3 = document.getElementById('importldixtruck_submit');
                // var form4 = document.getElementById('importldixtrucksat_submit');
                // var form5 = document.getElementById('importldixtruckreturn_submit');
                // var form6 = document.getElementById('importldixtrucksminc_submit');
                // var form7 = document.getElementById('importldibo_submit');
                

                if (form1 && form1.tagName === 'FORM') {
                    swal({
                        title: "Exporting Xtruck (UDC) Adjustments Textfile....",
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
                        title: "Exporting Xtruck (UDC) Overage Textfile....",
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
                        title: "Exporting Xtruck (UDC) Price Adjustments Textfile....",
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

                // setTimeout(function() {
                //     if (form4 && form4.tagName === 'FORM') {
                //         swal({
                //         title: "Exporting Xtruck (UDC) Price Adjustments Textfile....",
                //         type: "info",
                //          showConfirmButton: false,

                //     });
                //         setTimeout(function() {
                //             form4.dispatchEvent(new Event('submit', {
                //                 bubbles: true,
                //                 cancelable: true
                //             }));
                //         }, 5000); 
                //     } else {
                //         swal({
                //             type: 'error',
                //             title: 'Form 4 not found or is not a form element.'
                //         });
                //     }
                // }, 5000); //  form4

                

                


                
            });

            </script> 


        </div>
    </div>
</main>