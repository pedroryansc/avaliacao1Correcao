<?php
    class PessoaFisica{
        private $pf_id;
        private $pf_cpf;
        private $pf_nome;
        private $pf_dt_nascimento;

        public function __construct($id, $cpf, $nome, $dtNascimento){
            $this->pf_id = $id;
            $this->pf_cpf = $cpf;
            $this->pf_nome = $nome;
            $this->pf_dt_nascimento = $dtNascimento;
        }

        public function getId(){ return $this->pf_id; }
        public function getCpf(){ return $this->pf_cpf; }
        public function getNome(){ return $this->pf_nome; }
        public function getDtNascimento(){ return $this->pf_dt_nascimento; }

        public function setId($id){
            $this->pf_id = $id;
        }
        public function setCpf($cpf){
            if($cpf != "")
                $this->pf_cpf = $cpf;
            else
                throw new Exception("CPF inválido: $cpf");
        }
        public function setNome($nome){
            if($nome != "")
                $this->pf_nome = $nome;
            else
                throw new Exception("Nome inválido: $nome");    
        }
        public function setDtNascimento($dt_nascimento){
            if($dt_nascimento != "")
                $this->pf_dt_nascimento = $dt_nascimento;
            else
                throw new Exception("Data de nascimento inválida: $dt_nascimento");
        }

        public function buscar($id){
            require_once("../../conf/Conexao.php");
            $query = "SELECT * FROM pessoa_fisica";
            $conexao = Conexao::getInstance();
            if($id > 0){
                $query .= " WHERE pf_id = :id";
                $stmt->bindParam(":id", $id);
            }
            $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
                
                return false;
        }
    }
        /*
        
        $pessoa = new PessoaFisica("", "", "", "");
        $dados = $pessoa->buscar(0);
        var_dump($dados);

        $pessoa = new PessoaFisica(12, "123456", "Marcela Leite", "24/07/1980");
        var_dump($pessoa);

        $pessoa->setCpf("987654");

        echo $pessoa->getNome();
        
        */
?>