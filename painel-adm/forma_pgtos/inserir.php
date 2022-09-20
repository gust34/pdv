<?php 
require_once("../../conexao.php");

$nome = $_POST['nome'];
$codigo = $_POST['codigo'];
$id = $_POST['id'];

$antigo = $_POST['antigo'];



// EVITAR DUPLICIDADE NO NOME DA CAT
if($antigo != $codigo){
	$query_con = $pdo->prepare("SELECT * from forma_pgtos WHERE codigo = :codigo");
	$query_con->bindValue(":codigo", $codigo);
	$query_con->execute();
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res_con) > 0){
		echo 'Código de Forma de Pagamento já cadastrado!';
		exit();
	}
}



if($id == ""){
	$res = $pdo->prepare("INSERT INTO forma_pgtos SET nome = :nome, codigo = :codigo");
	$res->bindValue(":nome", $nome);
	$res->bindValue(":codigo", $codigo);	
	$res->execute();
}else{

	
	$res = $pdo->prepare("UPDATE forma_pgtos SET nome = :nome, codigo = :codigo  WHERE id = :id");
	
	
	$res->bindValue(":nome", $nome);
	$res->bindValue(":codigo", $codigo);
	$res->bindValue(":id", $id);
	$res->execute();
}



echo 'Salvo com Sucesso!';
?>