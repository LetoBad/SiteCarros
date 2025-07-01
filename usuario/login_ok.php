<?php
session_start();
include_once "../class/usuario.class.php";
include_once "../class/usuarioDAO.class.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"] ?? '';
    $senha = $_POST["senha"] ?? '';

    $obj = new usuario();
    $obj->setEmail($email);
    $obj->setSenha($senha);

    $objDAO = new usuarioDAO();
    $retorno = $objDAO->login($obj);

    if ($retorno === 0) {
        header("Location: login.php?erro=Email%20não%20cadastrado");
        exit();
    } elseif ($retorno === 1) {
        header("Location: login.php?erro=Senha%20incorreta");
        exit();
    } else {
        $_SESSION["usuario_logado"] = true;
        $_SESSION["usuario_id"] = $retorno["id"];
        $_SESSION["usuario_nome"] = $retorno["nome"];
        header("Location: ../index.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}