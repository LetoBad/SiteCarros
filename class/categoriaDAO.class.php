
<?php
include_once "categoria.class.php";
class categoriaDAO{
    private $conexao;
    public function __construct(){
        $this->conexao = new PDO(
            "mysql:host=localhost; dbname=sistema_veiculos",
            "root", ""
        );
    }
    public function inserir(categoria $obj){
        $sql = $this->conexao->prepare(
            "INSERT INTO categoria (nome)
            VALUES (:nome)"
        );
        $sql->bindValue(":nome", $obj->getNome());
        return $sql->execute();
    }
    public function listar(){
        $sql = $this->conexao->prepare(
            "SELECT * FROM categoria");
        $sql->execute();
        return $sql->fetchAll();
    }
        public function retornarUnico($id){
        $sql = $this->conexao->prepare("
            SELECT * FROM categoria WHERE id=:id
        ");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->fetch();
    }
    public function editar(categoria $obj){
        $sql = $this->conexao->prepare(
            "UPDATE categoria SET
            nome=:nome 
            WHERE id=:id"
        );
        $sql->bindValue(":nome", $obj->getNome());
        $sql->bindValue(":id", $obj->getId());
        return $sql->execute();
    }
    public function delete($id){
        $sql = $this->conexao->prepare("
            DELETE FROM categoria WHERE id=:id
        ");
        $sql->bindValue(":id", $id);
        return $sql->execute();
    }

}
