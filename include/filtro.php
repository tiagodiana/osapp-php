<?php
date_default_timezone_set('America/Sao_Paulo');
global $data;
$data = date('o-m-d G:i:s');

//FUNÇÃO PARA EXIBIR A DATA E HORA
function exibiData($data){
    $temp = $data;
    $data_split = explode(" ",$temp);
    $data = $data_split[0];
    $hora = $data_split[1];
    $data_split = explode("-", $data);
    $data = $data_split[2] . "-" . $data_split[1] . "-" . $data_split[0][2] . $data_split[0][3];
    $data_hora = $hora . " " . $data;
    return $data_hora;
}
