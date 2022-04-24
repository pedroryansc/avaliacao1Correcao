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

    $title = "Cadastro de Contato";
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
        Tipo: <input required="true" type="text" name="tipo" value="<?php if($acao == "editar") echo $dados["tipo"]; ?>"><br>
        <br>
        Descrição: <input required="true" type="text" name="descricao" value="<?php if($acao == "editar") echo $dados["descricao"]; ?>"><br>
        <br>
        Pessoa Física: <select name="pessoaFisica">
                            <?php
                                $pdo = Conexao::getInstance(); 
                                $consulta = $pdo->query("SELECT * FROM pessoa_fisica");
                                while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                            ?>
                            <option value="<?php echo $linha["pf_id"]; ?>" <?php if($acao == "editar" && $dados["pessoaFisica"] == $linha["pf_id"]) echo "selected"; ?>>
                                <?php echo $linha['pf_nome']; ?>
                            </option>
                            <?php
                                }
                            ?>
                        </select><br>
        <br>
        <button type="submit" name="acao" value="contatos">Salvar</button>
    </form>
</body>
</html>