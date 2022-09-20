<?php 
$pag = 'usuarios';
@session_start();

require_once('../conexao.php');
require_once('verificar-permissao.php')

?>

<a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" type="button" class="btn btn-secondary mt-2">Novo Usuário</a>

<div class="mt-4" style="margin-right:25px">
	<?php 
	$query = $pdo->query("SELECT * from usuarios order by id desc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){ 
		?>
		<small>
			<table id="example" class="table table-hover my-4" style="width:100%">
				<thead>
					<tr>
						<th>Nome</th>
						<th>CPF</th>
						<th>Email</th>
						<th>Senha</th>
						<th>Nível</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>

					<?php 
					for($i=0; $i < $total_reg; $i++){
						foreach ($res[$i] as $key => $value){	}
							?>

						<tr>
							<td><?php echo $res[$i]['nome'] ?></td>
							<td><?php echo $res[$i]['cpf'] ?></td>
							<td><?php echo $res[$i]['email'] ?></td>
							<td><?php echo $res[$i]['senha'] ?></td>
							<td><?php echo $res[$i]['nivel'] ?></td>
							<td>
								<a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $res[$i]['id'] ?>" title="Editar Registro">

									 <i class="bi bi-pencil-square text-primary"></i>
									

								</a>

								<a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $res[$i]['id'] ?>" title="Excluir Registro">
									<i class="bi bi-archive text-danger mx-3"></i>
								</a>
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


<?php 
if(@$_GET['funcao'] == "editar"){
	$titulo_modal = 'Editar Registro';
	$query = $pdo->query("SELECT * from usuarios where id = '$_GET[id]'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){ 
		$nome = $res[0]['nome'];
		$email = $res[0]['email'];
		$cpf = $res[0]['cpf'];
		$senha = $res[0]['senha'];
		$nivel = $res[0]['nivel'];

	}
}else{
	$titulo_modal = 'Inserir Registro';
}
?>



<div class="modal fade" tabindex="-1" id="modalCadastrar" data-bs-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $titulo_modal ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST" id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required="" value="<?php echo @$nome ?>">
							</div> 
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">CPF</label>
								<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" required="" value="<?php echo @$cpf ?>">
							</div>  
						</div>
					</div>



					

					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" required="" value="<?php echo @$email ?>">
					</div>  

					<div class="mb-3">
						<label for="exampleFormControlInput1"  class="form-label">Senha</label>
						<input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" required="" value="<?php echo @$senha ?>">
					</div>  

					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Nível</label>
						<select class="form-select mt-1" aria-label="Default select example" name="nivel">
							
							<option <?php if(@$nivel == 'Operador'){ ?> selected <?php } ?>  value="Operador">Operador</option>

							<option <?php if(@$nivel == 'Administrador'){ ?> selected <?php } ?>  value="Administrador">Administrador</option>
							
							<option <?php if(@$nivel == 'Tesoureiro'){ ?> selected <?php } ?>  value="Tesoureiro">Tesoureiro</option>

							
						</select>
					</div> 

					<small><div align="center" class="mt-1" id="mensagem">
						
					</div> </small>

				</div>
				<div class="modal-footer">
					<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button name="btn-salvar" id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>

					<input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

					<input name="antigo" type="hidden" value="<?php echo @$cpf ?>">
					<input name="antigo2" type="hidden" value="<?php echo @$email ?>">

				</div>
			</form>
		</div>
	</div>
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

					<p>Se Clicar em Sim o Registro sera Excluido?</p>

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
if(@$_GET['funcao'] == "novo"){ ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('modalCadastrar'), {
			backdrop: 'static'
		})

		myModal.show();
	</script>
<?php } ?>



<?php 
if(@$_GET['funcao'] == "editar"){ ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('modalCadastrar'), {
			backdrop: 'static'
		})

		myModal.show();
	</script>
<?php } ?>



<?php 
if(@$_GET['funcao'] == "deletar"){ ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('modalDeletar'), {
			
		})

		myModal.show();
	</script>
<?php } ?>





<script type="text/javascript">
	$("#form").submit(function () {
		var pag = "<?=$pag?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/inserir.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {

				$('#mensagem').removeClass()

				if (mensagem.trim() == "Salvo com Sucesso!") {

                  
                    $('#btn-fechar').click();
                    window.location = "index.php?pagina="+pag;

                } else {

                	$('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  
            	var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { 
                	myXhr.upload.addEventListener('progress', function () {
                		
                	}, false);
                }
                return myXhr;
            }
        });
	});
</script>




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

				if (mensagem.trim() == "Registro Excluido com Sucesso!") {

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


