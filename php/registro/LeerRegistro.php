<?php

    include("../conexion.php");

    $response['status'] = true;
 
if(isset($_POST['RegistroID']))
{

    $RegistroID = $_POST['RegistroID'];
   
    $response = selectquery("registro","*",NULL,"RegistroID ='$RegistroID'",$con);

} else {

    $response['status'] = false;
    $response['message'] = "Invalido";

}

    closequery($con);
    echo json_encode($response);