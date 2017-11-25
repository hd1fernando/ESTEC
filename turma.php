<?php
error_reporting(0);

switch ($_POST[functionName]) {
	case "listaTurma":
		echo listaTurma();
        break;
	case "opcaoTurma":
		echo opcaoTurma();
		break;
}

	function listaTurma(){
		include_once("$_SERVER[DOCUMENT_ROOT]/ESTEC/connection.php");
		
		$idProfessor = $_POST[idProfessor];
		
		$sql = "SELECT turma.id_turma as 'idTurma', turma.nome_turma as 'nomeTurma'
				FROM professor_turma
				INNER JOIN turma
				ON professor_turma.fk_turma = turma.id_turma
				INNER JOIN professor
				ON professor_turma.fk_professor = professor.id_professor
				WHERE professor.id_professor = ".$idProfessor."";
		$res = mysqli_query($conn, $sql);
		$result = array();
		while($row = mysqli_fetch_assoc($res)){
			$result[] = $row['idTurma']."&".$row['nomeTurma'];
		}
		mysqli_free_result($res);
		mysqli_close($conn);
		
		echo json_encode($result);
	}
	
		function opcaoTurma(){
		include_once("$_SERVER[DOCUMENT_ROOT]/ESTEC/connection.php");
		
		$idProfessor = $_POST[idProfessor];
		
		$sql = "SELECT fk_turma AS 'idTurma', turma.nome_turma AS 'nomeTurma'
				FROM professor_turma
				INNER JOIN professor ON professor_turma.fk_professor = professor.id_professor
				INNER JOIN turma ON professor_turma.fk_turma = turma.id_turma
				WHERE fk_professor = ".$idProfessor."";
		$res = mysqli_query($conn, $sql);
		$result = array();
		while($row = mysqli_fetch_assoc($res)){
			$result[] = $row['idTurma']."&".$row['nomeTurma'];
		}
		mysqli_free_result($res);
		mysqli_close($conn);
		
		echo json_encode($result);
	}
?>