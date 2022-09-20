<?php 
require_once("../../conexao.php");

$nome = $_POST['nome'];
$id = $_POST['id'];

$antigo = $_POST['antigo'];



if($antigo != $nome){
	$query_con = $pdo->prepare("SELECT * from caixas WHERE nome = :nome");
	$query_con->bindValue(":nome", $nome);
	$query_con->execute();
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res_con) > 0){
		echo 'Caixa já Cadastrado!';
		exit();
	}
}



if($id == ""){
	$res = $pdo->prepare("INSERT INTO caixas SET nome = :nome");
	$res->bindValue(":nome", $nome);
	
	$res->execute();
}else{

	
	$res = $pdo->prepare("UPDATE caixas SET nome = :nome  WHERE id = :id");
	
	
	$res->bindValue(":nome", $nome);
	$res->bindValue(":id", $id);
	$res->execute();
}



echo 'Salvo com Sucesso!';
?>