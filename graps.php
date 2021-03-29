<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
}

if (isset($_POST['logout'])) {
  $_SESSION = array();
  session_destroy();
  return header("Location: ../index.php");
  exit();
}



?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/basic/favicon.ico" type="image/x-icon">
    <title>Panello di controllo</title>

    <?php include "cssLinks.php" ?>

</head>

<body class="dark">

    <?php include "leftMenu.php"; ?>

    <!--Sidebar End-->
    <div class="page has-sidebar-left">
        <div class="pos-f-t">
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-dark pt-2 pb-2 pl-4 pr-2">
                    <div class="search-bar">
                        <input class="transparent s-24 text-white b-0 font-weight-lighter w-128 height-50" type="text"
                            placeholder="start typing...">
                    </div>
                    <a href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-expanded="false"
                        aria-label="Toggle navigation" class="paper-nav-toggle paper-nav-white active "><i></i></a>
                </div>
            </div>
        </div>
        <?php include "topMenu.php" ?>

        <?php
global $connection;
$client_id= $_SESSION['user_id'];
  $find_client = "SELECT * FROM client WHERE client_id='$client_id'";
 
  $find_result= mysqli_query($connection,$find_client);
  $row_find= mysqli_fetch_assoc($find_result);

  $query_guadagno = "SELECT SUM(importo_amount) AS importsum FROM importo WHERE cliente_id='$client_id'";
  $result_guadagno= mysqli_query($connection,$query_guadagno);
  $row_guadagno = mysqli_fetch_assoc($result_guadagno);

  $query_show ="SELECT SUM(bonifico_quantita)  AS totalbon FROM bonifico WHERE client_reconazition='$client_id'";
  $resut_show = mysqli_query($connection,$query_show);
  $row_show  = mysqli_fetch_assoc($resut_show);

?>
        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
                <div class="row my-3">
                    <div class="col-md-3  ">
                        <div class="counter-box   r-5 p-3  " style="background-color: #00765e;">
                            <div class="p-4">
                                <div class="float-right">
                                    <span class="icon icon-account_balance_wallet text-light s-48"></span>
                                </div>
                                <div class="counter-title text-light">Totale: guadagnio</div>
                                <h5 class="  mt-3   text-light">
                                    <?php echo   number_format($row_guadagno['importsum'], 2, ',', ' ')  ." €";?> </h5>
                            </div>
                            <div class="progress progress-xs r-0">
                                <div class="progress-bar" role="progressbar" style="width: 25%;"
                                    aria-valuenow=" <?php echo $row_guadagno['importsum'] ;?>" aria-valuemin="0"
                                    aria-valuemax="9999999999999"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3  ">
                        <div class="counter-box   r-5 p-3  " style="background-color: #00765e;">
                            <div class="p-4">
                                <div class="float-right">
                                    <span class="icon icon-money-1 text-light s-48"></span>
                                </div>
                                <div class="counter-title text-light">Totale bonifico</div>
                                <h5 class=" mt-3 text-light">
                                    <?php echo   number_format($row_show['totalbon'], 2, ',', ' ')  ." €";?>


                                </h5>
                            </div>
                            <div class="progress progress-xs r-0">
                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="9999999999999"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3  ">
                        <div class="counter-box   r-5 p-3  " style="background-color: #00765e;">
                            <div class="p-4">
                                <div class="float-right">
                                    <span class="icon icon-money2 text-light s-48"></span>
                                </div>
                                <div class="counter-title text-light">Saldo disponibile</div>
                                <h5 class="  mt-3 counter-animated text-light">0</h5>
                            </div>
                            <div class="progress progress-xs r-0">
                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="9999999999999"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    
                    $query_guadagno = "SELECT SUM(importo_amount) AS importsum FROM importo WHERE cliente_id='$client_id'";
                    $result_guadagno= mysqli_query($connection,$query_guadagno);
                    $row_guadagno = mysqli_fetch_assoc($result_guadagno);


                    $query_show ="SELECT SUM(bonifico_quantita) AS TOTALB FROM bonifico WHERE client_reconazition='$client_id'";
                    $resut_show = mysqli_query($connection,$query_show);
                    $row_total=mysqli_fetch_assoc( $resut_show);
                    $total=$row_total['TOTALB'];
                    ?>
                    <div class="col-md-3  ">
                        <div class="counter-box   r-5 p-3  " style="background-color: #00765e;">
                            <div class="p-4">
                                <div class="float-right">
                                    <span class="icon icon-taxes text-light s-48"></span>
                                </div>
                                <div class="counter-title text-light"><?php echo  $row_find['tax_label']; ?> </div>
                                <h5 class="  mt-3  text-light">(<?php echo  $row_find['client_tax']; ?>%)
                                    <?php echo ":". number_format(($row_find['client_tax']/100)*($total+ $row_guadagno['importsum']), 2, ',', ' ')  ."€" ?>
                                </h5>
                            </div>
                            <div class="progress progress-xs r-0">
                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="9999999999999"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card  ">
                    <center>
                        <iframe class=" mt-3"
                            src="//www.exchangerates.org.uk/widget/ER-LRTICKER.php?w=600&s=2&mc=GBP&mbg=F0F0F0&bs=yes&bc =000044&f=verdana&fs=10px&fc=000044&lc=000044&lhc= FE9A00&vc=FE9A00&vcu=008000&vcd=FF0000&"
                            height="30" frameborder="0" scrolling="no" marginwidth="0" marginheight="0"></iframe>
                    </center>
                    <div class="col-12">
                        <canvas data-chart="line" data-dataset="[[0,528,228,728,528,1628,1900]]"
                            data-labels="['BTN','DOP','BRL','USD','AED','CYN','NPR']"
                            data-dataset-options="[{ label:'Sales', borderColor:  'rgba(255,99,132,1)', backgroundColor: 'rgba(255, 99, 132, 0.2)'}]">
                        </canvas>
                    </div>
                    <div class="row">

                        <div class="card no-b p-3 my-3 col-md-6 col-sm-12">
                            <div class="chartjs-size-monitor"
                                style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                <div class="chartjs-size-monitor-expand"
                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink"
                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                </div>
                            </div>
                            <p>Progress </p>
                            <canvas id="strokeChart" width="556" height="278" class="chartjs-render-monitor"
                                style="display: block; width: 556px; height: 278px;"></canvas>
                            <script>
                            $(function() {
                                'use strict';
                                var ctx = document.getElementById('strokeChart').getContext("2d");

                                var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
                                gradientStroke.addColorStop(0, '#80b6f4');
                                gradientStroke.addColorStop(1, '#f49080');

                                var myChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: ["AGO", "SET", "OTT", "NOV", "DEC", "GEN", "FEB",
                                            "JUL"
                                        ],
                                        datasets: [{
                                            label: "Data",
                                            borderColor: "transparent",
                                            pointBorderColor: gradientStroke,
                                            pointBackgroundColor: gradientStroke,
                                            pointHoverBackgroundColor: gradientStroke,
                                            pointHoverBorderColor: gradientStroke,
                                            pointBorderWidth: 10,
                                            pointHoverRadius: 10,
                                            pointHoverBorderWidth: 1,
                                            pointRadius: 3,
                                            fill: false,
                                            data: [100, 120, 150, 170, 180, 170, 160, 260]
                                        }]
                                    },
                                    options: {
                                        legend: {
                                            position: "bottom"
                                        },
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    fontColor: "rgba(0,0,0,0.5)",
                                                    fontStyle: "bold",
                                                    beginAtZero: true,
                                                    maxTicksLimit: 5,
                                                    padding: 20
                                                },
                                                gridLines: {
                                                    drawTicks: false,
                                                    display: false
                                                }

                                            }],
                                            xAxes: [{
                                                gridLines: {
                                                    zeroLineColor: "transparent"
                                                },
                                                ticks: {
                                                    padding: 20,
                                                    fontColor: "rgba(0,0,0,0.5)",
                                                    fontStyle: "bold"
                                                }
                                            }]
                                        }
                                    }
                                });
                            });
                            </script>
                        </div>

                        <div class="card no-b col-6">
                            <div class="chartjs-size-monitor"
                                style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                <div class="chartjs-size-monitor-expand"
                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink"
                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                </div>
                            </div>
                            <p>Corrency </p>
                            <canvas id="shadowChart" width="556" height="278"
                                style="background-color: rgb(255, 255, 255); display: block; width: 556px; height: 278px;"
                                class="chartjs-render-monitor"></canvas>
                            <script>
                            $(function() {
                                'use strict';
                                let draw = Chart.controllers.line.prototype.draw;
                                Chart.controllers.line = Chart.controllers.line.extend({
                                    draw: function() {
                                        draw.apply(this, arguments);
                                        let ctx = this.chart.chart.ctx;
                                        let _stroke = ctx.stroke;
                                        ctx.stroke = function() {
                                            ctx.save();
                                            ctx.shadowColor = '#E56590';
                                            ctx.shadowBlur = 10;
                                            ctx.shadowOffsetX = 0;
                                            ctx.shadowOffsetY = 4;
                                            _stroke.apply(this, arguments)
                                            ctx.restore();
                                        }
                                    }
                                });

                                let ctx = document.getElementById("shadowChart").getContext('2d');
                                let myChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: ["Ottobre", "Novembre", "Dicembre", "Gennaio",
                                            "Febbraio",
                                            "Jiugno",
                                            "luglio"
                                        ],
                                        datasets: [{
                                            label: "Investment",
                                            data: [65, 59, 80, 81, 56, 55, 90],
                                            borderColor: '#ffb88c',
                                            pointBackgroundColor: "#fff",
                                            pointBorderColor: "#ffb88c",
                                            pointHoverBackgroundColor: "#ffb88c",
                                            pointHoverBorderColor: "#fff",
                                            pointRadius: 4,
                                            pointHoverRadius: 4,
                                            fill: false
                                        }]
                                    }
                                });
                            });
                            </script>
                        </div>
                    </div>
                    <div class="row pt-3 pb-3">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="card">
                                <div class="card-header white">
                                    <h6>Race Investmant</h6>
                                </div>
                                <div class="card-body">
                                    <div id="echart_pie2"
                                        style="height: 350px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative;"
                                        _echarts_instance_="ec_1616507321445">
                                        <div
                                            style="position: relative; overflow: hidden; width: 472px; height: 350px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                                            <canvas data-zr-dom-id="zr_0" width="472" height="350"
                                                style="position: absolute; left: 0px; top: 0px; width: 472px; height: 350px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
                                        </div>
                                        <div
                                            style="position: absolute; display: none; border-style: solid; white-space: nowrap; z-index: 9999999; transition: left 0.4s cubic-bezier(0.23, 1, 0.32, 1) 0s, top 0.4s cubic-bezier(0.23, 1, 0.32, 1) 0s; background-color: rgba(0, 0, 0, 0.5); border-width: 0px; border-color: rgb(51, 51, 51); border-radius: 4px; color: rgb(255, 255, 255); font: 14px / 21px Arial, Verdana, sans-serif; padding: 5px; left: 182px; top: 95px;">
                                            Area Mode <br>rose1 : 10 (9.09%)</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="card">
                                <div class="card-header white">
                                    <h6>Complesive Integration</h6>
                                </div>
                                <div class="card-body">
                                    <div id="echart_sonar"
                                        style="height: 370px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative;"
                                        _echarts_instance_="ec_1616507085510">
                                        <div
                                            style="position: relative; overflow: hidden; width: 472px; height: 370px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                                            <canvas data-zr-dom-id="zr_0" width="472" height="370"
                                                style="position: absolute; left: 0px; top: 0px; width: 472px; height: 370px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
                                        </div>
                                        <div
                                            style="position: absolute; display: none; border-style: solid; white-space: nowrap; z-index: 9999999; transition: left 0.4s cubic-bezier(0.23, 1, 0.32, 1) 0s, top 0.4s cubic-bezier(0.23, 1, 0.32, 1) 0s; background-color: rgba(0, 0, 0, 0.5); border-width: 0px; border-color: rgb(51, 51, 51); border-radius: 4px; color: rgb(255, 255, 255); font: 14px / 21px Arial, Verdana, sans-serif; padding: 5px; left: 234px; top: 125px;">
                                            Allocated Budget<br>Sales : 4300<br>Administration : 10000<br>Information
                                            Techology : 28000<br>Customer Support : 35000<br>Development :
                                            50000<br>Marketing : 19000</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="card">
                                <div class="card-header white">
                                    <h6>Corrency Poerformace</h6>
                                </div>
                                <div class="card-body">
                                    <div id="echart_gauge"
                                        style="height: 370px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative;"
                                        _echarts_instance_="ec_1616507085512">
                                        <div
                                            style="position: relative; overflow: hidden; width: 472px; height: 370px; padding: 0px; margin: 0px; border-width: 0px;">
                                            <canvas data-zr-dom-id="zr_0" width="472" height="370"
                                                style="position: absolute; left: 0px; top: 0px; width: 472px; height: 370px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
                                        </div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row d-flex justify-content-around">

                        <!-- EXCHANGERATES.ORG.UK CHART WIDGET START -->
                        <div style="width:178px;margin:0;padding:0;border:1px solid #B4B4B4;background:#8C881C;">
                            <div class="col-md-3 col-sm-12"
                                style="width:174px;text-align:center;margin:2px;padding:2px 0px;background:#B4B4B4;font-family:;font-size:11px;color:#FFFFFF;font-weight:bold;vertical-align:middle;">
                                <a rel="nofollow" style="color:#FFFFFF;text-decoration:none;text-transform:uppercase;"
                                    href="https://www.exchangerates.org.uk/Euros-to-Yemen-Riyal-currency-conversion-page.html"
                                    target="_new" title="EUR YER">EUR YER</a> CHARTS
                            </div>
                            <div style="padding:2px;">
                                <script type="text/javascript">
                                var dcf = 'EUR';
                                var dct = 'YER';
                                var mcol = 'B4B4B4';
                                var mbg = '8C881C';
                                var tc = 'FFFFFF';
                                var tz = '1';
                                </script>
                                <script type="text/javascript" src="https://www.currency.me.uk/remote/ER-CHART-1.php">
                                </script>
                            </div>
                        </div>
                        <!-- EXCHANGERATES.ORG.UK CHART WIDGET END -->
                        <!-- EXCHANGERATES.ORG.UK CHART WIDGET START -->
                        <div style="width:178px;margin:0;padding:0;border:1px solid #B4B4B4;background:#1D8C3B;">
                            <div class="col-3"
                                style="width:174px;text-align:center;margin:2px;padding:2px 0px;background:#B4B4B4;font-family:;font-size:11px;color:#FFFFFF;font-weight:bold;vertical-align:middle;">
                                <a rel="nofollow" style="color:#FFFFFF;text-decoration:none;text-transform:uppercase;"
                                    href="https://www.exchangerates.org.uk/Euros-to-South-Korean-Won-currency-conversion-page.html"
                                    target="_new" title="EUR KRW">EUR KRW</a> CHARTS
                            </div>
                            <div style="padding:2px;">
                                <script type="text/javascript">
                                var dcf = 'EUR';
                                var dct = 'KRW';
                                var mcol = 'B4B4B4';
                                var mbg = '1D8C3B';
                                var tc = 'FFFFFF';
                                var tz = '1';
                                </script>
                                <script type="text/javascript" src="https://www.currency.me.uk/remote/ER-CHART-1.php">
                                </script>
                            </div>
                        </div>
                        <!-- EXCHANGERATES.ORG.UK CHART WIDGET END -->
                        <!-- EXCHANGERATES.ORG.UK CHART WIDGET START -->
                        <div style="width:174px margin:0;padding:0;border:1px solid #B4B4B4;background:#8C0404;">
                            <div class="col-md-3 col-sm-12"
                                style="width:174px;text-align:center;margin:2px;padding:2px 0px;background:#B4B4B4;font-family:;font-size:11px;color:#FFFFFF;font-weight:bold;vertical-align:middle;">
                                <a rel="nofollow" style="color:#FFFFFF;text-decoration:none;text-transform:uppercase;"
                                    href="https://www.exchangerates.org.uk/Euros-to-Pounds-currency-conversion-page.html"
                                    target="_new" title="EUR GBP">EUR GBP</a> CHARTS
                            </div>
                            <div style="padding:2px;">
                                <script type="text/javascript">
                                var dcf = 'EUR';
                                var dct = 'GBP';
                                var mcol = 'B4B4B4';
                                var mbg = '8C0404';
                                var tc = 'FFFFFF';
                                var tz = '1';
                                </script>
                                <script type="text/javascript" src="https://www.currency.me.uk/remote/ER-CHART-1.php">
                                </script>
                            </div>
                        </div>
                        <!-- EXCHANGERATES.ORG.UK CHART WIDGET END -->


                        <div style="width:178px;margin:0;padding:0;border:1px solid #2D6AB4;background:#E6F2FA;">
                            <div class="col-md-3 col-sm-12"
                                style=" text-align:center;margin:2px;padding:2px 0px;background:#2D6AB4;font-family:;font-size:11px;color:#FFFFFF;font-weight:bold;vertical-align:middle;">
                                <a rel="nofollow" style="color:#FFFFFF;text-decoration:none;text-transform:uppercase;"
                                    href="https://www.exchangerates.org.uk/Euros-to-Dollars-currency-conversion-page.html"
                                    target="_new" title="EUR USD">EUR USD</a> CHARTS
                            </div>
                            <div style="padding:2px;">
                                <script type="text/javascript">
                                var dcf = 'EUR';
                                var dct = 'USD';
                                var mcol = '2D6AB4';
                                var mbg = 'E6F2FA';
                                var tc = 'FFFFFF';
                                var tz = '1';
                                </script>
                                <script type="text/javascript" src="https://www.currency.me.uk/remote/ER-CHART-1.php">
                                </script>
                            </div>
                        </div>


                    </div>
                    <!-- EXCHANGERATES.ORG.UK CHART WIDGET START -->

                    <!-- EXCHANGERATES.ORG.UK CHART WIDGET END -->


                    <div class="mt-3"
                        style="height:62px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; block-size:62px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;">
                        <div style="height:40px; padding:0px; margin:0px; width: 100%;"><iframe
                                src="https://widget.coinlib.io/widget?type=horizontal_v2&theme=light&pref_coin_id=1506&invert_hover=no"
                                width="100%" height="36px" scrolling="auto" marginwidth="0" marginheight="0"
                                frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div>
                        <div
                            style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;">
                            <a href="https://coinlib.io" target="_blank"
                                style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency
                                Prices</a>&nbsp;by NPM PARIBAS BANK
                        </div>
                    </div>
                    <div class="col-12 row d-flex justify-content-around mt-3">
                        <div class="col-md-4 col-sm-12"
                            style="height:433px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F; padding: 0px; margin: 0px;  ">
                            <div style="height:413px; padding:0px; margin:0px; width: 100%;"><iframe
                                    src="https://widget.coinlib.io/widget?type=full_v2&theme=light&cnt=6&pref_coin_id=1506&graph=yes"
                                    width="100%" height="409px" scrolling="auto" marginwidth="0" marginheight="0"
                                    frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div>
                            <div
                                style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;">
                                <a href="https://coinlib.io" target="_blank"
                                    style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency
                                    Prices</a>&nbsp;by NPM PARIBAS BANK
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12"
                            style="height:560px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;">
                            <div style="height:540px; padding:0px; margin:0px; width: 100%;"><iframe
                                    src="https://widget.coinlib.io/widget?type=chart&theme=light&coin_id=859&pref_coin_id=1506"
                                    width="100%" height="536px" scrolling="auto" marginwidth="0" marginheight="0"
                                    frameborder="0" border="0"
                                    style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div>
                            <div
                                style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;">
                                <a href="https://coinlib.io" target="_blank"
                                    style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency
                                    Prices</a>&nbsp;by NPM PARIBAS BANK
                            </div>
                        </div>


                    </div>
                    <br><br>
                    <center>
                        <div class="nomics-ticker-widget col-12 mt-3" data-name="Bitcoin" data-base="BTC"
                            data-quote="USD">
                        </div>
                    </center>
                    <script src="https://widget.nomics.com/embed.js"></script>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php include "scripts.php";
    
 ?>

</html>
