<?php 
require_once("../conexao.php"); 

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));


$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];

$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));


if($dataInicial != $dataFinal){
	$apuracao = $dataInicialF. ' até '. $dataFinalF;
}else{
	$apuracao = $dataInicialF;
}



//TOTAL DE QUEBRAS
$totalQuebra = 0;
$totalQuebraF = 0;
$entradas = 0;
$saidas = 0;		
$query = $pdo->query("SELECT * FROM caixa where data_fec >= '$dataInicial' and data_fec <= '$dataFinal' and valor_quebra != 0 order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalItens = @count($res);
if($totalItens > 0){
for ($i=0; $i < @count($res); $i++) { 
	foreach ($res[$i] as $key => $value) {
	}

	if($res[$i]['valor_quebra'] > 0){
		$entradas += $res[$i]['valor_quebra'];
	}else{
		$saidas += $res[$i]['valor_quebra'];
	}

	$totalQuebra = $entradas + $saidas;
	$totalQuebraF = number_format($totalQuebra, 2, ',', '.');

	if($totalQuebra >= 0){
		$classe_quebra = 'text-success';
	}else{
		$classe_quebra = 'text-danger';
	}

}
}



//TOTAL DE CONTAS A PAGAR
$totalpagar = 0;
$totalpagarF = 0;		
$query = $pdo->query("SELECT * FROM contas_pagar where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and pago = 'Sim' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalItens = @count($res);
if($totalItens > 0){
for ($i=0; $i < @count($res); $i++) { 
	foreach ($res[$i] as $key => $value) {
	}

	$totalpagar += $res[$i]['valor'];
	$totalpagarF = number_format($totalpagar, 2, ',', '.');

}
}



//TOTAL DE CONTAS A PAGAR
$totalreceber = 0;
$totalreceberF = 0;		
$query = $pdo->query("SELECT * FROM contas_receber where data_pgto >= '$dataInicial' and data_pgto <= '$dataFinal' and pago = 'Sim' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalItens = @count($res);
if($totalItens > 0){
for ($i=0; $i < @count($res); $i++) { 
	foreach ($res[$i] as $key => $value) {
	}

	$totalreceber += $res[$i]['valor'];
	$totalreceberF = number_format($totalreceber, 2, ',', '.');

}
}



//TOTAL DE VENDAS
$totalvendas = 0;
$totalvendasF = 0;		
$query = $pdo->query("SELECT * FROM vendas where data >= '$dataInicial' and data <= '$dataFinal' and status = 'Concluída' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalItens = @count($res);
if($totalItens > 0){
for ($i=0; $i < @count($res); $i++) { 
	foreach ($res[$i] as $key => $value) {
	}

	$totalvendas += $res[$i]['valor'];
	$totalvendasF = number_format($totalvendas, 2, ',', '.');

}
}


$total_lucro = $totalvendas + $totalQuebra + $totalreceber - $totalpagar;
$total_lucroF = number_format($total_lucro, 2, ',', '.');

if($total_lucro >= 0){
		$classe_lucro = 'text-success';
	}else{
		$classe_lucro = 'text-danger';
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Relatório de Lucro</title>
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

		.divTitulo{
			padding:15px 0px;
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


					</div>

				</div>
			</div>

		</div>

	<?php } ?>

	<div class="container">

		
		<div align="center" class="divTitulo">	
			<span class="titulorel"><small><small>RELATÓRIO DE LUCRO</small></small> </span>
		</div>


		<hr>


		<small>
			<div class="row">
				<div class="col-sm-6 esquerda">	
					<span class=""> <b> Total de Vendas : </b> <span class="text-success">R$ <?php echo $totalvendasF ?></span> </span>
					
				</div>
				<div class="col-sm-6 direita" align="right">
					
					<span class=""> <b> Contas à Receber :</b><span class="text-success"> R$ <?php echo $totalreceberF ?></span>  </span>
				</div>
			</div>
		</small>

		<hr>


		<small>
			<div class="row">
				<div class="col-sm-6 esquerda">	
					<span class=""> <b> Total de Quebras : </b> <span class="<?php echo @$classe_quebra ?>">R$ <?php echo $totalQuebraF ?></span> </span>
					
				</div>
				<div class="col-sm-6 direita" align="right">
					
					<span class=""> <b> Contas à Pagar :</b><span class="text-danger"> R$ <?php echo $totalpagarF ?></span>  </span>
				</div>
			</div>
		</small>

		<hr>


		
		<small>
			<div class="row">
				<div class="col-sm-6 esquerda">	
					<span class=""> <b> Período da Apuração </b> </span>
					<span class=""> <?php echo $apuracao ?> </span>
					
				</div>
				<div class="col-sm-6 direita" align="right">
					
					<big><span class=""> <b> Total Lucro :</b><span class="<?php echo @$classe_lucro ?>"><u> R$ <?php echo $total_lucroF ?></u></span>  </span></big>
				</div>
			</div>
		</small>

		<hr>




		<div class="cabecalho mt-3" style="border-bottom: solid 1px #0340a3">
		</div>

		


	</div>


	<div class="footer">
		<p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p> 
	</div>




</body>
</html>
