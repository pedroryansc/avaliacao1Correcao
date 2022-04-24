<!DOCTYPE html>
<?php

    require_once("utils.php");

    $title = "Operação de Saque/Depósito";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>
<body>
    <h3><a href="../../index.php">Voltar à página principal</a> |
    <?php echo $title; ?></h3>
    <br>
    <form action="ctrl_operacoes.php" method="post">
        <fieldset>
            <label for="cc_pf_id">Pessoa:</label>
            <select name="cc_pf_id">
                <?php
                    require_once("ctrl_cc.php");
                    echo lista_pessoa(0);
                ?>
            </select>
            <br>
            <label for="cc_numero">Conta Corrente:</label>
            <select name="cc_numero">
                <?php
                    $pessoa = isset($_POST["cc_pf_id"]) ? $_POST["cc_pf_id"] : 0;
                    require_once("ctrl_operacoes.php");
                    echo lista_conta_corrente($pessoa);
                ?>
            </select>
            <br>
            <label for="operacao">Operação:</label> <input type="radio" name="operacao" value="saque">Saque
                                                    <input type="radio" name="operacao" value="deposito">Depósito
            <br>
            <label for="valor">Valor:</label><input type="text" name="valor"><br>
            <button type="submit" name="acao" value="salvar">Salvar</button>
        </fieldset>
    </form>
</body>
</html>