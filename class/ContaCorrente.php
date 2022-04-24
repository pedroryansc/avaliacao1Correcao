<?php
    class ContaCorrente{
        private $numero;
        private $saldo;
        private $pessoaFisica;
        private $ultimaAlt;
        public function __construct($num, $sld, $pessoaF, $ultAlt){
            $this->setNumero($num);
            $this->setSaldo($sld);
            $this->setPessoaFisica($pessoaF);
            $this->setUltAlt($ultAlt);
        }
        
        public function inserirContaCorrente(){
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

        public function getNumero(){
            return $this->numero;
        }
        public function getSaldo(){
            return $this->saldo;
        }
        public function getPessoaFisica(){
            return $this->pessoaFisica;
        }
        public function getUltAlt(){
            return $this->ultimaAlt;
        }
        
        public function setNumero($newNumero){
            $this->numero = $newNumero;
        }
        public function setSaldo($newSaldo){
            $this->saldo = $newSaldo;
        }
        public function setPessoaFisica($newPessoaFisica){
            $this->pessoaFisica = $newPessoaFisica;
        }
        public function setUltAlt($newUltAlt){
            $this->ultimaAlt = $newUltAlt;
        }
    }
?>