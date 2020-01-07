<?php
require_once "include/cabecalho.php";
require_once "include/menu.php";
?>
<script>
    $(document).ready(function () {
        $('.titulo-inicio').click(function () {
            $('.informacao').show('slow')
        })
    })
</script>
<!-- CORPO DO SITE -->
<section class="corpo-site">
    <!--<h2 class="titulo-inicio">Sistema de Ordem de Serviço</h2>
    <div class="informacao">
            <p>Sistema para assistencias técnicas de manuteção em eletronico.</p>
            <p>Criado para gerar Ordem de Serviço para controle das manutenções e podendo assim emitir uma nota para o cliente.</p>
    </div>-->
    <div class= "img-fluid">
        <img src="image/logo.png" class="mx-auto d-block my-3 img-fluid" >
    </div>
</section>
<footer class="footer-bg ">
    
    <h6 class="footer-font">© 2019 Copyright: Tiago Roberto Diana</h6>
 
</footer>
</main>
</body>
</html>