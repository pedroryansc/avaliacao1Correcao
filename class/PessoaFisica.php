<?php
    class PessoaFisica{
        private $id;
        private $cpf;
        private $nome;
        private $dataNascimento;
        public function __construct($cpfDoc, $nm, $dtNascimento){
            $this->setCPF($cpfDoc);
            $this->setNome($nm);
            $this->setDataNascimento($dtNascimento);
        }
    
    /*
    Resolução da 1ª avaliação:

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

        public function getId(){ return this->pf_id; }
        public function getCpf(){ return this->pf_cpf; }
        public function getNome(){ return this->pf_nome; }
        public function getDtNascimento(){ return this->pf_dt_nascimento; }

        public function setId($id){ this->$pf_id = $id; }
        public function setCpf($cpf){ this->$pf_cpf = $cpf; }
        public function setNome($nome){ this->$pf_nome = $nome; }
        public function setDtNascimento($dt_nascimento){ this->$pf_dt_nascimento = $dt_nascimento; }
    }

    $pessoa = new PessoaFisica(12, "123456", "Marcela Leite", "24/07/1980");
    var_dump($pessoa);

    $pessoa->setCpf("987654");

    echo $pessoa->getNome();
    */
        
        public function inserirPessoaFisica(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("INSERT INTO pessoa_fisica (pf_cpf, pf_nome, pf_dt_nascimento) VALUES(:pf_cpf, :pf_nome, :pf_dt_nascimento)");
            $stmt->bindParam(":pf_cpf", $this->getCPF(), PDO::PARAM_STR);
            $stmt->bindParam(":pf_nome", $this->getNome(), PDO::PARAM_STR);
            $stmt->bindParam(":pf_dt_nascimento", $this->getDataNascimento(), PDO::PARAM_STR);
            return $stmt->execute();
        }

        public function buscar($id){
            require_once("../Conexao.php");
            $query = "SELECT * FROM pessoa_fisica";
            if($id > 0){
                $query .= " WHERE pf_id = :id";
                //"query .= ' ...'" = "$query = $query '...'"
                $stmt->bindParam(":id", $id);
                /*
                    $id no bindParam é um endereço para a variável $id, fazendo com que, quando o valor da variável for atualizado,
                    somente o bindParam seja executado, ao invés da função inteira.
                */
            }
            $stmt = $conexao->prepare($query);
            return $stmt->execute();
            /*
                Caso a última linha acima não der certo:

                ...
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetch();
                
                return false;
            */
        }
    
    /*
    } //Fechando a "class"

        $pessoa = new PessoaFisica("", "", "", "");
        $dados = $pessoa->buscar(0);
        var_dump($dados);
    */

        public function alterarPessoaFisica($id){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("UPDATE pessoa_fisica SET pf_cpf = :pf_cpf, pf_nome = :pf_nome, pf_dt_nascimento = :pf_dt_nascimento WHERE pf_id = $id");
            $stmt->bindParam(":pf_cpf", $this->getCPF(), PDO::PARAM_STR);
            $stmt->bindParam(":pf_nome", $this->getNome(), PDO::PARAM_STR);
            $stmt->bindParam(":pf_dt_nascimento", $this->getDataNascimento(), PDO::PARAM_STR);
            return $stmt->execute();
        }
        public function excluirPessoaFisica($id){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("DELETE from pessoa_fisica WHERE pf_id = $id");
            return $stmt->execute();
        }

        public function getCPF(){
            return $this->cpf;
        }
        public function getNome(){
            return $this->nome;
        }
        public function getDataNascimento(){
            return $this->dataNascimento;
        }
        
        public function setCPF($newCPF){
            $this->cpf = $newCPF;
        }
        public function setNome($newNome){
            $this->nome = $newNome;
        }
        public function setDataNascimento($newDataNascimento){
            $this->dataNascimento = $newDataNascimento;
        }
    }
?>