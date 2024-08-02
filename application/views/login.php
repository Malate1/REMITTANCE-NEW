<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ARIS Remittance</title>
        <link rel="shortcut icon" href="assets/img/bg.png">
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="assets/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-secondary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <center><img src="assets/img/bg.png" heigh="100px" width="100px"></center>
                                        <h3 class="text-center font-weight-light my-1">ARIS Remittance</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-danger" id="msg" role="alert" style="display: none">Incorrect username or password!</div>
                                        <form method="post" id="login_form">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Username</label>
                                                <input class="form-control py-4" id="inputUsername" autocomplete="off" type="text" placeholder="Enter username" name="username" required/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <label style="float:right" class="small mb-1" for="showPassword">&nbsp;&nbsp;Show Password</label>
                                                <input style="float:right;margin-top:4px" type="checkbox" id="showPassword" onclick="myFunction()">
                                                <input class="form-control py-4" id="inputPassword" autocomplete="off" type="password" placeholder="Enter password" name="password" required/>
                                            </div>
                                            <!-- <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div> -->
                                            <div class="form-group d-flex align-items-center justify-content-between mt-1 mb-0">
                                                <!-- <a class="small" href="password.html">Forgot Password?</a> -->
                                                <a></a>
                                                <button type="submit" class="btn btn-primary" name="submit" value="save"><i class="fas fa-key"></i>&nbsp;&nbsp;Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <!-- <div class="small"><a href="register.html">Need an account? Sign up!</a></div> -->
                                        <div class="small">Copyright &copy; ARIS Remittance 2020</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!-- <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
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
                </footer>
            </div> -->
        </div>
        <script>
            function myFunction() {
                var x = document.getElementById("inputPassword");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
        <script src="assets/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="assets/js/myjs.js"></script>
    </body>
</html>