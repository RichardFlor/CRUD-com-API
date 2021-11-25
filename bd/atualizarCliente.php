<?php 
/*******************************************
    Objetivo: Atualizar dados de um Cliente existente no Banco de Dados 
    Data: 13/10/2021
    Autor: Richard
********************************************/
//Import do arquivo de configuração de varaiveis e constantes
require_once('../bd/conexaoMysql.php');

function editar ($arrayCliente)
{
    $sql = "update tblcliente set 
            nome = '".$arrayCliente['nome']."',
            telefone = '".$arrayCliente['telefone']."',
            celular = '".$arrayCliente['celular']."',
            rg = '".$arrayCliente['rg']."',
            cpf = '".$arrayCliente['cpf']."',
            email = '".$arrayCliente['email']."',
            obs = '".$arrayCliente['obs']."',
            idEstado = ".$arrayCliente['idEstado'].",
            foto = '".$arrayCliente['foto']."'

            where idcliente = ".$arrayCliente['id'];
           
           
            

     //Chamando a função que estabelece a conexão com o BD 
     $conexao = conexaoMysql();
     //Envia o script SQL para o BD
     if (mysqli_query($conexao, $sql))
         return true; //Retorna verdadeiro se o registro for inserido no BD
     else
         return false; //Retorna falso se houver algum problema
    
}

?>