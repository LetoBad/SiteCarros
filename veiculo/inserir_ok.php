<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../usuario/login.php");
    exit();
}

include_once "../class/veiculo.class.php";
include_once "../class/veiculoDAO.class.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $placa = $_POST['placa'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];
    $id_categoria = $_POST['id_categoria'];
    
    // Processar upload da imagem
    $imagem = '';
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nome_imagem = uniqid() . '.' . $extensao;
        $caminho_destino = '../img/' . $nome_imagem;
        
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_destino)) {
            $imagem = $nome_imagem;
        } else {
            $_SESSION['message'] = "Erro ao fazer upload da imagem.";
            $_SESSION['message_type'] = "error";
            header("Location: inserir.php");
            exit();
        }
    }
    
    // Criar objeto veículo
    $veiculo = new Veiculo();
    $veiculo->setPlaca($placa);
    $veiculo->setModelo($modelo);
    $veiculo->setMarca($marca);
    $veiculo->setAno($ano);
    $veiculo->setCor($cor);
    $veiculo->setIdCategoria($id_categoria);
    $veiculo->setImagem($imagem);
    
    // Inserir no banco
    $veiculoDAO = new veiculoDAO();
    $resultado = $veiculoDAO->inserir($veiculo);
    
    if ($resultado) {
        $_SESSION['message'] = "Veículo cadastrado com sucesso!";
        $_SESSION['message_type'] = "success";
        header("Location: ../index.php");
    } else {
        $_SESSION['message'] = "Erro ao cadastrar veículo.";
        $_SESSION['message_type'] = "error";
        header("Location: inserir.php");
    }
} else {
    header("Location: inserir.php");
}
exit();