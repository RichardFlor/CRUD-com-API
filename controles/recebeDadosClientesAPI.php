<?php 
    /*******************************************
     Objetivo: Arquivo responsável por receber dados da API (POST ou PUT)
    Data: 24/11/2021
    Autor: Richard
********************************************/
//import do arquivo de configuração
require_once('../functions/config.php');

//import do arquivo que vai inserir no Bando de Dados 
require_once(SRC. 'bd/inserirCliente.php');

require_once(SRC. 'bd/atualizarCliente.php');

require_once(SRC. 'bd/excluirCliente.php');





//Função para inserir dados no Banco de Dados via POST da API
function inserirClienteAPI($arrayDados)
{
    //Fazer Tratamento de dados para consistencia
    //...

    if (inserir($arrayDados))
        return true;
    else 
        return false;

}

//Função para atualizar dados no Banco de Dados via PUT da API
function atualizarClienteAPI($arrayDados, $id)
{
    //Cria um novo array apenas com o ID
    $novoItem = array("id" => $id);

    //Acrescenta o array do novo item no arrayDados, fazendo uma mesclagem de chaves
    $arrayCliente = $arrayDados + $novoItem; 

    //Fazer Tratamento de dados para consistencia
    //...

    if (editar($arrayCliente))
        return true;
    else 
        return false;

}



//Função enviada para excluirDadosClientesAPO.php


// function excluirClienteAPI($id)
// {
//     //Fazer Tratamento de dados para consistencia
//     //...

//     if (excluir($id))
//         return true;
//     else 
//         return false;

// }


?>