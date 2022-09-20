<?php 
require_once("../../conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$tipo_pessoa = $_POST['tipo'];
$id = $_POST['id'];

$antigo = $_POST['antigo'];
$antigo2 = $_POST['antigo2'];

// EVITANDO DUPLICIDADE NO EMAIL
if($antigo2 != $email){
	$query_con = $pdo->prepare("SELECT * from fornecedores WHERE email = :email");
	$query_con->bindValue(":email", $email);
	$query_con->execute();
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res_con) > 0){
		echo 'O email do fornecedor já está cadastrado!';
		exit();
	}
}

if($antigo != $cpf){
// EVITAR DUPLICIDADE NO CPF
	$query_con = $pdo->prepare("SELECT * from fornecedores WHERE cpf = :cpf");
	$query_con->bindValue(":cpf", $cpf);
	$query_con->execute();
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res_con) > 0){
		echo 'O CPF / CNPJ do fornecedor já está cadastrado!';
		exit();
	}
}

if($id == ""){
	$res = $pdo->prepare("INSERT INTO fornecedores SET nome = :nome, email = :email, cpf = :cpf, telefone = :telefone, endereco = :endereco, tipo_pessoa = :tipo_pessoa");
	$res->bindValue(":nome", $nome);
	$res->bindValue(":email", $email);
	$res->bindValue(":cpf", $cpf);
	$res->bindValue(":telefone", $telefone);
	$res->bindValue(":endereco", $endereco);
	$res->bindValue(":tipo_pessoa", $tipo_pessoa);
	$res->execute();
}else{
	$res = $pdo->prepare("UPDATE fornecedores SET nome = :nome, email = :email, cpf = :cpf, telefone = :telefone, endereco = :endereco, tipo_pessoa = :tipo_pessoa WHERE id = :id");
	$res->bindValue(":nome", $nome);
	$res->bindValue(":email", $email);
	$res->bindValue(":cpf", $cpf);
	$res->bindValue(":telefone", $telefone);
	$res->bindValue(":endereco", $endereco);
	$res->bindValue(":tipo_pessoa", $tipo_pessoa);
	$res->bindValue(":id", $id);
	$res->execute();
}

echo 'Salvo com Sucesso!';
?>