<?php 
require_once("conexao.php");
@session_start();

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];



$query_con = $pdo->prepare("SELECT * from usuarios WHERE (email = :usuario or cpf = :usuario) and senha = :senha");
	$query_con->bindValue(":usuario", $usuario);
	$query_con->bindValue(":senha", $senha);
	$query_con->execute();
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);

	if(@count($res_con) > 0){
		$nivel = $res_con[0]['nivel'];

		$_SESSION['nome_usuario'] = $res_con[0]['nome'];
		$_SESSION['nivel_usuario'] = $res_con[0]['nivel'];
		$_SESSION['cpf_usuario'] = $res_con[0]['cpf'];
		$_SESSION['id_usuario'] = $res_con[0]['id'];


		if($nivel == 'Administrador'){
			echo "<script language='javascript'>window.location='painel-adm'</script>";
		}

		if($nivel == 'Operador'){
			echo "<script language='javascript'>window.location='painel-operador'</script>";
		}

		if($nivel == 'Tesoureiro'){
			echo "<script language='javascript'>window.location='painel-tesoureiro'</script>";
		}
	}else{

		echo "<script language='javascript'>window.alert('Dados Incorretos, ou Usuario nao Cadastrado!')</script>";

		echo "<script language='javascript'>window.location='index.php'</script>";
	}

 ?>