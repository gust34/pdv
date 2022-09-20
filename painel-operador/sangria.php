<?php 
require_once("../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$caixa = $_POST['caixa_fec'];
$gerente = $_POST['gerente_fec'];
$sangria = $_POST['valor_sangria'];
$sangria = str_replace(',', '.', $sangria);
$senha_gerente = $_POST['senha_gerente_fec'];



if($sangria == ""){
	echo 'Preencha o Valor da Sangria!';
	exit();
}

//VERIFICAR A SENHA DO GERENTE
$query_con = $pdo->prepare("SELECT * from usuarios WHERE id = :id_gerente and senha = :senha_gerente ");
$query_con->bindValue(":id_gerente", $gerente);
$query_con->bindValue(":senha_gerente", $senha_gerente);
$query_con->execute();
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
if(@count($res_con) == 0){
	echo 'A senha do Gerente está Incorreta, Não e possivel abrir o caixa!';
	exit();
}


$query = $pdo->query("SELECT * from caixa where operador = '$id_usuario' and status = 'Aberto' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
$valor_abertura = $res[0]['valor_ab'];
$id_abertura = $res[0]['id'];
}


$res = $pdo->prepare("INSERT INTO sangrias SET valor = :valor, data = curDate(), hora = curTime(), usuario = '$gerente', caixa = '$caixa', id_caixa = '$id_abertura'");

$res->bindValue(":valor", $sangria);


$res->execute();


echo "Sangria Efetuada com Sucesso!";

?>