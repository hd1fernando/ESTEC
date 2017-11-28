<?php
error_reporting(0);

switch ($_POST['functionName']) {
	case "listaAtendimentoSemFeedBack":
		echo listaAtendimentoSemFeedBack();
        break;
	case "listaAtendimentoSemAluno":
		echo listaAtendimentoSemAluno();
        break;
}

	function listaAtendimentoSemAluno(){
		include_once("$_SERVER[DOCUMENT_ROOT]/ESTEC/connection.php");
		
		$dataAgendamento = $_POST['dataAgendamento'];
		$idHora = $_POST['idHora'];
		$idServico = $_POST['idServico'];
		$nomeCliente = $_POST['nomeCliente'];

		if($dataAgendamento <> "") $filtro .= " AND DATE_FORMAT(agendamento.data_agendamento, '%Y-%m-%d') = '".$dataAgendamento."'";
		if($idHora <> "") $filtro .= " AND atendimento.fk_agendamento = ".$idHora."";
		if($idServico <> "") $filtro .= " AND atendimento.fk_servico = ".$idServico."";
		if($nomeCliente <> "") $filtro .= " AND UPPER(cliente.nome_cliente) LIKE UPPER('".$nomeCliente."%')"; 
		
		$sql = "SELECT
				id_atendimento AS 'idAtendimento',
				atendimento.fk_cliente AS 'idCliente',
				cliente.nome_cliente AS 'nomeCliente',
				cliente.telefone AS 'telefoneCliente',
				cliente.email AS 'emailCliente',
				atendimento.fk_servico AS 'idServico',
				servico.nome_servico AS 'nomeServico',
				atendimento.fk_agendamento AS 'idAgendamento',
				DATE_FORMAT(agendamento.data_agendamento, '%d/%m/%Y') AS 'dataAgendamento',
				TIME_FORMAT(agendamento.hora, '%H:%i') AS 'horaAgendamento'
				FROM atendimento
				INNER JOIN servico ON atendimento.fk_servico = servico.id_servico
				INNER JOIN cliente ON atendimento.fk_cliente = cliente.id_cliente
				INNER JOIN agendamento ON atendimento.fk_agendamento = agendamento.id_agendamento
				WHERE atendimento.feedback IS NULL
				AND atendimento.fk_aluno IS NULL ".$filtro."";
		$res = mysqli_query($conn, $sql);
		$result = array();
		while($row = mysqli_fetch_assoc($res)){
			$result[] = $row['idAtendimento']."&".$row['idCliente']."&".$row['nomeCliente']."&".$row['telefoneCliente']."&".$row['emailCliente']."&".$row['idServico']."&".$row['nomeServico']."&".$row['idAgendamento']."&".$row['dataAgendamento']."&".$row['horaAgendamento'];
		}
		mysqli_free_result($res);
		mysqli_close($conn);
		
		$result = array_map('utf8_encode', $result);
		
		echo json_encode($result);
	}

	function listaAtendimentoSemFeedBack(){
		include_once("$_SERVER[DOCUMENT_ROOT]/ESTEC/connection.php");
		
		$idProfessor = $_POST['idProfessor'];
		
		$idServico = $_POST['idServico'];
		$idTurma = $_POST['idTurma'];
		$idAgendamento = $_POST['idData'];
		$nomeAluno = $_POST['nomeAluno'];

		if($idServico <> "") $filtro .= " AND atendimento.fk_servico = ".$idServico."";
		if($idTurma <> "") $filtro .= " AND aluno.fk_turma = ".$idTurma."";
		if($idAgendamento <> "") $filtro .= " AND atendimento.fk_agendamento = ".$idAgendamento."";
		if($nomeAluno <> "") $filtro .= " AND UPPER(aluno.nome) LIKE UPPER('".$nomeAluno."%')"; 
		
		$sql = "SELECT
				id_atendimento AS 'idAtendimento',
				atendimento.fk_aluno AS 'idAluno',
				aluno.nome AS 'nomeAluno',
				atendimento.fk_servico AS 'idServico',
				servico.nome_servico AS 'nomeServico',
				atendimento.fk_cliente AS 'idCliente',
				cliente.nome_cliente AS 'nomeCliente',
				atendimento.fk_agendamento AS 'idAgendamento',
				DATE_FORMAT(agendamento.data_agendamento, '%d/%m/%Y') AS 'dataAgendamento',
				TIME_FORMAT(agendamento.hora, '%H:%i') AS 'horaAgendamento'
				FROM atendimento
				INNER JOIN aluno ON atendimento.fk_aluno = aluno.id_aluno
				INNER JOIN servico ON atendimento.fk_servico = servico.id_servico
				INNER JOIN cliente ON atendimento.fk_cliente = cliente.id_cliente
				INNER JOIN agendamento ON atendimento.fk_agendamento = agendamento.id_agendamento
				INNER JOIN professor_turma ON professor_turma.fk_turma = aluno.fk_turma
				WHERE atendimento.feedback IS NULL ".$filtro." AND professor_turma.fk_professor = ".$idProfessor."";
		$res = mysqli_query($conn, $sql);
		$result = array();
		while($row = mysqli_fetch_assoc($res)){
			$result[] = $row['idAtendimento']."&".$row['idAluno']."&".$row['nomeAluno']."&".$row['idServico']."&".$row['nomeServico']."&".$row['idCliente']."&".$row['nomeCliente']."&".$row['idAgendamento']."&".$row['dataAgendamento']."&".$row['horaAgendamento'];
		}
		mysqli_free_result($res);
		mysqli_close($conn);
		
		$result = array_map('utf8_encode', $result);
		
		echo json_encode($result);
	}
?>