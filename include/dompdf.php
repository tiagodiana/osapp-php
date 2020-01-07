<?php
require_once 'filtro.php';
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;



//Instanciando e usando a classe dompdf
$dompdf = new Dompdf();





if(isset($_GET['dados'])){

    $dados= $_GET['dados'];
    $dados = json_decode($dados);

    $dompdf->loadHtml("
<head>
    <title>Ordem de Serviço #$dados->id_os</title>
    <link rel='stylesheet' type='text/css' href='../assets/bootstrap/css/bootstrap.min.css'>
</head>
<body>
<section class='border' style='height: 330px;'>
<header>
    <div class='container'>
        <div class='row'>
            <div class='text-center'><h3 class='py-2 bg-light'>Ordem de Serviço #$dados->id_os</h3></div>
        </div>
    </div>
</header>

<article class='container'>
    <div class='row' style='margin-bottom: -240px; '>
        <div class='p-2'><h6>Cliente</h6><h7 class='text-muted'>$dados->nome</h7></div>
        <div class='p-2 offset-4'><h6>CPF</h6><p class='text-muted'>$dados->cpf</p></div>
        <div class='p-2 offset-7'><h6>Telefone</h6><p class='text-muted'>$dados->telefone</p></div>
        <div class='p-2 offset-10'><h6>Celular</h6><p class='text-muted'>$dados->celular</p></div>
    </div>
    <div class='row' style='margin-top: -250px;'>
        <div class='p-2'><h6>Tipo</h6><p class='text-muted'>$dados->tipo</p></div>
        <div class='p-2 offset-3'><h6>Marca</h6><p class='text-muted'>$dados->marca</p></div>
        <div class='p-2 offset-6'><h6>Modelo</h6><p class='text-muted'>$dados->modelo</p></div>
        <div class='p-2 offset-9 col-3'><h6>N° de Serie</h6><p class='text-muted'>$dados->num_serie</p></div>
    </div>
    <div class='row' style='margin:-300px 0 0 0 ;'>
        <div class='p-2 col-4'><h6>Defeito</h6><p class='text-muted'>$dados->defeito</p></div>
        <div class='p-2 offset-5 col-4'><h6>Solução</h6><p class='text-muted'>$dados->solucao</p></div>
        <div class='p-2 offset-10'><h6>Total</h6><p class='text-muted'>R$$dados->valor</p></div>
    </div>
    <div></div>
</article>
</section>
<br>
<br>
<div class='row' style='margin-bottom: -70px;'>
<div class='col-5 text-center'>
    <hr>
    <p>Técnico Responsável</p>
</div>
<div class='offset-6 col-5 text-center'>
    <hr>
    <p>$dados->nome</p>
</div>
</div>

<div class='row' style='margin-bottom: -20px;'>
<div class='col-6 text-left'>
    <p>Entrada: $dados->data_entrada</p>
</div>
<div class='col-6 offset-8 text-left'>
    <p>Saida: $dados->data_saida</p>
</div>
</div>
<hr style='margin-top: -60px;'>
<br>
<section class='border' style='height: 330px; margin-top: -30px;'>
<header>
    <div class='container'>
        <div class='row'>
            <div class='text-center'><h3 class='py-2 bg-light'>Ordem de Serviço #$dados->id_os</h3></div>
        </div>
    </div>
</header>

<article class='container'>
    <div class='row' style='margin-bottom: -240px; '>
        <div class='p-2'><h6>Cliente</h6><h7 class='text-muted'>$dados->nome</h7></div>
        <div class='p-2 offset-4'><h6>CPF</h6><p class='text-muted'>$dados->cpf</p></div>
        <div class='p-2 offset-7'><h6>Telefone</h6><p class='text-muted'>$dados->telefone</p></div>
        <div class='p-2 offset-10'><h6>Celular</h6><p class='text-muted'>$dados->celular</p></div>
    </div>
    <div class='row' style='margin-top: -250px;'>
        <div class='p-2'><h6>Tipo</h6><p class='text-muted'>$dados->tipo</p></div>
        <div class='p-2 offset-3'><h6>Marca</h6><p class='text-muted'>$dados->marca</p></div>
        <div class='p-2 offset-6'><h6>Modelo</h6><p class='text-muted'>$dados->modelo</p></div>
        <div class='p-2 offset-9 col-3'><h6>N° de Serie</h6><p class='text-muted'>$dados->num_serie</p></div>
    </div>
    <div class='row' style='margin:-300px 0 0 0 ;'>
        <div class='p-2 col-4'><h6>Defeito</h6><p class='text-muted'>$dados->defeito</p></div>
        <div class='p-2 offset-5 col-4'><h6>Solução</h6><p class='text-muted'>$dados->solucao</p></div>
        <div class='p-2 offset-10'><h6>Total</h6><p class='text-muted'>$dados->valor</p></div>
    </div>
</article>
</section>
<div class='row' style=' margin-bottom: -20px;'>
<div class='col-5 text-center' style='margin-top: 50px;'>
    <hr>
    <p>Técnico Responsável</p>
</div>
<div class='offset-6 col-5 text-center' style='margin-bottom:-100px;'>
<br>
<br>
    <hr>
    <p>$dados->nome</p>
</div>
</div>
<div class='row'>
<div class='col-6 text-left'>
    <p>Entrada: $dados->data_entrada</p>
</div>
<div class='col-6 offset-8 text-left'>
    <p>Saida: $dados->data_saida</p>
</div>
</div>
</body>");





//(opcional) Configurando o tipo do papel
    $dompdf->setPaper('A4','landsacpe');

//Renderizando o html para pdf
    $dompdf->render();

//Gerando saida pada o pdf no browser
    $dompdf->stream("Ordem de Serviço #$dados->id_os",array('Attachment' => 0));

}

