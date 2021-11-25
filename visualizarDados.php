<?php 
    //Import do arquivo para buscar os dados do cliente 
    require_once('controles/visualizarDadosClientes.php');

    //Recebe o id enviado pelo AJAX na pagina da index
    $id = $_GET['id'];

    //Chama a função para buscar no Banco de Dados
    $dadosCliente = visualizarCliente($id);

   
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
   <title>Visualizar</title>
</head>
<body>
    <table>
        <tr>
            <td>Nome:</td>
            <td><?=$dadosCliente['nome']?></td>
        </tr>
        <tr>
            <td>Telefone:</td>
            <td><?=$dadosCliente['telefone']?></td>
        </tr>
        <tr>
            <td>Celular:</td>
            <td><?=$dadosCliente['celular']?></td>
        </tr>
        <tr>
            <td>RG:</td>
            <td><?=$dadosCliente['rg']?></td>
        </tr>
        <tr>
            <td>CPF:</td>
            <td><?=$dadosCliente['cpf']?></td>
        </tr>
        <tr>
            <td>E-mail:</td>
            <td><?=$dadosCliente['email']?></td>
        </tr>
        <tr>
            <td>Observações:</td>
            <td><?=$dadosCliente['obs']?></td>
        </tr>
    </table>
</body>
</html>