<?php
error_reporting(0);

switch ($_POST[functionName]) {
	case "realizaLogin":
		echo realizaLogin();
        break;
	case "verificaSessao":
		echo verificaSessao();
        break;
	case "logout":
		echo logout();
        break;
	case "realizaSessao":
		echo realizaSessao();
        break;
}

	function realizaLogin(){
		include_once("$_SERVER[DOCUMENT_ROOT]/ESTEC/connection.php");
		
		$usuario = $_POST[usuario];
		$password = $_POST[password];
		
		$sql = "SELECT usuario.fk_professor as 'idProfessor', usuario.usuario AS 'usuario', professor.nome AS 'nome', usuario.senha AS 'senha'
		FROM usuario 
		INNER JOIN professor 
		ON usuario.fk_professor = professor.id_professor
		WHERE 1 AND usuario.usuario = '".$usuario."' AND usuario.senha = '".$password."'";
		$res = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($res);
		mysqli_free_result($res);
		mysqli_close($conn);
		
		echo $row['idProfessor']."&".$row['nome']."&".$row['usuario']."&".$row['senha'];
	}
	
	function realizaSessao(){
		session_start();
		$_SESSION[idProfessor] = $_POST[idProfessor];
		$_SESSION[nome] = $_POST[nome];
		$_SESSION[usuario] = $_POST[usuario];
		$_SESSION[senha] = $_POST[senha];
	}
	
	function verificaSessao(){
		session_start();
		if (empty($_SESSION[idProfessor]) OR empty($_SESSION[nome]) OR empty($_SESSION[usuario]) OR empty($_SESSION[senha])) {
			session_destroy();
			echo "N";
		} else echo $_SESSION[idProfessor]."&".$_SESSION[nome]."&".$_SESSION[usuario]."&".$_SESSION[senha];
	}
	
	function logout(){
		session_start();
		if (isset($_SESSION[idProfessor])) 		unset($_SESSION[idProfessor]);
		if (isset($_SESSION[nome])) 			unset($_SESSION[nome]);
		if (isset($_SESSION[usuario])) 			unset($_SESSION[usuario]);
		if (isset($_SESSION[senha])) 			unset($_SESSION[senha]);
		session_destroy();
	}
?>