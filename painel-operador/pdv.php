<?php 

@session_start();
$id_usuario = $_SESSION['id_usuario'];
require_once('../conexao.php');
require_once('verificar-permissao.php');

$pag = 'pdv';

//VERIFICAR SE O CAIXA ESTÁ ABERTO
$query = $pdo->query("SELECT * from caixa where operador = '$id_usuario' and status = 'Aberto' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){ 
  echo "<script language='javascript'>window.location='index.php'</script>";
}

if($desconto_porcentagem == 'Sim'){
  $desc = '%';
}else{
  $desc = 'R$';
}

?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="pt-br">
<head>
  <title><?php echo $nome_sistema ?></title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="../vendor/css/telapdv.css">

  <link rel="shortcut icon" href="../img/favicon.ico" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">


</head>
<body>


  <div class='checkout'>
    <div class="row">
      <div class="col-md-5 col-sm-12">
        <div class='order py-2'>
          <p class="background">LISTA DE PRODUTOS</p>

          <span id="listar">

          </span>

          


        </div>
      </div>

      

      <div id='payment' class='payment col-md-7'>
        <form method="post" id="form-buscar">
          <div class="row py-2">
            <div class="col-md-7">

              <p class="background">CÓDIGO DE BARRAS - USE LEITOR OU DIGITE</p>
              <input type="text" class="form-control form-control-lg" id="codigo" name="codigo" placeholder="Código de Barras" >

              <p class="background mt-3">PRODUTO</p>
              <input type="text" class="form-control  form-control-md" id="produto" name="produto" placeholder="Produto"  >

              <p class="background mt-3">DESCRIÇÃO</p>
              <input type="text" class="form-control  form-control-md" id="descricao" name="descricao" placeholder="Descrição do Produto"  >

              <div class="row">
                <div class="col-6">
                  <p class="background mt-3">QUANTIDADE</p>
                  <input type="text" class="form-control  form-control-md" id="quantidade" name="quantidade" placeholder="Quantidade"  >

                  <p class="background mt-1">VALOR UNITÁRIO</p>
                  <input type="text" class="form-control  form-control-md" id="valor_unitario" name="valor_unitario" placeholder="Valor"  >

                  <p class="background mt-1">ESTOQUE DISPONIVEL</p>
                  <input type="text" class="form-control  form-control-md" id="estoque" name="estoque" placeholder="Estoque"  >
                </div>

                <div class="col-6 mt-4">
                  <img id="imagem" src="" width="100%">
                </div>
              </div>



            </div>

            <div class="col-md-5">

              <p class="background">TOTAL DO ITEM</p>
              <input type="text" class="form-control form-control-md" id="total_item" name="total_item" placeholder="Código de Barras"  >


              <p class="background mt-3">SUB TOTAL</p>
              <input type="text" class="form-control  form-control-md" id="sub_total_item" name="sub_total" placeholder="Sub Total"  >

              <p class="background mt-3">DESCONTO EM <?php echo $desc ?></p>
              <input type="text" class="form-control  form-control-md" id="desconto" name="desconto" placeholder="Desconto em <?php echo $desc ?>" >


              <p class="background mt-3">TOTAL COMPRA</p>
              <input type="text" class="form-control  form-control-md" id="total_compra" name="total_compra" placeholder="Total da Compra" required="" >

              <p class="background mt-3">VALOR RECEBIDO</p>
              <input type="text" class="form-control  form-control-md" id="valor_recebido" name="valor_recebido" placeholder="R$ 0,00"  >

              <p class="background mt-3">TROCO</p>
              <input type="text" class="form-control  form-control-md" id="valor_troco" name="valor_troco" placeholder="Valor Troco"  >

              <input type="hidden" name="forma_pgto_input" id="forma_pgto_input">
              

            </div>
          </div>

        </form>



      </div>
      

    </div>
  </div>

</body>
</html>







<div class="modal fade" tabindex="-1" id="modalDeletar" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Excluir Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" id="form-excluir">
        <div class="modal-body">

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Gerente</label>
            <select class="form-select mt-1" aria-label="Default select example" name="gerente">
              <?php 
              $query = $pdo->query("SELECT * from usuarios where nivel = 'Administrador' order by nome asc");
              $res = $query->fetchAll(PDO::FETCH_ASSOC);
              $total_reg = @count($res);
              if($total_reg > 0){ 

                for($i=0; $i < $total_reg; $i++){
                  foreach ($res[$i] as $key => $value){ }
                    ?>

                  <option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

                <?php }

              }else{ 
                echo '<option value="">Cadastre um Gerente Administrador</option>';

              } ?>


            </select>
          </div>  


          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Senha Gerente</label>
            <input type="password" class="form-control" id="senha_gerente" name="senha_gerente" placeholder="Senha Gerente" required="" >
          </div> 

          <small><div align="center" class="mt-1" id="mensagem-excluir">

          </div> </small>

        </div>
        <div class="modal-footer">
          <button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button name="btn-excluir" id="btn-excluir" type="submit" class="btn btn-danger">Excluir</button>

          <input name="id" type="hidden" id="id_deletar_item">

        </div>
      </form>
    </div>
  </div>
</div>







<div class="modal fade" tabindex="-1" id="modalVenda" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Fechar Venda - Total: <span id="total-modal-venda"></span></h4>
        <a type="button" class="btn-close" href="pdv.php" aria-label="Close"></a>
      </div>
      <form method="POST" id="form-fechar-venda">
        <div class="modal-body">

          <?php 
              $query = $pdo->query("SELECT * from forma_pgtos order by id asc limit 6");
              $res = $query->fetchAll(PDO::FETCH_ASSOC);
              $total_reg = @count($res);
              if($total_reg > 0){ 

                for($i=0; $i < $total_reg; $i++){
                  foreach ($res[$i] as $key => $value){ }
                    ?>
                  <span class=""><small><small><?php echo $i + 1 ?> - <?php echo $res[$i]['nome'] ?> / </small></small></span>  
                <?php } } ?>

          <div class="mb-3">
            
            <select class="form-select form-select-sm mt-1" aria-label="Default select example" name="forma_pgto" id="forma_pgto">
              <?php 
              $query = $pdo->query("SELECT * from forma_pgtos order by id asc");
              $res = $query->fetchAll(PDO::FETCH_ASSOC);
              $total_reg = @count($res);
              if($total_reg > 0){ 

                for($i=0; $i < $total_reg; $i++){
                  foreach ($res[$i] as $key => $value){ }
                    ?>

                  <option value="<?php echo $res[$i]['codigo'] ?>"><?php echo $res[$i]['nome'] ?></option>

                <?php }

              }else{ 
                echo '<option value="">Cadastre uma Forma de Pagamento</option>';

              } ?>


            </select>
          </div>  


          <input type="hidden" id="textovenda">
          <small><div align="center" class="mt-1" id="mensagem-venda">

          </div> </small>

        </div>
        <div class="modal-footer">
          <a type="button" id="btn-fechar-venda" class="btn btn-secondary" href="pdv.php">Fechar</a>
          <button name="btn-venda" id="btn-venda" type="submit" class="btn btn-success">Fechar Venda</button>

          
        </div>
      </form>
    </div>
  </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>




<script type="text/javascript">
  $(document).ready(function() {
    listarProdutos();
    buscarDados();
    document.getElementById('codigo').focus();
    document.getElementById('quantidade').value = '1';
    $('#imagem').attr('src', '../img/produtos/sem-foto.jpg');
  } );
</script>







<script type="text/javascript">
  var pag = "<?=$pag?>";
  function buscarDados(){
    $.ajax({
      url: pag + "/buscar-dados.php",
      method: 'POST',
      data: $('#form-buscar').serialize(),
      dataType: "html",

      success:function(result){

        $('#mensagem-venda').text("");



        if(result.trim() === "Não é possível efetuar uma venda sem itens!"){
          $('#mensagem-venda').addClass('text-danger')
          $('#mensagem-venda').text(result)
          document.getElementById('forma_pgto_input').value = "";
           return;
        }

        var array = result.split("&-/z");

        if(array[0] === "Venda Salva!"){
          
        
          
          let a= document.createElement('a');
          a.target= '_blank';
          a.href= 'comprovante_class.php?id=' + array[1];
          a.click();
          return;
        }


        if(array.length == 2){
           var ms1 = array[0];
           var ms2 = array[1];
           
        }else{

        var estoque = array[0];
        var nome = array[1];
        var descricao = array[2];
        var imagem = array[3];
        var valor = array[4];
        var subtotal = array[5];
        var subtotalF = array[6];
        var totalVenda = array[7];
        var totalVendaF = array[8];
         var troco = array[9];
        var trocoF = array[10];
        console.log(result);
        
        
        document.getElementById('total_compra').value = 'R$ ' + totalVendaF; 
        $('#total-modal-venda').text('R$ ' + totalVendaF);
               

        document.getElementById('valor_troco').value = 'R$ ' + trocoF; 


        if(nome.trim() != "Código não Cadastrado"){

          document.getElementById('estoque').value = estoque;
          document.getElementById('produto').value = nome;
          document.getElementById('descricao').value = descricao;
          document.getElementById('valor_unitario').value = valor;

          if(imagem.trim() === ""){
           $('#imagem').attr('src', '../img/produtos/sem-foto.jpg');
         }else{
           $('#imagem').attr('src', '../img/produtos/' + imagem);
         }

         
         var audio = new Audio('../img/barCode.wav');
         audio.addEventListener('canplaythrough', function() {
          audio.play();
        });
         

         valor_format = "R$ " + valor.replace(".",",");
         document.getElementById('total_item').value = valor_format;
         
         document.getElementById('sub_total_item').value = 'R$ ' + subtotalF;


         document.getElementById('codigo').value = "";

         listarProdutos();

         }

       }

     } 

   });
  }
</script>


<script type="text/javascript">
  var pag = "<?=$pag?>";
  function listarProdutos(){
    $.ajax({
      url: pag + "/listar-produtos.php",
      method: 'POST',
      data: $('#form-buscar').serialize(),
      dataType: "html",

      success:function(result){
        $("#listar").html(result);
      } 

    });
  }
</script>





<script type="text/javascript">
  $("#form-excluir").submit(function () {
    var pag = "<?=$pag?>";
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      url: pag + "/excluir-item.php",
      type: 'POST',
      data: formData,

      success: function (mensagem) {

        $('#mensagem').removeClass()

        if (mensagem.trim() == "Excluído com Sucesso!") {

          $('#mensagem-excluir').addClass('text-success')

          $('#btn-fechar').click();
          window.location = "pdv.php";

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
  function modalExcluir(id){
    event.preventDefault();

    document.getElementById('id_deletar_item').value = id;
    

    var myModal = new bootstrap.Modal(document.getElementById('modalDeletar'), {

    })

    myModal.show();
  }
</script>




<script type="text/javascript">
  $("#desconto").keyup(function () {
    buscarDados();
  });
</script>


<script type="text/javascript">
  $("#valor_recebido").keyup(function () {
    buscarDados();
  });
</script>


<script type="text/javascript">
  $(document).keyup(function(e) {

    if(e.keyCode === 27){
      var myModal = new bootstrap.Modal(document.getElementById('modalVenda'), {

    })

    myModal.show();
    }


    var codigo = $("#codigo").val();
    if(codigo === ''){
      if($("#textovenda").val() === ''){
         if(e.keyCode === 13){
          $("#textovenda").val('aberto'); 
              var myModal = new bootstrap.Modal(document.getElementById('modalVenda'), {
               backdrop: 'static',
               })

             myModal.show();
          }
      }else{
        if(e.keyCode === 13){
            $('#btn-venda').click();
        }

        if(e.keyCode === 49|| e.keyCode === 97){
          document.getElementById("forma_pgto").options.selectedIndex = 0;
          $('#forma_pgto').val($('#forma_pgto').val()).change();
        }

        if(e.keyCode === 50|| e.keyCode === 98){
          document.getElementById("forma_pgto").options.selectedIndex = 1;
          $('#forma_pgto').val($('#forma_pgto').val()).change();
        }

        if(e.keyCode === 51|| e.keyCode === 99){
          document.getElementById("forma_pgto").options.selectedIndex = 2;
          $('#forma_pgto').val($('#forma_pgto').val()).change();
        }


        if(e.keyCode === 52|| e.keyCode === 100){
          document.getElementById("forma_pgto").options.selectedIndex = 3;
          $('#forma_pgto').val($('#forma_pgto').val()).change();
        }

        if(e.keyCode === 53|| e.keyCode === 101){
          document.getElementById("forma_pgto").options.selectedIndex = 4;
          $('#forma_pgto').val($('#forma_pgto').val()).change();
        }

        if(e.keyCode === 54|| e.keyCode === 102){
          document.getElementById("forma_pgto").options.selectedIndex = 5;
          $('#forma_pgto').val($('#forma_pgto').val()).change();
        }

      }
 
    }
    else{
      if(e.keyCode === 13){
      buscarDados();
      }
    }



    
});
</script>

<script type="text/javascript">
  $("#form-fechar-venda").submit(function () {
        event.preventDefault();
        var pgto = document.getElementById('forma_pgto').value;
        document.getElementById('forma_pgto_input').value = pgto;
        buscarDados();
    })
  </script>


