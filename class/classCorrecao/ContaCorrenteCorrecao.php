<?php
    class ContaCorrente{
        private $cc_numero;
        private $cc_saldo;
        private $cc_pf_id;
        private $cc_dt_ultima_alteracao;
        public function __construct($numero, $saldo, $pf_id, $dt_ultima_alteracao){
            $this->setNumero($numero);
            $this->setSaldo($saldo);
            $this->setPessoaFisica($pf_id);
            $this->setDtUltimaAlteracao($dt_ultima_alteracao);
        }
        
        public function getNumero(){ return $this->cc_numero; }
        public function getSaldo(){ return $this->cc_saldo; }
        public function getPessoaFisica(){ return $this->cc_pf_id; }
        public function getDtUltimaAlteracao(){ return $this->cc_dt_ultima_alteracao; }
        
        public function setNumero($numero){
            if($numero <> "" && $numero > 0) //<> = Diferente de (!=)
                $this->cc_numero = $numero;
            else
                throw new Exception("Número de conta inválido: $numero");
        }
        public function setSaldo($saldo){
            if($saldo <> "" && $saldo >= 0)
                $this->cc_saldo = $saldo;
            else
                throw new Exception("Saldo inválido: $saldo");
        }
        public function setPessoaFisica($pf_id){
            if($pf_id > 0)
                $this->cc_pf_id = $pf_id;
            else
                throw new Exception("Pessoa Física inválida: $pf_id");
        }
        public function setDtUltimaAlteracao($dt_ultima_alteracao){
            if($dt_ultima_alteracao <> "")
                $this->cc_dt_ultima_alteracao = $dt_ultima_alteracao;
            else
                throw new Exception("Data de última alteração inválida: $dt_ultima_alteracao");
        }

        public function insere(){
            require_once("../../conf/Conexao.php");
            $query = "INSERT INTO conta_corrente VALUES(:numero, :saldo, :pf_id, :dt_ultima_alteracao)";
            $conexao = Conexao::getInstance();
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(":numero", $this->cc_numero);
            $stmt->bindParam(":saldo", $this->cc_saldo);
            $stmt->bindParam(":pf_id", $this->cc_pf_id);
            $stmt->bindParam(":dt_ultima_alteracao", $this->cc_dt_ultima_alteracao);
            return $stmt->execute();
        }
        public function buscar($id){
            require_once("../../conf/Conexao.php");
            $query = "SELECT * FROM conta_corrente";
            $conexao = Conexao::getInstance();
            if($id > 0){
                $query .= " WHERE cc_pf_id = :id";
                $stmt->bindParam(":id", $id);
            }
            $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
                
                return false;
        }

        /* public function inserirContaCorrente(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("INSERT INTO conta_corrente (cc_numero, cc_saldo, cc_pf_id, cc_dt_ultima_alteracao) 
                                    VALUES(:cc_numero, :cc_saldo, :cc_pf_id, :cc_dt_ultima_alteracao)");
            $stmt->bindParam(":cc_numero", $this->getNumero(), PDO::PARAM_STR);
            $stmt->bindParam(":cc_saldo", $this->getSaldo(), PDO::PARAM_STR);
            $stmt->bindParam(":cc_pf_id", $this->getPessoaFisica(), PDO::PARAM_STR);
            $stmt->bindParam(":cc_dt_ultima_alteracao", $this->getUltAlt(), PDO::PARAM_STR);
            return $stmt->execute();
        }
        public function alterarContaCorrente($id){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("UPDATE conta_corrente 
                                SET cc_numero = :cc_numero, cc_saldo = :cc_saldo, cc_pf_id = :cc_pf_id, cc_dt_ultima_alteracao = :cc_dt_ultima_alteracao 
                                WHERE cc_numero = $id");
            $stmt->bindParam(":cc_numero", $this->getNumero(), PDO::PARAM_STR);
            $stmt->bindParam(":cc_saldo", $this->getSaldo(), PDO::PARAM_STR);
            $stmt->bindParam(":cc_pf_id", $this->getPessoaFisica(), PDO::PARAM_STR);
            $stmt->bindParam(":cc_dt_ultima_alteracao", $this->getUltAlt(), PDO::PARAM_STR);
            return $stmt->execute();
        }
        public function excluirContato($id){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("DELETE from contato WHERE cont_id = $id");
            return $stmt->execute();
        }
        */
    }
?>