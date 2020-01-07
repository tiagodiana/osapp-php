<?php 
require_once "include/cabecalho.php";
require_once "include/menu.php";
require_once "include/dompdf.php";

// SEPARANDO O ID DO NOME
if(isset($_POST['cliente'])){
$nomeid = empty($_POST['cliente']) ? Null : $_POST['cliente'];
$nomeid = explode('+', $nomeid);

$id_cliente = $nomeid[0];
$nome_cliente = $nomeid[1];
}

$tipo = empty($_POST['tipo']) ? Null : $_POST['tipo'];
$marca = empty($_POST['marca']) ? "Não Informado" : $_POST['marca'];
$modelo = empty($_POST['modelo']) ? "Não Informado" : $_POST['modelo'];
$num_serie = empty($_POST['num_serie']) ? "Não Informado" : $_POST['num_serie'];
$defeito = empty($_POST['defeito']) ? Null : $_POST['defeito'];
$solucao = empty($_POST['solucao']) ? Null : $_POST['solucao'];
$valor = empty($_POST['valor']) ? 0 : $_POST['valor'];

if(isset($_POST['concluir'])){
    $nome_cliente = $_POST['nome_cliente'];
    $id_cliente = $_POST['id_cliente'];
    $sql = "INSERT INTO ordem VALUES(0,'$tipo', '$marca', '$modelo', '$num_serie', '$defeito', '$solucao', $valor, 0,$id_cliente,'$data',null)";
    if(mysqli_query($conn,$sql)){
        $id_os = mysqli_insert_id($conn);
        echo "<div class='alert alert-success text-center'>";
        echo "<h2>Ordem de Serviço Salva com Sucesso Preparando Impressão</h2>";
        echo "</div>";
        echo "<meta http-equiv='Refresh' content='2; imprimir_os.php?id_cliente=$id_cliente&id_os=$id_os'>";
    }
    else{
        echo "<div class='alert alert-danger text-center'>";
        echo "<h2>ERRO ao Salvar</h2>";
        echo "</div>";
        echo "ERRO" . "<br>" . $sql . "<br>". mysqli_error($conn);
    }


}
?>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" class="col-12 col-md-10 mx-auto my-5">
<h2 class="py-4 mx-auto bg-light text-center mb-4">Ordem de Serviço</h2>
	<div class="form-group">
		<label for='cliente'>Cliente</label>
		<input type="text" name="id_cliente" class="form-control" value="<?php echo $id_cliente;?>" readonly hidden>
		<input type="text" name="nome_cliente" class="form-control" value="<?php echo $nome_cliente;?>" readonly style="background:none;">
	</div>

	<div class="form-row ">
        <div class="form-group col-md-3 col-3">
            <label for="tipo">Tipo</label>
            <input type="text" name="tipo" id="tipo" class="form-control" value="<?php echo $tipo; ?>" readonly style="background:none;">
        </div>

        <div class="form-group col-md-3 col-3">
            <label for="marca">Marca</label>
            <input type="text" name="marca" id="marca" class="form-control" value="<?php echo $marca;?>" readonly style="background:none;">
        </div>

        <div class="form-group col-md-3 col-3">
            <label for="modelo">Modelo</label>
            <input type="text" name="modelo" id="modelo" class="form-control" value="<?php echo $modelo;?>" readonly style="background:none;">
        </div>

        <div class="form-group col-md-3 col-3">
            <label for="num_serie">N° Serie</label>
            <input type="text" name="num_serie" id="num_serie" class="form-control" value="<?php echo $num_serie;?>" readonly style="background:none;">
        </div>

    </div>

    <div class="form-row">
        <div class="form-group col-6">
            <label for="defeito">Defeito</label>
            <textarea id="defeito" name="defeito" class="form-control" rows="4" readonly style="background:none;"><?php echo $defeito;?></textarea>
        </div>
        <div class="form-group col-6">
            <label for="solucao">Solução</label>
            <textarea id="solucao" name="solucao" class="form-control" rows="4" readonly style="background:none;"><?php echo $solucao;?></textarea>
        </div>
    </div>

    <div class="form-row ">
        <h2 class="col-5 offset-1 text-center pt-2">Valor</h2>
        <h2 class="col-1 text-right pt-2 mr-2">R$</h2>
        <input class="col-3" type="text" name="valor" id="valor" value="<?php echo $valor;?>" readonly style="background: none; border: none; font-size: 24pt;">
    </div>
    <div class="form-group">
        <input type="text" name="data" id="data" class="form-control " value="<?php echo "Data de Entrada   " . exibiData($data)?>" readonly style="background:none;border: none; font-size: 14pt;">
    </div>
    <div class="text-center my-4">
        <input type="submit" name="concluir" class="btn btn-lg btn-primary" value="Concluir">
        <a href="nova_os.php" class="btn btn-lg btn-danger">Voltar</a>
    </div>
</form>
<?php require_once "include/footer.php";?>
