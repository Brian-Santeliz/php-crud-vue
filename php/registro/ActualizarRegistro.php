<?php

include("../conexion.php");

if(isset($_POST['RegistroID'])&&isset($_POST['RegistroNombre'])&&isset($_POST['RegistroApellido']))
{	
	if($response['status']!=FALSE){

	    $RegistroNombre = $_POST['RegistroNombre'];
	    $RegistroApellido = $_POST['RegistroApellido'];
		$RegistroID = $_POST['RegistroID'];

	    $response=updatequery("registro", "RegistroNombre = '$RegistroNombre',RegistroApellido = '$RegistroApellido'", "RegistroID = '$RegistroID'", $con);
	    closequery($con);
	}

} else {
        $response['status']=FALSE;
        $response['message']="Error en variables";
    }
   
echo json_encode($response);