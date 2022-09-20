<?php 
require_once("../../conexao.php");

$id = $_POST['id'];


//BUSCAR A IMAGEM PARA EXCLUIR DA PASTA
$query_con = $pdo->query("SELECT * FROM contas_receber WHERE id = '$id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res_con);
if($total_reg > 0){ 
$pago = $res_con[0]['pago'];
if($pago == 'Sim'){
	echo 'Essa conta já está paga, você não pode excluí-la!';
	exit();
}

}

//EXCLUIR A IMAGEM DA PASTA
$imagem = $res_con[0]['arquivo'];
if($imagem != 'sem-foto.jpg'){
	unlink('../../img/contas_receber/'.$imagem);
}


$query_con = $pdo->query("DELETE from contas_receber WHERE id = '$id'");


echo 'Excluído com Sucesso!';

 ?>