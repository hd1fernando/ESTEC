<?php
error_reporting(0);

switch ($_POST['functionName']) {
	case "listaAluno":
		echo listaAluno();
        break;
	case "listaAlunoCliente":
		echo listaAlunoCliente();
        break;
	case "listaQTDAlunoTurma":
		echo listaQTDAlunoTurma();
        break;
	case "listaAlunoProfessor":
		echo listaAlunoProfessor();
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
	
	function listaAlunoCliente(){
		include_once("$_SERVER[DOCUMENT_ROOT]/ESTEC/connection.php");

		$idProfessor = $_POST['idProfessor'];
		
		$sql = "SELECT id_aluno AS 'idAluno', aluno.nome AS 'nomeAluno', aluno.telefone AS 'telefoneAluno', aluno.email AS 'emailAluno', aluno.fk_turma 'idTurma', turma.nome_turma AS 'nomeTurma',aluno. fk_cliente AS 'idCliente', cliente.nome_cliente AS 'nomeCliente'
		FROM aluno
		LEFT JOIN cliente ON aluno.fk_cliente = cliente.id_cliente
		INNER JOIN turma ON aluno.fk_turma = turma.id_turma
		INNER JOIN professor_turma ON aluno.fk_turma = professor_turma.fk_turma
		WHERE professor_turma.fk_professor = ".$idProfessor."";
		$res = mysqli_query($conn, $sql);
		$result = array();
		while($row = mysqli_fetch_assoc($res)){
			$result[] = $row['idAluno']."&".$row['nomeAluno']."&".$row['telefoneAluno']."&".$row['emailAluno']."&".$row['idTurma']."&".$row['nomeTurma']."&".$row['idCliente']."&".$row['nomeCliente'];
		}
		mysqli_free_result($res);
		mysqli_close($conn);
		
		$result = array_map('utf8_encode', $result);
		
		echo json_encode($result);
	}
	
	function listaQTDAlunoTurma(){
		include_once("$_SERVER[DOCUMENT_ROOT]/ESTEC/connection.php");

		$idProfessor = $_POST['idProfessor'];
		
		$sql = "SELECT turma.id_turma AS 'idTurma', turma.nome_turma AS 'nomeTurma', COUNT(aluno.id_aluno) AS 'quantidade'
				FROM aluno
				RIGHT JOIN turma ON aluno.fk_turma = turma.id_turma
				RIGHT JOIN professor_turma ON professor_turma.fk_turma = turma.id_turma
				WHERE professor_turma.fk_professor = ".$idProfessor."
				GROUP BY turma.id_turma";
		$res = mysqli_query($conn, $sql);
		$result = array();
		while($row = mysqli_fetch_assoc($res)){
			$result[] = $row['idTurma']."&".$row['nomeTurma']."&".$row['quantidade'];
		}
		mysqli_free_result($res);
		mysqli_close($conn);
		
		$result = array_map('utf8_encode', $result);
		
		echo json_encode($result);
	}
	
	function listaAlunoProfessor(){
		include_once("$_SERVER[DOCUMENT_ROOT]/ESTEC/connection.php");

		$idProfessor = $_POST['idProfessor'];
		
		$idTurma = $_POST['idTurma'];
		$nomeAluno = $_POST['nomeAluno'];

		if($idTurma <> "") $filtro .= " AND aluno.fk_turma = ".$idTurma."";
		if($nomeAluno <> "") $filtro .= " AND UPPER(aluno.nome) LIKE UPPER('".$nomeAluno."%')"; 
		
		$sql = "SELECT
				aluno.id_aluno AS 'idAluno',
				aluno.nome AS 'nomeAluno',
				aluno.telefone AS 'telefoneAluno',
				aluno.email AS 'emailAluno',
				turma.id_turma AS 'idTurma',
				turma.nome_turma AS 'nomeTurma'
				FROM aluno
				LEFT JOIN turma ON aluno.fk_turma = turma.id_turma
				LEFT JOIN professor_turma ON professor_turma.fk_turma = turma.id_turma
				WHERE professor_turma.fk_professor = ".$idProfessor." ".$filtro."
				ORDER BY turma.nome_turma, aluno.nome";
		$res = mysqli_query($conn, $sql);
		$result = array();
		while($row = mysqli_fetch_assoc($res)){
			$result[] = $row['idAluno']."&".$row['nomeAluno']."&".$row['telefoneAluno']."&".$row['emailAluno']."&".$row['idTurma']."&".$row['nomeTurma'];
		}
		mysqli_free_result($res);
		mysqli_close($conn);
		
		$result = array_map('utf8_encode', $result);
		
		echo json_encode($result);
	}
?>