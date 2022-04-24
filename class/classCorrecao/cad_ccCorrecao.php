<!DOCTYPE html>
<?php
    $title = "Cadastro de Conta Corrente";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>
<body>
    <a href="../../index.php">Voltar à página principal</a> |
    <?php echo $title; ?><br>
    <br>
    <form action="ctrl_cc.php" method="post">
        Número: <input type="text" name="numero"><br>
        <br>
        Saldo: R$<input type="text" name="saldo"><br>
        <br>
        Pessoa Física: <select name="pf_id">
                            <?php
                                require_once("utils.php");
                                echo lista_pessoa(0);
                            ?>
                        </select><br>
        <br>
        Data da última alteração: <input type="date" name="dt_ultima_alteracao"><br>
        <br>
        <button type="submit" name="acao" value="salvar">Salvar</button>
    </form>
</body>
</html>