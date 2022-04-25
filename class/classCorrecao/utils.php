<?php

    require_once("PessoaFisicaCorrecao.php");
    require_once("ContaCorrenteCorrecao.php");

    function exibir_como_select($chave, $dados){
        $str = "<option value=0>Escolha</option>";
        foreach($dados as $linha){
            $str .= "<option value='{$linha[$chave[0]]}'>{$linha[$chave[1]]}</option>";
        }
        return $str;
    }

    function lista_pessoa($id){
        $pessoa = new PessoaFisica("", "", "", "");
        $lista = $pessoa->buscar($id);
        return exibir_como_select(array("pf_id", "pf_nome"), $lista);
    }

    function lista_conta_corrente($id){
        try{
            $contaCorrente = new ContaCorrente(1, 1, 1, 1);
        } catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
        $lista = $contaCorrente->buscar($id);
        return exibir_como_select(array("cc_numero", "cc_numero"), $lista);
    }
?>