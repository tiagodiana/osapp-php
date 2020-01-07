<?php
require_once "include/cabecalho.php";
require_once "include/menu.php";


//FINALIZANDO ORDEM DE SERVIÇO E REDIRECIONANDO PARA A TELA DE IMPRESSÃO
if(isset($_POST['finalizar'])){
    $num_os = $_POST['num_os'];
    $id_cliente = $_POST['id'];
    $sql = "UPDATE ordem SET status= 1, data_saida='$data'WHERE id_os = $num_os";
    if(mysqli_query($conn, $sql)){
        echo "<div class='alert alert-success text-center'>";
        echo "<h2>Ordem de Serviço FINALIZADA</h2>";
        echo "<h3>Preparando Impressão</h3>";
        echo "</div>";
        //Enviando informaçãoes para a tela de impressão
        echo "<meta http-equiv='Refresh' content='2; imprimir_os.php?id_os=$num_os&&id_cliente=$id_cliente'>";
    }
    else{
        echo "<div class='alert alert-dark text-center'>";
        echo "<h2>ERRO NA BASE DE DADOS CONTATE UM TÉCNICO</h2>";
        echo "</div>";
        echo "<br>".mysqli_error($conn);
        exit();
    }
}



//ALTERANDO ORDEM DE SERVIÇO
if(isset($_POST['alterar'])){
    $tipo = empty($_POST['tipo']) ? Null : $_POST['tipo'];
    $marca = empty($_POST['marca']) ? "Não Informado" : $_POST['marca'];
    $modelo = empty($_POST['modelo']) ? "Não Informado" : $_POST['modelo'];
    $num_serie = empty($_POST['num_serie']) ? "Não Informado" : $_POST['num_serie'];
    $defeito = empty($_POST['defeito']) ? Null : $_POST['defeito'];
    $solucao = empty($_POST['solucao']) ? Null : $_POST['solucao'];
    $valor = empty($_POST['valor']) ? 0 : $_POST['valor'];
    $sql= "UPDATE ordem SET tipo='$tipo',marca='$marca', modelo='$modelo', num_serie='$num_serie', defeito='$defeito', solucao='$solucao', valor=$valor";

    if(mysqli_query($conn, $sql)){
        echo "<div class='alert alert-warning text-center'>";
        echo "<h2>Ordem de Serviço ALTERADA</h2>";
        echo "</div>";
        echo "<meta http-equiv='Refresh' content='2; busca_os.php'>";
    }
    else{
        echo "<div class='alert alert-dark text-center'>";
        echo "<h2>ERRO NA BASE DE DADOS CONTATE UM TÉCNICO</h2>";
        echo "</div>";
        echo "<br>".mysqli_error($conn);
        exit();
    }



}

//DELETANDO ORDEM DE SERVIÇO
if(isset($_POST['deletar'])){
    $num_os = $_POST['num_os'];
    $sql = "DELETE FROM ordem WHERE id_os = $num_os";
    if(mysqli_query($conn, $sql)){
        echo "<div class='alert alert-danger text-center'>";
        echo "<h2>Ordem de Serviço DELETADA</h2>";
        echo "</div>";
        echo "<meta http-equiv='Refresh' content='2; busca_os.php'>";
    }
    else{
        echo "<div class='alert alert-dark text-center'>";
        echo "<h2>ERRO NA BASE DE DADOS CONTATE UM TÉCNICO</h2>";
        echo "</div>";
        echo "<br>".mysqli_error($conn);
        exit();
    }
}


//BUSCANDO E EXIBINDO ORDEM DE SERVIÇO
if((isset($_POST['num_os']) && isset($_POST['buscar'])) || isset($_GET['num_os'])){
    $num_os = empty($_POST['num_os'])?$_GET['num_os']:$_POST['num_os'] ;
    $sql = "SELECT * FROM ordem INNER JOIN clientes ON ordem.id_cliente = clientes.id WHERE ordem.id_os =$num_os";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $dados = mysqli_fetch_assoc($result);
    }
    else{
        echo "<div class='alert alert-secondary text-center'>";
        echo "<h2>Ordem de Serviço NÃO EXISTE</h2>";
        echo "</div>";
        echo "<meta http-equiv='Refresh' content='2; busca_os.php'>";
        exit();
    }
    //FORM PARA EXIBIÇÃO DOS DADOS
    ?>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="border mx-auto col-md-8 col-12 bg-light font-arial my-4">
        <h2 class="pt-5 pb-3 mx-auto bg-light text-center mb-4">Buscar Ordem de Serviço</h2>
        <div class="form-group">
            <label for="num_os">Nº Ordem de Serviço</label><br>
            <input type="text" name="num_os" id="num_os" class="form-control col-5" value="<?php echo $num_os ?>" readonly>
        </div>
        <div class="form-group">
            <label for="cliente">Cliente</label>
            <input type="text" name="id"class="form-control" value="<?php echo $dados['id'] ?>" hidden>
            <input type="text" name="cliente" id="cliente" class="form-control" value="<?php echo $dados['nome'] ?>" readonly>
        </div>

        <div class="form-row ">
            <div class="form-group col-md-3 col-3">
                <label for="tipo">Tipo</label>
                <input type="text" name="tipo" id="tipo" class="form-control" value="<?php echo $dados['tipo'] ?>">
            </div>

            <div class="form-group col-md-3 col-3">
                <label for="marca">Marca</label>
                <input type="text" name="marca" id="marca" class="form-control" value="<?php echo $dados['marca'] ?>">
            </div>

            <div class="form-group col-md-3 col-3">
                <label for="modelo">Modelo</label>
                <input type="text" name="modelo" id="modelo" class="form-control" value="<?php echo $dados['modelo'] ?>">
            </div>

            <div class="form-group col-md-3 col-3">
                <label for="num_serie">N° Serie</label>
                <input type="text" name="num_serie" id="num_serie" class="form-control" value="<?php echo $dados['num_serie'] ?>">
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-6">
                <label for="defeito">Defeito</label>
                <textarea id="defeito" class="form-control" rows="4" name="defeito"><?php echo $dados['defeito'] ?></textarea>
            </div>
            <div class="form-group col-6">
                <label for="solucao">Solução</label>
                <textarea id="solucao" class="form-control" rows="4" name="solucao"><?php echo $dados['solucao'] ?></textarea>
            </div>
        </div>

        <div class="form-row">
            <h2 class="col-6 text-center pt-2">Valor</h2>
            <span class="col-2" style="margin-top: 12px;">R$</span><input type="text" name="valor" id="valor" value="<?php echo $dados['valor'] ?>" class="col-4" style="border:none;background: none;">
        </div>
        <div class="form-row ">
            <div class="form-group col-6">
                <input type="text" name="data" id="data" class="form-control data" value="<?php echo "Entrada: " . exibiData($dados['data_entrada'])?>" readonly style="background:none;border: none;">
            </div>
            <div class="form-group col-6">
                <input type="text" name="data" id="data" class="form-control data" value="<?php echo "Saida: " . empty($dados['data_saida'])?Null: exibiData($dados['data_saida']) ?>" readonly style="background:none;border: none;">
            </div>
        </div>
        <div class="text-center">
            <?php
                if($dados['status']){
                    echo "<h2 class='text-success'>Finalizada</h2>";
                }
                else{
                    echo "<h2 class='text-danger'>Aberta</h2>";
                }

            ?>
        </div>
        <div class="text-center my-4">
            <?php
                if($dados['status']){
                    echo '<input type="submit" name="deletar"  class="btn btn-lg btn-danger m-1" value="Deletar">';
                    echo '<input type="submit" name="voltar" class="btn btn-lg btn-secondary m-1" value="Voltar">';
                }
                else{
                    ?>
                    <input type="submit" name="finalizar" class="btn btn-lg btn-success m-1" value="Finalizar">
                    <input type="submit" name="alterar" class="btn btn-lg btn-warning m-1" value="Alterar">
                    <input type="submit" name="deletar"  class="btn btn-lg btn-danger m-1" value="Deletar">
                    <input type="submit" name="voltar" class="btn btn-lg btn-secondary m-1" value="Voltar">
                    <?php
                }
            ?>


        </div>
    </form>





<?php
}
//FORM PARA BUSCA DA ORDEM DE SERVIÇO
else{
    ?>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="border mx-auto col-md-8 col-12 bg-light font-arial my-4">
        <h2 class="pt-5 pb-3 mx-auto bg-light text-center mb-4">Buscar Ordem de Serviço</h2>
        <div class="form-group">
            <label for="num_os">Nº Ordem de Serviço</label>
            <input type="text" name="num_os" id="num_os" class="form-control col-5">
        </div>
        <div class="form-group">
            <label for="cliente">Cliente</label>
            <input type="text" name="cliente" id="cliente" class="form-control" disabled>
        </div>


        <div class="form-row ">
            <div class="form-group col-md-3 col-3">
                <label for="tipo">Tipo</label>
                <input type="text" name="cliente" id="tipo" class="form-control" disabled>
            </div>

            <div class="form-group col-md-3 col-3">
                <label for="marca">Marca</label>
                <input type="text" name="marca" id="marca" class="form-control" disabled>
            </div>

            <div class="form-group col-md-3 col-3">
                <label for="modelo">Modelo</label>
                <input type="text" name="modelo" id="modelo" class="form-control" disabled>
            </div>

            <div class="form-group col-md-3 col-3">
                <label for="num_serie">N° Serie</label>
                <input type="text" name="num_serie" id="num_serie" class="form-control" disabled>
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-6">
                <label for="defeito">Defeito</label>
                <textarea id="defeito" class="form-control" rows="4" name="defeito" disabled></textarea>
            </div>
            <div class="form-group col-6">
                <label for="solucao">Solução</label>
                <textarea id="solucao" class="form-control" rows="4" name="solucao" disabled></textarea>
            </div>
        </div>

        <div class="form-row">
            <h2 class="col-6 text-center pt-2">Valor</h2>
            <input type="text" name="valor" id="valor" disabled style="border:none;background: none;">
        </div>
        <div class="text-center my-4">
            <button class="btn btn-lg btn-primary text-center" name="buscar">Buscar</button>
        </div>
    </form>

<?php
}
require_once "include/footer.php";
?>


