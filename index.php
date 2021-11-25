<?php 
    //Ativa a tilização de variaveis de sessão
    session_start();

    //Declaração das variaveis para o formulário
    $nome = (string) null;
    $telefone = (string) null;
    $celular = (string) null;
    $rg = (string) null;
    $cpf = (string) null;
    $email = (string) null;
    $obs = (string) null;
    $id = (int) 0;
    //Variavel Foto para editar
    $foto = (string) 'semfoto.png';
    //Variaveis para trazer os valores do Estado para edição
    $idEstado = (int) null;
    $sigla = (string) "Selecione um Item";
    //Essa variavel será utilizada para de para definir
    //o modo de manipulação com o banco de dados 
    //(Salvar = será feito o insert
    //Atualizar = será feito o update)
    $modo = (string) "Salvar";


    //import do arquivo de configuração de variaveis e constantes
    require_once('functions/config.php');

    //require_once(SRC.'bd/conexaoMysql.php');
    //conexaoMysql();

    require_once(SRC.'controles/exibeDadosClientes.php');

    //import do arquivo que lista todos os estados do banco de dados 
    require_once(SRC.'controles/listarDadosEstados.php');


    //Varifica a existencia da variavel de sessão 
    //que usamos para trazer os dados para o editar
    if(isset($_SESSION['cliente']))
    {
        $id = $_SESSION['cliente']['idcliente'];
        $nome = $_SESSION['cliente']['nome'];
        $telefone = $_SESSION['cliente']['telefone'];
        $celular = $_SESSION['cliente']['celular'];
        $rg = $_SESSION['cliente']['rg'];
        $cpf = $_SESSION['cliente']['cpf'];
        $email = $_SESSION['cliente']['email'];
        $obs = $_SESSION['cliente']['obs'];
        $idEstado = $_SESSION['cliente']['idEstado'];
        $sigla = $_SESSION['cliente']['sigla'];
        $foto = $_SESSION['cliente']['foto'];
        $modo = "Atualizar";
        
        //Elimina um objeto, variavel da memória
        unset($_SESSION['cliente']);
    }
    
    //var_dump($_SESSION['cliente']);
    //echo($_SESSION['cliente']['nome']);
    
?>

<!DOCTYPE>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title> Cadastro </title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <script src="js/jquery.js"> </script>

        <script>
            $(document).ready(function(){

                //Formata uma propriedade de css ao carregar da página 
                $('#containerModal').css('display','none');
                

               

                //Abre a Modal
                $('.pesquisar').click(function(){
                  $('#containerModal').slideToggle(1000);
                    
                  //Recebe o id do Cliente que foi adicionado pelo data atributo no HTML
                  let idCliente = $(this).data('id');

                
                  //Realiza uma requisição para consumir dados de uma outra página   
                  $.ajax({
                     type:"GET",//Tipo de requisição (GET, POST PUT, etc)
                     url: "visualizarDados.php", //URL da página que será consumida/utilizada
                     data: {id:idCliente},
                     success: function(dados){ //Se a requisição der certo, iremos receber o conteudo iremos receber o conteudo na variavel dados 
                
                         $('#modal').html(dados); //Exibe dentro da div MODAL

                    }
                  });
                 });
                 //Fechar a Modal
                 $('#fecharModal').click(function(){
                   $('#containerModal').fadeOut();
                 });
            });
        </script>
    </head>
    <body>
        <div id="containerModal">
            <span id="fecharModal"><img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir"></span>
            <div id="modal">
                
            </div>
        </div>
        <div id="cadastro"> 
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Contatos </h1>
            </div>
            <div id="cadastroInformacoes">
                <!-- 
                    Principais elementos de formulário para HTML5
                    <input type = "tel"> indica que a caixa recebe um telefone
                    <input type = "email"> indica que a caixa recebe um email com o minimo necessário para ser um email (@)
                    <input type = "url"> indica que a caixa recebe uma URL válida (http://)
                    <input type = "number"> indica que a caixa recebe apenas numeros inteiros
                    <input type = "range"> cria um elemento tipo barra de rolagem horizontal
                    <input type = "color"> cria uma paleta de cor para escolha do usuário
                    <input type = "date"> Cria um calendário para escolha da data
                    <input type = "month"> Cria um calendário para escolha somente do mes e ano
                    <input type = "week"> Cria um calendário que retorna o numero da semana do ano

                -->

                <!--As variaveis modo e id, foram utilizadas no action do form, são responsaveis por encaminhar para a pagina recebeDadosClientes.php
                    duas informações:
                    modo - que é responsável por definir se é para inserir ou atualizar
                    id - que é responsável por identificar o registro a ser atualizado no Banco de Dados   
                
                    03/11/2021
                    enctype="multipart/form-data"  é obrigatorio ser utilizado quando for trabalhar com imagens 

                    Obs: (Para trabalhar com a input type="file") é obrigatorio utilizar o metodo POST
                -->

                <form enctype="multipart/form-data" action="controles/recebeDadosClientes.php?modo=<?=$modo?>&id=<?=$id?>&nomeFoto=<?=$foto?>" name="frmCadastro" method="post" >
                   
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Nome: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNome" value="<?=$nome?>" placeholder="Digite seu Nome" maxlength="100">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Foto: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="file" name="fleFoto" accept="image/jpeg, image/jpg, image/png">
                        </div>
                        <div id="visualizarFoto">
                        <img src="<?=NOME_DIRETORIO_FILE.$foto?>">
                        </div>
                    </div>

                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Estado: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <select name="sltEstado">
                                <option selected value="<?=$idEstado?>"><?=$sigla?></option>
                                <?php

                                    //Chama a função que vai buscar todos os estados no Banco de Dados 
                                    $listEstados = exibirEstados();

                                    //Repetição para exibir os dados do Banco de Dados
                                    while ($rsEstados = mysqli_fetch_assoc($listEstados))
                                    {
                                        ?>
                                        <option value="<?=$rsEstados['idEstado']?>"><?=$rsEstados['sigla']?> </option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Telefone: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtTelefone" value="<?=$telefone?>" placeholder="Digite seu Telefone">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Celular: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtCelular" value="<?=$celular?>" placeholder="Digite seu Celular">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> RG: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtRg" value="<?=$rg?>" maxlength="20" placeholder="Digite seu RG">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> CPF: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtCpf" value="<?=$cpf?>" maxlength="20" placeholder="Digite seu CPF">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> E-mail: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="email" name="txtEmail" value="<?=$email?>" placeholder="Digite seu E-mail">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Observações: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <textarea name="txtObs" cols="50" rows="7"><?=$obs?></textarea>
                        </div>
                    </div>
                    <div class="enviar">
                        <div class="enviar">
                            <input type="submit" name="btnEnviar" value="<?=$modo?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="consultaDeDados">
            <table id="tblConsulta" >
                <tr>
                    <td id="tblTitulo" colspan="6">
                        <h1> Consulta de Dados.</h1>
                    </td>
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas destaque"> Nome </td>
                    <td class="tblColunas destaque"> Celular </td>
                    <td class="tblColunas destaque"> Email </td>
                    <td class="tblColunas destaque"> Foto </td>
                    <td class="tblColunas destaque"> Opções </td>
                </tr>
                
                <?php 
                    $dadosClientes = exibirClientes();
                    
                    while ($rsClientes=mysqli_fetch_assoc($dadosClientes))
                    {
                ?>
                <tr id="tblLinhas">
                    <td class="tblColunas registros"><?=$rsClientes['nome']?></td>
                    <td class="tblColunas registros"><?=$rsClientes['celular']?></td>
                    <td class="tblColunas registros"><?=$rsClientes['email']?></td>
                    <td class="tblColunas registros">
                       <img class="foto" src="<?=NOME_DIRETORIO_FILE.$rsClientes['foto']?>"> </td>
                    <td class="tblColunas registros">   
                        <a href="controles/editaDadosClientes.php?id=<?=$rsClientes['idcliente']?>">
                        <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                        </a>
                        <a onclick="return confirm('Tem certeza que deseja excluir?');" href="controles/excluiDadosClientes.php?id=<?=$rsClientes['idcliente']?>&foto=<?=$rsClientes['foto']?>">
                            <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                        </a>    
                        <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar" data-id="<?=$rsClientes['idcliente']?>">
                    </td>
                </tr>
                <?php 
                    } 
                ?>
            </table>
        </div>
    </body>
</html>