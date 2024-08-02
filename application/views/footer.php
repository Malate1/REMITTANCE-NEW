                <!-- <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; ARIS Remittance 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer> -->
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>assets/js/sweetalert.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
        <!-- <script src="assets/js/Chart.min.js" crossorigin="anonymous"></script> -->
        <!-- <script src="assets/demo/chart-area-demo.js"></script> -->
        <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
        <script>
            var baseurl = "<?php echo base_url(); ?>";
        </script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>assets/demo/datatables-demo.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/myjs.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/salesman.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/cashier.js"></script>
        <script>
            // Add the following code if you want the name of the file appear on select
            $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            $('input#coins').keyup(function(event) {
                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
                }

                $(this).val(function(index, value) {
                    value = value.replace(/,/g,'');
                    return numberWithCommas(value);
                });
            });

            $('input#dc').keyup(function(event) {
                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
                }

                $(this).val(function(index, value) {
                    value = value.replace(/,/g,'');
                    return numberWithCommas(value);
                });
            });

            $('input#pdc').keyup(function(event) {
                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
                }

                $(this).val(function(index, value) {
                    value = value.replace(/,/g,'');
                    return numberWithCommas(value);
                });
            });

            $('input#totalremittance').keyup(function(event) {
                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
                }

                $(this).val(function(index, value) {
                    value = value.replace(/,/g,'');
                    return numberWithCommas(value);
                });
            });

            $('input#amount').keyup(function(event) {
                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
                }

                $(this).val(function(index, value) {
                    value = value.replace(/,/g,'');
                    return numberWithCommas(value);
                });
            });

            $('input#totalreturns').keyup(function(event) {
                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
                }

                $(this).val(function(index, value) {
                    value = value.replace(/,/g,'');
                    return numberWithCommas(value);
                });
            });

            $('input#totaltax').keyup(function(event) {
                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
                }

                $(this).val(function(index, value) {
                    value = value.replace(/,/g,'');
                    return numberWithCommas(value);
                });
            });

            $('input#totalbo').keyup(function(event) {
                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
                }

                $(this).val(function(index, value) {
                    value = value.replace(/,/g,'');
                    return numberWithCommas(value);
                });
            });

            document.getElementById("btncustomer").focus();

            function numberWithCommas(x) {
                var parts = x.toString().split(".");
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                return parts.join(".");
            }
        </script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.fixedColumns.min.js"></script>
    </body>
</html>