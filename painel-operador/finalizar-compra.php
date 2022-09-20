<?php 

@session_start();
include_once("conexao.php");
$cpf_usuario = @$_SESSION['cpf_usuario'];
$hora_atual = date("H:i");

$inicio = strtotime($abertura);
$final = strtotime($fechamento);
$atual = strtotime($hora_atual );




          //TRAZER OS DADOS DO CLIENTE
  $cpf_cliente = @$_SESSION['cpf_usuario'];
  $res = $pdo->query("SELECT * from clientes where cpf = '$cpf_cliente'");
  $dados = $res->fetchAll(PDO::FETCH_ASSOC);
  $rua = @$dados[0]['rua'];
  $numero = @$dados[0]['numero'];
  $bairro = @$dados[0]['bairro'];
  $cidade = @$dados[0]['cidade'];


  $res = $pdo->query("SELECT * from locais where nome = '$bairro'");
  $dados = $res->fetchAll(PDO::FETCH_ASSOC);
  $valor_local = @$dados[0]['valor'];
    
   

if($atual >= $inicio and $atual <= $final){
  
}else{
  echo "<script language='javascript'>window.alert('Nosso Delivery só funciona das $abertura às $fechamento'); </script>";
  echo "<script language='javascript'>window.location='produtos'; </script>";
}

$res = $pdo->query("SELECT * from carrinho where cpf = '$cpf_usuario' and id_venda = 0 order by id asc");
            $dados = $res->fetchAll(PDO::FETCH_ASSOC);
            $linhas = count($dados);

            if($linhas == 0){
              $linhas = 0;
              $total = 0;
              $valor_final = 0;
              echo "<script language='javascript'>window.location='produtos'; </script>";
}



?>


 

<!DOCTYPE html>
<html class="wide wow-animation" lang="pt-br">
<head>
  <title>Burguer Freitas</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <meta name="description" content="TESTE ">
  <meta name="author" content="iNTEGRADOR">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">


  <link rel="stylesheet" href="css/bootstrap.css">

  <link rel="stylesheet" href="css/style.css">



  <link rel="icon" href="images/favicon-nova.ico" type="image/x-icon">
  <!-- Stylesheets-->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500">
  <link rel="stylesheet" href="css/checkout.css">



  <script src="checkout.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>


  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    
</head>
<body>


  <div class='checkout margem-topo'>
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <div class='order'>
          <h2>PRODUTOS</h2>

          <ul class='order-list mt-4'>

            <?php 

            

            $total;
            for ($i=0; $i < count($dados); $i++) { 
              foreach ($dados[$i] as $key => $value) {
              }

              $id_produto = $dados[$i]['id_produto']; 
              $quantidade = $dados[$i]['quantidade'];
              $id_carrinho = $dados[$i]['id'];


              $res_p = $pdo->query("SELECT * from produtos where id = '$id_produto' ");
              $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
              $nome_produto = $dados_p[0]['nome'];  
              $valor = $dados_p[0]['valor'];
              $imagem = $dados_p[0]['imagem'];


              //VERIFICAR SE TEM ADICIONAIS E SOMAR VALOR AO TOTAL
                            $total_adc = 0;
                            
                            $res_adc = $pdo->query("SELECT * from adicionais_itens where id_car = '$id_carrinho'");
                            $dados_adc = $res_adc->fetchAll(PDO::FETCH_ASSOC);

                            for ($i_adc=0; $i_adc < count($dados_adc); $i_adc++) { 
                              foreach ($dados_adc[$i_adc] as $key => $value) {
                              }

                               $id_adc = $dados_adc[$i_adc]['id_adc'];
                               $id_item_adc = $dados_adc[$i_adc]['id'];
                               $res2_adc = $pdo->query("SELECT * from adicionais where id = '$id_adc'");
                                $dados2_adc = $res2_adc->fetchAll(PDO::FETCH_ASSOC);
                                $nome_adc = $dados2_adc[0]['nome'];
                                $valor_adc = $dados2_adc[0]['valor'];
                                @$total_adc = @$total_adc + $valor_adc;
                              }


                 //VERIFICAR SE TEM MAIS DE UM SABOR NA PIZZA E O VALOR DELE
                            
                            $total_sab = 0;
                            
                            $res_sab = $pdo->query("SELECT * from sabores_itens where id_car = '$id_carrinho'");
                            $dados_sab = $res_sab->fetchAll(PDO::FETCH_ASSOC);

                            for ($i_sab=0; $i_sab < count($dados_sab); $i_sab++) { 
                              foreach ($dados_sab[$i_sab] as $key => $value) {
                              }

                               $id_sab = $dados_sab[$i_sab]['id_sab'];
                               $id_item_sab = $dados_sab[$i_sab]['id'];
                               $res2_sab = $pdo->query("SELECT * from sabores where id = '$id_sab'");
                                $dados2_sab = $res2_sab->fetchAll(PDO::FETCH_ASSOC);
                                $nome_sab = $dados2_sab[0]['nome'];
                                $valor_sab = $dados2_sab[0]['valor'];
                                @$total_sab = @$total_sab + $valor_sab;
                              }


              $total_item = $valor * $quantidade;
              $total_item = $total_item + @$total_adc + @$total_sab;
              @$total = @$total + $total_item;
              $valor_final = $total;
              $valor_final_script = $valor_final;


              //VERIFICAR O TIPO DE TAXA DE ENTREGA
              if($taxa_fixa == 'Sim'){
                $taxa_entrega = $valor_local;
                if($valor_local == 0 || $valor_local == ""){
                  $taxa_entrega = "Escolha um Bairro";
                }
              }

              //totalizar com a entrega
              if($taxa_entrega != "Escolha um Bairro"){
                @$total_final = @$valor_final + @$taxa_entrega;
              }else{
                @$total_final = @$valor_final;
              }
              
              $sub_total = $total_final;

              $valor = number_format( $valor , 2, ',', '.');
                            //$total = number_format( $total , 2, ',', '.');
              $total_item = number_format( $total_item , 2, ',', '.');
              $valor_final = number_format( $valor_final , 2, ',', '.');

              if($valor_local != ""){
              @$taxa_entrega = number_format( @$taxa_entrega , 2, ',', '.');
              }
              $sub_total = number_format( $sub_total , 2, ',', '.');
              ?>

              <li><img src='images/produtos/<?php echo $imagem ?>'><h4><?php echo $quantidade; echo ' - '; echo $nome_produto; ?></h4><h5><?php echo $total_item ?></h5></li>


            <?php } ?>

          </ul>

          <h4 class='total mt-4'>Total R$ <?php echo $valor_final ?>
          <h4 class='total'>Taxa Entrega R$ <span id="taxa_entrega"><?php echo $taxa_entrega ?></span></h4>
          </h4>


          <h1>R$ <span id="sub_total"><?php echo $sub_total ?></span></h1>

          <small><p class="text-info" align="right">Previsão Entrega : <?php echo date("H:i",strtotime("$hora_atual + $previsao_minutos minutes")) ?></p></small>
        </div>
      </div>

      

      <div id='payment' class='payment col-md-6'>

       

        <form method="post" class="mt-2">
          <div class="div-select">
            <select  id="tipo" name="tipo" required>
              <option value="" selected>Forma de Pagamento</option>
              <option value="Dinheiro">Dinheiro</option>
              <option value="Cartão de Débito">Cartão de Débito</option>
              <option value="Cartão de Crédito">Cartão de Crédito</option>
              <option value="Mercado Pago">Mercado Pago</option>
            </select>
          </div>

          <div id="troco" class="mt-2">

            <input type="text" class="form-control" id="troco" placeholder="Total em Dinheiro para calcularmos o Troco " name="troco" required> 
          </div>

       





           <img src="images/dados.png" width="100%" class="mt-2">

           <div class="dados-usuario row">


            <div class="col-md-9">

           <div class="form-group">

            <label class="text-dark" for="exampleInputEmail1">Rua</label>
            <input type="text" class="form-control form-control-sm" id="rua" name="rua" placeholder="Rua" required value="<?php echo @$rua ?>">

          </div>

        </div>


          <div class="col-md-3">
           <div class="form-group">
            <label class="text-dark" for="exampleInputEmail1">Número</label>
            <input type="text" class="form-control form-control-sm" id="numero" name="numero" placeholder="Número" required value="<?php echo @$numero ?>">

          </div>

        </div>

          <div class="col-md-6">
           <div class="form-group">
            <label class="text-dark" for="exampleInputEmail1">Bairro</label>
            
            <select class="form-control form-control-sm" id="bairro" name="bairro" required>



                <?php 
                //SE EXISTIR EDIÇÃO DOS DADOS, TRAZER O NOME DO ITEM ASSOCIADA AO REGISTRO
                if(@$bairro != ''){

                 
                  echo '<option value="'.@$bairro.'">'.@$bairro.'</option>';
                }else{
                   echo '<option value="">Selecione um Bairro</option>';
                }
                


                //TRAZER TODOS OS REGISTROS EXISTENTES
                $res = $pdo->query("SELECT * from locais order by nome asc");
                $dados = $res->fetchAll(PDO::FETCH_ASSOC);

                for ($i=0; $i < count($dados); $i++) { 
                  foreach ($dados[$i] as $key => $value) {
                  }

                  $id_item = $dados[$i]['id'];  
                  $nome_item = $dados[$i]['nome'];

                  if($nome_dado != $nome_item){
                    echo '<option value="'.$nome_item.'">'.$nome_item.'</option>';
                  }

                  
                }
                ?>
              </select>

          </div>

        </div>

         <div class="col-md-6">
           <div class="form-group">
            <label class="text-dark" for="exampleInputEmail1">Cidade</label>
            <input type="text" class="form-control form-control-sm" id="cidade" name="cidade" placeholder="Cidade" required value="<?php echo @$cidade ?>">

          </div>

        </div>


         <div class="col-md-12">
           <div class="form-group">
            <label class="text-dark" for="exampleInputEmail1">Observações <span class="text-muted">(Retirar Picles, Etc)</span></label>
            <textarea maxlength="350" class="form-control form-control-sm" id="obs" name="obs" required></textarea>

          </div>

        </div>
           
           
          </div>

           <input type="hidden" id="total" name="total"  value="<?php echo @$total_final ?>">

          <button id="btn-finalizar" class='button-cta' title='Finalizar a Compra'><span>CONCLUIR</span></button>

        </form>

        <div align="center" id="mensagem" class="text-dark mt-2">
        </div>
      </div>
      

    </div>
  </div>

</body>
</html>








<!--AJAX PARA CHAMAR O CARREGAMENTO DO INPUT SELECT A PARTIR DE OUTRO INPUT -->
<script type="text/javascript">
  $(function(){
    $('#troco').hide();
    $('#mp').hide();
    $('#tipo').change(function(){
      if( $(this).val() == 'Dinheiro' ) {
        $('#troco').show();

      } else {
        $('#troco').hide();
      }

     
    });
  });
</script>





<!--AJAX PARA INSERÇÃO DOS DADOS -->
<script type="text/javascript">
    $(document).ready(function(){
       
        $('#btn-finalizar').click(function(event){
            event.preventDefault();
            
            $.ajax({
                url: "carrinho/finalizar.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem == 'Cadastrado com Sucesso!!'){
                        
                        $('#mensagem').addClass('text-success');
                        alert('Pedido Finalizado!');
                        window.location='painel-cliente/index.php?acao=pedidos';
                       
                        //$('#btn-fechar').click();
                        //location.reload();


                    }else if(mensagem == 'Mercado Pago!!'){
                      atualizarUltimaVenda();
                      $("#modal-mp").modal("show");
                    }else{
                        
                        $('#mensagem').addClass('text-danger')
                    }
                    
                    $('#mensagem').text(mensagem)

                },
                
            })
        })
    })
</script>






<!--AJAX PARA LISTAR OS DADOS -->
<script type="text/javascript">
  
  function atualizarUltimaVenda(){
     $.ajax({
      url: "carrinho/listar-ultima-venda.php",
      method: "post",
      data: $('#frm').serialize(),
      dataType: "html",
      success: function(result){
        $('#ultima-venda').html(result)

      },

      
    })
  }
</script>






<div class="modal fade" id="modal-mp" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pagar com Mercado Pago <?php echo @$id_venda ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
   <span>Apenas pagamentos com liberação imediata como (Cartão de Crédito ou Débito e Saldo em Conta, clique na imagem abaixo para pagar!</span>

     <div id="ultima-venda" class="mt-2">

           
           
          </div>


</div>

</div>
</div>
</div>




<script type="text/javascript">
  $('#bairro').change(function(){
    bairro = document.getElementById('bairro').value;

    var valor_produtos = "<?=$valor_final_script?>";
    var taxa_fixa = "<?=$taxa_fixa?>";
   
    $.ajax({
      url:  "valor-locais.php",
      method: "post",
      data: {bairro},
      dataType: "html",
      success: function(result){
      if(taxa_fixa == 'Sim'){
        $('#taxa_entrega').text(result)              
        var total_final = parseFloat(result) + parseFloat(valor_produtos);
        
          $('#sub_total').text(total_final);
          $('#total').val(total_final);
        }
         
      },
     })
  })
</script>