<?php 
$pag = 'produtos';
@session_start();

require_once('../conexao.php');
require_once('verificar-permissao.php');

?>

<a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" type="button" class="btn btn-secondary mt-2">Novo Produto</a>

<div class="mt-4" style="margin-right:25px">
	<?php 
	$query = $pdo->query("SELECT * from produtos order by id desc");
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
						<th>Valor Compra</th>
						<th>Valor Venda</th>
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
							<td>R$ <?php echo number_format($res[$i]['valor_compra'], 2, ',', '.'); ?></td>
							<td>R$ <?php echo number_format($res[$i]['valor_venda'], 2, ',', '.'); ?></td>
							<td><?php echo $nome_forn ?></td>

							
							
							<td><img src="../img/<?php echo $pag ?>/<?php echo $res[$i]['foto'] ?>" width="40"></td>
							<td>
								<a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $res[$i]['id'] ?>" title="Editar Registro" style="text-decoration: none">
									<i class="bi bi-pencil-square text-primary"></i>
								</a>

								<a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $res[$i]['id'] ?>" title="Excluir Registro" style="text-decoration: none">
									<i class="bi bi-archive text-danger mx-1"></i>
								</a>

								<a href="#" onclick="mostrarDados('<?php echo $res[$i]['nome'] ?>', '<?php echo $res[$i]['descricao'] ?>', '<?php echo $res[$i]['foto'] ?>', '<?php echo $nome_cat ?>', '<?php echo $nome_forn ?>', '<?php echo $tel_forn ?>')" title="Ver Descriçao" style="text-decoration: none">
									<i class="bi bi-card-text text-dark mx-1"></i>
								</a>


								<a href="#" onclick="comprarProdutos('<?php echo $res[$i]['id'] ?>', '<?php echo $res[$i]['valor_venda'] ?>', '<?php echo $res[$i]['lucro'] ?>', '<?php echo $res[$i]['valor_compra'] ?>')" title="Comprar Produtos" style="text-decoration: none">
									<i class="bi bi-bag text-success mx-1"></i>
								</a>


								<a target="_blank" title="Gerar Etiquetas" href="../rel/barras_class.php?codigo=<?php echo $res[$i]['codigo'] ?>" style="text-decoration: none">
									<i class="bi bi-clipboard-check text-dark mx-1"></i>
								</a>


								<a target="_blank" title="Gerar Etiquetas com Valor" href="../rel/barras_valor_class.php?codigo=<?php echo $res[$i]['codigo'] ?>&valor=<?php echo $res[$i]['valor_venda'] ?>&nome=<?php echo $res[$i]['nome'] ?>" style="text-decoration: none">
									<i class="bi bi-clipboard-check text-danger mx-1"></i>
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
	$query = $pdo->query("SELECT * from produtos where id = '$_GET[id]'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){ 
		$nome = $res[0]['nome'];
		$codigo = $res[0]['codigo'];
		$categoria = $res[0]['categoria'];
		$fornecedor = $res[0]['fornecedor'];
		$descricao = $res[0]['descricao'];
		$estoque = $res[0]['estoque'];
		$valor_compra = $res[0]['valor_compra'];
		$valor_venda = $res[0]['valor_venda'];
		$foto = $res[0]['foto'];
		$estoque_min = $res[0]['estoque_min'];

	}
}else{
	$titulo_modal = 'Inserir Registro';
}
?>


<div class="modal fade" tabindex="-1" id="modalCadastrar" data-bs-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $titulo_modal ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST" id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-3">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Código</label>
								<input type="number" class="form-control" id="codigo" name="codigo" placeholder="Código" required="" value="<?php echo @$codigo ?>">
							</div> 

						</div>
						<div class="col-md-3">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required="" value="<?php echo @$nome ?>">
							</div> 
						</div>
						<div class="col-md-3">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Valor Venda</label>
								<input type="text" class="form-control" id="valor_venda" name="valor_venda" placeholder="Valor Venda" required="" value="<?php echo @$valor_venda ?>">
							</div> 
						</div>

						<div class="col-md-3">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Estoque Mínimo</label>
								<input type="number" class="form-control" id="estoque_min" name="estoque_min" placeholder="Estoque Mínimo" required="" value="<?php echo @$estoque_min ?>">
							</div> 
						</div>
					</div>

					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Descrição do Produto</label>
						<textarea type="text" class="form-control" id="descricao" name="descricao" maxlength="200"><?php echo @$descricao ?></textarea>
					</div> 
					
					
					<div class="row">
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Categoria</label>
								<select class="form-select mt-1" aria-label="Default select example" name="categoria">
									<?php 
									$query = $pdo->query("SELECT * from categorias order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if($total_reg > 0){ 

										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){	}
												?>

											<option <?php if(@$categoria == $res[$i]['id']){ ?> selected <?php } ?>  value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

										<?php }

									}else{ 
										echo '<option value="">Cadastre uma Categoria</option>';

									} ?>
									

								</select>
							</div> 
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label >Foto</label>
								<input type="file" value="<?php echo @$foto ?>"  class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
							</div>

							

						</div>

						<div class="col-md-4">
							<div id="divImgConta" class="mt-4">
								<?php if(@$foto != ""){ ?>
									<img src="../img/<?php echo $pag ?>/<?php echo $foto ?>"  width="150px" id="target">
								<?php  }else{ ?>
									<img src="../img/<?php echo $pag ?>/sem-foto.jpg" width="150px" id="target">
								<?php } ?>
							</div>
						</div>
					</div>
					
					
					<div id="codigoBarra"></div>


					<small><div align="center" class="mt-1" id="mensagem">

					</div> </small>

				</div>
				<div class="modal-footer">
					<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button name="btn-salvar" id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>

					<input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

					<input name="antigo" type="hidden" value="<?php echo @$nome ?>">

					<input name="antigo2" type="hidden" value="<?php echo @$codigo ?>">


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
								<input type="text" class="form-control" id="valor_compra" name="valor_compra" placeholder="Valor Compra" required="" onkeyup="calcularLucro()">
							</div> 
							
						</div>
						<div class="col-6">
							
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Quantidade</label>
								<input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade" required="" >
							</div> 
							
						</div>
					</div>


					<div class="row">
						<div class="col-6">
							
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">% Lucro</label>
								<input type="text" class="form-control" id="lucro" name="lucro" placeholder="Somente o valor, sem %"  onkeyup="calcularLucro()">
							</div> 
							
						</div>
						<div class="col-6">
							
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Valor Venda</label>
								<input type="text" class="form-control" id="valor_v" name="valor_venda" placeholder="Valor da Venda" required="" >
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
                		/* faz alguma coisa durante o progresso do upload */
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
	function comprarProdutos(id, valor, lucro, valor_compra){
		event.preventDefault();

		console.log(valor)

		$('#id-comprar').val(id);
		$('#valor_v').val(valor);
		$('#lucro').val(lucro);
		$('#valor_compra').val(valor_compra);

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
                    window.location = "index.php?pagina="+pag;

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

<script type="text/javascript">
	function calcularLucro(){
		console.log('chamou')

		valor_compra = $("#valor_compra").val();
		lucro = $("#lucro").val();

		valor_compra = valor_compra.replace(",",".");
		lucro = lucro.replace("%","");
		
		total = (valor_compra * lucro / 100);
		total = parseFloat(total) + parseFloat(valor_compra);
		$("#valor_v").val(total)
		

	}
</script>