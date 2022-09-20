<?php 

//AQUI VARIAVEIS GLOBAIS
$nome_sistema = "Eletricagregorios Comercio de Materiais para Construção Ltda. ";
$email_adm = 'gregorios.eletrica@gmail.com';

 
$url_sistema = "http://$_SERVER[HTTP_HOST]/";
$url = explode("//", $url_sistema);
if($url[1] == 'localhost/'){
	$url_sistema = "http://$_SERVER[HTTP_HOST]/pdv/";
}



$telefone_sistema = "(11) 3698-2580";
$endereco_sistema = "Av. Erico Verissimo, 115 Recanto das Rosas - Osasco - SP";
$rodape_relatorios = " Projeto Integrador Curso Sistema de Informação e ADS 5º!";
$cnpj_sistema = '29.933.294/0001-96';


//Conectar com O BANCO DE DADOS LOCAL
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'pdv';


//VARIAVEIS DE CONFIGURAÇÕES DO SISTEMA

$nivel_estoque_minimo = 8; 

$relatorio_pdf = 'Sim'; //Se você utilizar sim ele vai gerar os relatórios utilizando a biblioteca do dompdf configurada para o PHP 8.0

$cabecalho_img_rel = 'Sim'; 

$desconto_porcentagem = 'Sim'; //Sim para desconto em porcentagem

$cupom_fiscal = 'Não'; //Se você utilizar sim, ele irá apontar para a api que vai gerar o cupom fiscal

$largura_cod_barras = 3; 

$altura_cod_barras = 50; //Tamanho padrão de 50,


$etiquetas_por_linha = 5; //5 etiquetas de código de barras por cada linha na pagina

$linhas_etiquetas_pag = 14; // total de linhas por pagina

 ?>