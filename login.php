<?php
error_reporting(0);

switch ($_POST[functionName]) {
	case "realizaLogin":
		echo realizaLogin();
        break;
}

	function realizaLogin(){
		include_once("$_SERVER[DOCUMENT_ROOT]/ESTEC/connection.php");
		
		$usuario = $_POST[usuario];
		$password = $_POST[password];
		
		$sql = "SELECT usuario, senha FROM usuario WHERE usuario = '".$usuario."' AND senha = '".$password."'";
		$res = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($res);
		mysqli_free_result($res);
		mysqli_close($conn);
		
		echo $row['usuario']."&".$row['senha'];
	}
?>