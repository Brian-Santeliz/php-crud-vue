<?php

    include("../conexion.php");

    $response['status']=TRUE;

if(isset($_POST['RegistroID']) && isset($_POST['RegistroID']) != "") {
 
    $RegistroID = $_POST['RegistroID'];

    $row = deletequery("registro", "RegistroID", $RegistroID, $con);

    closequery($con);
    echo json_encode($response);
}

?>