<?php
session_start();

include_once "../class/veiculo.class.php";
include_once "../class/veiculoDAO.class.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $placa = $_POST['placa'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];
    $id_categoria = $_POST['id_categoria'];
    $imagem_atual = $_POST['imagem_atual']; // imagem atual guardada no hidden

    $imagem = $imagem_atual; // padrão: manter imagem atual

    // Verificar se enviaram uma nova imagem para upload
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nome_imagem = uniqid() . '.' . $extensao;
        $caminho_destino = '../img/' . $nome_imagem;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_destino)) {
            $imagem = $nome_imagem;

            // Apagar a imagem antiga, se existir e for diferente da nova
            if (!empty($imagem_atual) && file_exists('../img/' . $imagem_atual)) {
                unlink('../img/' . $imagem_atual);
            }
        } else {
            $_SESSION['message'] = "Erro ao fazer upload da nova imagem.";
            $_SESSION['message_type'] = "error";
            header("Location: editar.php?id=" . $id);
            exit();
        }
    }

    $obj = new Veiculo();
    $obj->setId($id);
    $obj->setPlaca($placa);
    $obj->setModelo($modelo);
    $obj->setMarca($marca);
    $obj->setAno($ano);
    $obj->setCor($cor);
    $obj->setIdCategoria($id_categoria);
    $obj->setImagem($imagem);

    $objDAO = new veiculoDAO();
    $retorno = $objDAO->editar($obj);

    if ($retorno) {
        $_SESSION['message'] = "Veículo editado com sucesso!";
        $_SESSION['message_type'] = "success";
        header("Location: ../index.php");
    } else {
        $_SESSION['message'] = "Erro ao editar veículo.";
        $_SESSION['message_type'] = "error";
        header("Location: editar.php?id=" . $id);
    }
    exit();
} else {
    header("Location: ../index.php");
    exit();
}