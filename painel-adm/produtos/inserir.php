<?php 
require_once("../../conexao.php");

$nome = $_POST['nome'];
$codigo = $_POST['codigo'];
$valor_venda = $_POST['valor_venda'];
$valor_venda = str_replace(',', '.', $valor_venda);
$descricao = $_POST['descricao'];
$categoria = $_POST['categoria'];
$estoque_min = $_POST['estoque_min'];
$id = $_POST['id'];

$antigo = $_POST['antigo'];
$antigo2 = $_POST['antigo2'];

// EVITAR DUPLICIDADE NO NOME
if($antigo != $nome){
	$query_con = $pdo->prepare("SELECT * from produtos WHERE nome = :nome");
	$query_con->bindValue(":nome", $nome);
	$query_con->execute();
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res_con) > 0){
		echo 'Produto já Cadastrado!';
		exit();
	}
}


// EVITAR DUPLICIDADE NO CÓDIGO
if($antigo2 != $codigo){
	$query_con = $pdo->prepare("SELECT * from produtos WHERE codigo = :codigo");
	$query_con->bindValue(":codigo", $codigo);
	$query_con->execute();
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res_con) > 0){
		echo 'Código do Produto já Cadastrado!';
		exit();
	}
}



//SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../img/produtos/' .$nome_img;
if (@$_FILES['imagem']['name'] == ""){
  $imagem = "sem-foto.jpg";
}else{
    $imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name']; 
$ext = pathinfo($imagem, PATHINFO_EXTENSION);   
if($ext == 'JPG' or $ext == 'jpg' or $ext == 'jpeg'){ 
move_uploaded_file($imagem_temp, $caminho);
}else{
	echo 'Extensão de Imagem não permitida, use somente imagem jpg!!';
	exit();
}



if($id == ""){
	$res = $pdo->prepare("INSERT INTO produtos SET codigo = :codigo, nome = :nome, descricao = :descricao, valor_venda = :valor_venda, categoria = :categoria, foto = :foto, estoque_min = '$estoque_min'");
	$res->bindValue(":codigo", $codigo);
	$res->bindValue(":nome", $nome);
	$res->bindValue(":descricao", $descricao);
	$res->bindValue(":valor_venda", $valor_venda);
	$res->bindValue(":categoria", $categoria);
	$res->bindValue(":foto", $imagem);
	$res->execute();
}else{

	if($imagem != 'sem-foto.jpg'){
		$res = $pdo->prepare("UPDATE produtos SET codigo = :codigo, nome = :nome, descricao = :descricao, valor_venda = :valor_venda, categoria = :categoria, foto = :foto, estoque_min = '$estoque_min' WHERE id = :id");
		$res->bindValue(":foto", $imagem);
	}else{
		$res = $pdo->prepare("UPDATE produtos SET codigo = :codigo, nome = :nome, descricao = :descricao, valor_venda = :valor_venda, categoria = :categoria, estoque_min = '$estoque_min' WHERE id = :id");
	}

	
	$res->bindValue(":codigo", $codigo);
	$res->bindValue(":nome", $nome);
	$res->bindValue(":descricao", $descricao);
	$res->bindValue(":valor_venda", $valor_venda);
	$res->bindValue(":categoria", $categoria);
	$res->bindValue(":id", $id);
	$res->execute();
}



echo 'Salvo com Sucesso!';
?>