//
<?php
error_reporting(0);

switch ($_POST['functionName']) {
	case "listaClienteAluno":
		echo listaClienteAluno();
        break;
}

	function listaClienteAluno(){
		include_once("$_SERVER[DOCUMENT_ROOT]/ESTEC/connection.php");
		
		$sql = "SELECT cliente.id_cliente AS 'idCliente', cliente.nome_cliente AS 'nomeCliente', cliente.telefone AS 'telefoneCliente', cliente.email AS 'emailCliente', endereco.id_endereco AS 'idEndereco', concat(endereco.logradouro,'-', endereco.numero,'-', endereco.complemento,'-',endereco.bairro,'-',endereco.cidade,'-',endereco.estado) AS 'endereco', aluno.id_aluno AS 'idAluno', aluno.nome AS 'nomeAluno'
				FROM cliente
				LEFT JOIN aluno ON aluno.fk_cliente = cliente.id_cliente
				LEFT JOIN endereco ON cliente.fk_endereco = endereco.id_endereco";
		$res = mysqli_query($conn, $sql);
		$result = array();
		while($row = mysqli_fetch_assoc($res)){
			$result[] = $row['idCliente']."&".$row['nomeCliente']."&".$row['telefoneCliente']."&".$row['emailCliente']."&".$row['idEndereco']."&".$row['endereco']."&".$row['idAluno']."&".$row['nomeAluno'];
		}
		mysqli_free_result($res);
		mysqli_close($conn);
		
		$result = array_map('utf8_encode', $result);
		
		echo json_encode($result);
	}
?>