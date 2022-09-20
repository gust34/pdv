<?php 
require_once("../../conexao.php");

$id = $_POST['id'];


$query_con = $pdo->query("UPDATE vendas SET status = 'Cancelada' WHERE id = '$id'");

//EXCLUIR TODOS OS ITENS DA VENDA E DEVOLVELOS AO ESTOQUE
$res = $pdo->query("SELECT * from itens_venda where venda = '$id'");
		$dados = $res->fetchAll(PDO::FETCH_ASSOC);
		$novo_estoque = 0;		
		for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {
			}

			$id_produto = $dados[$i]['produto']; 
			$quantidade = $dados[$i]['quantidade'];
			$id_item_venda = $dados[$i]['id'];

			$res_2 = $pdo->query("SELECT * from produtos where id = '$id_produto' ");
			$dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC);
			$estoque = $dados_2[0]['estoque'];
			$novo_estoque = $estoque + $quantidade;

			$res_2 = $pdo->query("UPDATE produtos SET estoque = '$novo_estoque' where id = '$id_produto' ");

			$res_2 = $pdo->query("DELETE FROM itens_venda  where id = '$id_item_venda' ");
		
			
}

echo 'Excluído com Sucesso!';

 ?>