<?php
date_default_timezone_set('Europe/Rome');
include "dbconnect.php";
session_start();
//*******************************************************this is the log in function *******************************************/
function login()
{
    global $connection;

    if (isset($_POST['submit'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {
            
            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = '6Lfr5I8aAAAAAIdPCb8ocA8SC6QftQiec7N3D1yT';
            $recaptcha_response = $_POST['recaptcha_response'];

            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);
          
            if ($recaptcha->score >= 0.5) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
 
        $query = "SELECT * from users WHERE user_username = '$username' AND user_password = '$password'";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);
        if ($count == 0) {
          

            $queryclient = "SELECT * from client WHERE username = '$username' AND password = '$password'";
            $resultclient = mysqli_query($connection, $queryclient);
            $countclient = mysqli_num_rows($resultclient);

            if ($countclient == 0) { 
                return header("Location: ./login.php?error=1");
             } else {

                while (($rowclient = mysqli_fetch_array($resultclient))) {
            
                    if ($username === $rowclient['username'] && $password === $rowclient['password']) {
                            $_SESSION['user_id'] = $rowclient['client_id'];
                            $_SESSION['user_name'] = $rowclient['client_name'];
                            $_SESSION['user_subname'] = $rowclient['client_subname'];
                            $_SESSION['client'] = 1;
                 
                            return header("Location: graps.php");
                    }
                }

             }

        } else {
            while (($row = mysqli_fetch_array($result))) {
            
                if ($username === $row['user_username'] && $password === $row['user_password']) {
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['user_name'] = $row['user_name'];
                        $_SESSION['user_subname'] = $row['user_subname'];
                        $_SESSION['client'] = 0;
                        return header("Location: dashboard.php");
                } else {
                    return header("Location: ./login.php?error=1");
                }
            }
        }
    }
    
    }
}
}
//*******************************************************this is the end of  log in function ********************************/

//**************************************************this is the log out function  *******************************************/

function logout() //!***********
{
    if (isset($_POST['logout'])) {
       
        session_destroy();
    
        return header("Location:  login.php");
  
                 }
             }
//**************************************************this is the end  log out function  *******************************************/

//**************************************************create clients *******************************************/

function createClient(){

    if(isset($_POST['client_submit'])){

        global $connection;

        $client_name =   str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_name']);
        $client_subname =  str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_subname']);
        $client_email =   str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_email']);
        $client_phone =  str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_phone']);
        $client_adress = str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_adress']);
        $client_tax = str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_tax']);
        $username = str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_email']);
        $password = str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['password']);
        $password = str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['password']);
        $tax_label = str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['tax_label']);
        $payemnt_due =   date("Y-m-d", strtotime($_POST['payemnt_due']));
        $date_client =  date("Y-m-d", strtotime($_POST['date_client']));

        $query_insert = "INSERT INTO client (client_name,client_subname,client_email,client_phone,client_adress,date_client,payemnt_due,client_tax,username,password,tax_label) VALUES ('$client_name','$client_subname','$client_email','$client_phone','$client_adress','$date_client','$payemnt_due','$client_tax','$username','$password','$tax_label')";
     
        $resut_query = mysqli_query($connection,$query_insert);
        if($resut_query){ 
        echo '<script type="text/javascript">
        swal({
            title: "Congratulazione...",
            text: "Il cliente e stato creato con successo",
            icon: "success",
            showCancelButton: false,
            confirmButtonText: "Continua il lavoro",
            padding: "2em",
            allowOutsideClick: false
            }).then(() => location.reload());</script>';
               
                    }
                }
            }
//**************************************************create clients *******************************************/

//**************************************************Crea bonifico *******************************************/

function createbonifico(){

    if(isset($_POST['bonifico_crea'])){

        global $connection;
        $client_reconazition= $_POST['client_reconazition'];
        $bonifico_data=   date("Y-m-d", strtotime($_POST['bonifico_data']));
        $bonifico_quantita= $_POST['bonifico_quantita'];

        $query_insert = "INSERT INTO bonifico (client_reconazition,bonifico_data,bonifico_quantita ) VALUES ('$client_reconazition','$bonifico_data','$bonifico_quantita')";

        
        $resut_query = mysqli_query($connection,$query_insert);
        if($resut_query){ 

            
        echo '<script type="text/javascript">
        swal({
            title: "Congratulazione...",
            text: "Il Bonifico e stato registrato con successo",
            icon: "success",
            showCancelButton: false,
            confirmButtonText: "Continua il lavoro",
            padding: "2em",
            allowOutsideClick: false
            }).then(() => location.reload());</script>';
               
                }
            }
        }


//**************************************************Crea bonifico *******************************************/

//**************************************************elimina bonifico *******************************************/

function eleiminabonifico(){

    if(isset($_POST['elemina_bonifico'])){
        global $connection;
            $id_bonifico = $_POST['elemina_bonifico'];
            $deletequery = "DELETE FROM bonifico WHERE bonifico_id='$id_bonifico'";
            $result_delete= mysqli_query($connection,$deletequery);
            if($result_delete){ 
                echo '<script type="text/javascript">
                swal({
                    title: "Congratulazione...",
                    text: "Il Bonifico e stato eleminato con successo",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonText: "Continua il lavoro",
                    padding: "2em",
                    allowOutsideClick: false
                    }).then(() => location.reload());</script>';
                       
                      }
                  }
            }

//**************************************************elimina bonifico *******************************************/

//************************************************** modifica Cliente *******************************************/

function modificaCliente(){

    if(isset($_POST['Modifica_client_submit'])){


        global $connection;
        $date_client= date("Y-m-d", strtotime($_POST['date_client']));
        $payemnt_due= date("Y-m-d", strtotime($_POST['payemnt_due']));
        $client_tax=  str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_tax']);
        $client_adress= str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_adress']);
        $client_phone= str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_phone']);
        $client_email= str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_email']);
        $password= str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['password1']);
        $client_subname= str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_subname']);
        $client_name= str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_name']);
        $client_reconazition= str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['client_reconazition']);
        $tax_label= str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['tax_label']);


        $query_update="UPDATE client  SET date_client='$date_client', payemnt_due='$payemnt_due',client_tax='$client_tax',client_adress='$client_adress',client_phone='$client_phone',client_email='$client_email',client_subname='$client_subname',client_name='$client_name' ,tax_label='$tax_label',password='$password' WHERE client_id='$client_reconazition'";
            $result_update=mysqli_query($connection, $query_update);
            if($result_update){ 
                echo '<script type="text/javascript">
                swal({
                    title: "Congratulazione...",
                    text: "IGli dati sono stati modiificati con successo",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonText: "Continua il lavoro",
                    padding: "2em",
                    allowOutsideClick: false
                    }).then(() => location.reload());</script>';
                       
                }
              }
            }

//************************************************** modifica Cliente *******************************************/

//************************************************** aktive disactive website*******************************************/

function activediactive(){

    if(isset($_POST['submit_active'])){
        global $connection;
      
 
        if( $_POST['submit_active'] == 1){
            $website_on_of1=0;
        } else {
            $website_on_of1=1;
        }

     
      
        if($_POST['secretpass']==='n3U@>xnpn^@5YO'){
        $query_update="UPDATE users  SET  website_on_of='$website_on_of1'";
   
        $result_update = mysqli_query($connection,$query_update);
        return header("Location: aktivesite.php");
        }
    }
}

//************************************************** aktive disactive website*******************************************/

//************************************************** Add prelievo *******************************************/

function addprelievo(){

    if(isset($_POST['addprelievo'])){

        global $connection;
        $client_id= $_POST['beneficario'];
 
     
        $swift=str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['swift']);
        $iban=str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['iban']);
        $causale= str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['causale']);
        $importo=str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['importo']);
        $citta=str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['citta']);
        $stato=str_replace(array("'", "’", "“", "”"), array("\'", "\'", "\'", "\'"), $_POST['stato']);

        $find_client = "SELECT * FROM client WHERE client_id='$client_id'";
                                        
        $find_result= mysqli_query($connection,$find_client);
        $row_find= mysqli_fetch_assoc($find_result);
        $beneficario=  $row_find['client_name'].' '. $row_find['client_subname'];
       //     if($_POST['addprelievo'] != null || $_POST['addprelievo'] != ""){
        $query_insert = "INSERT INTO prelievo (client_id,beneficario,swift,iban,causale,importo,citta,stato) VALUES ('$client_id','$beneficario','$swift','$iban','$causale','$importo','$citta','$stato')";
     
        $resut_query = mysqli_query($connection,$query_insert);
        if($resut_query){ 
        echo '<script type="text/javascript">
        swal({
            title: "Congratulazione...",
            text: "Il prelievo e statto effetuato con successo",
            icon: "success",
            showCancelButton: false,
            confirmButtonText: "Continua il lavoro",
            padding: "2em",
            allowOutsideClick: false
            }).then(() => location.reload());</script>';
               
                    }
                   // }else {
                        // echo '<script type="text/javascript">
                        // swal({
                        //     title: "Attenzione...",
                        //     text: "Il prelievo e statto fatto una volta non si puoi rimetere una seconda volta",
                        //     icon: "error",
                        //     showCancelButton: false,
                        //     confirmButtonText: "Continua il lavoro",
                        //     padding: "2em",
                        //     allowOutsideClick: false
                        //     }).then(() => location.reload());</script>';
                   // }
                }
            }


//************************************************** Add prelievo *******************************************/



//**************************************************Crea guadagnio *******************************************/

function createguadagnio(){

    if(isset($_POST['guadagno_crea'])){

        global $connection;
        $client_reconazition= $_POST['client_reconazition'];
  
        $bonifico_quantita= $_POST['guadagnio_quantita'];

        $query_insert = "INSERT INTO importo (cliente_id,importo_amount ) VALUES ('$client_reconazition','$bonifico_quantita'  )";


        $resut_query = mysqli_query($connection,$query_insert);
        if($resut_query){ 
        echo '<script type="text/javascript">
        swal({
            title: "Congratulazione...",
            text: "Il guadagnio e stato registrato con successo",
            icon: "success",
            showCancelButton: false,
            confirmButtonText: "Continua il lavoro",
            padding: "2em",
            allowOutsideClick: false
            }).then(() => location.reload());</script>';
               
                }
            }
        }


//**************************************************Crea guadagnio *******************************************/


//**************************************************elimina guadagnio *******************************************/

function eleiminaguadagnio(){

    if(isset($_POST['elemina_guadagnio'])){
        global $connection;
            $elemina_guadagnio = $_POST['elemina_guadagnio'];
            $deletequery = "DELETE FROM importo WHERE importo_id='$elemina_guadagnio'";
            $result_delete= mysqli_query($connection,$deletequery);
            if($result_delete){ 
                echo '<script type="text/javascript">
                swal({
                    title: "Congratulazione...",
                    text: "Il guadagnio e stato eleminato con successo",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonText: "Continua il lavoro",
                    padding: "2em",
                    allowOutsideClick: false
                    }).then(() => location.reload());</script>';
                       
                      }
                  }
            }

//**************************************************elimina guadagnio *******************************************/

//**************************************************funzioni geoplugin*******************************************/


function getUserIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getUserCountry($ipUser)
{
    $now = date('Y-m-d H:i:s');
    $ipdat = @json_decode(file_get_contents(
        "http://www.geoplugin.net/json.gp?ip=" . $ipUser));

    $countryName = $ipdat->geoplugin_countryName;
    $cityName = $ipdat->geoplugin_city;
    $userData = array(
        'countryName' => $countryName,
        'cityName' => $cityName,
        'now' => $now,
    );
    return $userData;
}
//**************************************************funzioni geoplugin*******************************************/



//**************************************************fhide  and show site *******************************************/

function opensite(){

    if(isset($_POST['unlock']) ||isset($_POST['lock'])){

        global $connection;
        if(isset($_POST['unlock'])){
            $value=$_POST['unlock'];
        }else if( isset($_POST['lock'])){
            $value=$_POST['lock'];
        }
        $query_update="UPDATE users  SET unlocks='$value'";
        mysqli_query($connection, $query_update);

    }
}

//**************************************************fhide  and show site *******************************************/


?>
