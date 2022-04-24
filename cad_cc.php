<!DOCTYPE html>
<?php
    include_once "acao.php";
    
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $obj = isset($_GET["obj"]) ? $_GET["obj"] : "";
    $id = isset($_GET["numero"]) ? $_GET["numero"] : 0;

    if($acao == "editar"){
        if($id > 0){
            $dados = buscarDados($id, $obj);
        }
    }

    $title = "Cadastro de Conta Corrente";
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
        Número: <input required="true" type="text" name="numero" value="<?php if($acao == "editar") echo $dados["numero"]; ?>"><br>
        <br>
        Saldo: R$<input required="true" type="text" name="saldo" value="<?php if($acao == "editar") echo $dados["saldo"]; ?>"><br>
        <br>
        Pessoa Física: <select name="pessoaFisica">
                            <?php
                                /*
                                Resolução da 1ª avaliação:
                                - Forma alternativa:

                                    require_once("conexao.php");
                                    $query = "SELECT * FROM pessoa_fisica";
                                    $resultado = $conexao->query($query);
                                    foreach($resultado->fetchAll() as $linha){
                                ?>
                                <option value="<?=$linha["pf_id]?>"><?=$linha["pf_nome"]?>
                                <?php
                                    }
                                ?>

                                - Consulta com classes:
                                */

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
        Data da última alteração: <input required="true" type="date" name="ultimaAlt" value="<?php if($acao == "editar") echo $dados["ultimaAlt"]; ?>"><br>
        <br>
        <button type="submit" name="acao" value="contaCorrente">Salvar</button>
    </form>
</body>
</html>