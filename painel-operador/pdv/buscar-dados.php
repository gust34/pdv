<?php 
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$novo_estoque = '';


$query_con = $pdo->query("SELECT * FROM caixa WHERE operador = '$id_usuario' and status = 'Aberto'");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
$id_abertura = $res[0]['id'];

$estoque = "";
$nome = "Código não Cadastrado";
$descricao = "";
$imagem = "";
$valor = "";
$valor_total = "";

$codigo = $_POST['codigo'];
$quantidade = $_POST['quantidade'];
$desconto = $_POST['desconto'];
$desconto = str_replace(',', '.', $desconto);
$valor_recebido = $_POST['valor_recebido'];
$valor_recebido = str_replace(',', '.', $valor_recebido);

$forma_pgto_input = $_POST['forma_pgto_input'];


if($forma_pgto_input == '2'){
	//VAMOS REDIRECIONR PARA PAGAMENTO NO CRÉDITO
}


//FECHAR A VENDA
if($forma_pgto_input != ""){

	$troco = $_POST['valor_troco'];
	$troco = str_replace('R$', '', $troco);
	$troco = str_replace('.', '', $troco);
	$troco = str_replace(',', '.', $troco);

	$total_compra = $_POST['total_compra'];
	$total_compra = str_replace('R$', '', $total_compra);
	$total_compra = str_replace('.', '', $total_compra);
	$total_compra = str_replace(',', '.', $total_compra);


	if($total_compra <= 0){
		echo 'Não é possível efetuar uma venda sem itens!';
		exit();
	}

	if($valor_recebido == ""){
		$valor_recebido = $total_compra;
	}

	if($desconto != ""){
		if($desconto_porcentagem == 'Sim'){
		$desconto = $desconto . '%';
		}else{
		$desconto = 'R$ '.$desconto . ',00';
		}
	}else{
		$desconto = 'R$ 0,00';
	}
	

	$res = $pdo->prepare("INSERT INTO vendas SET valor = :valor, data = curDate(), hora = curTime(),  operador = :usuario, valor_recebido = :valor_recebido, desconto = :desconto, troco = :troco, forma_pgto = :forma_pgto, abertura = :abertura, status = 'Concluída' ");
	$res->bindValue(":valor_recebido", $valor_recebido);
	$res->bindValue(":desconto", $desconto);
	$res->bindValue(":valor", $total_compra);
	$res->bindValue(":usuario", $id_usuario);
	$res->bindValue(":troco", $troco);
	$res->bindValue(":forma_pgto", $forma_pgto_input);
	$res->bindValue(":abertura", $id_abertura);
	$res->execute();
	$id_venda = $pdo->lastInsertId();

	//RELACIONAR OS ITENS DA VENDA COM A NOVA VENDA
	$query_con = $pdo->query("UPDATE itens_venda SET venda = '$id_venda' WHERE usuario = '$id_usuario' and venda = 0");

	echo 'Venda Salva!&-/z'.$id_venda;
	exit();
}

$troco = 0;
$trocoF = 0;

if($desconto == ""){
	$desconto = 0;
}



$query_con = $pdo->query("SELECT * FROM produtos WHERE codigo = '$codigo'");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$estoque = $res[0]['estoque'];
	$nome = $res[0]['nome'];
	$descricao = $res[0]['descricao'];
	$imagem = $res[0]['foto'];
	$valor = $res[0]['valor_venda'];
	$id = $res[0]['id'];

	if($estoque < $quantidade){
		echo 'Quantidade em Estoque Insuficiente!&-/z Por enquanto temos '.$estoque .' Produtos em Estoque';
		exit();
	}

	$valor_total = $valor * $quantidade;
	$valor_totalF =  number_format($valor_total, 2, ',', '.');


	//INSERIR NA TABELA ITENS VENDAS
	$res = $pdo->prepare("INSERT INTO itens_venda SET produto = :produto, valor_unitario = :valor, usuario = :usuario, venda = '0', quantidade = :quantidade, valor_total = :valor_total, data = curDate()");
	$res->bindValue(":produto", $id);
	$res->bindValue(":valor", $valor);
	$res->bindValue(":usuario", $id_usuario);
	$res->bindValue(":quantidade", $quantidade);
	$res->bindValue(":valor_total", $valor_total);
	
	$res->execute();


	//ABATER OS PRODUTOS DO ESTOQUE
	$novo_estoque = $estoque - $quantidade;
	$res = $pdo->prepare("UPDATE produtos SET estoque = :estoque WHERE id = '$id'");
	$res->bindValue(":estoque", $novo_estoque);
	$res->execute();



}




//TOTALIZAR A VENDA

$total_venda = 0;
$query_con = $pdo->query("SELECT * FROM itens_venda WHERE usuario = '$id_usuario' and venda = 0 order by id desc");
$res = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){ 
	for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){	}

		
		$valor_total_item = $res[$i]['valor_total'];
		
		$total_venda += $valor_total_item;
		
				
	}

	if($desconto_porcentagem == 'Sim'){
		$desconto = str_replace('%', '', $desconto);
		if($desconto < 10){
			$desconto = '0.0'.$desconto;
		}else{
			$desconto = '0.'.$desconto;
		}
		
		$total_venda = $total_venda -  ($total_venda * $desconto);
	}else{
		$total_venda = $total_venda - $desconto;
	}
	
	$total_vendaF =  number_format($total_venda, 2, ',', '.');

	if($valor_recebido == ""){
		$valor_recebido = 0;
	}else{
		$troco = $valor_recebido - $total_venda;
		$trocoF =  number_format($troco, 2, ',', '.');
	}	

	
		
}


$dados = $novo_estoque .'&-/z'. $nome .'&-/z'. $descricao .'&-/z'. $imagem .'&-/z'. $valor .'&-/z'. $valor_total .'&-/z'. $valor_totalF .'&-/z'. $total_venda .'&-/z'. $total_vendaF .'&-/z'. $troco .'&-/z'. $trocoF;
	echo $dados;




 ?>
