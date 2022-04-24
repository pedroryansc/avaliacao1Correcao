<?php
    class Contato{
        private $id;
        private $tipo;
        private $descricao;
        private $pessoaFisica;
        public function __construct($tp, $desc, $pessoaF){
            $this->setTipo($tp);
            $this->setDescricao($desc);
            $this->setPessoaFisica($pessoaF);
        }
        
        public function inserirContato(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("INSERT INTO contatos (cont_tipo, cont_descricao, cont_pf_id) VALUES(:cont_tipo, :cont_descricao, :cont_pf_id)");
            $stmt->bindParam(":cont_tipo", $this->getTipo(), PDO::PARAM_STR);
            $stmt->bindParam(":cont_descricao", $this->getDescricao(), PDO::PARAM_STR);
            $stmt->bindParam(":cont_pf_id", $this->getPessoaFisica(), PDO::PARAM_STR);
            return $stmt->execute();
        }
        public function alterarContato($id){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("UPDATE contatos SET cont_tipo = :cont_tipo, cont_descricao = :cont_descricao, cont_pf_id = :cont_pf_id WHERE cont_id = $id");
            $stmt->bindParam(":cont_tipo", $this->getTipo(), PDO::PARAM_STR);
            $stmt->bindParam(":cont_descricao", $this->getDescricao(), PDO::PARAM_STR);
            $stmt->bindParam(":cont_pf_id", $this->getPessoaFisica(), PDO::PARAM_STR);
            return $stmt->execute();
        }
        public function excluirContato($id){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("DELETE from contatos WHERE cont_id = $id");
            return $stmt->execute();
        }

        public function getTipo(){
            return $this->tipo;
        }
        public function getDescricao(){
            return $this->descricao;
        }
        public function getPessoaFisica(){
            return $this->pessoaFisica;
        }
        
        public function setTipo($newTipo){
            $this->tipo = $newTipo;
        }
        public function setDescricao($newDescricao){
            $this->descricao = $newDescricao;
        }
        public function setPessoaFisica($newPessoaFisica){
            $this->pessoaFisica = $newPessoaFisica;
        }
    }
?>