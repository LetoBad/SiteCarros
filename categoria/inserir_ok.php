<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../usuario/login.php");
    exit();
}

include_once "../class/categoria.class.php";
include_once "../class/categoriaDAO.class.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    
    // Criar objeto categoria
    $categoria = new Categoria();
    $categoria->setNome($nome);
    
    // Inserir no banco
    $categoriaDAO = new categoriaDAO();
    $resultado = $categoriaDAO->inserir($categoria);
    
    if ($resultado) {
        $_SESSION['message'] = "Categoria cadastrada com sucesso!";
        $_SESSION['message_type'] = "success";
        header("Location: ../index.php");
    } else {
        $_SESSION['message'] = "Erro ao cadastrar categoria.";
        $_SESSION['message_type'] = "error";
        header("Location: inserir.php");
    }
} else {
    header("Location: inserir.php");
}
exit();