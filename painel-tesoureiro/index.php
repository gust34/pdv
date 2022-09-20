<?php 

@session_start();
require_once('../conexao.php');
require_once('verificar-permissao.php');


//VARIAVEIS DO MENU ADMINISTRATIVO
$menu1 = 'home';
$menu2 = 'contas_pagar';
$menu3 = 'contas_receber';
$menu4 = 'movimentacoes';
$menu5 = 'vendas';
$menu6 = 'compras';
$menu7 = 'contas_pagar_vencidas';
$menu8 = 'contas_pagar_hoje';
$menu9 = 'contas_receber_vencidas';


//RECUPERAR DADOS DO USUÁRIO
$query = $pdo->query("SELECT * from usuarios WHERE id = '$_SESSION[id_usuario]'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_usu = $res[0]['nome'];
$email_usu = $res[0]['email'];
$senha_usu = $res[0]['senha'];
$nivel_usu = $res[0]['nivel'];
$cpf_usu = $res[0]['cpf'];
$id_usu = $res[0]['id'];

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Painel Tesouraria</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="../vendor/DataTables/datatables.min.css"/>
 
  <script type="text/javascript" src="../vendor/DataTables/datatables.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

  <link rel="shortcut icon" href="../img/favicon.ico" />
  

</head>
<body>



  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="../img/logo-texto-escuro.png" width="100">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?pagina=<?php echo $menu1 ?>">| Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            | Contas
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
             <li class="nav-item">
          <a class="nav-link" href="index.php?pagina=<?php echo $menu2 ?>">Contas à Pagar</a>
        </li>
           

         <li class="nav-item">
          <a class="nav-link" href="index.php?pagina=<?php echo $menu3 ?>">Contas à Receber</a>
        </li>

         <li><hr class="dropdown-divider"></li>


          <li class="nav-item">
          <a class="nav-link" href="index.php?pagina=<?php echo $menu7 ?>">Pagar Vencidas</a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="index.php?pagina=<?php echo $menu8 ?>">Pagar Hoje</a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="index.php?pagina=<?php echo $menu9 ?>">Receber Vencidas</a>
        </li>

          </ul>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="index.php?pagina=<?php echo $menu4 ?>">| Movimentações</a>
        </li>

       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            | Compras - Vendas
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu5 ?>">Lista de Vendas</a></li>
            <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu6 ?>">Lista de Compras</a></li>
           
          </ul>
        </li>


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            | Relatórios
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#ModalRelMov">Relatório de Movimentações</a></li>

             <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#ModalRelContasPagar">Relatório Contas Pagar</a></li>
           
           
          </ul>
        </li>
        
      </ul>
      <div class="d-flex mx-3">
        <img src="../img/icone-user.png" width="40px" height="40px">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $nome_usu ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modalPerfil">Editar Perfil</a></li>
             <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../logout.php">Sair</a></li>
            
          </ul>
        </li>
      </ul>
    </div>
       </div>
    </div>
  </div>
</nav>

<div class="container-fluid mt-2 mx-3">
<?php 

if(@$_GET['pagina'] == $menu1){
  require_once($menu1. '.php');
}

else if(@$_GET['pagina'] == $menu2){
  require_once($menu2. '.php');
}

else if(@$_GET['pagina'] == $menu3){
  require_once($menu3. '.php');
}

else if(@$_GET['pagina'] == $menu4){
  require_once($menu4. '.php');
}

else if(@$_GET['pagina'] == $menu5){
  require_once($menu5. '.php');
}

else if(@$_GET['pagina'] == $menu6){
  require_once($menu6. '.php');
}

else if(@$_GET['pagina'] == $menu7){
  require_once($menu7. '.php');
}

else if(@$_GET['pagina'] == $menu8){
  require_once($menu8. '.php');
}

else if(@$_GET['pagina'] == $menu9){
  require_once($menu9. '.php');
}

else{
  require_once($menu1. '.php');
}

 ?>
</div>

</body>
</html>




<div class="modal fade" tabindex="-1" id="modalPerfil" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Perfil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" id="form-perfil">
        <div class="modal-body">

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome-perfil" name="nome-perfil" placeholder="Nome" required="" value="<?php echo @$nome_usu ?>">
              </div> 
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf-perfil" name="cpf-perfil" placeholder="CPF" required="" value="<?php echo @$cpf_usu ?>">
              </div>  
            </div>
          </div>



          

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="email-perfil" name="email-perfil" placeholder="Email" required="" value="<?php echo @$email_usu ?>">
          </div>  

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Senha</label>
            <input type="text" class="form-control" id="senha-perfil" name="senha-perfil" placeholder="Senha" required="" value="<?php echo @$senha_usu ?>">
          </div>  

          

          <small><div align="center" class="mt-1" id="mensagem-perfil">
            
          </div> </small>

        </div>
        <div class="modal-footer">
          <button type="button" id="btn-fechar-perfil" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button name="btn-salvar-perfil" id="btn-salvar-perfil" type="submit" class="btn btn-primary">Salvar</button>

          <input name="id-perfil" type="hidden" value="<?php echo @$id_usu ?>">

          <input name="antigo-perfil" type="hidden" value="<?php echo @$cpf_usu ?>">
          <input name="antigo2-perfil" type="hidden" value="<?php echo @$email_usu ?>">

        </div>
      </form>
    </div>
  </div>
</div>







<!--  Modal Rel-->
<div class="modal fade" tabindex="-1" id="ModalRelMov" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Relatório de Movimentações</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <form action="../rel/relMov_class.php" method="POST" target="_blank">
       
                <div class="modal-body">

                 <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label >Data Inicial</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control mt-1"  name="dataInicial" >
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group mb-3">
                            <label >Data Final</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control mt-1"  name="dataFinal" >
                        </div>


                    </div>

                    <div class="col-md-4">

                        <div class="form-group mb-3">
                            <label >Status</label>
                            <select class="form-select mt-1"  name="status">
                                <option value="">Todas</option>
                                <option value="Entrada">Entradas</option>
                                <option value="Saída">Saídas</option>
                               
                            </select>
                        </div>


                    </div>

                </div>     

            </div>
            <div class="modal-footer">
          <button type="submit" class="btn btn-primary" >Gerar Relatório</button>
         
        </div>
        </form>


    </div>
</div>
</div>





<!--  Modal Rel-->
<div class="modal fade" tabindex="-1" id="ModalRelContasPagar" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Relatório de Contas Pagar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <form action="../rel/relContasPagar_class.php" method="POST" target="_blank">
       
                <div class="modal-body">

                 <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label >Data Inicial</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control mt-1"  name="dataInicial" >
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group mb-3">
                            <label >Data Final</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control mt-1"  name="dataFinal" >
                        </div>


                    </div>

                    <div class="col-md-4">

                        <div class="form-group mb-3">
                            <label >Pago</label>
                            <select class="form-select mt-1"  name="status">
                                <option value="">Todas</option>
                                <option value="Sim">Sim</option>
                                <option value="Não">Não</option>
                               
                            </select>
                        </div>


                    </div>

                </div>     

            </div>
            <div class="modal-footer">
          <button type="submit" class="btn btn-primary" >Gerar Relatório</button>
         
        </div>
        </form>


    </div>
</div>
</div>







<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script type="text/javascript" src="../vendor/js/mascaras.js"></script>





<script type="text/javascript">
  $("#form-perfil").submit(function () {
    
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      url: "editar-perfil.php",
      type: 'POST',
      data: formData,

      success: function (mensagem) {

        $('#mensagem-perfil').removeClass()

        if (mensagem.trim() == "Salvo com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar-perfil').click();
                    //window.location = "index.php?pagina="+pag;

                } else {

                  $('#mensagem-perfil').addClass('text-danger')
                }

                $('#mensagem-perfil').text(mensagem)

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

