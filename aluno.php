<?php
error_reporting(0);

switch ($_POST['functionName']) {
	case "listaAluno":
		echo listaAluno();
        break;
}

	function listaAluno(){
		include_once("$_SERVER[DOCUMENT_ROOT]/ESTEC/connection.php");

		$idTurma = $_POST['idTurma'];
		
		$sql = "SELECT id_aluno, nome FROM aluno WHERE fk_turma = ".$idTurma."";
		$res = mysqli_query($conn, $sql);
		$result = array();
		while($row = mysqli_fetch_assoc($res)){
			$result[] = $row['id_aluno']."&".$row['nome'];
		}
		mysqli_free_result($res);
		mysqli_close($conn);
		
		$result = array_map('utf8_encode', $result);
		
		echo json_encode($result);
	}
?>