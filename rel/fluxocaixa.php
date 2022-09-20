<?php 
require_once("../conexao.php"); 

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));


$id = $_GET['id'];




$query = $pdo->query("SELECT * from caixa where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$id_operador = $res[0]['operador'];
$id_caixa = $res[0]['caixa'];
$status = $res[0]['status'];

$data_ab = $res[0]['data_ab'];
$hora_ab = $res[0]['hora_ab'];
$id_gerente_ab = $res[0]['gerente_ab'];
$valor_ab = $res[0]['valor_ab'];
$valor_sangria = $res[0]['valor_sangrias'];

$data_fec = $res[0]['data_fec'];
$hora_fec = $res[0]['hora_fec'];
$id_gerente_fec = $res[0]['gerente_fec'];
$valor_fec = $res[0]['valor_fec'];

$data2 = implode('/', array_reverse(explode('-', $res[0]['data_ab'])));
$data_ab = implode('/', array_reverse(explode('-', $data_ab)));
$data_fec = implode('/', array_reverse(explode('-', $data_fec)));

$valor_quebra = number_format( $res[0]['valor_quebra'] , 2, ',', '.');
$total_vendido = number_format( $res[0]['valor_vendido'] , 2, ',', '.');
$valor_ab = number_format( $valor_ab , 2, ',', '.');
$valor_fec = number_format( $valor_fec , 2, ',', '.');



$res_2 = $pdo->query("SELECT * from usuarios where id = '$id_operador' ");
$dados = $res_2->fetchAll(PDO::FETCH_ASSOC);
$nome_operador = $dados[0]['nome'];


$res_2 = $pdo->query("SELECT * from caixas where id = '$id_caixa' ");
$dados = $res_2->fetchAll(PDO::FETCH_ASSOC);
$nome_caixa = $dados[0]['nome'];


$res_2 = $pdo->query("SELECT * from usuarios where id = '$id_gerente_ab' ");
$dados = $res_2->fetchAll(PDO::FETCH_ASSOC);
$gerente_ab = $dados[0]['nome'];

$res_2 = $pdo->query("SELECT * from usuarios where id = '$id_gerente_fec' ");
$dados = $res_2->fetchAll(PDO::FETCH_ASSOC);
@$gerente_fec = @$dados[0]['nome'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Fluxo de Caixa</title>
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
			<span class="titulorel">Fluxo de Caixa - <?php echo $status ?> </span>
		</div>


		<hr>


		<small><small>
			<div class="row">
				<div class="col-sm-6 esquerda">	
					<span class=""> <b> Caixa : </b> <span class=""><?php echo $nome_caixa ?></span> </span>

					<span class=""> <b> Operador : </b> <span class=""><?php echo $nome_operador ?></span> </span>

					
				</div>
				<div class="col-sm-6 direita" align="right">

				<span class=""> <b>Valor Quebra : </b> <span class="text-danger">R$ <?php echo $valor_quebra ?></span> </span>

				<span class=""> <b>Sangrias : </b> <span class="text-success">R$ <?php echo $valor_sangria ?></span> </span>

					<span class=""> <b> Total Vendido :</b><span class="<?php echo $classeSaldo ?>"> R$ <?php echo $total_vendido ?></span>  </span>
				</div>
			</div>
		</small></small>

		<hr>


		<small><small>
			<div class="row">
				<div class="col-sm-6 esquerda">	
					<span class=""> <b> Data Abertura : </b> <span class=""><?php echo $data_ab ?></span> </span>

					<span class=""> <b> Hora Abertura : </b> <span class=""><?php echo $hora_ab ?></span> </span>

					
				</div>
				<div class="col-sm-6 direita" align="right">

				<span class=""> <b>Gerente Abertura : </b> <span ><?php echo $gerente_ab ?></span> </span>	
					<span class=""> <b> Valor Abertura :</b><span class=""> R$ <?php echo $valor_ab ?></span>  </span>
				</div>
			</div>
		</small></small>

		<hr>


		<small><small>
			<div class="row">
				<div class="col-sm-6 esquerda">	
					<span class=""> <b> Data Fechamento : </b> <span class=""><?php echo $data_fec ?></span> </span>

					<span class=""> <b> Hora Fechamento : </b> <span class=""><?php echo $hora_fec ?></span> </span>

					
				</div>
				<div class="col-sm-6 direita" align="right">

				<span class=""> <b>Gerente Fechamento : </b> <span ><?php echo $gerente_fec ?></span> </span>	
					<span class=""> <b> Valor Fechamento :</b><span class=""> R$ <?php echo $valor_fec ?></span>  </span>
				</div>
			</div>
		</small></small>

		<hr>




		<div class="mx-2" style="padding-top:15px ">

			<small><small>
				<section class="area-tab" style="background-color: #f5f5f5;">
					
					<div class="linha-cab" style="padding-top: 5px;">
						<div class="coluna" style="width:20%">STATUS</div>
						<div class="coluna" style="width:20%">VALOR</div>
						<div class="coluna" style="width:20%">DATA</div>
						<div class="coluna" style="width:15%">HORA</div>
						<div class="coluna" style="width:25%">PAGAMENTO</div>
												

					</div>
					
				</section><small></small>

				<div class="cabecalho mb-1" style="border-bottom: solid 1px #e3e3e3;">
				</div>
				<?php 
				
			$query = $pdo->query("SELECT * from vendas where abertura = '$id' order by id asc");
			$res = $query->fetchAll(PDO::FETCH_ASSOC);
			$totalItens = @count($res);

			for ($i=0; $i < @count($res); $i++) { 
				foreach ($res[$i] as $key => $value) {
				}

				$tipo_pgto = $res[$i]['forma_pgto'];

						$data2 = implode('/', array_reverse(explode('-', $res[$i]['data'])));

						$total = number_format( $res[$i]['valor'] , 2, ',', '.');

						$res_2 = $pdo->query("SELECT * from forma_pgtos where codigo = '$tipo_pgto' ");
						$dados = $res_2->fetchAll(PDO::FETCH_ASSOC);
						$nome_pgto = $dados[0]['nome'];




					if($res[$i]['status'] == 'Concluída'){
					$foto = 'verde.jpg';
					
				}else{
					$foto = 'vermelho.jpg';
					
				}
				?>


				<section class="area-tab" style="padding-top:5px">					
					<div class="linha-cab">				
						<div class="coluna" style="width:20%"><img src="<?php echo $url_sistema ?>img/<?php echo $foto ?>" width="13px"> <?php echo $res[$i]['status'] ?> </div>
						<div class="coluna" style="width:20%">R$ <?php echo $total ?></div>
						<div class="coluna" style="width:20%"><?php echo $data2 ?></div>				
						<div class="coluna" style="width:15%"><?php echo $res[$i]['hora']  ?></div>
						<div class="coluna" style="width:25%"><?php echo $nome_pgto ?></div>
							
									

					</div>
				</section>

				
			<div class="cabecalho" style="border-bottom: solid 1px #e3e3e3;">
				</div>

			<?php } ?>

			</small>



		</div>


		<div class="cabecalho mt-3" style="border-bottom: solid 1px #0340a3">
		</div>

		


	</div>


	<div class="footer">
		<p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p> 
	</div>




</body>
</html>
