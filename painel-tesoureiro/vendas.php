<?php 
$pag = 'vendas';
@session_start();

require_once('../conexao.php');
require_once('verificar-permissao.php')

?>



<div class="mt-4" style="margin-right:25px">
	<?php 
	$query = $pdo->query("SELECT * from vendas order by id desc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){ 
		?>
		<small>
			<table id="example" class="table table-hover my-4" style="width:100%">
				<thead>
					<tr>
						<th>Status</th>
						<th>Valor</th>
						<th>Data</th>
						<th>Hora</th>
						<th>Operador</th>
						<th>Pagamento</th>						
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>

					<?php 
					for($i=0; $i < $total_reg; $i++){
						foreach ($res[$i] as $key => $value){	}

							$id_operador = $res[$i]['operador'];
						$tipo_pgto = $res[$i]['forma_pgto'];

						$data2 = implode('/', array_reverse(explode('-', $res[$i]['data'])));

						$total = number_format( $res[$i]['valor'] , 2, ',', '.');

						$res_2 = $pdo->query("SELECT * from forma_pgtos where codigo = '$tipo_pgto' ");
						$dados = $res_2->fetchAll(PDO::FETCH_ASSOC);
						$nome_pgto = $dados[0]['nome'];

						$res_2 = $pdo->query("SELECT * from usuarios where id = '$id_operador' ");
						$dados = $res_2->fetchAll(PDO::FETCH_ASSOC);
						$nome_operador = $dados[0]['nome'];


						if($res[$i]['status'] == 'Concluída'){
							$classe = 'text-success';
						}else{
							$classe = 'text-danger';
						}


						?>

						<tr>
							<td>
								<i class="bi bi-square-fill <?php echo $classe ?>"></i>
								<?php echo $res[$i]['status'] ?></td>
								<td>R$ <?php echo $total ?></td>
								<td><?php echo $data2 ?></td>
								<td><?php echo $res[$i]['hora'] ?></td>
								<td><?php echo $nome_operador ?></td>
								<td><?php echo $nome_pgto ?></td>


								<td>
									<a href="../painel-operador/comprovante_class.php?id=<?php echo $res[$i]['id'] ?>" title="Gerar Comprovante" target="_blank" style="text-decoration: none">
										<i class="bi bi-clipboard-check text-primary"></i>
									</a>

									<?php if($res[$i]['status'] == 'Concluída'){ ?>

									
								<?php } ?>
								</td>
							</tr>

						<?php } ?>

					</tbody>

				</table>
			</small>
		<?php }else{
			echo '<p>Não existem dados para serem exibidos!!';
		} ?>
	</div>




	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable({
				"ordering": false
			});
		} );
	</script>



