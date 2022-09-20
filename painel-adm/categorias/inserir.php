<?php 
require_once("../../conexao.php");


$nome = $_POST['nome'];
$id = $_POST['id'];

$antigo = $_POST['antigo'];


// EVITAR DUPLICIDADE NO NOME DA CAT
if($antigo != $nome){
	$query_con = $pdo->prepare("SELECT * from categorias WHERE nome = :nome");
	$query_con->bindValue(":nome", $nome);
	$query_con->execute();
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res_con) > 0){
		echo 'Categoria já Cadastrada!';
		exit();
	}
}




//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../img/categorias/' .$nome_img;
if (@$_FILES['imagem']['name'] == ""){
  $imagem = "sem-foto.jpg";
}else{
    $imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name']; 
$ext = pathinfo($imagem, PATHINFO_EXTENSION);   
if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
move_uploaded_file($imagem_temp, $caminho);
}else{
	echo 'Extensão de Imagem não permitida!';
	exit();
}



if($id == ""){
	$res = $pdo->prepare("INSERT INTO categorias SET nome = :nome, foto = :foto");
	$res->bindValue(":nome", $nome);
	$res->bindValue(":foto", $imagem);
	$res->execute();
}else{

	if($imagem != 'sem-foto.jpg'){
		$res = $pdo->prepare("UPDATE categorias SET nome = :nome, foto = :foto WHERE id = :id");
		$res->bindValue(":foto", $imagem);
	}else{
		$res = $pdo->prepare("UPDATE categorias SET nome = :nome WHERE id = :id");
	}

	
	$res->bindValue(":nome", $nome);
	$res->bindValue(":id", $id);
	$res->execute();
}



echo 'Salvo com Sucesso!';
?>