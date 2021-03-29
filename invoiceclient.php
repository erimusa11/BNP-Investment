<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
}

if (isset($_POST['logout'])) {
  $_SESSION = array();
  session_destroy();
  return header("Location: login.php");
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

<body class="light">

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

        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
                <div class="card">

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
                    <div class="card-header white mt-3">

                    </div>
                    <div class="invoice white shadow">

                        <?php

global $connection;
$client_id= $_SESSION['user_id'];
  $find_client = "SELECT * FROM client WHERE client_id='$client_id'";
 
  $find_result= mysqli_query($connection,$find_client);
  $row_find= mysqli_fetch_assoc($find_result);


?>

                        <div class="p-5">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12 row">
                                    <div class="col-sm-2 col-md-2">
                                        Il cliente
                                        <address>
                                            <strong>Nome/Cognome:</strong>
                                            <?php echo $row_find['client_name'].' '.$row_find['client_subname']; ?><br>
                                            <strong>Email:</strong> <?php echo  $row_find['client_email']; ?><br>
                                            <strong>Indirizio: </strong> <?php echo  $row_find['client_adress']; ?><br>
                                            <strong>Telefono: </strong> <?php echo  $row_find['client_phone']; ?><br>

                                        </address>
                                    </div>
                                    <div class="col-8 d-flex justify-content-center"> <img class="col-6 "
                                            src="assets/bnp-paribas-fortis.png" alt=""> </div>


                                    <div class="float-right">

                                        <h4>Invoice #007612</h4><br>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="font-weight-normal">Data Esecusione:</td>
                                                    <td> <?php echo   date("d-m-Y", strtotime($row_find['date_client'])); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-normal">Scadenza Esecuzione: &nbsp; &nbsp;
                                                        &nbsp;
                                                    </td>
                                                    <td><?php echo  date("d-m-Y", strtotime($row_find['payemnt_due']));?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                                <!-- /.col -->
                            </div>

                            <!-- info row 
                            <div class="row my-3 ">
 

                              
                                <div class="col-sm-4">

                            
                            </div>
                    /.row -->

                            <!-- Table row -->
                            <div class="row my-3">
                                <div class="col-12 table-responsive">
                                    <table class="table table-bordered table-hover data-tables"
                                        data-options='{"searching":true}'>
                                        <thead>

                                            <tr class="table-success">
                                                <th>Informazione</th>
                                                <th>Data Bonifico</th>
                                                <th>Quantita</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                
                                               

                                                        global $connection; 
                                                     $total =0;
                                                         
                                                        $query_show ="SELECT * FROM bonifico WHERE client_reconazition='$client_id' ORDER BY bonifico_data DESC";
                                                        $resut_show = mysqli_query($connection,$query_show);
                                                        while($row_show = mysqli_fetch_array($resut_show)){
                                                        $total=  $row_show['bonifico_quantita']+$total;
                                                ?>
                                            <tr>
                                                <td>Bonifico Sefa</td>
                                                <td><?php echo  date("d-m-Y", strtotime($row_show['bonifico_data']))?>
                                                </td>
                                                <td><?php echo    number_format($row_show['bonifico_quantita'], 2, ',', ' ')."€"?>
                                                </td>


                                            </tr>
                                            <?php 
                                                        }
                                         
                                                    ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-md-6 col-sm-12">
                                    <?php 
                      global $connetion;
                      
                      $query_count = "SELECT COUNT(client_id) AS totalId FROM prelievo WHERE client_id='$client_id'";
                        $result_count= mysqli_query($connection,$query_count);
                        $row_count = mysqli_fetch_assoc($result_count);
                        if($row_count['totalId']>0){

                          echo '  <h1 class="text-success text-bold well well-sm no-shadow" style="margin-top: 10px;"><img
                          src="assets/check.png" width="30" alt="">
                          Quadro RW NON PRESENTE
                        </h1>';
                        } 
                        // else {
                        //   echo '  <h1 class="text-danger text-bold well well-sm no-shadow" style="margin-top: 10px;">
                        //   <img
                        //   src="assets/warning.png" width="50" alt=""> 
                        //   FATTURAZIONE INSOLUTA
                        // </h1>';
                        // }
                    


                        $query_guadagno = "SELECT SUM(importo_amount) AS importsum FROM importo WHERE cliente_id='$client_id'";
                        $result_guadagno= mysqli_query($connection,$query_guadagno);
                        $row_guadagno = mysqli_fetch_assoc($result_guadagno);
                    ?>

                                    <center>
                                        <b> <label for=""> I nostri clienti sono da tutto il mondo</label></b>
                                        <img src="assets/stamp.png" class="col-10" alt="">
                                    </center>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 col-sm-12">
                                    <p class="lead">Informazioni</p>

                                    <div class="table-responsive ">
                                        <table class="table ">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">Totale importo depositato:</th>
                                                    <td><?php echo   number_format( $total, 2, ',', ' ') ."€" ?></td>
                                                </tr>
                                                <tr class="table-success">
                                                    <th style="width:50%">Totale guadagno:</th>
                                                    <td><?php echo    number_format( $row_guadagno['importsum'], 2, ',', ' ') ."€" ?>
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <th><?php echo  $row_find['tax_label']; ?>
                                                        (<?php echo  $row_find['client_tax']; ?>%)</th>
                                                    <td> <?php echo   number_format( ($row_find['client_tax']/100)*($total+ $row_guadagno['importsum']), 2, ',', ' ')  ."€" ?>
                                                    </td>
                                                </tr>
                                                <tr class="table-success">
                                                    <th>Totale:</th>
                                                    <td> <?php echo  number_format( $row_guadagno['importsum'] + $total, 2, ',', ' ')    ."€"; ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-12 d-flex justify-content-center">
                                    <form action="addPrelievo.php" method="GET" class="col-3">
                                        <button type="submit" name="person_id" value="<?php echo $client_id;?>"
                                            class="col-12 btn btn btn-md btn-success"> Fai un prelievo</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php include "scripts.php"; ?>

</html>
