<?php 
require_once("../../conexao.php");
@session_start();


$id_usuario = $_SESSION['id_usuario'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$vencimento = $_POST['vencimento'];
$id = $_POST['id'];

$query = $pdo->query("SELECT * from contas_pagar where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){ 
$pago = $res[0]['pago'];
$descricao = $res[0]['descricao'];
if($pago == 'Sim'){
	echo 'Essa conta já está paga, você não pode editá-la!';
	exit();
}

if($descricao == 'Compra de Produtos'){
	echo 'Essa conta foi lançada pelo Gerente / Administrador, você não pode editá-la!';
	exit();
}
}


//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../img/contas_pagar/' .$nome_img;
if (@$_FILES['imagem']['name'] == ""){
  $imagem = "sem-foto.jpg";
}else{
    $imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name']; 
$ext = pathinfo($imagem, PATHINFO_EXTENSION);   
if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'pdf'){ 
move_uploaded_file($imagem_temp, $caminho);
}else{
	echo 'Extensão de Imagem não permitida!';
	exit();
}



if($id == ""){
	$res = $pdo->prepare("INSERT INTO contas_pagar SET vencimento = :vencimento, pago = 'Não', data = curDate(), usuario = '$id_usuario', descricao = :descricao, valor = :valor, arquivo = :foto");
	$res->bindValue(":descricao", $descricao);
	$res->bindValue(":valor", $valor);
	$res->bindValue(":foto", $imagem);
	$res->bindValue(":vencimento", $vencimento);
	$res->execute();
}else{

	if($imagem != 'sem-foto.jpg'){
		$res = $pdo->prepare("UPDATE contas_pagar SET vencimento = :vencimento, usuario = '$id_usuario', descricao = :descricao, valor = :valor, arquivo = :foto WHERE id = :id");
		$res->bindValue(":foto", $imagem);
	}else{
		$res = $pdo->prepare("UPDATE contas_pagar SET vencimento = :vencimento, pago = 'Não', data = curDate(), usuario = '$id_usuario', descricao = :descricao, valor = :valor WHERE id = :id");
	}

	
	$res->bindValue(":descricao", $descricao);
	$res->bindValue(":valor", $valor);
	$res->bindValue(":vencimento", $vencimento);
	$res->bindValue(":id", $id);
	$res->execute();
}



echo 'Salvo com Sucesso!';
?>