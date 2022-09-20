<?php 
require_once("../../conexao.php");

$id = $_POST['id'];


$query_con = $pdo->query("SELECT * FROM compras WHERE id = '$id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res_con);
if($total_reg > 0){ 
$pago = $res_con[0]['pago'];
if($pago == 'Sim'){
	echo 'Essa compra já está concluída, você não pode excluí-la!';
	exit();
}
}


$query_con = $pdo->query("DELETE from contas_pagar WHERE id_compra = '$id'");

$query_con = $pdo->query("DELETE from compras WHERE id = '$id'");



echo 'Excluído com Sucesso!';



 ?>