<?php 
require_once("../conexao.php"); 


setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));


$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];
$status = $_GET['status'];

$status_like = '%'.$status.'%';

$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));

if($status == 'Sim'){
	$status_serv = 'Pagas ';
}else if($status == 'Não'){
	$status_serv = 'Pendentes';

}else{
	$status_serv = '';
}


if($dataInicial != $dataFinal){
	$apuracao = $dataInicialF. ' até '. $dataFinalF;
}else{
	$apuracao = $dataInicialF;
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Relatório de Contas Pagar</title>
	<link rel="shortcut icon" href="../img/favicon.ico" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<style>

		@page {
			margin: 0px;

		}

		.footer {
			margin-top:20px;
			width:100%;
			background-color: #ebebeb;
			padding:10px;
			position:absolute;
			bottom:0;
		}

		.cabecalho-topo {    
			background-color: #ebebeb;
			padding:10px;
			margin-bottom:30px;
			width:100%;
			height:100px;
		}

		.cabecalho {    
			padding:10px;
			margin-bottom:30px;
			width:100%;
			font-family:Times, "Times New Roman", Georgia, serif;
		}

		.titulo{
			margin:0;
			font-size:28px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.subtitulo{
			margin:0;
			font-size:12px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;
		}

		.areaTotais{
			border : 0.5px solid #bcbcbc;
			padding: 15px;
			border-radius: 5px;
			margin-right:25px;
			margin-left:25px;
			position:absolute;
			right:20;
		}

		.areaTotal{
			border : 0.5px solid #bcbcbc;
			padding: 15px;
			border-radius: 5px;
			margin-right:25px;
			margin-left:25px;
			background-color: #f9f9f9;
			margin-top:2px;
		}

		.pgto{
			margin:1px;
		}

		.fonte13{
			font-size:13px;
		}

		.esquerda{
			display:inline;
			width:50%;
			float:left;
		}

		.direita{
			display:inline;
			width:50%;
			float:right;
		}

		.table{
			padding:15px;
			font-family:Verdana, sans-serif;
			margin-top:20px;
		}

		.texto-tabela{
			font-size:12px;
		}


		.esquerda_float{

			margin-bottom:10px;
			float:left;
			display:inline;
		}


		.titulos{
			margin-top:10px;
		}

		.image{
			margin-top:-10px;
		}

		.margem-direita{
			margin-right: 80px;
		}

		.margem-direita50{
			margin-right: 50px;
		}

		hr{
			margin:8px;
			padding:1px;
		}


		.titulorel{
			margin:0;
			font-size:25px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.margem-superior{
			margin-top:30px;
		}

		.areaSubtituloCab{
			margin-top:15px;
			margin-bottom:15px;
		}


		.area-cab{
			
			display:block;
			width:100%;
			height:10px;

		}

		
		.coluna{
			margin: 0px;
			float:left;
			height:30px;
		}

		.area-tab{
			
			display:block;
			width:100%;
			height:30px;

		}


	</style>



</head>
<body>


	<?php if($cabecalho_img_rel == 'Sim'){ ?>

		<div class="img-cabecalho my-4">
			<img src="<?php echo $url_sistema ?>img/topo-relatorio.jpg" width="100%">
		</div>

	<?php }else{ ?>


		<div class="cabecalho">
			
			<div class="row titulos">
				<div class="col-sm-2 esquerda_float image">	
					<img src="<?php echo $url_sistema ?>img/logo.jpg" width="90px">
				</div>
				<div class="col-sm-10 esquerda_float">	
					<h2 class="titulo"><b><?php echo strtoupper($nome_sistema) ?></b></h2>

					<div class="areaSubtituloCab">
						<h6 class="subtitulo"><?php echo $endereco_sistema . ' Tel: '.$telefone_sistema  ?></h6>

						<p class="subtitulo"><?php echo $data_hoje ?></p>
					</div>

				</div>
			</div>
			
		</div>


	<?php } ?>


	<div class="container">

		
		<div align="center" class="">	
			<span class="titulorel">Contas à Pagar <?php echo $status_serv  ?> </span>
		</div>


		<hr>



		<div class="mx-2" style="padding-top:15px ">

			<small><small>
				<section class="area-tab" style="background-color: #f5f5f5;">
					
					<div class="linha-cab" style="padding-top: 5px;">
						<div class="coluna" style="width:10%">PAGO</div>
						<div class="coluna" style="width:25%">DESCRIÇÃO</div>
						<div class="coluna" style="width:15%">VALOR</div>
						<div class="coluna" style="width:20%">USUÁRIO</div>
						<div class="coluna" style="width:10%">DATA</div>
						<div class="coluna" style="width:10%">VENCIMENTO</div>
						

					</div>
					
				</section><small></small>

				<div class="cabecalho mb-1" style="border-bottom: solid 1px #e3e3e3;">
				</div>
<?php 
				$saldo = 0;			
				$query = $pdo->query("SELECT * FROM contas_pagar where data >= '$dataInicial' and data <= '$dataFinal' and pago LIKE '$status_like' order by data asc");
				$res = $query->fetchAll(PDO::FETCH_ASSOC);
				$totalItens = @count($res);

				for ($i=0; $i < @count($res); $i++) { 
					foreach ($res[$i] as $key => $value) {
					}

					$usuario = $res[$i]['usuario'];
					$pago = $res[$i]['pago'];
					$total = $res[$i]['valor'];
					$data = $res[$i]['data'];
					$vencimento = $res[$i]['vencimento'];		

					$id = $res[$i]['id'];

					$saldo = $saldo + $total;
					$saldoF = number_format($saldo, 2, ',', '.');

					$total = number_format($total, 2, ',', '.');
					$data = implode('/', array_reverse(explode('-', $data)));

					$vencimento = implode('/', array_reverse(explode('-', $vencimento)));


					$query_usu = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
					$res_usu = $query_usu->fetchAll(PDO::FETCH_ASSOC);
					$nome_usu = $res_usu[0]['nome'];




					if($pago == 'Sim'){
						$foto = 'verde.jpg';
					}else{
						$foto = 'vermelho.jpg';
					}
					?>


				<section class="area-tab" style="padding-top:5px">					
					<div class="linha-cab">				
						<div class="coluna" style="width:10%"><img src="<?php echo $url_sistema ?>img/<?php echo $foto ?>" width="13px"></div>
						<div class="coluna" style="width:25%"><?php echo $res[$i]['descricao'] ?></div>
						<div class="coluna" style="width:15%">R$ <?php echo number_format($res[$i]['valor'], 2, ',', '.'); ?></div>				
						<div class="coluna" style="width:20%"><?php echo $nome_usu ?></div>
						<div class="coluna" style="width:10%"><?php echo $data ?></div>
						<div class="coluna" style="width:10%"><?php echo $vencimento ?></div>			
									

					</div>
				</section>

				
			<div class="cabecalho" style="border-bottom: solid 1px #e3e3e3;">
				</div>

			<?php } ?>

			</small>



		</div>


		<div class="cabecalho mt-3" style="border-bottom: solid 1px #0340a3">
		</div>


		<br>
		<div class="col-md-12 p-2">
			<div class="" align="right">
				<span class="mx-4"><small><b> Período da Apuração </b> <span> <?php echo $apuracao ?></span></small> </span>  

				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

				

				<span class="mx-4"><small><b> Total de Vendas R$  <?php echo $saldoF ?></small> </span> 
			</div>
		</div>

				


		

		<hr>


	</div>


	<div class="footer">
		<p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p> 
	</div>




</body>
</html>
