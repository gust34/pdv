<?php 
$pag = 'produtos';
@session_start();

require_once('../conexao.php');
require_once('verificar-permissao.php');



?>


<div class="mt-4" style="margin-right:25px">
	<?php 
	$query = $pdo->query("SELECT * from produtos where estoque < estoque_min");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){ 
		?>
		<small>
			<table id="example" class="table table-hover my-4" style="width:100%">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Código</th>
						<th>Estoque</th>
						<th>Estoque Mínimo</th>
						<th>Valor Compra</th>
						<th>Fornecedor</th>
						<th>Foto</th>
						<th>Ações</th>
						
					</tr>
				</thead>
				<tbody>

					<?php 
					for($i=0; $i < $total_reg; $i++){
						foreach ($res[$i] as $key => $value){	}

							$id_cat = $res[$i]['categoria'];
						$query_2 = $pdo->query("SELECT * from categorias where id = '$id_cat'");
						$res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);
						$nome_cat = $res_2[0]['nome'];


						//BUSCAR OS DADOS DO FORNECEDOR
						$id_forn = $res[$i]['fornecedor'];
						$query_f = $pdo->query("SELECT * from fornecedores where id = '$id_forn'");
						$res_f = $query_f->fetchAll(PDO::FETCH_ASSOC);
						$total_reg_f = @count($res_f);
						if($total_reg_f > 0){ 
							$nome_forn = $res_f[0]['nome'];
							$tel_forn = $res_f[0]['telefone'];
						}else{
							$nome_forn = '';
							$tel_forn = '';
						}

						?>

						<tr>
							<td><?php echo $res[$i]['nome'] ?></td>
							<td><?php echo $res[$i]['codigo'] ?></td>
							<td><?php echo $res[$i]['estoque'] ?></td>
							<td><?php echo $res[$i]['estoque_min'] ?></td>
							<td>R$ <?php echo number_format($res[$i]['valor_compra'], 2, ',', '.'); ?></td>
						
							<td><?php echo $nome_forn ?></td>
							
							<td><img src="../img/<?php echo $pag ?>/<?php echo $res[$i]['foto'] ?>" width="40"></td>
							<td>
								
								<a href="#" onclick="mostrarDados('<?php echo $res[$i]['nome'] ?>', '<?php echo $res[$i]['descricao'] ?>', '<?php echo $res[$i]['foto'] ?>', '<?php echo $nome_cat ?>', '<?php echo $nome_forn ?>', '<?php echo $tel_forn ?>')" title="Ver Descriçao" style="text-decoration: none">
									<i class="bi bi-card-text text-dark mx-1"></i>
								</a>


								<a href="#" onclick="comprarProdutos('<?php echo $res[$i]['id'] ?>')" title="Comprar Produtos" style="text-decoration: none">
									<i class="bi bi-bag text-success mx-1"></i>
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




<div class="modal fade" tabindex="-1" id="modalDados" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><span id="nome-registro"></span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			
			<div class="modal-body mb-4">

				<b>Categoria: </b>
				<span id="categoria-registro"></span>
				<hr>
				
				<div id="div-forn">
					<span class="mr-4">
						<b>Fornecedor: </b>
						<span id="nome-forn-registro"></span>
					</span>
					
					<span class="mr-4">
						<b>Telefone: </b>
						<span id="tel-forn-registro"></span>
					</span>
					<hr>
				</div>


				
				<b>Descrição: </b>
				<span id="descricao-registro"></span>
				<hr>
				<img id="imagem-registro" src="" class="mt-4" width="200">
			</div> 

		</div>
	</div>
</div>






<div class="modal fade" tabindex="-1" id="modalComprar" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Fazer Pedido</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST" id="form-comprar">
				<div class="modal-body">

					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Fornecedor</label>
						<select class="form-select mt-1" aria-label="Default select example" name="fornecedor">
							<?php 
							$query = $pdo->query("SELECT * from fornecedores order by nome asc");
							$res = $query->fetchAll(PDO::FETCH_ASSOC);
							$total_reg = @count($res);
							if($total_reg > 0){ 

								for($i=0; $i < $total_reg; $i++){
									foreach ($res[$i] as $key => $value){	}
										?>

									<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

								<?php }

							}else{ 
								echo '<option value="">Cadastre um Fornecedor</option>';

							} ?>


						</select>
					</div> 


					<div class="row">
						<div class="col-6">
							
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Valor Compra</label>
								<input type="text" class="form-control" id="valor_compra" name="valor_compra" placeholder="Valor Compra" required="">
							</div> 
							
						</div>
						<div class="col-6">
							
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Quantidade</label>
								<input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade" required="" >
							</div> 
							
						</div>
					</div>

					<small><div align="center" class="mt-1" id="mensagem-comprar">
						
					</div> </small>

				</div>
				<div class="modal-footer">
					<button type="button" id="btn-fechar-comprar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button name="btn-salvar-comprar" id="btn-salvar-comprar" type="submit" class="btn btn-success">Salvar</button>

					<input name="id-comprar" id="id-comprar" type="hidden">

				</div>
			</form>
		</div>
	</div>
</div>







<script type="text/javascript">
	$(document).ready(function() {
		gerarCodigo();
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




<script type="text/javascript">
	function mostrarDados(nome, descricao, foto, categoria, nome_forn, tel_forn){
		event.preventDefault();

		if(nome_forn.trim() === ""){
			document.getElementById("div-forn").style.display = 'none';
		}else{
			document.getElementById("div-forn").style.display = 'block';
		}

		$('#nome-registro').text(nome);
		$('#categoria-registro').text(categoria);
		$('#descricao-registro').text(descricao);
		$('#nome-forn-registro').text(nome_forn);
		$('#tel-forn-registro').text(tel_forn);
		
		$('#imagem-registro').attr('src', '../img/produtos/' + foto);


		var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {
			
		})

		myModal.show();
	}
</script>







<!--AJAX PARA EXCLUIR DADOS -->
<script type="text/javascript">
	$("#codigo").keyup(function () {
		gerarCodigo();
	});
</script>


<script type="text/javascript">
	var pag = "<?=$pag?>";
	function gerarCodigo(){
		$.ajax({
			url: pag + "/barras.php",
			method: 'POST',
			data: $('#form').serialize(),
			dataType: "html",

			success:function(result){
				$("#codigoBarra").html(result);
			}
		});
	}
</script>



<script type="text/javascript">
	function comprarProdutos(id){
		event.preventDefault();

		$('#id-comprar').val(id);

		var myModal = new bootstrap.Modal(document.getElementById('modalComprar'), {
			
		})
		myModal.show();
	}
</script>







<!--AJAX PARA COMPRAR PRODUTO -->
<script type="text/javascript">
	$("#form-comprar").submit(function () {
		var pag = "<?=$pag?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/comprar-produto.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {

				$('#mensagem-comprar').removeClass()

				if (mensagem.trim() == "Salvo com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pagina=estoque";

                } else {

                	$('#mensagem-comprar').addClass('text-danger')
                }

                $('#mensagem-comprar').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
            	var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                	myXhr.upload.addEventListener('progress', function () {
                		/* faz alguma coisa durante o progresso do upload */
                	}, false);
                }
                return myXhr;
            }
        });
	});
</script>