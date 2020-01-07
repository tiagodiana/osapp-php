<?php
require_once "include/cabecalho.php";
require_once "include/menu.php";

$result = todosClientes($conn);

?>

<form action="salvar_os.php" method="POST" class="border mx-auto col-md-8 col-12 bg-light font-arial my-4">
    <h2 class="pt-5 pb-3 mx-auto bg-light text-center mb-4">Nova Ordem de Serviço</h2>
    <div class="form-group">
        <label for="cliente">Cliente</label>
        <select class="custom-select form-control" name="cliente">
            <?php
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='".$row['id']."+".$row['nome']."'>".$row['nome']."</option>";
                    }
                }
                else{
                    echo "<option>Não Existe Clientes Cadastrados</option>";
                }
            ?>
        </select>
    </div>


    <div class="form-row ">
        <div class="form-group col-md-3 col-3">
            <label for="tipo">Tipo</label>
            <select name="tipo" class="custom-select form-control" id="tipo" >
                <option value="Computador">Computador</option>
                <option value="Notebook">Notebook</option>
                <option value="Celular">Celular</option>
                <option value="Tablet">Tablet</option>
            </select>
        </div>

        <div class="form-group col-md-3 col-3">
            <label for="marca">Marca</label>
            <input type="text" name="marca" id="marca" class="form-control">
        </div>

        <div class="form-group col-md-3 col-3">
            <label for="modelo">Modelo</label>
            <input type="text" name="modelo" id="modelo" class="form-control">
        </div>

        <div class="form-group col-md-3 col-3">
            <label for="num_serie">N°Serie</label>
            <input type="text" name="num_serie" id="num_serie" class="form-control">
        </div>

    </div>

    <div class="form-row">
        <div class="form-group col-6">
            <label for="defeito">Defeito</label>
            <textarea id="defeito" class="form-control" rows="4" name="defeito"></textarea>
        </div>
        <div class="form-group col-6">
            <label for="solucao">Solução</label>
            <textarea id="solucao" class="form-control" rows="4" name="solucao"></textarea>
        </div>
    </div>

    <div class="form-row">
        <h2 class="col-6 text-center pt-2">Valor</h2>
        <input type="text" name="valor" id="valor" class="col-3 form-control mt-2">
    </div>
    <div class="text-center my-4">
        <button class="btn btn-lg btn-primary text-center">Criar</button>
    </div>
</form>

<?php require_once "include/footer.php";?>
