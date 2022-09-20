<?php 
require_once("../../conexao.php");

$id = $_POST['id'];




//BUSCAR A IMAGEM PARA EXCLUIR DA PASTA
$query_con = $pdo->query("SELECT * FROM categorias WHERE id = '$id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);

//VERIFICAR SE EXISTE REGISTROS RELACIONADOS A ESSA CATEGORIA
$query_p = $pdo->query("SELECT * FROM produtos WHERE categoria = '$id'");
$res_p = $query_p->fetchAll(PDO::FETCH_ASSOC);
if(@count($res_p) > 0){
	echo 'Existem produtos relacionados a essa categoria, primeiramente exclua estes produtos e depois exclua a categoria!';
	exit();
}

//EXCLUIR A IMAGEM DA PASTA
$imagem = $res_con[0]['foto'];
if($imagem != 'sem-foto.jpg'){
	unlink('../../img/categorias/'.$imagem);
}


$query_con = $pdo->query("DELETE from categorias WHERE id = '$id'");



echo 'Excluído com Sucesso!';

 ?>