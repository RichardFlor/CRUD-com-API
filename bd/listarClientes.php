<?php 
/*************************************************************************
    Objetivo: Listar todos os dados de Clientes do Banco de Dados
    Data: 23/09/2021
    Autor: Richard
*************************************************************************/
//Import do arquivo de conexão com o BD
require_once(SRC.'bd/conexaoMysql.php');

//retorna todos os reegistros existentes no banco 
function listar ()
{
    $sql = "select tblcliente.*, tblEstado.sigla 
    from tblcliente
    inner join tblEstado 
    on tblEstado.idEstado = tblCliente.idEstado order by idcliente desc";
    
    //Abre a conexão com o BD
    $conexao = conexaoMysql();
    
    //Solicita aoBD a execução do script SQL
    $select = mysqli_query($conexao, $sql);
    
    return $select;
    
}
//Retorna apenas um registro, com base no id 
function buscar ($idCliente)
{
    $sql = "select tblcliente.*, tblEstado.sigla 
                from tblcliente
	            inner join tblEstado 
		        on tblEstado.idEstado = tblCliente.idEstado
     where tblcliente.idcliente = ".$idCliente;
    
    //Abre a conexão com o BD
    $conexao = conexaoMysql();
    
    //Solicita aoBD a execução do script SQL
    $select = mysqli_query($conexao, $sql);
    
    return $select;
}

//Retorna a lista de registros com filtro pelo nome do cliente
function buscarNome ($nome)
{
    $sql = "select tblcliente.*, tblEstado.sigla 
                from tblcliente
	            inner join tblEstado 
		        on tblEstado.idEstado = tblCliente.idEstado
     where tblcliente.nome like '%".$nome."%'";
    
    //Abre a conexão com o BD
    $conexao = conexaoMysql();
    
    //Solicita aoBD a execução do script SQL
    $select = mysqli_query($conexao, $sql);
    
    return $select;

}

?>