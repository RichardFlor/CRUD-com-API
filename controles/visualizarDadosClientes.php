<?php 
/*************************************************************************
    Objetivo: Arquivo responável por buscar um registro para exibir na modal do visualizar
    Data: 21/10/2021
    Autor: Richard
*************************************************************************/

function visualizarCliente($id)
{
      //Import do arquivo de configuração de varaiveis e constantes
      require_once('functions/config.php');

      //Import do arquivo para exluir no BD
      require_once(SRC.'bd/listarClientes.php');
  
      
    //Recebe o id enviado como argumento na função
      $idCliente = $id;
      
      //Chama a fnção para busca de id do cliente
      $dadosCliente = buscar($idCliente);
      
      //Converte o resultado do BD em um array
      //através mysli_fetch_assoc
      if($rsCliente=mysqli_fetch_assoc($dadosCliente))
            return $rsCliente;
                else
            return false;
}



?>