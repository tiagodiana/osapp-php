<?php
require_once "include/cabecalho.php";

$id_os = empty($_GET['id_os']) ? Null : $_GET['id_os'];
$id_cliente = empty($_GET['id_cliente']) ? Null : $_GET['id_cliente'];

//Criando o array associativo
$sql = "SELECT * FROM ordem INNER JOIN clientes on ordem.id_cliente = clientes.id WHERE ordem.id_os = $id_os";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$json = json_encode($data,JSON_UNESCAPED_UNICODE);

echo "<iframe src='include/dompdf.php?dados=$json' style='width: 100%; height: 585px'></iframe>";

//=======================================
?>

<div class="text-center bg-dark py-3" >
    <a href='index.php' class='btn btn-lg btn-primary'>Voltar ao Inicio</a>
</div>

