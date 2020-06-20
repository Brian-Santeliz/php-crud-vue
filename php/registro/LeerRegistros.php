<?php

include("../conexion.php");

if($response['status']!=FALSE){

    $response=selectquery("registro","*",NULL,NULL,$con);

}
    closequery($con);
    echo json_encode($response);
?>