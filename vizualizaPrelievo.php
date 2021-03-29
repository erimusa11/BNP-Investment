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

                    <div class="invoice white shadow  ">
                        <div class="p-5 col-12 ">
                            <center>
                                <form action="vizualizaPrelievo.php" method="POST">
                                    <label for="" class="col-6">Seleziona il cliente che vuoi vizualizare</label>
                                    <select class="select2 col-6"  onchange="this.form.submit()" name="client_reconazition">
                                        <option value=""> Seleziona</option>
                                        <?php 
                    
                    global $connection; 
                    $query_select = "SELECT * FROM client ORDER BY client_name";
                    $result_select = mysqli_query($connection,$query_select);
                    while($row_select = mysqli_fetch_array($result_select)){

                        if($_POST['client_reconazition'] == $row_select['client_id']){

                            $selected= "selected";
                        } else {
                            $selected= "";

                        }

                      echo '<option '.$selected.' value="'.$row_select['client_id'].'">'.$row_select['client_name'].' '.$row_select['client_subname'].'</option>';

                    }
                    
                    
                    ?>
                                    </select>
                            </center>
                            </form>

                            <br>
                            <table class="table table-bordered table-hover data-tables"
                                data-options='{"searching":true}'>
                                <thead>
                                    <tr>
                                        <th>Beneficario</th>
                                        <th>Swift</th>
                                        <th>Importo</th>
                                        <th>Iban</th>
                                        <th>Causale</th>
                                        <th>Stato</th>
                                        <th>Citta</th>
                                   
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            if(isset($_POST['client_reconazition'])){
                                                global $connection;
                                                $client_id = $_POST['client_reconazition'];
                                                $query_find= "SELECT * FROM prelievo WHERE client_id='$client_id'";
                                                $result_find= mysqli_query($connection,$query_find);
                                                while($row_find=mysqli_fetch_array($result_find)){



                                              

                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $row_find['beneficario']  ?></td>
                                        <td><?php echo $row_find['swift']  ?></td>
                                        <td><?php echo $row_find['importo']."€"  ?></td>
                                        <td><?php echo $row_find['iban']  ?></td>
                                        <td><?php echo $row_find['causale']  ?></td>
                                        <td><?php echo $row_find['stato']  ?></td>
                                        <td><?php echo $row_find['citta']  ?></td>
                                    </tr>

                                    <?php 
                                    
                                }
                            }
                                    ?>
                                    
                                    </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php include "scripts.php";
    
 ?>

</html>