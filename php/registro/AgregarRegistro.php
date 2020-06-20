<?php
    include("../conexion.php");

    $response['status']=TRUE;

    if(isset($_POST['RegistroNombre'])&&isset($_POST['RegistroApellido'])){
 
        $RegistroNombre = $_POST['RegistroNombre'];
        $RegistroApellido = $_POST['RegistroApellido'];
        $response = insertquery("registro", "RegistroNombre, RegistroApellido", "'$RegistroNombre', '$RegistroApellido'", $con);
        
    } else {
        $response['status']=FALSE;
        $response['error']="Hubo un error con los campos";
    }

    closequery($con);
    echo json_encode($response);
?>