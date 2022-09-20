<?php 
require_once("../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];



//VERIFICAR SE EXISTEM ITENS DA VENDA PENDENTES
$query_con = $pdo->query("SELECT * FROM itens_venda WHERE usuario = '$id_usuario' and venda = 0 order by id desc");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){ 
	echo 'Existe uma venda em andamento, exclua os itens da venda para Fechar o Caixa!';
	exit();
}

$caixa = $_POST['caixa_fec'];
$gerente = $_POST['gerente_fec'];
$valor_fec = $_POST['valor_fec'];
$valor_fec = str_replace(',', '.', $valor_fec);
$senha_gerente = $_POST['senha_gerente_fec'];


$query = $pdo->query("SELECT * from caixa where operador = '$id_usuario' and status = 'Aberto' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
$valor_abertura = $res[0]['valor_ab'];
$id_abertura = $res[0]['id'];
}

$valor_vendido = 0;
$query = $pdo->query("SELECT * from vendas where operador = '$id_usuario' and abertura = '$id_abertura' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){	}

			$valor_vendido += $res[$i]['valor'];
	}
}



	//CALCULAR TOTAL DE SANGRIAS
	$valor_sang = 0;
	$query = $pdo->query("SELECT * from sangrias where id_caixa = '$id_abertura' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		for($i=0; $i < $total_reg; $i++){
			foreach ($res[$i] as $key => $value){	}

				$valor_sang += $res[$i]['valor'];
		}
	}

$valor_quebra = $valor_fec - ($valor_abertura + $valor_vendido - $valor_sang);


//VERIFICAR A SENHA DO GERENTE
$query_con = $pdo->prepare("SELECT * from usuarios WHERE id = :id_gerente and senha = :senha_gerente ");
$query_con->bindValue(":id_gerente", $gerente);
$query_con->bindValue(":senha_gerente", $senha_gerente);
$query_con->execute();
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
if(@count($res_con) == 0){
	echo 'A senha do Gerente está Incorreta, Não foi possivel abrir o caixa!';
	exit();
}




$res = $pdo->prepare("UPDATE caixa SET data_fec = curDate(), hora_fec = curTime(), valor_fec = :valor_fec, gerente_fec = :gerente_fec, valor_vendido = :valor_vendido, valor_quebra = :valor_quebra, status = 'Fechado', valor_sangrias = '$valor_sang' WHERE operador = '$id_usuario' and status = 'Aberto'");
$res->bindValue(":valor_fec", $valor_fec);
$res->bindValue(":gerente_fec", $gerente);
$res->bindValue(":valor_vendido", $valor_vendido);
$res->bindValue(":valor_quebra", $valor_quebra);

$res->execute();


echo "Aberto com Sucesso!";

?>