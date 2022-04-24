<!DOCTYPE html>
<?php
    include_once "acao.php";
    
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $obj = isset($_GET["obj"]) ? $_GET["obj"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    if($acao == "editar"){
        if($id > 0){
            $dados = buscarDados($id, $obj);
        }
    }

    $title = "Cadastro de Pessoa Física";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>
<body>
    <a href="index.php">Voltar à página principal</a> |
    <?php echo $title; ?><br>
    <br>
    <form action="acao.php?id=<?php echo $id; ?>" method="post">
        Nome: <input required="true" type="text" name="nome" value="<?php if($acao == "editar") echo $dados["nome"]; ?>"><br>
        <br>
        CPF: <input required="true" type="text" name="cpf" value="<?php if($acao == "editar") echo $dados["cpf"]; ?>"><br>
        <br>
        Data de nascimento: <input required="true" type="date" name="dataNascimento" value="<?php if($acao == "editar") echo $dados["dataNascimento"]; ?>"><br>
        <br>
        <button type="submit" name="acao" value="pessoa_fisica">Salvar</button>
    </form>
</body>
</html>