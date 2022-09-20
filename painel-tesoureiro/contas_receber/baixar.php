<?php 
require_once("../../conexao.php");


$id = $_POST['id'];
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$query_con = $pdo->query("UPDATE contas_receber SET pago = 'Sim', usuario = '$id_usuario', data_pgto = curDate() WHERE id = '$id'");


//LANÇAR NAS MOVIMENTAÇÕES
$query_con = $pdo->query("SELECT * FROM contas_receber WHERE id = '$id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
$descricao = $res_con[0]['descricao'];
$valor = $res_con[0]['valor'];

$res = $pdo->query("INSERT INTO movimentacoes SET tipo = 'Entrada', data = curDate(), usuario = '$id_usuario', descricao = '$descricao', valor = '$valor', id_mov = '$id'");
	

echo 'Baixado com Sucesso!';

?>