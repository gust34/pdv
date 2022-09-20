<?php 
require_once("../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];


$caixa = $_POST['caixa'];
$gerente = $_POST['gerente'];
$valor_ab = $_POST['valor_ab'];
$valor_ab = str_replace(',', '.', $valor_ab);
$senha_gerente = $_POST['senha_gerente'];

//VERIFICAR A SENHA DO GERENTE
$query_con = $pdo->prepare("SELECT * from usuarios WHERE id = :id_gerente and senha = :senha_gerente ");
$query_con->bindValue(":id_gerente", $gerente);
$query_con->bindValue(":senha_gerente", $senha_gerente);
$query_con->execute();
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
if(@count($res_con) == 0){
		echo 'A senha do Gerente está Incorreta, Não foi possivel abrir o caixa!';
	exit();
	}


// VERIFICAR SE O CAIXA ESTÁ ABERTO

$query_con = $pdo->prepare("SELECT * from caixa WHERE caixa = :caixa AND status = 'Aberto' ");
$query_con->bindValue(":caixa", $caixa);
$query_con->execute();
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
if(@count($res_con) > 0){
	$id_gerente = $res_con[0]['gerente_ab'];
	$operador = $res_con[0]['operador'];

	$query2 = $pdo->query("SELECT * from usuarios WHERE id = '$id_gerente' ");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_gerente = $res2[0]['nome'];

	$query3 = $pdo->query("SELECT * from usuarios WHERE id = '$operador' ");
	$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
	$nome_operador = $res3[0]['nome'];

	echo 'Este caixa já está aberto, ele foi aberto pelo Gerente '.$nome_gerente. ' e o operador dele é ' .$nome_operador. ' !';
	exit();
}


$res = $pdo->prepare("INSERT INTO caixa SET data_ab = curDate(), hora_ab = curTime(), valor_ab = :valor_ab, gerente_ab = :gerente_ab, caixa = :caixa, operador = '$id_usuario', status = 'Aberto'");
$res->bindValue(":valor_ab", $valor_ab);
$res->bindValue(":gerente_ab", $gerente);
$res->bindValue(":caixa", $caixa);

$res->execute();


echo "Aberto com Sucesso!";

?>