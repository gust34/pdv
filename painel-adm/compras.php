<?php 
$pag = 'compras';
@session_start();

require_once('../conexao.php');
require_once('verificar-permissao.php');

?>

<div class="mt-4" style="margin-right:25px">
	<?php 
	$query = $pdo->query("SELECT * from compras order by id desc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){ 
		?>
		<small>
			<table id="example" class="table table-hover my-4" style="width:100%">
				<thead>
					<tr>
						<th>Pago</th>
						<th>Total</th>
						<th>Data</th>
						<th>Gerente</th>
						<th>Fornecedor</th>
						<th>Tel Fornecedor</th>
						<th>Excluir</th>
					</tr>
				</thead>
				<tbody>

					<?php 
					for($i=0; $i < $total_reg; $i++){
						foreach ($res[$i] as $key => $value){	}


							//DADOS DO USUARIO
							$id_usu = $res[$i]['usuario'];
						$query_f = $pdo->query("SELECT * from usuarios where id = '$id_usu'");
						$res_f = $query_f->fetchAll(PDO::FETCH_ASSOC);
						$total_reg_f = @count($res_f);
						if($total_reg_f > 0){ 
							$nome_usuario = $res_f[0]['nome'];
							
						}


						//DADOS DO FORNECEDOR
						$id_forn = $res[$i]['fornecedor'];
						$query_f = $pdo->query("SELECT * from fornecedores where id = '$id_forn'");
						$res_f = $query_f->fetchAll(PDO::FETCH_ASSOC);
						$total_reg_f = @count($res_f);
						if($total_reg_f > 0){ 
							$nome_forn = $res_f[0]['nome'];
							$tel_forn = $res_f[0]['telefone'];
						}


						if($res[$i]['pago'] == 'Sim'){
							$classe = 'text-success';
						}else{
							$classe = 'text-danger';
						}

						?>

						<tr>
							<td>								<i class="bi bi-square-fill <?php echo $classe ?>"></i>
								</td>
							<td>R$ <?php echo number_format($res[$i]['total'], 2, ',', '.'); ?></td>

							<td><?php echo implode('/', array_reverse(explode('-', $res[$i]['data']))); ?></td>

							<td><?php echo $nome_usuario ?></td>

							<td><?php echo $nome_forn ?></td>
							
							<td><?php echo $tel_forn ?></td>

							<td>
								<?php if($res[$i]['pago'] != 'Sim'){ ?>

								<a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $res[$i]['id'] ?>" title="Excluir Registro" style="text-decoration: none">
									<i class="bi bi-archive text-danger mx-1"></i>
								</a>
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



<div class="modal fade" tabindex="-1" id="modalDeletar" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Excluir Registro</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST" id="form-excluir">
				<div class="modal-body">

					<p>Deseja Realmente Excluir o Registro?</p>

					<small><div align="center" class="mt-1" id="mensagem-excluir">
						
					</div> </small>

				</div>
				<div class="modal-footer">
					<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button name="btn-excluir" id="btn-excluir" type="submit" class="btn btn-danger">Excluir</button>

					<input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

				</div>
			</form>
		</div>
	</div>
</div>




<?php 
if(@$_GET['funcao'] == "deletar"){ ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('modalDeletar'), {
			
		})

		myModal.show();
	</script>
<?php } ?>




<!--AJAX PARA EXCLUIR DADOS -->
<script type="text/javascript">
	$("#form-excluir").submit(function () {
		var pag = "<?=$pag?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/excluir.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {

				$('#mensagem').removeClass()

				if (mensagem.trim() == "Excluído com Sucesso!") {

					$('#mensagem-excluir').addClass('text-success')

					$('#btn-fechar').click();
					window.location = "index.php?pagina="+pag;

				} else {

					$('#mensagem-excluir').addClass('text-danger')
				}

				$('#mensagem-excluir').text(mensagem)

			},

			cache: false,
			contentType: false,
			processData: false,

		});
	});
</script>






<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable({
			"ordering": false
		});
	} );
</script>




