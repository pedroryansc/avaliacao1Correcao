<?php
    //ctrl_cc -> Controle-conta-corrente

    require_once("PessoaFisicaCorrecao.php");
    require_once("ContaCorrenteCorrecao.php");
    
    if($_POST["acao"] == "salvar"){
        $numero = isset($_POST["numero"]) ? $_POST["numero"] : "";
        $saldo = isset($_POST["saldo"]) ? $_POST["saldo"] : "";
        $pf_id = isset($_POST["pf_id"]) ? $_POST["pf_id"] : 0;
        $dt_ultima_alteracao = isset($_POST["dt_ultima_alteracao"]) ? $_POST["dt_ultima_alteracao"] : "";
        try{
            $contaCorrente = new ContaCorrente($_POST["numero"], $_POST["saldo"], $_POST["pf_id"], $_POST["dt_ultima_alteracao"]);
            $contaCorrente->insere();
        }catch(Exception $e){
            echo "<h1>Erro ao cadastrar conta.</h1>
            <br>
            Erro:".$e->getMessage();
        }
    }
?>