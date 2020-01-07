<?php
require_once "include/cabecalho.php";
require_once "include/menu.php";
?>

<div class="container contact-form border border-light bg-light">
    <div class="contact-image">
        <img src="image/logo-icone.png" alt="OS_APP" class="img-fluid"/>
    </div>
    <div class="form">
        <h3><strong>Envie Sua Menssagem</strong></h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" id="nome_contato" class="form-control" placeholder="Nome Completo *" required/>
                </div>
                <div class="form-group">
                    <input type="text" id="email_contato" class="form-control" placeholder="E-mail *" required/>
                </div>


            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea id="msg_contato" class="form-control" placeholder="Mensagem *" style="width: 100%; height: 150px;" required></textarea>
                </div>
            </div>
            <div class="form-group text-center col-12">
                <input type="submit" name="enviar_contato" class="btn btn-dark" value="Enviar Mensagem" />
            </div>
        </div>
    </div>
</div>

<?php require_once "include/footer.php";?>