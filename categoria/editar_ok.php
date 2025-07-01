
<?php
session_start();

include_once "../class/categoria.class.php";
include_once "../class/categoriaDAO.class.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST["id"];
    $nome = $_POST["nome"];

    $obj = new Categoria();
    $obj->setId($id);
    $obj->setNome($nome);

    $objDAO = new categoriaDAO();
    $retorno = $objDAO->editar($obj);

    if ($retorno) {
        $_SESSION['message'] = "Categoria editada com sucesso!";
        $_SESSION['message_type'] = "success";
        header("Location: ../index.php");
    } else {
        $_SESSION['message'] = "Erro ao editar categoria.";
        $_SESSION['message_type'] = "error";
        header("Location: editar.php?id=" . $id);
    }
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
