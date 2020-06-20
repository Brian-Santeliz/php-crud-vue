<?php

$response['status']=TRUE;

if((isset($_SERVER['SERVER_NAME'])&&$_SERVER['SERVER_NAME']=="localhost")){
	$host = "localhost"; 
	$user = "root"; 
	$password = ""; 
	$database = "crud2_db"; 
	$con = new mysqli($host, $user, $password, $database);
} else {
	$host = "localhost"; 
	$user = ""; 
	$password = ""; 
	$database = ""; 
	$con = new mysqli($host, $user, $password, $database);
}
 
mysqli_set_charset($con, "utf8");
 

if ($con->connect_error) {
    $response['status']=FALSE;
    $response['message']="Connection failed: ".$con->connect_error;
}


	function closequery($con){
		mysqli_close($con);
	}


	function insertquery($table, $fields, $values, $connection){
		$response['status']=TRUE;
	    $query="INSERT INTO $table($fields) VALUES($values)";
		if (!$result = mysqli_query($connection, $query)) {
                    //exit(mysqli_error($connection));
					$response['status']=FALSE;
					$response['message']="Insert Error: ".mysqli_error($connection);
        }else{	
        	$response['id']=mysqli_insert_id($connection);
        }
        return $response;
	}


	function selectquery($table, $fields, $join, $where, $connection){
		$response = array();
		$response['status']=TRUE;
		$query="SELECT $fields FROM $table";
		if($join!=NULL){
			$query.=" $join ";
		}
		if($where!=NULL){
			$query.=" WHERE $where";
		}
		if (!$result = mysqli_query($connection, $query)) {
                    //exit(mysqli_error($connection));
                    $response['status']=FALSE;
                    $response['message']="Select Error: ".mysqli_error($connection);
        }
	    if(mysqli_num_rows($result) > 0) {
	        for ($i=0;$row = mysqli_fetch_assoc($result);$i++) {
	            $response['values'][$i] = $row;
	        }
	        $response['empty']=FALSE;
	    }else{
	        $response['empty']=TRUE;
	    }
	    return $response;
	}

	function deletequery($table, $field, $value, $connection){
		$response['status']=TRUE;
	 	$query = "DELETE FROM $table WHERE $field = '$value'";
	 	if (!$result = mysqli_query($connection, $query)) {
                    //exit(mysqli_error($connection));
	 				$response['status']=FALSE;
	 				$response['message']="Delete Error: ".mysqli_error($connection);
        }
        return $response;
	}

	function updatequery($table, $rowvalue, $where, $connection){
		$response['status']=TRUE;
		$query = "UPDATE $table SET $rowvalue ";
		$query .= " WHERE $where ";
		if (!$result = mysqli_query($connection, $query)) {
                    //exit(mysqli_error($connection));
                    $response['status']=FALSE;
                    $response['message']="Update Error: ".mysqli_error($connection);
        }
        return $response;
	}

	function countquery($table,$where,$connection){
		$response = array();
		$response['status']=TRUE;
		$query="SELECT COUNT(*) AS total FROM $table";
		if($where!=NULL){
			$query.=" WHERE $where";
		}
		if (!$result = mysqli_query($connection, $query)) {
                    //exit(mysqli_error($connection));
                    $response['status']=FALSE;
                    $response['message']="Count Error: ".mysqli_error($connection);
        }
        $response['values'] = mysqli_fetch_assoc($result);
	    return $response;
	}

	function existquery($table,$where,$connection){
		$response = array();
		$response['status']=TRUE;
		$query="SELECT COUNT(1) AS result FROM $table";
		if($where!=NULL){
			$query.=" WHERE $where";
		}
		if (!$result = mysqli_query($connection, $query)) {
                    //exit(mysqli_error($connection));
                    $response['status']=FALSE;
                    $response['message']="Count Error: ".mysqli_error($connection);
        }
        $response['values'] = mysqli_fetch_assoc($result);
	    return $response;

	}


?>