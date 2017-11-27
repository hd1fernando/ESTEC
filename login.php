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
		
		$sql = "SELECT usuario.fk_professor as 'idProfessor', usuario.usuario AS 'usuario', professor.nome AS 'nome'
		FROM usuario 
		INNER JOIN professor 
		ON usuario.fk_professor = professor.id_professor
		WHERE 1 AND usuario.usuario = '".$usuario."' AND usuario.senha = '".$password."'";
		$res = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($res);
		mysqli_free_result($res);
		mysqli_close($conn);
		
		echo $row['idProfessor']."&".$row['usuario']."&".$row['nome'];
	}
?>