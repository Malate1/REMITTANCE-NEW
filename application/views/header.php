<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ARIS Remittance</title>
        <link href="<?php echo base_url(); ?>assets/css/fixedColumns.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/bg.png">
        <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/sweetalert.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
         <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
        <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script> -->
        <!-- <link href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" /> -->
        <script src="<?php echo base_url(); ?>assets/js/all.min.js" crossorigin="anonymous"></script>
        <script>
            // function startTime() {
            // var today = new Date();
            // var tdate = today.toLocaleDateString();
            // var hours = today.getHours();
            // var minutes = today.getMinutes();
            // var ampm = hours >= 12 ? 'PM' : 'AM';
            // hours = hours % 12;
            // hours = hours ? hours : 12; // the hour '0' should be '12'
            // minutes = minutes < 10 ? '0'+minutes : minutes;
            // var strTime = hours + ':' + minutes + ' ' + ampm;
            // document.getElementById('txt').innerHTML =
            // tdate + ' ' + strTime
            // var t = setTimeout(startTime, 500);
            // }
            // function checkTime(i) {
            // if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            // return i;
            // }
        </script>
    </head>
    <!-- Modal -->
    <div id="userLocation" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Location</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="user_location">
                    <div id="user_content3"></div>
                </form>
            </div>
            </div>

        </div>
    </div>

    <div id="userBu" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change BU</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="user_bu">
                    <div id="user_content4"></div>
                </form>
            </div>
            </div>

        </div>
    </div>
    <div id="userPassword" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="user_password">
                    <div id="user_content"></div>
                </form>
            </div>
            </div>

        </div>
    </div>
    <div id="userUsername" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Username</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="user_username">
                    <div id="user_content2"></div>
                </form>
            </div>
            </div>

        </div>
    </div>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?= site_url("main"); ?>">ARIS Remittance</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group" id="txt" style="color: white;font-size: 25px"> 
                    <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" /> <?php echo date("D., M. d, Y h:i A");?>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div> -->
                </div>
            </form>

            <script type="text/javascript">
                function doDate()
                {
                        
                    var str = "";

                    var days = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                    var months = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                    var now = new Date();
                    //var hour = c.getHours()%12;
                    var am = now.getHours()/12;

                    str += "" + days[now.getDay()] + ", " + months[now.getMonth()] + " " + format(now.getDate()) + ", " + now.getFullYear() + " " + format(now.getHours()%12) +":" + format(now.getMinutes()) + ":" + format(now.getSeconds()) +" " + (am > 1 ? 'PM' : 'AM');
                    document.getElementById("txt").innerHTML = str;
                }

                    setInterval(doDate, 1000);

                function format(num){
                    return num < 10 ? '0'+num : num;
                }
            </script>
            <!-- Navbar-->
           
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        


                        <?php if(@$locate != 'Allow'){ ?>
                        <a class="dropdown-item" style="cursor: pointer" data-toggle="modal" data-target="#userUsername" onclick=user_username(<?php echo $this->session->userdata('user_id'); ?>)>Change Username</a>
                        <a class="dropdown-item" style="cursor: pointer" data-toggle="modal" data-target="#userPassword" onclick=user_password(<?php echo $this->session->userdata('user_id'); ?>)>Change Password</a>
                        <a class="dropdown-item" style="cursor: pointer" data-toggle="modal" data-target="#userLocation" onclick=user_location(<?php echo $this->session->userdata('user_id'); ?>)>Change Location</a>
                        <a class="dropdown-item" style="cursor: pointer" data-toggle="modal" data-target="#userBu" onclick=user_bu(<?php echo $this->session->userdata('user_id'); ?>)>Change BU</a>
                        
                        <!-- <a class="dropdown-item" href="#">Activity Log</a> -->
                        <div class="dropdown-divider"></div>
                        <?php } ?>
                        <a class="dropdown-item" href="<?= site_url("logout"); ?>">Logout</a>
                    </div>
                </li>
            </ul>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <?php if($this->session->userdata('type')=='Salesman' || $this->session->userdata('type')=='JefeDeViaje' || $this->session->userdata('type')=='Walk-In' || $this->session->userdata('type')=='OtherCharges') { ?>
                            <div class="sb-sidenav-menu-heading">Salesman</div>
                            <a class="nav-link" href="<?= base_url('/smdenom'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                                Denomination
                            </a>
                            <a class="nav-link" href="<?= base_url('/sm_ledger'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-list-ol"></i></div>
                                Salesman Record
                            </a>
                            <?php } ?>
                            <?php if($this->session->userdata('type')=='Cashier') { ?>
                            <div class="sb-sidenav-menu-heading">Cashier</div>
                            <!-- <a class="nav-link" href="<?= base_url('/cashier_payment'); ?>">
                                <div class="sb-nav-link-icon"><i class="far fa-money-bill-alt"></i></div>
                                Payments
                            </a>
                            <a class="nav-link" href="<?= base_url('/cashierdenom'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                                Denomination
                            </a> -->
                            <a class="nav-link" href="<?= base_url('/remitdate'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-check"></i></div>
                                Salesman Check Entry
                            </a>
                            <a class="nav-link" href="<?= base_url('/checkclearingdate'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-check-square"></i></div>
                                Check Clearing
                            </a>
                            <!-- <a class="nav-link" href="<?= base_url('/accountrecorddate'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Accountability
                            </a> -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Reports" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Reports
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="Reports" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= base_url('/accountdate'); ?>">Accountability</a>
                                    <a class="nav-link" href="<?= base_url('/pdcdcdate'); ?>">PDC & DC Report</a>
                                    <a class="nav-link" href="<?= base_url('/colsum'); ?>">Collection Summary</a>
                                </nav>
                            </div>
                            <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CashierRecord" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Cashier Record
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="CashierRecord" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= base_url('/cashier_date'); ?>">Payments</a>
                                    <a class="nav-link" href="<?= base_url('/cashier_ledger'); ?>">Denomination</a>
                                </nav>
                            </div> -->
                            <?php } ?>
                            <div class="sb-sidenav-menu-heading">Masterfile</div>
                            <?php if($this->session->userdata('type')=='Admin') { ?>
                            <?php if($this->session->userdata('location')=='LDI') { ?>
                            <!-- <a class="nav-link" href="<?= base_url('/importldi'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-import"></i></div>
                                Import for LDI
                            </a> -->
                            <!-- <a class="nav-link" href="<?= base_url('/customers'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Customer
                            </a> -->
                            <?php }} ?>
                            <?php if($this->session->userdata('type')=='Cashier' || $this->session->userdata('type')=='Admin') { ?>
                            <a class="nav-link" href="<?= base_url('/import'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-import"></i></div>
                                Import
                            </a>
                            <?php if($this->session->userdata('location')=='LDI') { ?>
                            <a class="nav-link" href="<?= base_url('/importldi_sm'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-import"></i></div>
                                Import for LDI
                            </a>
                            <?php } ?>
                            <a class="nav-link" href="<?= base_url('/export'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-export"></i></div>
                                Export
                            </a>
                            <a class="nav-link" href="<?= base_url('/customers'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Customer
                            </a>
                            <a class="nav-link" href="<?= base_url('/banks'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                                Bank
                            </a>
                            <?php } ?>
                            <?php if($this->session->userdata('type')=='Admin') { ?>
                            <a class="nav-link" href="<?= base_url('/user'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                User
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as (<?php echo $this->session->userdata('type'); ?>) in <?php echo $this->session->userdata('location');?> <?php echo $this->session->userdata('bu');?>: </div>
                        <?php echo $this->session->userdata('full_name'); ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">