<?php

include "functions.php";
opensite();
global $connection;
$queryunloc="SELECT * FROM users WHERE user_id=1";

$resultunlock = mysqli_query($connection, $queryunloc);
$row= mysqli_fetch_assoc($resultunlock);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panello</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>
    <form action="" method="POST">
        <center>
            <h1>FAI CLICK AL BUTTONE PER</h1>
        </center>
        <?php   if($row['unlocks']==0){
    ?>
        <center> <button type="submit" name="unlock" value="1" class="btn btn-md btn-dark mt-5">Per sblocare il sito
            </button>


        </center>
        <?php    } else {
    ?>
        <center> <button type="submit" name="lock" value="0" class="btn btn-md btn-danger mt-5">Chiudere il sito
            </button>
            <a href="https://investmentbtnpparibas.site/" class="btn btn-md btn-info mt-5">Andare nel sito
            </a>
        </center>
        <?php    } ?>
    </form>
</body>

</html>
