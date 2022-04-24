<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $obj = isset($_GET["obj"]) ? $_GET["obj"] : "";
    if ($acao == "excluir"){
        if($obj == "pessoaFisica"){
            require_once "class/PessoaFisica.php";
            $pessoaFisica = new PessoaFisica($_POST["cpf"], $_POST["nome"], $_POST["dataNascimento"]);
            $pessoaFisica->excluirPessoaFisica();
            header("location:index.php");
        } else if($obj == "contato"){
            require_once "class/Contatos.php";
            $contato = new Contato($_POST["tipo"], $_POST["descricao"], $_POST["pessoaFisica"]);
            $contato->excluirContato($id);
            header("location:index.php");
        } else if($obj == "contaCorrente"){

        }
    }
    
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "pessoa_fisica"){
        if ($id == 0)
            cadastrarPessoaFisica();
        else
            editarPessoaFisica($id);
    } else if($acao == "contatos"){
        if ($id == 0)
            cadastrarContato();
        else
            editarContato($id);
    } else if($acao == "contaCorrente"){
        if ($id == 0)
            cadastrarContaCorrente();
        else
            editarContaCorrente($id);
    }

    function cadastrarPessoaFisica(){
        require_once "class/PessoaFisica.php";
        $pessoaFisica = new PessoaFisica($_POST["cpf"], $_POST["nome"], $_POST["dataNascimento"]);
        $pessoaFisica->inserirPessoaFisica();
        header("location:index.php");
    }
    function editarPessoaFisica($id){
        require_once "class/PessoaFisica.php";
        $pessoaFisica = new PessoaFisica($_POST["cpf"], $_POST["nome"], $_POST["dataNascimento"]);
        $pessoaFisica->alterarPessoaFisica($id);
        header("location:index.php");
    }

    function cadastrarContato(){
        require_once "class/Contatos.php";
        $contato = new Contato($_POST["tipo"], $_POST["descricao"], $_POST["pessoaFisica"]);
        $contato->inserirContato();
        header("location:index.php");
    }
    function editarContato($id){
        require_once "class/Contatos.php";
        $contato = new Contato($_POST["tipo"], $_POST["descricao"], $_POST["pessoaFisica"]);
        $contato->alterarContato($id);
        header("location:index.php");
    }

    function cadastrarContaCorrente(){
        require_once "class/ContaCorrente.php";
        $contaCorrente = new ContaCorrente($_POST["numero"], $_POST["saldo"], $_POST["pessoaFisica"], $_POST["ultimaAlt"]);
        $contaCorrente->inserirContaCorrente();
        header("location:index.php");
    }
    function editarContaCorrente($id){
        require_once "class/ContaCorrente.php";
        $contaCorrente = new ContaCorrente($_POST["numero"], $_POST["saldo"], $_POST["pessoaFisica"], $_POST["ultimaAlt"]);
        $contaCorrente->alterarContaCorrente($id);
        header("location:index.php");
    }

    function buscarDados($id, $obj){
        if($obj == "pessoaFisica"){    
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query("SELECT * FROM pessoa_fisica WHERE pf_id = $id");
            $dados = array();
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $dados["cpf"] = $linha["pf_cpf"];
                $dados["nome"] = $linha["pf_nome"];
                $dados["dataNascimento"] = $linha["pf_dt_nascimento"];
            }
            return $dados;
        } else if($obj == "contato"){
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query("SELECT * FROM contatos WHERE cont_id = $id");
            $dados = array();
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $dados["tipo"] = $linha["cont_tipo"];
                $dados["descricao"] = $linha["cont_descricao"];
                $dados["pessoaFisica"] = $linha["cont_pf_id"];
            }
            return $dados;
        } else if($obj == "contaCorrente"){
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query("SELECT * FROM conta_corrente WHERE cc_numero = $id");
            $dados = array();
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $dados["tipo"] = $linha["cont_tipo"];
                $dados["descricao"] = $linha["cont_descricao"];
                $dados["pessoaFisica"] = $linha["cont_pf_id"];
            }
        }
    }
?>