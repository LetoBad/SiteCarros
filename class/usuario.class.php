
<?php
    class usuario{
        private $id;
        private $nome;
        private $email;
        private $senha;
        public function getId(){
            return $this->id;
        }
        public function setId($value){
            $this->id=$value;
        }
        public function getNome(){
            return $this->nome;
        }
        public function setNome($value){
            $this->nome=$value;
        }
        public function getEmail(){
            return $this->email;
        }
        public function setEmail($value){
            $this->email=$value;
        }
        
        public function getSenha(){
            return $this->senha;
        }
        public function setSenha($value){
            $this->senha=$value;
        }
    }
?>
