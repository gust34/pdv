<?php 
$pag = 'categorias';
@session_start();

require_once('../conexao.php');
require_once('verificar-permissao.php')

?>

<a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" type="button" class="btn btn-secondary mt-2">Nova Categoria</a>

<div class="mt-4" style="margin-right:25px">
	<?php 
	$query = $pdo->query("SELECT * from categorias order by id desc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){ 
		?>
		<small>
			<table id="example" class="table table-hover my-4" style="width:100%">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Produtos</th>
						<th>Foto</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>

					<?php 
					for($i=0; $i < $total_reg; $i++){
						foreach ($res[$i] as $key => $value){	}

							$id_cat = $res[$i]['id'];
							$query_p = $pdo->query("SELECT * from produtos where categoria = '$id_cat'");
	$res_p = $query_p->fetchAll(PDO::FETCH_ASSOC);
	$produtos = @count($res_p);

							?>

						<tr>
							<td><?php echo $res[$i]['nome'] ?></td>

							<td><?php echo $produtos ?></td>
							
							<td><img src="../img/<?php echo $pag ?>/<?php echo $res[$i]['foto'] ?>" width="40"></td>
							<td>
								<a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $res[$i]['id'] ?>" title="Editar Registro">
									<i class="bi bi-pencil-square text-primary"></i>
								</a>

								<a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $res[$i]['id'] ?>" title="Excluir Registro">
									<i class="bi bi-archive text-danger mx-1"></i>
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
	$query = $pdo->query("SELECT * from categorias where id = '$_GET[id]'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){ 
		$nome = $res[0]['nome'];
		$foto = $res[0]['foto'];

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

					
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Nome</label>
						<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required="" value="<?php echo @$nome ?>">
					</div> 


					
						<div class="form-group">
							<label >Foto</label>
							<input type="file" value="<?php echo @$foto ?>"  class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
						</div>

						<div id="divImgConta" class="mt-4">
							<?php if(@$foto != ""){ ?>
								<img src="../img/<?php echo $pag ?>/<?php echo $foto ?>"  width="200px" id="target">
							<?php  }else{ ?>
								<img src="../img/<?php echo $pag ?>/sem-foto.jpg" width="200px" id="target">
							<?php } ?>
						</div>
					
					
				

				<small><div align="center" class="mt-1" id="mensagem">

				</div> </small>

			</div>
			<div class="modal-footer">
				<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
				<button name="btn-salvar" id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>

				<input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

				<input name="antigo" type="hidden" value="<?php echo @$nome ?>">
				

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




<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
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

                    //$('#nome').val('');
                    //$('#cpf').val('');
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
            xhr: function () {  // Custom XMLHttpRequest
            	var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                	myXhr.upload.addEventListener('progress', function () {
                		
                	}, false);
                }
                return myXhr;
            }
        });
	});
</script>




<!--AJAX  EXCLUIR DADOS -->
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






<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">

    function carregarImg() {

        var target = document.getElementById('target');
        var file = document.querySelector("input[type=file]").files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);


        } else {
            target.src = "";
        }
    }

</script>