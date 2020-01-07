<?php
require_once 'include/cabecalho.php';
require_once 'include/menu.php';

    //Se os dados forem alterados com sucesso
    if(isset($_GET['status']) && $_GET['status'] == 'alteradosucesso') {
        echo "<div class='alert alert-success text-center'><h2>Registro Alterado Com Sucesso!!</h2></div>";
        echo "<meta http-equiv='Refresh' content='1; busca_user.php'>";
    }

    //Se der erro na alteração avisa o usuario
    if(isset($_GET['status']) && $_GET['status'] == 'alteradoerro'){
        echo "<div class='alert alert-danger text-center'><h2>ERRO ao alterar o Registro</h2></div>";
        echo "<meta http-equiv='Refresh' content='1; busca_user.php'>";
    }

    //Se status for alterar Exibira os dados do cliente e o botao se muda para alterar
    if(isset($_GET['status']) && $_GET['status'] == 'alterar'){
        $nome = empty($_GET['nome'])?null: $_GET['nome'];
        $cpf = empty($_GET['cpf'])?null: $_GET['cpf'];


        //Fazendo Busca pelo nome
        if(empty($cpf)){
            $sql = "SELECT * FROM clientes WHERE nome LIKE '$nome'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            //Verificando se o registro existe, se não existir retorna a busca
            if(empty($data)){
                echo "<div class='alert alert-secondary text-center'><h2>Não existem Registros</h2></div>";
                echo "<meta http-equiv='Refresh' content='1; busca_user.php'>";
                exit();
            }

            //Fazendo busca pelo CPF
        }else if(empty($nome)){
            $sql = "SELECT * FROM clientes WHERE cpf LIKE '$cpf'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            //Verificando se o registro existe, se não existir retorna a busca
            if(empty($data)){
                echo "<div class='alert alert-secondary text-center'><h2>Não existem Registros</h2></div>";
                echo "<meta http-equiv='Refresh' content='1; busca_user.php'>";
                exit();
            }
        }
        $id_cliente = $data['id'];
        $sql = "SELECT * FROM ordem WHERE id_cliente=$id_cliente";
        $os_result = mysqli_query($conn, $sql);
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="mt-5 col-md-8 col-12 mx-auto border py-4 bg-light font-arial">
            <input type="text" name="id" value="<?php echo $data['id'] ?>" hidden>
            <h2 class="py-2 mx-auto bg-light text-center">Alterar Dados do Cliente</h2>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="nome">Nome Completo</label>
                    <input class="form-control" type="text" name="nome" id="nome" value="<?php echo $data['nome']?>" required>
                </div>
                <div class="form-group col-6">
                    <label for="cpf">CPF</label>
                    <input class="form-control" type="text" name="cpf" id="rg" value="<?php echo $data['cpf']?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-6">
                    <label for="telefone">Telefone</label>
                    <input class="form-control" type="text" name="telefone" id="telefone" value="<?php echo $data['telefone']?>" >
                </div>
                <div class="form-group col-6">
                    <label for="celular">Celular</label>
                    <input class="form-control" type="text" name="celular" id="celular" value="<?php echo $data['celular']?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-8">
                    <label for="rua">Rua</label>
                    <input class="form-control" type="text" name="rua" id="rua" value="<?php echo $data['rua']?>" required>
                </div>
                <div class="form-group col-4">
                    <label for="bairro">Bairro</label>
                    <input class="form-control" type="text" name="bairro" id="bairro" value="<?php echo $data['bairro']?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-6">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="form-control" value="<?php echo $data['cidade']?>" required>
                </div>

                <div class="form-group col-2">
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" id="estado" class="form-control" value="<?php echo $data['estado']?>" required>
                </div>

                <div class="form-group col-4">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" id="cep" class="form-control" value="<?php echo $data['CEP']?>" >
                </div>
            </div>

            <div class="text-center my-3">
                <input type="submit" class="btn btn-lg btn-primary" name="alterar" value="Alterar">
                <a href="busca_user.php" class="btn btn-lg btn-danger">Voltar</a>
            </div>
        </form>
        <?php
        echo "<div class='list-group col-md-8 mx-auto  col-12 font-arial text-center pr-0'>";
        if(mysqli_num_rows($os_result) > 0){
            while($result=mysqli_fetch_assoc($os_result)){
                if($result['status']){
                echo "<a href='busca_os.php?num_os=".$result['id_os']."' class='list-group-item list-group-item-action list-group-item-success'>Ordem de Serviço #". $result['id_os'] ."</a>";
                }
                else{
                    echo "<a href='busca_os.php?num_os=".$result['id_os']."' class='list-group-item list-group-item-action list-group-item-danger'>Ordem de Serviço #". $result['id_os'] ."</a>";
                }
            }
        }
        else{
            echo"<br>";
            echo "Não existe Ordem de Serviço para esse cliente";
        }


        echo "</div>";
        require_once "include/footer.php";?>
    <?php
    }
    else{?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="mt-5 col-md-8 col-12 mx-auto border py-4 bg-light font-arial">
            <h2 class="py-2 mx-auto bg-light text-center">Buscar Cliente</h2>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="nome">Nome Completo</label>
                    <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome Completo para a Busca" >
                </div>
                <div class="form-group col-6">
                    <label for="cpf">CPF</label>
                    <input class="form-control" type="text" name="cpf" id="rg" placeholder="CPF do Cliente" >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-6">
                    <label for="telefone">Telefone</label>
                    <input class="form-control" type="text" name="telefone" id="telefone" disabled>
                </div>
                <div class="form-group col-6">
                    <label for="celular">Celular</label>
                    <input class="form-control" type="text" name="celular" id="celular" disabled="">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-8">
                    <label for="rua">Rua</label>
                    <input class="form-control" type="text" name="rua" id="rua" disabled>
                </div>
                <div class="form-group col-4">
                    <label for="bairro">Bairro</label>
                    <input class="form-control" type="text" name="bairro" id="bairro" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-5">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="form-control" disabled>
                </div>

                <div class="form-group col-3">
                    <label for="estado">Estado</label>
                    <select class="custom-select" name="estado" disabled>
                        <option value="SP">SP</option>

                    </select>
                </div>

                <div class="form-group col-4">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" id="cep" class="form-control" disabled>
                </div>
            </div>

            <div class="text-center my-3">
                <input type="submit" class="btn btn-lg btn-primary" name="buscar" value="Buscar">
            </div>
        </form>
<?php require_once "include/footer.php";?>

<?php
    }

    if(isset($_POST['nome']) || isset($_POST['cpf'])){
        $nome = empty($_POST['nome'])?null: $_POST['nome'];
        $cpf = empty($_POST['cpf'])?null: $_POST['cpf'];

        //Realizando buscar pelo nome
        if(isset($_POST['buscar']) && empty($cpf)){
          echo "<meta http-equiv='Refresh' content='0; busca_user.php?status=alterar&nome=$nome'>";
        }

        //Realizando busca pelo cpf do cliente
        if(isset($_POST['buscar']) && empty($nome)){
            echo "<meta http-equiv='Refresh' content='0; busca_user.php?status=alterar&cpf=$cpf'>";
        }

        //Alterando dados do cliente
        if(isset($_POST['alterar'])){
            $id = $_POST['id'];
            $telefone = $_POST['telefone'];
            $celular = $_POST['celular'];
            $rua = $_POST['rua'];
            $bairro = $_POST['bairro'];
            $cidade = $_POST['cidade'];
            $estado = $_POST['estado'];
            $cep = $_POST['cep'];
            $sql = "UPDATE clientes SET nome='$nome', cpf='$cpf', telefone='$telefone', celular='$celular', rua='$rua', bairro='$bairro',cidade='$cidade', estado='$estado', cep='$cep' WHERE id = $id";
            if(mysqli_query($conn, $sql)){
                echo "<meta http-equiv='Refresh' content='0; busca_user.php?status=alteradosucesso'>";
            }
            else{
                echo "<meta http-equiv='Refresh' content='0; busca_user.php?status=alteradoerro'>";

            }
        }
    }
?>




