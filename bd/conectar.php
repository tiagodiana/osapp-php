<?php
require_once "funcoes.php";


global $conn;
$conn = mysqli_connect('localhost','root', '1872','os');

if(!$conn){
	echo "ERRO";
}

mysqli_set_charset($conn, 'utf8');


