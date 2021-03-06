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
                    <div class="card-header white">
                        <h6> Registra un bonifico</h6>
                    </div>
                    <div class="invoice white shadow  ">


                        <div class="p-5 col-12 ">
                            <center>
                                <form action="creaBonifico.php" method="POST">
                                    <label for="" class="col-6">Seleziona il cliente che cuoi creare ul bonifico</label>
                                    <select class="select2 col-6" name="client_reconazition">
                                        <?php 
                    
                    global $connection; 
                    $query_select = "SELECT * FROM client ORDER BY client_name";
                    $result_select = mysqli_query($connection,$query_select);
                    while($row_select = mysqli_fetch_array($result_select)){

                      echo '<option value="'.$row_select['client_id'].'">'.$row_select['client_name'].' '.$row_select['client_subname'].'</option>';

                    }
                    
                    
                    ?>
                                    </select>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-6">
                                            <h6 class="text-center">Data del bonifico</h6>
                                            <div class="row clearfix">
                                                <div class="col-sm-12">
                                                    <div class="form-group col-12">
                                                        <div class="form-line">
                                                            <div class="form-group">
                                                                <input type="text" name="bonifico_data"
                                                                    data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;d-m-Y&quot;}"
                                                                    class="date-time-picker form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <h6 class="text-center">Quantita del bonifico (???)</h6>
                                            <div class="row clearfix">
                                                <div class="col-sm-12">
                                                    <div class="form-group col-12">
                                                        <div class="form-line">
                                                            <div class="form-group">
                                                                <input type="text" name="bonifico_quantita"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <button type="submit" name="bonifico_crea" class="btn btn-md  btn-success ">Registra
                                        il bonifico</button>
                            </center>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php include "scripts.php";
    
createbonifico();
?>

</html>
