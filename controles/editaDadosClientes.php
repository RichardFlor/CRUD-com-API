<?php 
/*******************************************
    Objetivo: Arquivo responsável por receber o id do Cliente e
    encaminhar para a função que irá buscar os dados
    Data: 06/019/2021
    Autor: Richard

********************************************/
    
    //Import do arquivo de configuração de varaiveis e constantes
    require_once('../functions/config.php');

    //Import do arquivo para exluir no BD
    require_once(SRC.'bd/listarClientes.php');

    //O id esta sendo encaminhado pela index, no link que foi realizado na imagem do excluir
    $idCliente = $_GET['id'];

    
    
    //Chama a fnção para busca de id do cliente
    $dadosCliente = buscar($idCliente);
    
    //Converte o resultado do BD em um array
    //através mysli_fetch_assoc
    if($rsCliente=mysqli_fetch_assoc($dadosCliente))
    {
        //Ativa a atualizção de variaveis de sessão
        //(são variaveis) globais
        session_start();
        
        //Criamos uma variavel de sessão para guardar o array
        //com os dados do cliente que retornou o BD
        $_SESSION['cliente'] = $rsCliente;
        
        //Permite chamar um arquivo como se fosse um link,
        //através do php
        header('location:../index.php');
    }

    //Chama a função buscar e encaminha o ID que será localizado do BD
    //if(buscar($idCliente))
        //echo(BD_MSG_EXCLUIR);
    else
        echo("
                <script>
                    alert('". BD_MSG_ERRO ."');
                    window.history.back(); 
                </script>
            ");




?>