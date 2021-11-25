<?php
/*******************************************
    Objetivo: Arquivo responsavel por receber o ID do cliente e exclui do banco de dados
    Data: 25/11/2021
    Autor: Richard
********************************************/

  //Import do arquivo para exluir no BD
  require_once(SRC.'bd/excluirCliente.php');

  
function excluirClienteAPI($id)
{
    //Fazer Tratamento de dados para consistencia
    //...

    if (excluir($id))
        return true;
    else 
        return false;

}

?>