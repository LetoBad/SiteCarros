<?php
    class veiculo{
        private $id;
        private $placa;
        private $cor;
        private $modelo;
        private $marca;
        private $ano;
        private $id_categoria;
        private $imagem;
        public function getId(){
            return $this->id;
        }
        public function setId($value){
            $this->id = $value;
        }
        public function getPlaca(){
            return $this->placa;
        }
        public function setPlaca($value){
            $this->placa = $value;
        }
        public function getCor(){
            return $this->cor;
        }
        public function setCor($value){
            $this->cor = $value;
        }
        public function getModelo(){
            return $this->modelo;
        }
        public function setModelo($value){
            $this->modelo = $value;
        }
        public function getMarca(){
            return $this->marca;
        }
        public function setMarca($value){
            $this->marca = $value;
        }
        public function getAno(){
            return $this->ano;
        }
        public function setAno($value){
            $this->ano = $value;
        }
        public function getIdCategoria(){
            return $this->id_categoria;
        }
        public function setIdCategoria($value){
            $this->id_categoria = $value;
        }
        public function getImagem(){
            return $this->imagem;
        }
        public function setImagem($value){
            $this->imagem = $value;
        }
    }
?>