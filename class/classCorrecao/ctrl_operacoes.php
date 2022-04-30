<?php
    require_once("ContaCorrenteCorrecao.php");

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
    
    if($acao == "salvar"){
        $cc_pf_id = isset($_POST["cc_pf_id"]) ? $_POST["cc_pf_id"] : 0;
        $cc_numero = isset($_POST["cc_numero"]) ? $_POST["cc_numero"] : "";
        $operacao = isset($_POST["operacao"]) ? $_POST["operacao"] : "";
        $valor = isset($_POST["valor"]) ? $_POST["valor"] : 0;
        $contaCorrente = new ContaCorrente(1, 1, 1, 1);
        if($operacao == "saque"){
            $lista = $contaCorrente->buscar($cc_numero);
            $vetor = converteParaArray($lista);
            $contaCorrente->saque($vetor, $valor, $cc_numero);
            header("location:../../index.php");
        } else if($operacao == "deposito")
            $contaCorrente->deposito();
    }

    function converteParaArray($lista){
        foreach($lista as $vetor)
            return $vetor;
    }
?>