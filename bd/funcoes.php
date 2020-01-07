<?php

function todosClientes($conn){
    $sql ="SELECT id, nome FROM clientes ORDER BY nome";
    $result = mysqli_query($conn, $sql);
    return $result;
}