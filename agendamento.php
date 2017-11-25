<?php
error_reporting(0);

switch ($_POST[functionName]) {
	case "opcaoAgendamento":
		echo opcaoAgendamento();
        break;
}

	function opcaoAgendamento(){
		include_once("$_SERVER[DOCUMENT_ROOT]/ESTEC/connection.php");
		
		$sql = "SELECT id_agendamento, DATE_FORMAT(data_agendamento, '%d/%m/%Y') AS 'dataAgendamento' FROM agendamento";
		$res = mysqli_query($conn, $sql);
		$result = array();
		while($row = mysqli_fetch_assoc($res)){
			$result[] = $row['id_agendamento']."&".$row['dataAgendamento'];
		}
		mysqli_free_result($res);
		mysqli_close($conn);
		
		echo json_encode($result);
	}
?>