<?php
error_reporting(0);

switch ($_POST[functionName]) {
	case "opcaoServico":
		echo opcaoServico();
        break;
}

	function opcaoServico(){
		include_once("$_SERVER[DOCUMENT_ROOT]/ESTEC/connection.php");
		
		$sql = "SELECT id_servico, nome_servico FROM servico";
		$res = mysqli_query($conn, $sql);
		$result = array();
		while($row = mysqli_fetch_assoc($res)){
			$result[] = $row['id_servico']."&".$row['nome_servico'];
		}
		mysqli_free_result($res);
		mysqli_close($conn);
		
		echo json_encode($result);
	}
?>